<?php use Phalcon\Tag as Tag ?>
<header>
	<div id="logo">
		<?php echo $this->tag->image(array('images/logo.png')); ?>
	</div><?php if ($this->session->get('auth')) { ?><nav class="navbar navbar-reverse" role="navigation">
	  
		
		
		  <ul class="nav navbar-nav navbar-right">

			<li><?php echo $this->tag->linkTo(array($language . '/compose', '<span class="glyphicon glyphicon-pencil"></span> ' . nltool\Controllers\ControllerBase::translate('compose'), 'title' => nltool\Controllers\ControllerBase::translate('compose'))); ?></li>
			
			<li><?php echo $this->tag->linkTo(array('activity', '<span class="glyphicon glyphicon-eye-open"></span>', 'title' => 'Activity')); ?></li>

			
			<li class="notification-container"><?php echo $this->tag->linkTo(array('notifications', '<span class="glyphicon glyphicon-globe"></span>', 'title' => 'Notifications')); ?><?php if ($this->notifications->has()) { ?><span class="notification-counter"><?php echo $this->notifications->getNumber(); ?></span><?php } ?></li>
			

			<li class="dropdown">

				<a href="#" class="dropdown-toggle categories-link" data-toggle="dropdown" title="Categories">
					<span class="glyphicon glyphicon-th-list"></span> <b class="caret"></b>
				</a>

				<ul class="dropdown-menu" id="categories-dropdown">
					<li>lorem ipsum</li>
					<li>lorem ipsum</li><?php $_cache['sidebar'] = $this->di->get('viewCache'); $_cacheKey['sidebar'] = $_cache['sidebar']->start('sidebar'); if ($_cacheKey['sidebar'] === null) { ?><?php if (isset($categories)) { ?><?php foreach ($categories as $category) { ?><li><?php echo $this->tag->linkTo(array('category/' . $category->id . '/' . $category->slug, $category->name . '<span class="label label-default" style="float: right">' . $category->number_posts . '</span>')); ?></li><?php } ?><?php } ?><?php $_cache['sidebar']->save('sidebar'); } else { echo $_cacheKey['sidebar']; } ?></ul>
			</li>

			<li><?php echo $this->tag->linkTo(array('help', '<span class="glyphicon glyphicon-question-sign"></span>', 'title' => 'Help')); ?></li>

			
			<li><?php echo $this->tag->linkTo(array('settings', '<span class="glyphicon glyphicon-cog"></span>', 'title' => 'Settings')); ?></li>
			<li><?php echo $this->tag->linkTo(array('logout', '<span class="glyphicon glyphicon-off"></span>', 'title' => 'Logout')); ?></li>
			
		  </ul>

			


		
	  
	</nav><?php } ?><div class="clearfix"></div>
</header>
<?php echo $this->getContent(); ?>
<div id="footer" align="center" class="container-fluid">
	<hr>
	<div id="footer-container" class="row-fluid">
		<span class='version'>BayWa Newsletter Tool <?php echo $version; ?> | &copy; denkfabrik groupcom GmbH 2014</span>
	</div>
</div>