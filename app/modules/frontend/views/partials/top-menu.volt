<header>
	<div id="logo">
		<a href="{{ baseurl }}" title="Home">{{image('images/logo.png')}}</a>
	</div>
	{%- if session.get('auth') -%}
	<nav class="navbar navbar-reverse" role="navigation">
	  
		<ul class="sercive-nav navbar-right">						
			<li>{{ link_to('', '<span class="glyphicon glyphicon-home"></span>', 'title': 'Home') }}</li>			
			<li>{{ link_to('session/logout/', '<span class="glyphicon glyphicon-off"></span>', 'title': 'Logout') }}</li>			
		</ul>
		<div class="clearfix"></div>
		  <ul class="nav navbar-nav navbar-right">
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
			
			{% if 'addressfolders' == dispatcher.getControllerName() %}
              <li class="dropdown active">
              {% else %}
			 <li class="dropdown">
              {% endif %}
				{{- link_to(language~'/addressfolders', '<span class="glyphicon glyphicon-user"></span> '~tr('addressfolders'), 'title': tr('addressfolders')) -}}
				<ul class="dropdown-menu submenu">
					<li>{{ link_to(language~'/addressfolders/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('create'), 'title': tr('create')) }}</li>
					<li>{{ link_to(language~'/addressfolders/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('retrieve')) }}</li>
				</ul>
			</li>	
			{% if 'segmentobjects' == dispatcher.getControllerName() %}
              <li class="dropdown active">
              {% else %}
			 <li class="dropdown">
              {% endif %}
				{{- link_to(language~'/segmentobjects', '<span class="glyphicon glyphicon-user"></span> '~tr('segmentobjects'), 'title': tr('segmentobjects')) -}}
				<ul class="dropdown-menu submenu">
					<li>{{ link_to(language~'/segmentobjects/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('create'), 'title': tr('create')) }}</li>
					<li>{{ link_to(language~'/segmentobjects/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('retrieve')) }}</li>
				</ul>
			</li>	
			  {% if 'distributors' == dispatcher.getControllerName() %}
              <li class="dropdown active">
              {% else %}
			 <li class="dropdown">
              {% endif %}
				{{- link_to(language~'/distributors', '<span class="glyphicon glyphicon-user"></span> '~tr('distributors'), 'title': tr('distributors')) -}}
				<ul class="dropdown-menu submenu">
					<li>{{ link_to(language~'/distributors/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('create'), 'title': tr('create')) }}</li>
					<li>{{ link_to(language~'/distributors/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('retrieve')) }}</li>
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
			  {% if 'review' == dispatcher.getControllerName() %}
              <li class="dropdown active">
              {% else %}
			 <li class="dropdown">
              {% endif %}
				{{- link_to(language~'/review', '<span class="glyphicon glyphicon-ok"></span> '~tr('review'), 'title': tr('review')) -}}
				<ul class="dropdown-menu submenu">					
					<li>{{ link_to(language~'/review/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('retrieve')) }}</li>
				</ul>
			</li>	
			{% if 'review' == dispatcher.getControllerName() %}
              <li class="dropdown active">
              {% else %}
			 <li class="dropdown">
              {% endif %}
				{{- link_to(language~'/report', '<span class="glyphicon glyphicon-stats"></span> '~tr('report'), 'title': tr('report')) -}}
				
			</li>	
			  			
			
				
			
			
		  </ul>	
		

			


		
	  
	</nav>
	{%- endif -%}
	<div class="clearfix"></div>
</header>