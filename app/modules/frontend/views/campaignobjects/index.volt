
{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">	
{%- if session.get('auth') -%}
<div class='ceElement medium'>
<h1>{{tr('campaigns')}}</h1>



<ul class="listviewList">
	{% for campaignobject in campaignobjects %}
	<li><a href='{{ path }}{{ campaignobject.uid }}'>>> {{campaignobject.title}} | {{ date('d.m.Y',campaignobject.tstamp) }}</a></li>
	{% endfor %}
</ul>
</div>
{%- endif -%}

</div>
