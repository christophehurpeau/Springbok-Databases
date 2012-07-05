<?php
class MysqldocController extends Controller{
	public static function beforeRender(){
		self::setForLayout('categories',EMCategory::generateSimpleTreeList(NULL,'parent_category_id'));
		return true;
	}
	
	/** */
	function index(){
		self::render();
	}
	
	/** @ValidParams
	 * id > @Required
	 */
	function category(int $id){
		$categ=EMCategory::findOneByHelp_category_id($id);
		if(empty($categ)) notFound();
		$categ->findWith('Topic',array('fields'=>'help_topic_id,name'));
		self::mset($categ);
		self::render();
	}
	
	/** */
	function topic(int $id){
		$topic=EMTopic::findOneByHelp_topic_id($id);
		if(empty($topic)) notFound();
		self::mset($topic);
		self::render();
	}
}
