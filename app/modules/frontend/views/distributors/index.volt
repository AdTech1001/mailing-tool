<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<div class="ceElement medium">
<h1>{{tr('distributors')}}</h1>

<ul class="listviewList">
	{% for distributor in distributors %}
	<li><a href='{{ path }}{{ distributor.uid }}'>>> {{distributor.title}} | {{ date('d.m.Y',distributor.tstamp) }} | {{distributor.countAddresses()}}</a></li>
	{% endfor %}
</ul>
</div>

{%- endif -%}

</div>
