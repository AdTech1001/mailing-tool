<header>
	<div id="logo">
		<a href="<?php echo $baseurl; ?>" title="Home"><?php echo $this->tag->image(array('images/logo.png')); ?></a>
	</div><?php if ($this->session->get('auth')) { ?><nav class="navbar navbar-reverse" role="navigation">
	  
		<ul class="sercive-nav navbar-right">
			<li><?php echo $this->tag->linkTo(array('notifications', '<span class="glyphicon glyphicon-globe"></span>', 'title' => 'Notifications')); ?></li>			

			<li><?php echo $this->tag->linkTo(array('help', '<span class="glyphicon glyphicon-question-sign"></span>', 'title' => 'Help')); ?></li>

			
			<li><?php echo $this->tag->linkTo(array('', '<span class="glyphicon glyphicon-home"></span>', 'title' => 'Home')); ?></li>
			<li><?php echo $this->tag->linkTo(array('settings', '<span class="glyphicon glyphicon-cog"></span>', 'title' => 'Settings')); ?></li>
			<li><?php echo $this->tag->linkTo(array('session/logout/', '<span class="glyphicon glyphicon-off"></span>', 'title' => 'Logout')); ?></li>
			
		  </ul>
		<div class="clearfix"></div>
		  <ul class="nav navbar-nav navbar-right">
			   <?php if ('campaignobjects' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array('campaignobjects', '<span class="glyphicon glyphicon-th"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaign'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaign'))); ?><ul class="dropdown-menu submenu">
					<li><?php echo $this->tag->linkTo(array($language . '/campaignobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'))); ?></li>
					<li><?php echo $this->tag->linkTo(array($language . '/campaignobjects/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>			
			<?php if ('mailobjects' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array('mailobjects', '<span class="glyphicon glyphicon-envelope"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('mailobjects'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('mailobjects'))); ?><ul class="dropdown-menu submenu">
					<li><?php echo $this->tag->linkTo(array($language . '/mailobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'))); ?></li>
					<li><?php echo $this->tag->linkTo(array($language . '/mailobjects/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>	
			<?php if ('templateobjects' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array('templateobjects', '<span class="glyphicon glyphicon-file"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('templateobjects'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('templateobjects'))); ?><ul class="dropdown-menu submenu">
					<li><?php echo $this->tag->linkTo(array($language . '/templateobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'))); ?></li>
					<li><?php echo $this->tag->linkTo(array($language . '/templateobjects/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>
			<?php if ('configurationobjects' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array('configurationobjects', '<span class="glyphicon glyphicon-align-justify"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('configurationobjects'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('configurationobjects'))); ?><ul class="dropdown-menu submenu">
					<li><?php echo $this->tag->linkTo(array($language . '/configurationobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'))); ?></li>
					<li><?php echo $this->tag->linkTo(array($language . '/configurationobjects/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>
		  </ul>	
		

			


		
	  
	</nav><?php } ?><div class="clearfix"></div>
</header>