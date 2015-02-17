<?php if ($this->session->get('auth')) { ?><header>
	
	
	
	
	<nav class="navbar navbar-reverse" role="navigation">
		<div id="headerLeft">
	<div id="logo">
		<a href="<?php echo $baseurl; ?>" title="Home"><?php echo $this->tag->image(array('images/logo.png')); ?></a>
	</div>
	</div>
		<div id="pageTitle">
			<h1>Newsletter Tool</h1>
		</div>
		<ul class="sercive-nav navbar-right">						
			<li><?php echo $this->tag->linkTo(array('', '<span class="glyphicon glyphicon-home"></span>', 'title' => 'Home')); ?></li>			
			<li><?php echo $this->tag->linkTo(array('session/logout/', '<span class="glyphicon glyphicon-off"></span>', 'title' => 'Logout')); ?></li>			
		</ul>
		
		
		  <ul class="nav navbar-nav">
			  
			  
			  
			  <?php if (nltool\Acl\Acl::linkAllowed($this->session->get('auth'), 'templateobjects', 'index')) { ?>		
			  <?php if ('templateobjects' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array($language . '/templateobjects', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('templateobjects') . ' <span class="glyphicon glyphicon-chevron-down"></span>', 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('templateobjects'))); ?><ul class="dropdown-menu submenu">
					<?php if (nltool\Acl\Acl::linkAllowed($this->session->get('auth'), 'templateobjects', 'create')) { ?>		
					<li <?php if ('create' == $this->dispatcher->getActionName() && 'templateobjects' == $this->dispatcher->getControllerName()) { ?> class="active" <?php } ?>><?php echo $this->tag->linkTo(array($language . '/templateobjects/create/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'))); ?></li>
					<?php } ?>
					<li <?php if ('index' == $this->dispatcher->getActionName() && 'templateobjects' == $this->dispatcher->getControllerName()) { ?> class="active" <?php } ?>><?php echo $this->tag->linkTo(array($language . '/templateobjects/index/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>
			<?php } ?>
			
			<?php if (nltool\Acl\Acl::linkAllowed($this->session->get('auth'), 'configurationobjects', 'index')) { ?>		
			  <?php if ('configurationobjects' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array($language . '/configurationobjects', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('configurationobjects') . ' <span class="glyphicon glyphicon-chevron-down"></span>', 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('configurationobjects'))); ?><ul class="dropdown-menu submenu">
					<?php if (nltool\Acl\Acl::linkAllowed($this->session->get('auth'), 'configurationobjects', 'create')) { ?>		
					<li <?php if ('create' == $this->dispatcher->getActionName() && 'configurationobjects' == $this->dispatcher->getControllerName()) { ?> class="active" <?php } ?>><?php echo $this->tag->linkTo(array($language . '/configurationobjects/create/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'))); ?></li>
					<?php } ?>
					<li <?php if ('index' == $this->dispatcher->getActionName() && 'configurationobjects' == $this->dispatcher->getControllerName()) { ?> class="active" <?php } ?>><?php echo $this->tag->linkTo(array($language . '/configurationobjects/index/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>
			<?php } ?>
			
			<?php if (nltool\Acl\Acl::linkAllowed($this->session->get('auth'), 'addressfolders', 'index')) { ?>		
			<?php if ('addressfolders' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array($language . '/addressfolders', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('addressfolders') . ' <span class="glyphicon glyphicon-chevron-down"></span>', 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('addressfolders'))); ?><ul class="dropdown-menu submenu">
					<?php if (nltool\Acl\Acl::linkAllowed($this->session->get('auth'), 'addressfolders', 'index')) { ?>		
					<li <?php if ('create' == $this->dispatcher->getActionName() && 'addressfolders' == $this->dispatcher->getControllerName()) { ?> class="active" <?php } ?>><?php echo $this->tag->linkTo(array($language . '/addressfolders/create/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'))); ?></li>
					<?php } ?>
					<li <?php if ('index' == $this->dispatcher->getActionName() && 'addressfolders' == $this->dispatcher->getControllerName()) { ?> class="active" <?php } ?>><?php echo $this->tag->linkTo(array($language . '/addressfolders/index/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>	
			<?php } ?>
			<?php if (nltool\Acl\Acl::linkAllowed($this->session->get('auth'), 'segmentobjects', 'index')) { ?>		
			<?php if ('segmentobjects' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array($language . '/segmentobjects', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('segmentobjects') . ' <span class="glyphicon glyphicon-chevron-down"></span>', 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('segmentobjects'))); ?><ul class="dropdown-menu submenu">
					<?php if (nltool\Acl\Acl::linkAllowed($this->session->get('auth'), 'segmentobjects', 'create')) { ?>		
					<li <?php if ('create' == $this->dispatcher->getActionName() && 'segmentobjects' == $this->dispatcher->getControllerName()) { ?> class="active" <?php } ?>><?php echo $this->tag->linkTo(array($language . '/segmentobjects/create/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'))); ?></li>
					<?php } ?>
					<li <?php if ('index' == $this->dispatcher->getActionName() && 'segmentobjects' == $this->dispatcher->getControllerName()) { ?> class="active" <?php } ?>><?php echo $this->tag->linkTo(array($language . '/segmentobjects/index/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>	
			<?php } ?>
			
			<?php if (nltool\Acl\Acl::linkAllowed($this->session->get('auth'), 'distributors', 'index')) { ?>		
			  <?php if ('distributors' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array($language . '/distributors', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('distributors') . ' <span class="glyphicon glyphicon-chevron-down"></span>', 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('distributors'))); ?><ul class="dropdown-menu submenu">
					<?php if (nltool\Acl\Acl::linkAllowed($this->session->get('auth'), 'distributors', 'create')) { ?>		
					<li <?php if ('create' == $this->dispatcher->getActionName() && 'distributors' == $this->dispatcher->getControllerName()) { ?> class="active" <?php } ?>><?php echo $this->tag->linkTo(array($language . '/distributors/create/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'))); ?></li>
					<?php } ?>
					<li <?php if ('index' == $this->dispatcher->getActionName() && 'distributors' == $this->dispatcher->getControllerName()) { ?> class="active" <?php } ?>><?php echo $this->tag->linkTo(array($language . '/distributors/index/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>	
			<?php } ?>
			<?php if (nltool\Acl\Acl::linkAllowed($this->session->get('auth'), 'mailobjects', 'index')) { ?>		
			  <?php if ('mailobjects' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array($language . '/mailobjects', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('mailobjects') . ' <span class="glyphicon glyphicon-chevron-down"></span>', 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('mailobjects'))); ?><ul class="dropdown-menu submenu">
					<?php if (nltool\Acl\Acl::linkAllowed($this->session->get('auth'), 'mailobjects', 'create')) { ?>		
					<li <?php if ('create' == $this->dispatcher->getActionName() && 'mailobjects' == $this->dispatcher->getControllerName()) { ?> class="active" <?php } ?>><?php echo $this->tag->linkTo(array($language . '/mailobjects/create/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'))); ?></li>
					<?php } ?>
					<li <?php if ('index' == $this->dispatcher->getActionName() && 'mailobjects' == $this->dispatcher->getControllerName()) { ?> class="active" <?php } ?>><?php echo $this->tag->linkTo(array($language . '/mailobjects/index/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>
			<?php } ?>
			<?php if (nltool\Acl\Acl::linkAllowed($this->session->get('auth'), 'campaignobjects', 'index')) { ?>		
			   <?php if ('campaignobjects' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array($language . '/campaignobjects', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaign') . ' <span class="glyphicon glyphicon-chevron-down"></span>', 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('campaign'))); ?><ul class="dropdown-menu submenu">
					<?php if (nltool\Acl\Acl::linkAllowed($this->session->get('auth'), 'campaignobjects', 'create')) { ?>		
					<li <?php if ('create' == $this->dispatcher->getActionName() && 'campaignobjects' == $this->dispatcher->getControllerName()) { ?> class="active" <?php } ?>><?php echo $this->tag->linkTo(array($language . '/campaignobjects/create/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('create'))); ?></li>
					<?php } ?>
					<li <?php if ('index' == $this->dispatcher->getActionName() && 'campaignobjects' == $this->dispatcher->getControllerName()) { ?> class="active" <?php } ?>><?php echo $this->tag->linkTo(array($language . '/campaignobjects/index/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>
			<?php } ?>
			<?php if (nltool\Acl\Acl::linkAllowed($this->session->get('auth'), 'review', 'index')) { ?>		
			  <?php if ('review' == $this->dispatcher->getControllerName()) { ?>
              <li class="dropdown active">
              <?php } else { ?>
			 <li class="dropdown">
              <?php } ?><?php echo $this->tag->linkTo(array($language . '/review', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('review') . ' <span class="glyphicon glyphicon-chevron-down"></span>', 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('review'))); ?><ul class="dropdown-menu submenu">					
					<li <?php if ('index' == $this->dispatcher->getActionName() && 'review' == $this->dispatcher->getControllerName()) { ?> class="active" <?php } ?>><?php echo $this->tag->linkTo(array($language . '/review/index/', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('retrieve'))); ?></li>
				</ul>
			</li>	
			<?php } ?>
			<?php if (nltool\Acl\Acl::linkAllowed($this->session->get('auth'), 'report', 'index')) { ?>		
			<?php if ('report' == $this->dispatcher->getControllerName()) { ?>
              <li class="active">
              <?php } else { ?>
			 <li>
              <?php } ?><?php echo $this->tag->linkTo(array($language . '/report', nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('report'), 'title' => nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('report'))); ?></li>	
			<?php } ?>
			  			
			
				
			
			
		  </ul>	
		

			


		
	  
	</nav>
	
	<div class="clearfix"></div>
	
</header><?php } ?>