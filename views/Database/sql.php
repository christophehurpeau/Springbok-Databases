<?php $v=new View(_t('SQL'),'database') ?>

<div class="content dbsqlcode">
<?php $form=HForm::create(NULL,array('rel'=>'content')) ?>
<textarea id="sqlcode<? $id=time() ?>" name="sql" rows="30">{$sql}</textarea>
<? $form->end(_t('Execute')) ?>
<?php HHtml::jsInlineStart() ?>
var sqleditor=false;
$(document).ready(function(){
	if(sqleditor!==false) return;
	sqleditor=CodeMirror.fromTextArea(document.getElementById("sqlcode<? $id ?>"),{
		lineNumbers:false,indentWithTabs:true,indentUnit:8,
		matchBrackets:false,mode:'text/x-plsql'
	});
});
<? HHtml::jsInlineEnd() ?>
</div>

{if isset($result)}
	{if $result===false}<p class="message error">Une erreur s'est produite</p>
	{elseif is_int($result)}<p class="message succeed">{=$result} row(s) updated.</p>
	{else} {debug $result}
	{/if}
{elseif isset($ex)}
	<div class="message error">
		<h5>MySQL Error :</h5>
		{$ex->getMessage()}
	</div>
{/if}
