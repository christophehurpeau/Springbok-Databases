<?php $v=new AjaxContentView(_t('Table:').' '.$tablename.' - Structure','table') ?>

<div class="content">
	<?php $form=HForm::create(NULL,array('id'=>'formInsert'.$tablename),'div',array('setValuesFromVar'=>false));
		echo $form->fieldsetStart(_tC('Insert'));
		foreach($modelName::$__PROP_DEF as $name=>$def){
			$infos=$modelName::$__modelInfos['columns'][$name];
			if(! $infos['autoincrement'] && !in_array($name,array('created','updated'))){
				/*if($infos['notnull']===false){
					$attr=array('id'=>'checkboxCRUD'.$modelName.$name);
					if($this->_getValue($name)===null) $attr['checked']=true;
					echo $this->checkbox($name,'NULL',$attr);
				}*/
				//foreach($data as $key=>&$val) if($val===null) $val='NULL';
				if(substr($name,-3)==='_id' && Controller::_isset($vname=UInflector::pluralize(substr($name,0,-3))))
					echo $this->select($name,Controller::get($vname));
				elseif($def['type']==='boolean'){
					$attrs=$attributes;
					if($this->_getValue($name)==='') $attrs['checked']=true;
					echo $this->hidden($name,'').$this->checkbox($name,_tF($modelName,$name),$attrs,$containerAttributes);
				}elseif(isset($def['annotations']['Enum'])) echo $this->select($name,call_user_func(array($modelName,$def['annotations']['Enum'].'List')),$attributes,$containerAttributes);
				elseif(isset($def['annotations']['Text'])) echo $this->textarea($name,$attributes,$containerAttributes);
				else echo $this->input($name,$attributes,$containerAttributes);
			}
		}
		echo $form->end();
	?>
</div>