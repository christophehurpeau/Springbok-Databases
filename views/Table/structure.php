<?php $v=new AjaxContentView(_t('Table:').' '.$tablename.' - Structure','table') ?>

<div class="content">
<table>
	<tr>
		<th><?= _t('Name') ?></th>
		<th><?= _t('Type') ?></th>
		<th style="width:50px"><?= _t('Null') ?></th>
		<th><?= _t('Default') ?></th>
	</tr>
	{f $columns as $col}
		<tr>
			<td>{if $pk=($col['Key']==='PRI')}<u class="bold">{/if}{$col['name']}{if $pk}</u>{/if}</td>
			<td>{$col['type']}</td>
			<td class="center">{if $col['notnull']}{icon disabled}{else}{icon enabled}{/if}</td>
			<td>{if $col['default'] !== false}{$col['default']}{/if}</td>
		</tr>
	{/f}
</table>

<br />
<h5>Indexes</h5>
<table>
	<tr>
		<th><?= _t('Name') ?></th>
		<th><?= _t('Unique') ?></th>
		<th><?= _t('Columns') ?></th>
		<th><?= _t('Cardinality') ?></th>
		<th>Sub_part</th>
		<th>Packed</th>
		<th style="width:50px"><?= _t('Null') ?></th>
		<th><?= _t('Type') ?></th>
		<th><?= _t('Comment') ?></th>
	</tr>
	{f array('nonunique'=>false,'unique'=>true) as $key=>$isUnique}
		{if!e $indexes[$key]}{f $indexes[$key] as $keyName=>$index}
			<?php $colCount=count($index['columns']); $colCount=$colCount===1?'':' rowspan="'.$colCount.'"'; ?>
			<tr>
				<td{=$colCount}>{* {if $pk=($index['Key_name']==='PRIMARY')}<u class="bold">{/if} *}{$keyName}{* {if $pk}</u>{/if} *}</td>
				<td{=$colCount} class="center">{if $isUnique}{icon disabled}{else}{icon enabled}{/if}</td>
				<td><? key($index['columns']) ?></td>
				<td><? current($index['columns']) ?></td>
				<td{=$colCount}>{$index['Sub_part']}</td>
				<td{=$colCount}>{$index['packed']}</td>
				<td{=$colCount} class="center">{if $index['Null']}{icon enabled}{else}{icon disabled}{/if}</td>
				<td{=$colCount}>{$index['index_type']}</td>
				<td{=$colCount}>{$index['comment']}</td>
			</tr>
			{while next($index['columns'])}
				<tr>
					<td><? key($index['columns']) ?></td>
					<td><? current($index['columns']) ?></td>
				</tr>
			{/while}
		{/f}{/if}
	{/f}
</table>
</div>