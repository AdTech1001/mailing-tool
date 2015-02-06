{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
	<h1>{{tr('clearingTasks')}}</h1>
	<div class="dataTables_wrapper">
	<table class="display dataTable">
		<thead>
		<tr>
		<th>{{tr('sendoutDateLabel')}}</th>
		<th>{{tr('mailobjects')}}</th>
		<th>{{tr('campaign')}}</th>
		<th>{{tr('reviewed')}}</th>
		<th>{{tr('cleared')}}</th>
		<th>{{tr('sendstate')}}</th>
		</tr>
		</thead>
		<tbody>
			{% for index,sendoutobject in sendoutobjects %}
			<tr class='{% if index is even %}odd{% else %}even{%endif%}'>
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
	</div>
	<br>
	</div>
{%- endif -%}

</div>