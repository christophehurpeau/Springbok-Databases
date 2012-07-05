<?php new AjaxContentView($layout_title,'serverPage','database_'.$server->id.'_'.$dbname) ?>
{menuTop 'startsWith':true
	_t('View'):array('url'=>$server->linkdb($dbname),'startsWith'=>false),
	_t('Tables'):array('url'=>$server->linkdb($dbname,'tables')),
	_t('Triggers'):array('url'=>$server->linkdb($dbname,'triggers')),
	_t('Export'):array('url'=>$server->linkdb($dbname,'export')),
}

<div class="clear">
{=$layout_content}
</div>