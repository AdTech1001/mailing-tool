{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<h1>{{tr('clearingTasks')}}</h1>
	<table class="maintable">
		<thead>
		<tr>
		<td>{{tr('sendoutDateLabel')}}</td>
		<td>{{tr('mailobjects')}}</td>
		<td>{{tr('campaign')}}</td>
		<td>{{tr('reviewed')}}</td>
		<td>{{tr('cleared')}}</td>
		<td>{{tr('sendstate')}}</td>
		</tr>
		</thead>
		<tbody>
			{% for index,sendoutobject in sendoutobjects %}
			<tr class='{% if index is even %}even{% else %}odd{%endif%}'>
				<td>{{ date('d.m.Y',sendoutobject.tstamp)}}</td>
				<td><a href='{{ path }}{{ sendoutobject.uid }}'>>> {{sendoutobject.subject}}</a></td>
				<td>{{sendoutobject.getCampaign().title}}</td>
				<td> 
					{% if sendoutobject.reviewed == 1 %}    
						{{tr('yes')}}
					{% else %}
						{{tr('no')}}
					{% endif %}
				</td>
				<td> {% if sendoutobject.cleared == 1 %}    
						{{tr('yes')}}
					{% else %}
						{{tr('no')}}
					{% endif %}</td>
				<td>
					{% if sendoutobject.inprogress == 1 %}    
						{{tr('inprogress')}}
					{% elseif sendoutobject.sent == 1%}
						{{tr('sent')}}
					{% else%}
						{{tr('preparation')}}
					{% endif %}
					
				</td>
			</tr>
			{% endfor %}
		</tbody>
	</table>
{%- endif -%}

</div>