<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<h1>{{tr('distributorCreateTitle')}}</h1>

<ul class="listviewList">
	{% for distributor in distributors %}
	<li><a href='{{ path }}{{ distributor.uid }}'>>> {{distributor.title}} | {{ date('d.m.Y',distributor.tstamp) }} | {{distributor.countAddresses()}}</a></li>
	{% endfor %}
</ul>


{%- endif -%}

</div>
