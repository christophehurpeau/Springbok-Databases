<?php $v=new View(_t('Export'),'database') ?>
<div class="content">
{=$form=HForm::Get()}
{=$form->select('echo',array('1'=>'Oui','0'=>'Non'))->radio()->label('Afficher le résultat')}
{=$form->end()}
</div>