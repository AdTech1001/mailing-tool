{% include 'partials\flash-messages.volt' %}
<div class="container">
	{% include 'partials\function-menu.volt' %}
	<div class="desktop">
		{{ content() }}
		<h1>{{tr('actionTitle')}}</h1>
		<div class="module_el">
			<h2>{{ link_to(language~'/campaigns/create/', '<span class="glyphicon glyphicon-envelope"></span> '~tr('campaign'), 'title': tr('campaign')) }}
			</h2>
			<ul>
			<li>{{ link_to(language~'/campaigns/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('campaignCreate'), 'title': tr('campaignCreate')) }}</li>
			<li>{{ link_to(language~'/campaigns/retrieve/', '<span class="glyphicon glyphicon-pencil"></span> '~tr('campaignRetrieve'), 'title': tr('campaignRetrieve')) }}</li>
			</ul>
		</div>
		<div class="module_el">
			<h2>{{ link_to(language~'/mailobjects/index/', '<span class="glyphicon glyphicon-envelope"></span> '~tr('mailobjects'), 'title': tr('mailobjects')) }}
			</h2>
			<ul>
			<li>{{ link_to(language~'/mailobjects/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('mailobjectsCreate'), 'title': tr('mailobjectsCreate')) }}</li>
			<li>{{ link_to(language~'/mailobjects/index/', '<span class="glyphicon glyphicon-pencil"></span> '~tr('mailobjectsRetrieve'), 'title': tr('mailobjectsRetrieve')) }}</li>
			</ul>
		</div>
		<div class="module_el">
			<h2>{{ link_to(language~'/contentobjects/', '<span class="glyphicon glyphicon-envelope"></span> '~tr('contentobjects'), 'title': tr('contentobjects')) }}
			</h2>
			<ul>
			<li>{{ link_to(language~'/contentobjects/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('contentobjectsCreate'), 'title': tr('contentobjectsCreate')) }}</li>
			<li>{{ link_to(language~'/contenobjectst/index/', '<span class="glyphicon glyphicon-pencil"></span> '~tr('contentobjectsRetrieve'), 'title': tr('contentobjectsRetrieve')) }}</li>
			<li>{{ link_to(language~'/contentobjects/templates/', '<span class="glyphicon glyphicon-pencil"></span> '~tr('contentobjectsTemplates'), 'title': tr('contentobjectsTemplates')) }}</li>
			</ul>
		</div>
		
	</div>
</div>