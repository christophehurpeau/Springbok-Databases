<?php $v=new AjaxContentView(_t('Table:').' '.$tablename,'table') ?>

<div class="content dbsqlcode">
<?php $form=HForm::create(NULL,array('method'=>'get','rel'=>'content')) ?>
<textarea id="sqlcode<? $id=time() ?>" name="sql">{$sql}</textarea>
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

{if isset($table)}
	<div class="sqlresult"><?php $table->display() ?>{* <?php AHSqlTable::table($table,$server->linktable($dbname,$tablename,'details'),$qsql) ?>*}</div>
	{if isset($qsql)}
		{if !$qsql->isJoined()}
			{*<ul id="rowMenu" class="contextMenu">
			    <li class="insert">{icon table_row_update}<a href="#row_update"></a></li>
			    <li class="insert">{icon table_row_delete}<a href="#row_delete">{t 'Delete row'}</a></li>
			</ul>*}
			<?php HHtml::jsInlineStart() ?>
				$(document).ready(function(){
					/*$('.sqlresult table tr td').contextMenu({ menu:'rowMenu'},function(action, el, pos){
						if(action==='row_update'){
							
						}else if(action==='row_delete'){
							if(!confirm('Êtes-vous sûr de vouloir supprimer cette ligne ?')) return;
						}
					});*/
					$('.sqlresult table tr td').contextmenu({menu:{
						'{t 'Update row'}':{'icon':'table_row_update',callbacks:{
								click:function(){S.redirect('<? HHtml::url($server->linktable($dbname,$tablename,'update')) ?>?'+$(this).data('pksurl'))}
							}}
					}})
				});
			<? HHtml::jsInlineEnd() ?>
		{/if}
	{/if}
{elseif isset($result)}
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
