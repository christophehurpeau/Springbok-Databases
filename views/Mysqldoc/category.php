<?php $v=new AjaxContentView($categ->name,'mysqldoc') ?>

<ul>
	{f $categ->topics as $topic}
	<li><? HHtml::link($topic->name,'/mysqldoc/topic/'.$topic->help_topic_id) ?></li>
	{/f}
</ul>