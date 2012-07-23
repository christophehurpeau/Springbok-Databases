<?php new AjaxContentView($layout_title,'serverPage','server') ?>
{menuTop 'startsWith':true
	_t('View'):array($server->linktable($dbname,$tablename),'startsWith'=>false),
	_t('Structure'):array($server->linktable($dbname,$tablename,'structure')),
	_t('Insert'):array($server->linktable($dbname,$tablename,'insert')),
	_t('PhpCode'):array($server->linktable($dbname,$tablename,'phpcode')),
	_t('Export'):array($server->linktable($dbname,$tablename,'export')),
}

<div class="clear">
{=$layout_content}
</div>