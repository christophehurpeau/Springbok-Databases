<?php new AjaxBaseView($layout_title) ?>
<header>
	<div id="logo">{icon sb}Springbok <b>Database</b></div>
	<?php $links=array(_tC('Home')=>false);
	foreach(Server::findListName() as $id=>$name) $links[$name]=array('url'=>array('/:id',$id),'current'=>isset($server) && $server->id==$id);
	$links['Doc']='/mysqldoc';
	echo HMenu::top($links) ?>
	<br class="clear"/>
</header>
{=$layout_content}
<footer>Version du <b><? HHtml::enhanceDate() ?></b> | <? HHtml::powered() ?></footer>