
{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">	
{%- if session.get('auth') -%}
<h1>{{tr('campaignObjectsIndexTitle')}}</h1>



<ul class="listviewList">
	{% for campaignobject in campaignobjects %}
	<li><a href='{{ path }}{{ campaignobject.uid }}'>>> {{campaignobject.title}} | {{ date('d.m.Y',campaignobject.tstamp) }}</a></li>
	{% endfor %}
</ul>

{%- endif -%}

</div>
