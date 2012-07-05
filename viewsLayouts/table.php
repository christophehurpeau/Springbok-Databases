<?php new AjaxContentView($layout_title,'serverPage','server') ?>
{menuTop 'startsWith':true
	_t('View'):array('url'=>$server->linktable($dbname,$tablename),'startsWith'=>false),
	_t('Structure'):array('url'=>$server->linktable($dbname,$tablename,'structure')),
	_t('Insert'):array('url'=>$server->linktable($dbname,$tablename,'insert')),
	_t('PhpCode'):array('url'=>$server->linktable($dbname,$tablename,'phpcode')),
	_t('Export'):array('url'=>$server->linktable($dbname,$tablename,'export')),
}

<div class="clear">
{=$layout_content}
</div>