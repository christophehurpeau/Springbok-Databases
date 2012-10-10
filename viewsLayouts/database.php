<?php new AjaxContentView($layout_title,'serverPage','database_'.$server->id.'_'.$dbname) ?>
{menuTop 'startsWith':true
	_t('View'):array($server->linkdb($dbname),'startsWith'=>false),
	_t('Tables'):array($server->linkdb($dbname,'tables')),
	_t('SQL'):array($server->linkdb($dbname,'sql')),
	_t('Triggers'):array($server->linkdb($dbname,'triggers')),
	_t('Export'):array($server->linkdb($dbname,'export')),
}

<div class="clear">
{=$layout_content}
</div>