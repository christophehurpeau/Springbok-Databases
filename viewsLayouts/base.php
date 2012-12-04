<? HHtml::doctype() ?>
<html>
	<head>
		<? HHtml::metaCharset() ?>
		<title>{$layout_title}</title>
		<? HHtml::jsCompat() ?>
		<?php HHtml::cssLink(); HHtml::jsLink(); HHtml::jsI18n() ?>
		<? HHtml::favicon() ?>
	</head>
	<body>
		{=$layout_content}
	</body>
</html>