<?php
class AController extends Controller{
	protected static $server,$db_instance;
	
	protected static function db_init($dbId,$dbName=null,$tablename=null){
		if(empty($dbId)) self::redirect('/');
		self::$server=Server::ById($dbId);
		notFoundIfFalse(self::$server);
		if(empty($dbName)){
			$dbName=CSession::getOr('dbname_'.$dbId);
			if(empty($dbName)) $dbName='mysql';
		}else CSession::set('dbname_'.$dbId,$dbName);
		self::$db_instance=DB::init('db_'.$dbId,array(
			'type'=>'MySQL',
			'host'=>'p:'.self::$server->host,
			'port'=>self::$server->port,
			'user'=>self::$server->user,
			'password'=>USecure::decryptAES(self::$server->password),
			'dbname'=>$dbName
		));
		self::setForLayoutAndView('server',self::$server);
		self::setForLayoutAndView('db',self::$db_instance);
		self::setForLayoutAndView('dbname',$dbName);
		self::setForLayoutAndView('tablename',$tablename);
	}
}
