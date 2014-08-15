<header>
	<div id="logo">
		{{image('images/logo.png')}}
	</div>
	{%- if session.get('auth') -%}
	<nav class="navbar navbar-reverse" role="navigation">
	  
		
		
		  <ul class="nav navbar-nav navbar-right">

			<li>{{ link_to(language~'/compose', '<span class="glyphicon glyphicon-pencil"></span> '~tr('compose'), 'title': tr('compose')) }}</li>
			
			<li>{{ link_to('activity', '<span class="glyphicon glyphicon-eye-open"></span>', 'title': 'Activity') }}</li>

			
			<li class="notification-container">
				{{- link_to('notifications', '<span class="glyphicon glyphicon-globe"></span>', 'title': 'Notifications') -}}
				{%- if notifications.has() -%}
				<span class="notification-counter">{{ notifications.getNumber() }}</span>
				{%- endif -%}
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

			{#%- if session.get('auth') -%#}
			<li>{{ link_to('settings', '<span class="glyphicon glyphicon-cog"></span>', 'title': 'Settings') }}</li>
			<li>{{ link_to('logout', '<span class="glyphicon glyphicon-off"></span>', 'title': 'Logout') }}</li>
			{#%- endif -%#}
		  </ul>

			


		
	  
	</nav>
	{%- endif -%}
	<div class="clearfix"></div>
</header>