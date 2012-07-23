<?php new AjaxContentView($layout_title,'serverPage','server') ?>
{menuTop 'startsWith':true
	_tC('Home'):array($server->link(),'startsWith'=>false),
	_t('Process'):array($server->link('processlist')),
	_t('Inno DB Status'):array($server->link('innodbStatus')),
	_t('Users'):array($server->link('users')),
}

<div class="clear">
{=$layout_content}
</div>