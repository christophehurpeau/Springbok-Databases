<?php
class TableController extends AController{
	/**
	* id > @Required
	* dbname > @Required
	* tablename > @Required 
	*/ function view(int $id,$dbname,$tablename,$sql){
		/*self::db_init($dbid,$dbname);
		EmptyModel::init(self::$db_instance,$tablename);
		$table=CTable::create(EmptyModel::QAll());
		$table->translateField=false;
		$table->filter=true;
		self::set('table',$table);
		self::mset($tablename);
		self::render();*/
		
		/*if(!CHttpRequest::isAjax()) redirect(array('/database/:dbid/:dbname/:action/*',$dbid,$dbname,'table','/'.$tablename));*/
		self::db_init($id,$dbname,$tablename);
		if($sql===NULL) $sql='SELECT * FROM '.$tablename;
		mset($sql);
		try{
			$sql=new QSql(self::$db_instance,$sql);
			set('qsql',$sql);
			if($sql->isSelect()){
				$dbSchema=DBSchema::get(self::$db_instance,$tablename);
				$table=ACSqlDbTable::create($sql,$tablename,$dbSchema);
				set('table',$table);
			}else set('result',$sql->execute());
		}catch(DBException $ex){
			set('ex',$ex);
		}
		render();
	}
	
	
	
	
	/** */
	function details($pkValue,int $id,$dbname,$tablename,$sql){
		self::db_init($dbid,$dbname,$tablename);
		self::mset($pkValue);
		
		$dbSchema=DBSchema::get(self::$db_instance,$tablename);
		$pks=$dbSchema->getPrimaryKeys();
		$bT=$dbSchema->getForeignKeys();
		$hM=$dbSchema->getHasManyForeignKeys();
		
		$row=self::$db_instance->doSelectRow('SELECT * FROM '.self::$db_instance->formatTable($tablename).' WHERE '.self::$db_instance->formatField($pks[0]).'='.self::$db_instance->escape($pkValue));
		
		$belongsTo=$hasMany=array();
		
		foreach($bT as $fk){
			$belongsTo[$fk['referenced_table']]=self::$db_instance->doSelectRow('SELECT * FROM '
				.self::$db_instance->formatTable($fk['referenced_table']).' WHERE '.self::$db_instance->formatField($fk['referenced_column']).'='.self::$db_instance->escape($row[$fk['column']]));
		}
		foreach($hM as $fk){
			$query='FROM '.self::$db_instance->formatTable($fk['tableName']).' WHERE '.self::$db_instance->formatField($fk['column']).'='.self::$db_instance->escape($row[$fk['referenced_column']]);
			$count=self::$db_instance->doSelectValue('SELECT count(*) '.$query);
			$results=$count==0 || $count > 8 ? null : self::$db_instance->doSelectRows('SELECT * '.$query); 
			$hasMany[$fk['tableName']]=array('count'=>$count,'results'=>$results);
		}
		
		mset($row,$belongsTo,$hasMany);
		render();
	}
	
	/** */
	function structure(int $id,$dbname,$tablename){
		self::db_init($id,$dbname,$tablename);
		$dbSchema=DBSchema::get(self::$db_instance,$tablename);
		$columns=$dbSchema->getColumns(); //self::$db_instance->getColumns($tablename);
		$indexes=$dbSchema->getIndexes(); //self::$db_instance->getIndexes($tablename);
		self::mset($columns,$indexes);
		self::render();
	}
	
	
	/** */
	function insert(int $id,$dbname,$tablename){
		self::db_init($id,$dbname,$tablename);
		
		if(!empty($_POST)){
			$data=&$_POST[$tablename];
			foreach($data as &$val){
				if($val['null']) $val=null;
				elseif($val['function']) $val=array($val['function']);
				else $val=$val['val'];
			}
			debug($data);
		}
		
		$dbSchema=DBSchema::get(self::$db_instance,$tablename);
		$columns=$dbSchema->getColumns(); //self::$db_instance->getColumns($tablename);
		
		mset($columns,$indexes);
		render();
	}
	
	/** */
	function phpcode(int $id,$dbname,$tablename){
		self::db_init($id,$dbname,$tablename);
		$dbSchema=DBSchema::get(self::$db_instance,$tablename);
		$columns=$dbSchema->getColumns(); // $columns=self::$db_instance->getColumns($tablename);
		$pks=$dbSchema->getPrimaryKeys(); //self::$db_instance->getPrimaryKeys($tablename);
		$phpcode="/** @TableAlias() */\nclass ".UInflector::camelize(UInflector::singularizeUnderscoredWords($tablename))." extends SSqlModel{\n"
			."\tpublic\n";
		foreach($columns as $col)
			$phpcode.="\t\t/** ".(in_array($col['name'],$pks)?'@Pk ':'').($col['autoincrement']?'@AutoIncrement ':'')."@SqlType('".$col['type']."') @".($col['notnull']?'Not':'')."Null ".($col['default']||$col['default']==='0'?"@Default(".$col['default'].")":'').($col['comment']?" @Comment(".UPhp::exportString($col['comment']).")":'')."\n"
				."\t\t*/ \$".$col['name'].",\n";
		$phpcode=substr(rtrim($phpcode),0,-1).';'.PHP_EOL;
		$phpcode.='}';
		self::mset($phpcode);
		self::render();
	}
	
	/** */
	function export(int $id,$dbname,$tablename){
		self::db_init($id,$dbname,$tablename);
		if(CHttpRequest::isPOST()){
			UExec::exec('mysqldump -h '.escapeshellarg(self::$server->host).' --port='.self::$server->port
				.' -u '.escapeshellarg(self::$server->user).' --password='.escapeshellarg(self::$server->password())
				.' '.escapeshellarg($dbname).' '.escapeshellarg($tablename).' > '.escapeshellarg(Config::$export_dir.date('Y-m-d_H:i').'-'.$tablename.'.sql'));
			redirect(self::$server->linktable($dbname,$tablename));
		}else{
			self::render();
		}
	}
}