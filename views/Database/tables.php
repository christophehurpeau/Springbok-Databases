<?php $v=new View(_t('Process list'),'database') ?>
<div class="content">
<table>
	<tr>
		<th style="width:16px"></th>
		{f current($tables) as $key=>$table}<th>{$key}</th>{/f}
	</tr>
{f $tables as &$table}
	<tr>
		<td>{iconLink 'delete','',$server->linkdb($dbname,'del_table',$table['Name']),array('confirm'=>_tC('Are you sure ?'))}</td>
		{f $table as &$value}<td>{$value}</td>{/f}
	</tr>
{/f}
</table>
</div>