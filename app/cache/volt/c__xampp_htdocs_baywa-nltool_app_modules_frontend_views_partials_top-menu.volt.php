<header>
	<div id="logo">
		<?php echo $this->tag->image(array('images/logo.png')); ?>
	</div><?php if ($this->session->get('auth')) { ?><nav class="navbar navbar-reverse" role="navigation">
	  
		
		
		  <ul class="nav navbar-nav navbar-right">

			

			
			<li class="notification-container"><?php echo $this->tag->linkTo(array('notifications', '<span class="glyphicon glyphicon-globe"></span>', 'title' => 'Notifications')); ?><li><?php echo $this->tag->linkTo(array('settings', '<span class="glyphicon glyphicon-cog"></span>', 'title' => 'Settings')); ?></li>
			<li><?php echo $this->tag->linkTo(array('session/logout/', '<span class="glyphicon glyphicon-off"></span>', 'title' => 'Logout')); ?></li>
			
		  </ul>

			


		
	  
	</nav><?php } ?><div class="clearfix"></div>
</header>