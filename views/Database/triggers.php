<?php $v=new View(_t('Process list'),'database') ?>
<div class="content">
{ife $triggers}
<div class="mWarning">No Triggers</div>
{else}
<table>
	<tr>
		<th style="width:16px"></th>
		{f current($triggers) as $key=>$trigger}<th>{$key}</th>{/f}
	</tr>
{f $triggers as &$trigger}
	<tr>
		<td>{iconLink 'delete','',$server->Linkdb($dbname,'del_trigger',$trigger['Trigger']),array('confirm'=>_tC('Are you sure ?'))}</td>
		{f $trigger as &$value}<td>{$value}</td>{/f}
	</tr>
{/f}
</table>
{/if}
</div>