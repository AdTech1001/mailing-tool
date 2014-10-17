
{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
{%- if session.get('auth') -%}
<h1>{{tr('templateobjectsIndexTitle')}}</h1>

<ul class="listviewList">
	{% for templateobject in templateobjects %}
	<li><a href='{{ path }}{{ templateobject.uid }}'>>> {{templateobject.title}} | {{ date('d.m.Y',templateobject.tstamp) }}</a></li>
	{% endfor %}
</ul>


{%- endif -%}

</div>
