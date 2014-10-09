<header>
	<div id="logo">
		<a href="<?php echo $baseurl; ?>" title="Home"><?php echo $this->tag->image(array('images/logo.png')); ?></a>
	</div><?php if ($this->session->get('auth')) { ?><nav class="navbar navbar-reverse" role="navigation">
	  
		
		
		  <ul class="nav navbar-nav navbar-right">

			

			
			<li class="notification-container"><?php echo $this->tag->linkTo(array('notifications', '<span class="glyphicon glyphicon-globe"></span>', 'title' => 'Notifications')); ?></li>
			

			<li class="dropdown">

				<a href="#" class="dropdown-toggle categories-link" data-toggle="dropdown" title="Categories">
					<span class="glyphicon glyphicon-th-list"></span> <b class="caret"></b>
				</a>

				<ul class="dropdown-menu" id="categories-dropdown">
					<li>lorem ipsum</li>
					<li>lorem ipsum</li><?php $_cache['sidebar'] = $this->di->get('viewCache'); $_cacheKey['sidebar'] = $_cache['sidebar']->start('sidebar'); if ($_cacheKey['sidebar'] === null) { ?><?php if (isset($categories)) { ?><?php foreach ($categories as $category) { ?><li><?php echo $this->tag->linkTo(array('category/' . $category->id . '/' . $category->slug, $category->name . '<span class="label label-default" style="float: right">' . $category->number_posts . '</span>')); ?></li><?php } ?><?php } ?><?php $_cache['sidebar']->save('sidebar'); } else { echo $_cacheKey['sidebar']; } ?></ul>
			</li>

			<li><?php echo $this->tag->linkTo(array('help', '<span class="glyphicon glyphicon-question-sign"></span>', 'title' => 'Help')); ?></li>

			
			<li><?php echo $this->tag->linkTo(array('', '<span class="glyphicon glyphicon-home"></span>', 'title' => 'Home')); ?></li>
			<li><?php echo $this->tag->linkTo(array('settings', '<span class="glyphicon glyphicon-cog"></span>', 'title' => 'Settings')); ?></li>
			<li><?php echo $this->tag->linkTo(array('session/logout/', '<span class="glyphicon glyphicon-off"></span>', 'title' => 'Logout')); ?></li>
			
		  </ul>

			


		
	  
	</nav><?php } ?><div class="clearfix"></div>
</header>