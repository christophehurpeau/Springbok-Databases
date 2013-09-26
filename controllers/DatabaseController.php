<?php
class DatabaseController extends AController{
	/** @Id @NotEmpty('dbname') */
	static function view(int $id,$dbname){
		self::db_init($id,$dbname);
		self::render();
	}
	
	
	/** @Id @NotEmpty('dbname') */
	static function tables(int $id,$dbname){
		self::db_init($id,$dbname);
		set('tables',self::$db_instance->doSelectRows('SHOW TABLE STATUS'));
		self::render();
	}
	
	
	/** @Id @NotEmpty('dbname') */
	static function sql(int $id,$dbname,$sql){
		self::db_init($id,$dbname);
		mset($sql);
		if(!empty($sql)){
			try{
				$qsql=new QSql(self::$db_instance,$sql);
				mset($qsql);
				if($qsql->isSelect()){
					$dbSchema=DBSchema::get(self::$db_instance,$tablename);
					$table=ACSqlDbTable::create($qsql,$tablename,$dbSchema);
					set('table',$table);
				}else set('result',$qsql->execute());
			}catch(DBException $ex){
				set('ex',$ex);
			}
		}
		self::render();
	}
	
	
	/** */
	static function del_table($tablename,int $id,$dbname){
		self::db_init($id,$dbname);
		self::$db_instance->doUpdate('DROP TABLE `'.$tablename.'`');
		redirect(self::$server->linkdb($dbname,'tables'));
	}
	
	/** */
	static function triggers(int $id,$dbname){
		self::db_init($id,$dbname);
		set('triggers',self::$db_instance->doSelectRows('SHOW TRIGGERS'));
		self::render();
	}
	
	/** */
	static function del_trigger($triggername,int $id,$dbname){
		self::db_init($id,$dbname);
		self::$db_instance->doUpdate('DROP TRIGGER `'.$triggername.'`');
		redirect(self::$server->linkdb($dbname,'triggers'));
	}
	
	/**
	 * tables > @Type(array[])
	*/
	static function export(int $id,$dbname,$tables,bool $echo){
		self::db_init($id,$dbname);
		if(isset($_GET['echo'])){
			UExec::exec('mysqldump -h '.escapeshellarg(self::$server->host).' --port='.self::$server->port
				.' -u '.escapeshellarg(self::$server->user).' --password='.escapeshellarg(self::$server->password())
				.' '.escapeshellarg($dbname).(empty($tables)?'':implode(',',$tables)).' > '.escapeshellarg($filenameexport=(Config::$export_dir.date('Y-m-d_H:i').'-'.$dbname.'.sql')));
			if($echo){
				set('result',file_get_contents($filenameexport));
				render('export_result');
			}else redirect(self::$server->linkdb($dbname));
		}else{
			self::render();
		}
	}
	
}