<?php
class AHDbTable extends HTable{
	
	protected static function displayValue(&$field,&$value,&$obj,$escape=true){
		$attributes=array();
		
		if($value===NULL){ $value='<i>NULL</i>'; $escape=false; }
		
		echo HHtml::tag('td',$attributes,$value,$escape);
	}
}
