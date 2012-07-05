<?php $v=new View(_t('Servers'),'server') ?>

<div class="float_left w200 content">
<h5>{t 'Databases:'}</h5>
<nav class="left">
	<ul>
	{f $db->getDatabases() as $name}
		<li>{link $name,$server->linkdb($name)}</li>
	{/f}
	</ul>
</nav>
</div>

<div class="float_left w200 content noclear ml10">
	<h5>{t 'New database'}</h5>
	<?php $form=HForm::create(NULL,array('action'=>$server->link('createdb')),false,false) ?>
	{=$form->input('name')}
	{=$form->end(_tC('Add'))}
</div>

<br class="clear"/>
