<?php
/** @Db('mysql') @Generate('mysql') @TableName('help_topic') @TableAlias('t') */
class EMTopic extends SSqlModel{
	public
		/** @Pk @SqlType('int(10) unsigned') @NotNull 
		 */ $help_topic_id,
		/** @SqlType('char(64)') @NotNull 
		 */ $name,
		/** @SqlType('smallint(5) unsigned') @NotNull 
		 */ $help_category_id,
		/** @SqlType('text') @NotNull 
		 */ $description,
		/** @SqlType('text') @NotNull 
		 */ $example,
		/** @SqlType('char(128)') @NotNull 
		 */ $url;
}
