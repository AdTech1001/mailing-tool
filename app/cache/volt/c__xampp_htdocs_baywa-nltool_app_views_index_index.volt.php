<div id="messages"><?php echo $this->flashSession->output(); ?></div>
<div class="container">
	<div class="function-bar">
	<?php if (isset($functions)) { ?>    
	<ul>
		
	</ul>
	<?php } ?>	
</div>
	<div class="desktop">
		<h1><?php echo nltool\Controllers\ControllerBase::translate('overviewTitle'); ?></h1>

		<div class="content_el">
			<h2>Overview</h2>
			<?php echo $this->getContent(); ?>
		</div>
	</div>
</div>