<?php $v=new View(_t('Process list'),'server') ?>

<table>
	<tr>
		{f current($processlist) as $key=>$process}<th>{$key}</th>{/f}
		<th style="width:16px"></th>
	</tr>
{f $processlist as &$process}
	<tr>
		{f $process as &$value}<td>{$value}</td>{/f}
		<td>{iconLink 'delete','',$server->link('killprocess',$process['Id']),array('confirm'=>_tC('Are you sure ?'))}</td>
	</tr>
{/f}
</table>
