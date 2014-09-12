{% include 'partials\flash-messages.volt' %}
<div class="container">
	{% include 'partials\function-menu.volt' %}
	<div class="desktop">
		{{ content() }}
		<h1>{{tr('actionTitle')}}</h1>
		<div class="module_el">
			<h2>{{ link_to(language~'/campaigns/', '<span class="glyphicon glyphicon-envelope"></span> '~tr('campaign'), 'title': tr('campaign')) }}
			</h2>
			<ul>
			<li>{{ link_to(language~'/campaigns/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('campaignCreate'), 'title': tr('campaignCreate')) }}</li>
			<li>{{ link_to(language~'/campaigns/retrieve/', '<span class="glyphicon glyphicon-pencil"></span> '~tr('campaignRetrieve'), 'title': tr('campaignRetrieve')) }}</li>
			</ul>
		</div>
		<div class="module_el">
			<h2>{{ link_to(language~'/content/', '<span class="glyphicon glyphicon-envelope"></span> '~tr('content'), 'title': tr('content')) }}
			</h2>
			<ul>
			<li>{{ link_to(language~'/content/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('contentCreate'), 'title': tr('contentCreate')) }}</li>
			<li>{{ link_to(language~'/content/retrieve/', '<span class="glyphicon glyphicon-pencil"></span> '~tr('contentRetrieve'), 'title': tr('contentRetrieve')) }}</li>
			<li>{{ link_to(language~'/content/templates/', '<span class="glyphicon glyphicon-pencil"></span> '~tr('contentTemplates'), 'title': tr('contentTemplates')) }}</li>
			</ul>
		</div>
		
	</div>
</div>