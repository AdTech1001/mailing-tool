{% include 'partials/flash-messages.volt' %}
<div class="container">	
	<div class="desktop">
		{{ content() }}
		<h1>{{tr('actionTitle')}}</h1>
		<div class="module_el">
			<h2>{{ link_to(language~'/campaignobjects/index/', '<span class="glyphicon glyphicon-th"></span> '~tr('campaign'), 'title': tr('campaign')) }}
			</h2>
			<ul>
			<li>{{ link_to(language~'/campaignobjects/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('campaignCreate'), 'title': tr('campaignCreate')) }}</li>
			<li>{{ link_to(language~'/campaignobjects/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('campaignRetrieve'), 'title': tr('campaignRetrieve')) }}</li>
			</ul>
		</div>
		<div class="module_el">
			<h2>{{ link_to(language~'/mailobjects/index/', '<span class="glyphicon glyphicon-envelope"></span> '~tr('mailobjects'), 'title': tr('mailobjects')) }}
			</h2>
			<ul>
			<li>{{ link_to(language~'/mailobjects/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('mailobjectsCreate'), 'title': tr('mailobjectsCreate')) }}</li>
			<li>{{ link_to(language~'/mailobjects/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('mailobjectsRetrieve'), 'title': tr('mailobjectsRetrieve')) }}</li>
			</ul>
		</div>
		<div class="module_el">
			<h2>{{ link_to(language~'/templateobjects/index/', '<span class="glyphicon glyphicon-file"></span> '~tr('templateobjects'), 'title': tr('templateobjects')) }}
			</h2>
			<ul>
			<li>{{ link_to(language~'/templateobjects/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('templateobjectsCreate'), 'title': tr('templateobjectsCreate')) }}</li>
			<li>{{ link_to(language~'/templateobjects/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('templateobjectsRetrieve'), 'title': tr('templateobjectsRetrieve')) }}</li>
			</ul>
		</div>
		<div class="module_el">
			<h2>{{ link_to(language~'/configurationobjects/index/', '<span class="glyphicon glyphicon-align-justify"></span> '~tr('configurationobjects'), 'title': tr('configurationobjects')) }}
			</h2>
			<ul>
			<li>{{ link_to(language~'/configurationobjects/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('configurationobjectsCreate'), 'title': tr('configurationobjectsCreate')) }}</li>
			<li>{{ link_to(language~'/configurationobjects/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('configurationobjectsRetrieve'), 'title': tr('configurationobjectsRetrieve')) }}</li>
			</ul>
		</div>
		<div class="module_el">
			<h2>{{ link_to(language~'/contentobjects/', '<span class="glyphicon glyphicon-envelope"></span> '~tr('contentobjects'), 'title': tr('contentobjects')) }}
			</h2>
			<ul>
			<li>{{ link_to(language~'/contentobjects/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('contentobjectsCreate'), 'title': tr('contentobjectsCreate')) }}</li>
			<li>{{ link_to(language~'/contentobjects/index/', '<span class="glyphicon glyphicon-pencil"></span> '~tr('contentobjectsRetrieve'), 'title': tr('contentobjectsRetrieve')) }}</li>
			<li>{{ link_to(language~'/contentobjects/templates/', '<span class="glyphicon glyphicon-pencil"></span> '~tr('contentobjectsTemplates'), 'title': tr('contentobjectsTemplates')) }}</li>
			</ul>
		</div>
		<div class="module_el">
			<h2>{{ link_to(language~'/addresses/', '<span class="glyphicon glyphicon-user"></span> '~tr('addresses'), 'title': tr('addresses')) }}
			</h2>
			<ul>
			<li>{{ link_to(language~'/addresses/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('addressesCreate'), 'title': tr('addressesCreate')) }}</li>
			<li>{{ link_to(language~'/addresses/index/', '<span class="glyphicon glyphicon-pencil"></span> '~tr('addressesRetrieve'), 'title': tr('addressesRetrieve')) }}</li>
			
			</ul>
		</div>
		
		
	</div>
</div>