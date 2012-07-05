<?php $v=new View(_t('Users'),'server') ?>

<table>
	<tr>
		<th>{t 'User'}</th>
		<th>{t 'Host'}</th>
		<th>{t 'Privileges'}</th>
		<th style="width:16px"></th>
	</tr>
{f $users as &$user}
	<tr>
		<td>{$user['User']}</td>
		<td>{$user['Host']}</td>
		<td class="smallinfo">
			{if $user['Select_priv']==='Y'}SELECT, {/if}
			{if $user['Insert_priv']==='Y'}INSERT, {/if}
			{if $user['Update_priv']==='Y'}UPDATE, {/if}
			{if $user['Delete_priv']==='Y'}DELETE, {/if}
			{if $user['Create_priv']==='Y'}CREATE, {/if}
			{if $user['Drop_priv']==='Y'}DROP, {/if}
			{if $user['Reload_priv']==='Y'}RELOAD, {/if}
			{if $user['Shutdown_priv']==='Y'}SHUTDOWN, {/if}
			{if $user['Process_priv']==='Y'}PROCESS, {/if}
			{if $user['File_priv']==='Y'}FILE, {/if}
			{if $user['Grant_priv']==='Y'}GRANT, {/if}
			{if $user['References_priv']==='Y'}REFERENCES, {/if}
			{if $user['Index_priv']==='Y'}INDEX, {/if}
			{if $user['Alter_priv']==='Y'}ALTER, {/if}
			{if $user['Show_db_priv']==='Y'}SHOW&nbsp;DB, {/if}
			{if $user['Super_priv']==='Y'}SUPER, {/if}
			{if $user['Create_tmp_table_priv']==='Y'}CREATE&nbsp;TMP&nbsp;TABLE, {/if}
			{if $user['Lock_tables_priv']==='Y'}LOCK&nbsp;TABLES, {/if}
			{if $user['Execute_priv']==='Y'}EXECUTE, {/if}
			{if $user['Repl_slave_priv']==='Y'}REPL&nbsp;SLAVE, {/if}
			{if $user['Repl_client_priv']==='Y'}REPL&nbsp;CLIENT, {/if}
			{if $user['Create_view_priv']==='Y'}CREATE&nbsp;VIEW, {/if}
			{if $user['Show_view_priv']==='Y'}SHOW&nbsp;VIEW, {/if}
			{if $user['Create_routine_priv']==='Y'}CREATE&nbsp;ROUTINE, {/if}
			{if $user['Alter_routine_priv']==='Y'}ALTER&nbsp;ROUTINE, {/if}
			{if $user['Create_user_priv']==='Y'}CREATE&nbsp;USER, {/if}
			{if $user['Event_priv']==='Y'}EVENT, {/if}
			{if $user['Trigger_priv']==='Y'}TRIGGER, {/if}
		</td>
		<td></td>
	</tr>
{/f}
</table>
