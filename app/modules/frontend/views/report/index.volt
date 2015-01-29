{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	{%- if list -%}
	<h1>{{tr('reports')}}</h1>
	<ul class="listviewList">
		{% for campaignobject in campaignobjects %}
		<li><a href='{{ path }}/{{ campaignobject.uid }}'>>> {{campaignobject.title}} | {{ date('d.m.Y',campaignobject.tstamp) }}</a></li>
		{% endfor %}
	</ul>
	{% else %}
	<h1>{{tr('report')}}</h1>
	<ul class="listviewList">
		{% for sendoutobject in sendoutobjects %}
		<li><a href='{{ path }}/{{ sendoutobject.uid }}'>>> {{sendoutobject.subject}} | {{ date('d.m.Y',sendoutobject.tstamp) }}</a></li>
		{% endfor %}
	</ul>
	{% endif %}
	{% endif %}
</div>