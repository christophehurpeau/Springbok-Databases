<?php $v=new AjaxPageDynamicTabsView($layout_title); ?>
<div class="fixed left w200">
	<div class="center"><? HHtml::select($db->getDatabases(),array(
		'onchange'=>"S.redirect('".HHtml::url(array('/:id',$server->id))."-'+\$(this).find(':selected').text());",
		'selectedText'=>$dbname)) ?></div>

	<?php $action=CRoute::getAction(); if($action!=='structure') $action=null; ?>
	<nav class="left">
		<ul>
		{f $db->getTables() as $table}
			<li>{link $table,$server->linktable($dbname,$table,$action)}</li>
		{/f}
		</ul>
	</nav>
</div>
<div class="variable padding"><h1>{$layout_title}</h1>{=$layout_content}</div>