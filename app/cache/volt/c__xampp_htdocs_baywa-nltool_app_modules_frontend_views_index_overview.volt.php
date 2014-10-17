<div id="messages"><?php echo $this->flashSession->output(); ?></div>
<div class="container">	
	<div class="desktop">
		<?php echo $this->getContent(); ?>
		<h1><?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('actionTitle'); ?></h1>
		<div class="module_el">
			<h2><?php echo $this->tag->linkTo(array($language . '/campaignobjects/index/', '<span class="glyphicon glyphicon-envelope"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaign'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaign'))); ?>
			</h2>
			<ul>
			<li><?php echo $this->tag->linkTo(array($language . '/campaignobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaignCreate'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaignCreate'))); ?></li>
			<li><?php echo $this->tag->linkTo(array($language . '/campaignobjects/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaignRetrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaignRetrieve'))); ?></li>
			</ul>
		</div>
		<div class="module_el">
			<h2><?php echo $this->tag->linkTo(array($language . '/mailobjects/index/', '<span class="glyphicon glyphicon-envelope"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('mailobjects'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('mailobjects'))); ?>
			</h2>
			<ul>
			<li><?php echo $this->tag->linkTo(array($language . '/mailobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('mailobjectsCreate'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('mailobjectsCreate'))); ?></li>
			<li><?php echo $this->tag->linkTo(array($language . '/mailobjects/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('mailobjectsRetrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('mailobjectsRetrieve'))); ?></li>
			</ul>
		</div>
		<div class="module_el">
			<h2><?php echo $this->tag->linkTo(array($language . '/templateobjects/index/', '<span class="glyphicon glyphicon-envelope"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('templateobjects'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('templateobjects'))); ?>
			</h2>
			<ul>
			<li><?php echo $this->tag->linkTo(array($language . '/templateobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('templateobjectsCreate'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('templateobjectsCreate'))); ?></li>
			<li><?php echo $this->tag->linkTo(array($language . '/templateobjects/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('templateobjectsRetrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('templateobjectsRetrieve'))); ?></li>
			</ul>
		</div>
		<div class="module_el">
			<h2><?php echo $this->tag->linkTo(array($language . '/configurationobjects/index/', '<span class="glyphicon glyphicon-envelope"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('configurationobjects'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('configurationobjects'))); ?>
			</h2>
			<ul>
			<li><?php echo $this->tag->linkTo(array($language . '/configurationobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('configurationobjectsCreate'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('configurationobjectsCreate'))); ?></li>
			<li><?php echo $this->tag->linkTo(array($language . '/configurationobjects/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('configurationobjectsRetrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('configurationobjectsRetrieve'))); ?></li>
			</ul>
		</div>
		<div class="module_el hidden">
			<h2><?php echo $this->tag->linkTo(array($language . '/contentobjects/', '<span class="glyphicon glyphicon-envelope"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('contentobjects'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('contentobjects'))); ?>
			</h2>
			<ul>
			<li><?php echo $this->tag->linkTo(array($language . '/contentobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('contentobjectsCreate'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('contentobjectsCreate'))); ?></li>
			<li><?php echo $this->tag->linkTo(array($language . '/contentobjects/index/', '<span class="glyphicon glyphicon-pencil"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('contentobjectsRetrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('contentobjectsRetrieve'))); ?></li>
			<li><?php echo $this->tag->linkTo(array($language . '/contentobjects/templates/', '<span class="glyphicon glyphicon-pencil"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('contentobjectsTemplates'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('contentobjectsTemplates'))); ?></li>
			</ul>
		</div>
		
	</div>
</div>