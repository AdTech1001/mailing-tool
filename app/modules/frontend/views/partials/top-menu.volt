<header>
	<div id="logo">
		<a href="{{ baseurl }}" title="Home">{{image('images/logo.png')}}</a>
	</div>
	{%- if session.get('auth') -%}
	<nav class="navbar navbar-reverse" role="navigation">
	  
		<ul class="sercive-nav navbar-right">
			<li>
				
				{{- link_to(language~'notifications', '<span class="glyphicon glyphicon-globe"></span>', 'title': 'Notifications') -}}
				
			</li>			

			<li>{{ link_to('help', '<span class="glyphicon glyphicon-question-sign"></span>', 'title': 'Help') }}</li>

			
			<li>{{ link_to('', '<span class="glyphicon glyphicon-home"></span>', 'title': 'Home') }}</li>
			<li>{{ link_to('settings', '<span class="glyphicon glyphicon-cog"></span>', 'title': 'Settings') }}</li>
			<li>{{ link_to('session/logout/', '<span class="glyphicon glyphicon-off"></span>', 'title': 'Logout') }}</li>
			
		  </ul>
		<div class="clearfix"></div>
		  <ul class="nav navbar-nav navbar-right">
			   {% if 'campaignobjects' == dispatcher.getControllerName() %}
              <li class="dropdown active">
              {% else %}
			 <li class="dropdown">
              {% endif %}
				{{- link_to(language~'/campaignobjects', '<span class="glyphicon glyphicon-th"></span> '~tr('campaign'), 'title': tr('campaign')) -}}				
				<ul class="dropdown-menu submenu">
					<li>{{ link_to(language~'/campaignobjects/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('create'), 'title': tr('create')) }}</li>
					<li>{{ link_to(language~'/campaignobjects/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('retrieve')) }}</li>
				</ul>
			</li>			
			{% if 'mailobjects' == dispatcher.getControllerName() %}
              <li class="dropdown active">
              {% else %}
			 <li class="dropdown">
              {% endif %}
				{{- link_to(language~'/mailobjects', '<span class="glyphicon glyphicon-envelope"></span> '~tr('mailobjects'), 'title': tr('mailobjects')) -}}
				<ul class="dropdown-menu submenu">
					<li>{{ link_to(language~'/mailobjects/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('create'), 'title': tr('create')) }}</li>
					<li>{{ link_to(language~'/mailobjects/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('retrieve')) }}</li>
				</ul>
			</li>	
			{% if 'templateobjects' == dispatcher.getControllerName() %}
              <li class="dropdown active">
              {% else %}
			 <li class="dropdown">
              {% endif %}
				{{- link_to(language~'/templateobjects', '<span class="glyphicon glyphicon-file"></span> '~tr('templateobjects'), 'title': tr('templateobjects')) -}}
				<ul class="dropdown-menu submenu">
					<li>{{ link_to(language~'/templateobjects/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('create'), 'title': tr('create')) }}</li>
					<li>{{ link_to(language~'/templateobjects/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('retrieve')) }}</li>
				</ul>
			</li>
			{% if 'configurationobjects' == dispatcher.getControllerName() %}
              <li class="dropdown active">
              {% else %}
			 <li class="dropdown">
              {% endif %}
				{{- link_to(language~'/configurationobjects', '<span class="glyphicon glyphicon-align-justify"></span> '~tr('configurationobjects'), 'title': tr('configurationobjects')) -}}
				<ul class="dropdown-menu submenu">
					<li>{{ link_to(language~'/configurationobjects/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('create'), 'title': tr('create')) }}</li>
					<li>{{ link_to(language~'/configurationobjects/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('retrieve')) }}</li>
				</ul>
			</li>
		  </ul>	
		

			


		
	  
	</nav>
	{%- endif -%}
	<div class="clearfix"></div>
</header>