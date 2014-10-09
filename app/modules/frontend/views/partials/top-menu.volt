<header>
	<div id="logo">
		<a href="{{ baseurl }}" title="Home">{{image('images/logo.png')}}</a>
	</div>
	{%- if session.get('auth') -%}
	<nav class="navbar navbar-reverse" role="navigation">
	  
		
		
		  <ul class="nav navbar-nav navbar-right">

			

			
			<li class="notification-container">
				{{- link_to('notifications', '<span class="glyphicon glyphicon-globe"></span>', 'title': 'Notifications') -}}
				
			</li>
			

			<li class="dropdown">

				<a href="#" class="dropdown-toggle categories-link" data-toggle="dropdown" title="Categories">
					<span class="glyphicon glyphicon-th-list"></span> <b class="caret"></b>
				</a>

				<ul class="dropdown-menu" id="categories-dropdown">
					<li>lorem ipsum</li>
					<li>lorem ipsum</li>
				{%- cache "sidebar" -%}
						{%- if categories is defined -%}
							{%- for category in categories -%}
								<li>
									{{- link_to('category/' ~ category.id ~ '/' ~ category.slug,
										category.name ~ '<span class="label label-default" style="float: right">' ~ category.number_posts ~ '</span>')
									-}}
								</li>
							{%- endfor -%}
						{%- endif -%}
				{%- endcache -%}
				</ul>
			</li>

			<li>{{ link_to('help', '<span class="glyphicon glyphicon-question-sign"></span>', 'title': 'Help') }}</li>

			
			<li>{{ link_to('', '<span class="glyphicon glyphicon-home"></span>', 'title': 'Home') }}</li>
			<li>{{ link_to('settings', '<span class="glyphicon glyphicon-cog"></span>', 'title': 'Settings') }}</li>
			<li>{{ link_to('session/logout/', '<span class="glyphicon glyphicon-off"></span>', 'title': 'Logout') }}</li>
			
		  </ul>

			


		
	  
	</nav>
	{%- endif -%}
	<div class="clearfix"></div>
</header>