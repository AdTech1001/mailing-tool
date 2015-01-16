<?php use Phalcon\Tag as Tag ?>
<header>
	<div id="logo">
		<a href="<?php echo $baseurl; ?>" title="Home"><?php echo $this->tag->image(array('images/logo.png')); ?></a>
	</div><?php if ($this->session->get('auth')) { ?><nav class="navbar navbar-reverse" role="navigation">
	  
		<ul class="sercive-nav navbar-right">
			<li><?php echo $this->tag->linkTo(array($language . '/notifications', '<span class="glyphicon glyphicon-globe"></span>', 'title' => 'Notifications')); ?></li>			
			
			<li><?php echo $this->tag->linkTo(array('', '<span class="glyphicon glyphicon-home"></span>', 'title' => 'Home')); ?></li>
			<li><?php echo $this->tag->linkTo(array('settings', '<span class="glyphicon glyphicon-cog"></span>', 'title' => 'Settings')); ?></li>
			<li><?php echo $this->tag->linkTo(array('session/logout/', '<span class="glyphicon glyphicon-off"></span>', 'title' => 'Logout')); ?></li>
			
		  </ul>
		<div class="clearfix"></div>
		  <ul class="nav navbar-nav navbar-right">
			  <?php if ('templateobjects' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array($language . '/templateobjects', '<span class="glyphicon glyphicon-file"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('templateobjects'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('templateobjects'))); ?><ul class="dropdown-menu submenu">
					<li><?php echo $this->tag->linkTo(array($language . '/templateobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'))); ?></li>
					<li><?php echo $this->tag->linkTo(array($language . '/templateobjects/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>
			  <?php if ('configurationobjects' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array($language . '/configurationobjects', '<span class="glyphicon glyphicon-align-justify"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('configurationobjects'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('configurationobjects'))); ?><ul class="dropdown-menu submenu">
					<li><?php echo $this->tag->linkTo(array($language . '/configurationobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'))); ?></li>
					<li><?php echo $this->tag->linkTo(array($language . '/configurationobjects/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>
			
			<?php if ('addressfolders' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array($language . '/addressfolders', '<span class="glyphicon glyphicon-user"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('addressfolders'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('addressfolders'))); ?><ul class="dropdown-menu submenu">
					<li><?php echo $this->tag->linkTo(array($language . '/addressfolders/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'))); ?></li>
					<li><?php echo $this->tag->linkTo(array($language . '/addressfolders/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>	
			<?php if ('segmentobjects' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array($language . '/segmentobjects', '<span class="glyphicon glyphicon-user"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('segmentobjects'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('segmentobjects'))); ?><ul class="dropdown-menu submenu">
					<li><?php echo $this->tag->linkTo(array($language . '/segmentobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'))); ?></li>
					<li><?php echo $this->tag->linkTo(array($language . '/segmentobjects/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>	
			  <?php if ('distributors' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array($language . '/distributors', '<span class="glyphicon glyphicon-user"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('distributors'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('distributors'))); ?><ul class="dropdown-menu submenu">
					<li><?php echo $this->tag->linkTo(array($language . '/distributors/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'))); ?></li>
					<li><?php echo $this->tag->linkTo(array($language . '/distributors/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>	
			  <?php if ('mailobjects' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array($language . '/mailobjects', '<span class="glyphicon glyphicon-envelope"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('mailobjects'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('mailobjects'))); ?><ul class="dropdown-menu submenu">
					<li><?php echo $this->tag->linkTo(array($language . '/mailobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'))); ?></li>
					<li><?php echo $this->tag->linkTo(array($language . '/mailobjects/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>	
			   <?php if ('campaignobjects' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array($language . '/campaignobjects', '<span class="glyphicon glyphicon-th"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaign'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaign'))); ?><ul class="dropdown-menu submenu">
					<li><?php echo $this->tag->linkTo(array($language . '/campaignobjects/create/', '<span class="glyphicon glyphicon-edit"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'))); ?></li>
					<li><?php echo $this->tag->linkTo(array($language . '/campaignobjects/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>
			  <?php if ('review' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array($language . '/review', '<span class="glyphicon glyphicon-ok"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('review'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('review'))); ?><ul class="dropdown-menu submenu">					
					<li><?php echo $this->tag->linkTo(array($language . '/review/index/', '<span class="glyphicon glyphicon-list"></span> ' . nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>	
			  			
			
				
			
			
		  </ul>	
		

			


		
	  
	</nav><?php } ?><div class="clearfix"></div>
</header>
<?php echo $this->getContent(); ?>
<div id="footer" align="center" class="container-fluid">
	<hr>
	<div id="footer-container" class="row-fluid">
		<span class='version'>BayWa Newsletter Tool <?php echo $version; ?> | &copy; denkfabrik groupcom GmbH 2015</span>
	</div>
</div>