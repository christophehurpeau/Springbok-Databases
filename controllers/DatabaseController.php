<?php
class DatabaseController extends AController{
	/**
	* id > @Required
	* dbname > @Required
	*/ function view(int $id,$dbname){
		self::db_init($id,$dbname);
		self::render();
	}
	
	
	/**
	* id > @Required
	* dbname > @Required
	*/ function tables(int $id,$dbname){
		self::db_init($id,$dbname);
		set('tables',self::$db_instance->doSelectRows('SHOW TABLE STATUS'));
		self::render();
	}
	
	/** */
	function del_table($tablename,int $id,$dbname){
		self::db_init($id,$dbname);
		self::$db_instance->doUpdate('DROP TABLE `'.$tablename.'`');
		redirect(self::$server->linkdb($dbname,'tables'));
	}
	
	/** */
	function triggers(int $id,$dbname){
		self::db_init($id,$dbname);
		set('triggers',self::$db_instance->doSelectRows('SHOW TRIGGERS'));
		self::render();
	}
	
	/** */
	function del_trigger($triggername,int $id,$dbname){
		self::db_init($id,$dbname);
		self::$db_instance->doUpdate('DROP TRIGGER `'.$triggername.'`');
		redirect(self::$server->linkdb($dbname,'triggers'));
	}
	
	/**
	 * tables > @Type(array[])
	*/
	function export(int $id,$dbname,$tables){
		self::db_init($id,$dbname);
		if(CHttpRequest::isPOST()){
			UExec::exec('mysqldump -h '.escapeshellarg(self::$server->host).' --port='.self::$server->port
				.' -u '.escapeshellarg(self::$server->user).' --password='.escapeshellarg(self::$server->password())
				.' '.escapeshellarg($dbname).(empty($tables)?'':implode(',',$tables)).' > '.escapeshellarg(Config::$export_dir.date('Y-m-d_H:i').'-'.$dbname.'.sql'));
			redirect(self::$server->linkdb($dbname));
		}else{
			self::render();
		}
	}
	
}