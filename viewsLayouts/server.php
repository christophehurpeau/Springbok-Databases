<?php new AjaxContentView($layout_title,'serverPage','server') ?>
{menuTop 'startsWith':true
	_tC('Home'):array('url'=>$server->link(),'startsWith'=>false),
	_t('Process'):array('url'=>$server->link('processlist')),
	_t('Inno DB Status'):array('url'=>$server->link('innodbStatus')),
	_t('Users'):array('url'=>$server->link('users')),
}

<div class="clear">
{=$layout_content}
</div>