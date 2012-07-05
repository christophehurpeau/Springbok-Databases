<?php $v=new AjaxContentView($topic->name,'mysqldoc') ?>

<i><? HHtml::link($topic->url) ?></i><br />
<br />
<pre>{$topic->description}</pre>