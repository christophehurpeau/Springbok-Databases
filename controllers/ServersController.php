<?php
class ServersController extends AController{
	/** */
	function index(){
		redirect('/');
	}
	
	/** @ValidParams
	* server > @Required
	* server > @Valid('name')
	*/ function add(Server $server){
		$server->insert();
		redirect('/servers/edit/'.$server->id);
	}
	
	
	/** @ValidParams('/')
	* id > @Required
	*/ function edit(int $id){
		CRUD::edit('Server',$id);
	}
	
	/** @ValidParams('/')
	* id > @Required
	*/ function view(int $id){
		self::db_init($id);
		self::render();
	}
	
	/** @ValidParams('/')
	* id > @Required
	* name > @Required
	*/ function createdb(int $id,$name){
		self::db_init($id);
		self::$db_instance->doUpdate('CREATE DATABASE IF NOT EXISTS `'.$name.'` DEFAULT CHARACTER SET=utf8 COLLATE utf8_general_ci');
		redirect(self::$server->linkdb($name));
	}
	
	/** @ValidParams('/')
	* id > @Required
	*/ function processlist(int $id){
		self::db_init($id);
		set('processlist',self::$db_instance->doSelectRows('SHOW FULL PROCESSLIST'));
		render();
	}
	
	/** @ValidParams('/')
	* id > @Required
	*/ function innodbStatus(int $id){
		self::db_init($id);
		$row=self::$db_instance->doSelectRow('SHOW ENGINE INNODB STATUS');
		set('status',$row['Status']);
		render();
	}
	
	/** @ValidParams('/')
	* threadId > @Required 
	* id > @Required
	*/ function killprocess(int $threadId,int $id){
		self::db_init($id);
		try{
			$res=self::$db_instance->doUpdate('KILL '.$threadId);
		}catch(DBException $ex){
			$res=$ex->getMessage();
		}
		CSession::setFlash($res);
		redirect(self::$server->link('processlist'));
	}
	
	/** @ValidParams('/')
	* id > @Required
	*/ function users(int $id){
		self::db_init($id);
		set('users',self::$db_instance->doSelectRows('SELECT * FROM mysql.user'));
		render();
	}
	
}