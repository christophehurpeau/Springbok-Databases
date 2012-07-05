<?php
/** @TableAlias('s') */
class Server extends SSqlModel{
	public
		/** @Pk @AutoIncrement @SqlType('INTEGER') @NotNull
		 */ $id,
		/** @SqlType('VARCHAR(255)') @NotNull
		 */ $name,
		/** @SqlType('VARCHAR(255)') @NotNull @Default('localhost')
		 */ $host,
		/** @SqlType('INTEGER') @NotNull @Default(3306)
		 */ $port,
		/** @SqlType('VARCHAR(255)') @NotNull @Default('root')
		 */ $user,
		/** @SqlType('VARCHAR(255)') @NotNull @Default('root')
		 */ $password;
	
	public function link($action=null,$more=false){
		if($action==null) return array('/:id',$this->id);
		return array('/:id/:action/*',$this->id,$action,$more===false?'':'/'.$more);
	}
	
	public function linkdb($dbname,$action=null,$more=false){
		if($action==null) return array('/:id-:dbname',$this->id,$dbname);
		return array('/:id-:dbname/:action/*',$this->id,$dbname,$action,$more===false?'':'/'.$more);
	}
	
	public function linktable($dbname,$tablename,$action=null,$more=false){
		if($action==null) return array('/:id-:dbname/table/:tablename',$this->id,$dbname,$tablename);
		return array('/:id-:dbname/table/:tablename/:action/*',$this->id,$dbname,$tablename,$action,$more===false?'':'/'.$more);
	}
	
	public function beforeSave(){
		if(!empty($this->password)) $this->password=USecure::encryptAES($this->password);
		return parent::beforeSave();
	}
	
	public function password(){
		return USecure::decryptAES($this->password);
	}
}