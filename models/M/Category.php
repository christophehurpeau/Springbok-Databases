<?php
/** @Db('mysql') @Generate('mysql') @TableName('help_category') @TableAlias('c') */
class EMCategory extends SSqlModel{
	use BTree;
	
	public
		/** @Pk */ $help_category_id,
		/** */ $name,
		/** */ $parent_category_id,
		/** */ $url;
	public $children;
	
	public $hasMany=array('Topic'=>array('modelName'=>'EMTopic'));
}
