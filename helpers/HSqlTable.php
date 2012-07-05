<?php
class AHSqlTable extends AHDbTable{
	private static $url,$qsql;
	
	public static function table($component,$url=null,QSql $qsql=null){
		/* DEV */if(!($component instanceof ACSqlDbTable)) throw new Exception('Your component must be an instance of ACSqlDbTable'); /* /DEV */
		self::$url=&$url; self::$qsql=&$qsql;
		parent::table($component);
		if($component->getTotalResults() !=0) $fields=array_map(function(&$field){return $field['name'];},$qsql->getFields());
		//debugVar($qsql->getFields());
	}
	
	protected static function displayResults(&$component,&$results){
		$pkName=count($primaryKeys=$component->getPrimaryKeys())===1?$primaryKeys:false;
		$fieldsNameList=array_map(function(&$field){return $field['name'];},self::$qsql->getFields());
		$iTrRow=0;
		foreach($results as $key=>&$row){
			echo '<tr'.($iTrRow++%2 ? ' class="alternate"' : '');
			//array('/database/:dbid/:dbname/:action/*',$database->id,$dbname,'table','/'.$tablename)
			if($pkName!==false){
				$url=self::$url;
				$iRow=array_search($pkName,$fieldsNameList);
				$url[4].=$row[$iRow];
				//echo ' class="pointer" onclick="S.redirect(\''.HHtml::urlEscape($url).'\')"';
			}else $iRow=-1;
			echo ' data-pksurl="';
			$values=array();
			if($primaryKeys) foreach($primaryKeys as $pk) $values[]=$pk.'='.$row[array_search($pk,$fieldsNameList)];
			else foreach($component->fields as $i=>$field) $values[]=$field['title'].'='.$row[$i];
			echo h(implode('&',$values)).'">';
			
			foreach($component->fields as $i=>$field){
				//$value=$row[$field['title']];
				$escape=true;
				$value=$row[$i];
				if($i===$iRow){
					$value='<a href="'.HHtml::urlEscape($url).'">'.$value.'</a>';
					$escape=false;
				}
				self::displayValue($field,$value,$model,$escape);
			}
			echo '</tr>';
		}
	}
	
	public static function getValueFromModel(&$row,&$field,&$i){
		return $row[$i];
	}
	
}
