<div id="messages"><?php echo $this->flashSession->output(); ?></div>
<div class="container">
	<div class="function-bar">
	<?php if (isset($functions)) { ?>    
	<ul>
		
	</ul>
	<?php } ?>	
</div>
	<div class="desktop">
		<?php echo $this->getContent(); ?>
		<h1><?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('actionTitle'); ?></h1>
		<div class="module_el">
			<h2><?php echo $this->tag->linkTo(array($language . '/campaigns/', '<span class="glyphicon glyphicon-envelope"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaign'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaign'))); ?>
			</h2>
			<ul>
			<li><?php echo $this->tag->linkTo(array($language . '/campaigns/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaignCreate'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaignCreate'))); ?></li>
			<li><?php echo $this->tag->linkTo(array($language . '/campaigns/retrieve/', '<span class="glyphicon glyphicon-pencil"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaignRetrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaignRetrieve'))); ?></li>
			</ul>
		</div>
		<div class="module_el">
			<h2><?php echo $this->tag->linkTo(array($language . '/content/', '<span class="glyphicon glyphicon-envelope"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('content'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('content'))); ?>
			</h2>
			<ul>
			<li><?php echo $this->tag->linkTo(array($language . '/content/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('contentCreate'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('contentCreate'))); ?></li>
			<li><?php echo $this->tag->linkTo(array($language . '/content/retrieve/', '<span class="glyphicon glyphicon-pencil"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('contentRetrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('contentRetrieve'))); ?></li>
			<li><?php echo $this->tag->linkTo(array($language . '/content/templates/', '<span class="glyphicon glyphicon-pencil"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('contentTemplates'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('contentTemplates'))); ?></li>
			</ul>
		</div>
		
	</div>
</div>