<?php
class ACSqlDbTable extends CModelTable{
	public static function create($query,$tablename='',$dbSchema=null){
		return new ACSqlDbTable($query,$tablename,$dbSchema);
	}
	
	private $dbSchema,$tablename,$primaryKeys;
	
	public function __construct($query,$tablename='',$dbSchema=null){
		parent::__construct($query);
		$this->dbSchema=$dbSchema;
		$this->tablename=$tablename;
		//$this->export=array('csv,xls','',$tablename);
	}
	public function isExportable(){ return false; }
	public function isFiltersAllowed(){ return false; }
	public function isOrderAllowed(){ return false; }
	/*
	
	public function __construct($query,$tablename='',$dbSchema=null){
		$this->query=&$query;
		$this->dbSchema=&$dbSchema;
		$this->tablename=&$tablename;
		$this->export=array('csv,xls','',$tablename);
	}
	public function execute($exportOutput=null){
		if($this->executed===true) return; $this->executed=true;
		if(/*$this->export!==false && *//*isset($_GET['export']) ? true : false){
			ob_clean();
			AHSqlTable::export($_GET['export'],$this,$fields,$exportOutput,$this->tablename,isset($this->export[2])?$this->export[2]:null);
			if($exportOutput!==null) return; else exit;
		}
		
		$this->pagination=CPagination::create($this->query)->pageSize(25)->execute($this);
		$this->totalResults=$this->pagination->getTotalResults();
		$this->results=$this->pagination->getResults();
		if($this->filter === 0 && $this->filter && empty($_POST)) $this->filter=false;
		
		if($this->pagination->getTotalResults() !== 0 || $this->filter){
			$this->_setFields(null,null);
		}
	}
	
	
	public function _setFields($fields,$fromQuery,$export=false){
		$this->fields=array();
		$fields=$this->query->getFields();
		if(empty($fields)) return;
		foreach($fields as $key=>$val){
			$this->fields[]=array('title'=>$val['name'],'escape'=>$val['type']==='string','type'=>$val['type']);
		}
	}
	*/
	
	public function getPrimaryKeys(){
		if($this->primaryKeys===null) $this->primaryKeys=$this->dbSchema->getPrimaryKeys();
		return $this->primaryKeys;
	}
	public function getPrimaryKey(){
		return $this->primaryKeys[0];
	}
	
	public function _setFields($export=false){
		$this->fields=array();
		$fields=$this->query->getFields();
		if(empty($fields)) return;
		foreach($fields as $key=>$val){
			$this->fields[]=array('title'=>$val['name'],'escape'=>$val['type']==='string','type'=>$val['type']);
		}
	}
}
