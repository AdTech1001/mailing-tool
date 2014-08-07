<header>
	<nav class="navbar navbar-reverse" role="navigation">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <?php echo $this->tag->linkTo(array('', 'nltool', 'class' => 'navbar-brand')); ?>
		</div>

		<div class="collapse navbar-collapse">
		  <ul class="nav navbar-nav navbar-right">

			<li><?php echo $this->tag->linkTo(array('', '<span class="glyphicon glyphicon-comment">asdfg</span>', 'title' => 'Discussions')); ?></li>
			<li class="dropdown">
          		<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Search">
          			<span class="glyphicon glyphicon-search"></span> <b class="caret"></b>
          		</a>
          		
          	</li>
			<li><?php echo $this->tag->linkTo(array('activity', '<span class="glyphicon glyphicon-eye-open"></span>', 'title' => 'Activity')); ?></li><?php if ($this->session->get('identity')) { ?><li class="notification-container"><?php echo $this->tag->linkTo(array('notifications', '<span class="glyphicon glyphicon-globe"></span>', 'title' => 'Notifications')); ?><?php if ($notifications->has()) { ?><span class="notification-counter"><?php echo $notifications->getNumber(); ?></span><?php } ?></li><?php } ?><li class="dropdown">

				<a href="#" class="dropdown-toggle categories-link" data-toggle="dropdown" title="Categories">
					<span class="glyphicon glyphicon-th-list">sdg</span> <b class="caret"></b>
				</a>

				<ul class="dropdown-menu" id="categories-dropdown"><?php $_cache['sidebar'] = $this->di->get('viewCache'); $_cacheKey['sidebar'] = $_cache['sidebar']->start('sidebar'); if ($_cacheKey['sidebar'] === null) { ?><?php if (isset($categories)) { ?><?php foreach ($categories as $category) { ?><li><?php echo $this->tag->linkTo(array('category/' . $category->id . '/' . $category->slug, $category->name . '<span class="label label-default" style="float: right">' . $category->number_posts . '</span>')); ?></li><?php } ?><?php } ?><?php $_cache['sidebar']->save('sidebar'); } else { echo $_cacheKey['sidebar']; } ?></ul>
			</li>

			<li><?php echo $this->tag->linkTo(array('help', '<span class="glyphicon glyphicon-question-sign"></span>', 'title' => 'Help')); ?></li><?php if ($this->session->get('identity')) { ?><li><?php echo $this->tag->linkTo(array('settings', '<span class="glyphicon glyphicon-cog"></span>', 'title' => 'Settings')); ?></li>
			<li><?php echo $this->tag->linkTo(array('logout', '<span class="glyphicon glyphicon-off"></span>', 'title' => 'Logout')); ?></li><?php } ?></ul><?php if ($this->session->get('identity')) { ?><?php echo $this->tag->linkTo(array('post/discussion', 'Start a Discussion', 'class' => 'btn btn-default btn-info navbar-btn navbar-right', 'rel' => 'nofollow')); ?><?php } ?></div>
	  </div>
	</nav>
</header>

<?php echo $this->getContent(); ?>

<div id="footer" align="center" class="container-fluid">
	<hr>
	<div id="footer-container" class="row-fluid">
		<span class='version'>BayWa Newsletter Tool <?php echo Phalcon\Version::get(); ?> | &copy; denkfabrik groupcom GmbH 2014</span>
	</div>
</div>