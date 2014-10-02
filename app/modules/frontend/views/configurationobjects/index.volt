
<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<h1>{{tr('configurationobjectsIndexTitle')}}</h1>

<ul class="listviewList">
	{% for configurationobject in configurationobjects %}
	<li><a href='{{ path }}{{ configurationobject.uid }}'>>> {{configurationobject.title}} | {{ date('d.m.Y',configurationobject.tstamp) }}</a></li>
	{% endfor %}
</ul>


{%- endif -%}

</div>
