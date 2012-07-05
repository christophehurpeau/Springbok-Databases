<!DOCTYPE html>
<html>
	<head>
		<? HHtml::metaCharset() ?>
		<title>{$layout_title}</title>
		<!--[if lt IE 9]><?php HHtml::jsLink('/ie-lt9') ?><![endif]-->
		<?php HHtml::cssLink(); HHtml::jsLink(); HHtml::jsI18n() ?>
		<? HHtml::favicon() ?>
	</head>
	<body>
		{=$layout_content}
	</body>
</html>