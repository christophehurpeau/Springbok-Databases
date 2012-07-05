<?php $v=new AjaxPageView($layout_title); ?>
<div class="fixed left w200">
	<nav class="left">
		<ul>
		<?php UPhp::recursive(function($callback,$categories){ ?>
			{f $categories as $category}
			<li>
				<? HHtml::link($category->name,'/mysqldoc/category/'.$category->help_category_id) ?>
				{if!e $category->children}<ul><?php $callback($callback,$category->children) ?></ul>{/if}
			</li>
			{/f}
		<?php },$categories);?>
		</ul>
	</nav>
</div>
<div class="variable content"><h1>{$layout_title}</h1>{=$layout_content}</div>