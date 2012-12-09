<? HHtml::doctype() ?>
<html>
	<head>
		<? HHtml::metaCharset() ?>
		<title>{$layout_title}</title>
		<?php HHtml::cssLink(); HHtml::jsLink(); HHtml::jsI18n() ?>
		<? HHtml::favicon() ?>
	</head>
	<body>
		{=$layout_content}
	</body>
</html>