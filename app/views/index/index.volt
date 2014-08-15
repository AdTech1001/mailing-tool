{% include 'partials\flash-messages.volt' %}
<div class="container">
	{% include 'partials\function-menu.volt' %}
	<div class="desktop">
		<h1>{{tr('overviewTitle')}}</h1>

		<div class="content_el">
			<h2>Overview</h2>
			{{ content() }}
		</div>
	</div>
</div>