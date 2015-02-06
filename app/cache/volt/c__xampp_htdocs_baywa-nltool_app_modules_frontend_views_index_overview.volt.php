<div id="messages"><?php echo $this->flashSession->output(); ?></div>
<?php echo $this->getContent(); ?>
<div class="container">	
	<div class="desktop">
		
		<h1><?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('actionTitle'); ?></h1><br>
		<div class="ceElement xs">
			<h1><?php echo $this->tag->linkTo(array($language . '/templateobjects/index/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('templateobjects'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('templateobjects'))); ?>
			</h1>
			<ul>
			<li><?php echo $this->tag->linkTo(array($language . '/templateobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('templateobjectsCreate'))); ?></li>
			<li><?php echo $this->tag->linkTo(array($language . '/templateobjects/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('templateobjectsRetrieve'))); ?></li>
			</ul>
		</div>
		<div class="ceElement xs">
			<h1><?php echo $this->tag->linkTo(array($language . '/configurationobjects/index/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('configurationobjects'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('configurationobjects'))); ?>
			</h1>
			<ul>
			<li><?php echo $this->tag->linkTo(array($language . '/configurationobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('configurationobjectsCreate'))); ?></li>
			<li><?php echo $this->tag->linkTo(array($language . '/configurationobjects/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('configurationobjectsRetrieve'))); ?></li>
			</ul>
		</div>
		<div class="ceElement xs">
			<h1><?php echo $this->tag->linkTo(array($language . '/addressfolders/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('addressfolders'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('addressfolders'))); ?>
			</h1>
			<ul>
			<li><?php echo $this->tag->linkTo(array($language . '/addressfolders/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('addressfoldersCreate'))); ?></li>
			<li><?php echo $this->tag->linkTo(array($language . '/addressfolders/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('addressfoldersCreate'))); ?></li>
			
			</ul>
		</div>
		<div class="ceElement xs">
			<h1><?php echo $this->tag->linkTo(array($language . '/segmentobjects/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('segmentobjects'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('segmentobjects'))); ?>
			</h1>
			<ul>
			<li><?php echo $this->tag->linkTo(array($language . '/segmentobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('segmentobjectsCreate'))); ?></li>
			<li><?php echo $this->tag->linkTo(array($language . '/segmentobjects/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('segmentobjectsCreate'))); ?></li>
			
			</ul>
		</div>
		<div class="ceElement xs">
			<h1><?php echo $this->tag->linkTo(array($language . '/distributors/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('distributors'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('distributors'))); ?>
			</h1>
			<ul>
			<li><?php echo $this->tag->linkTo(array($language . '/distributors/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('distributorsCreate'))); ?></li>
			<li><?php echo $this->tag->linkTo(array($language . '/distributors/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('distributorsCreate'))); ?></li>
			
			</ul>
		</div>
		<div class="ceElement xs">
			<h1><?php echo $this->tag->linkTo(array($language . '/mailobjects/index/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('mailobjects'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('mailobjects'))); ?>
			</h1>
			<ul>
			<li><?php echo $this->tag->linkTo(array($language . '/mailobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('mailobjectsCreate'))); ?></li>
			<li><?php echo $this->tag->linkTo(array($language . '/mailobjects/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('mailobjectsRetrieve'))); ?></li>
			</ul>
		</div>
		<div class="ceElement xs">
			<h1><?php echo $this->tag->linkTo(array($language . '/campaignobjects/index/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaigns'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaign'))); ?>
			</h1>
			
			<ul>
			<li><?php echo $this->tag->linkTo(array($language . '/campaignobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaignCreate'))); ?></li>
			<li><?php echo $this->tag->linkTo(array($language . '/campaignobjects/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaignRetrieve'))); ?></li>
			</ul>
			
		</div>
		<div class="ceElement xs">
			<h1><?php echo $this->tag->linkTo(array($language . '/report/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('report'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('report'))); ?>
			</h1>
			<ul>			
			<li><?php echo $this->tag->linkTo(array($language . '/report/index/', '<span class="glyphicon glyphicon-eye-open"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('report'))); ?></li>
			
			</ul>
		</div>
		
		
	</div>
</div>