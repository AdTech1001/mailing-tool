{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<h1>{{tr('report')}}</h1>
	<h2>{{tr('general')}}</h2>
	<label>{{tr('campaign')}}:</label> {{ sendoutobject.getCampaign().title}}<br>
	<label>{{tr('sendoutSubject')}}:</label> {{sendoutobject.subject}}<br>
	<label>{{tr('sendoutDateLabel')}}:</label> {{ date('d.m.Y.',sendoutobject.sendstart) }} - {{ date('d.m.Y.',sendoutobject.sendend) }}<br>
	<br>
	<label>{{tr('sent')}}:</label> {{sent}} / {{complete}}
	<h2>{{tr('response')}}</h2>
	<label>{{tr('opened')}}:</label> {{ opened }} / {{ roundTwo((opened*100/sent)) }}%<br>
	<label>{{tr('clicked')}}:</label> {{ clicked }} / {{ roundTwo((clicked*100/sent)) }}%<br>
	<h2>{{tr('responseLinks')}}</h2>
	<table class="maintable" style="width:auto;min-width:0">
		<thead>
			<tr>
				<th>{{tr('linknumber')}}</th>
				<th>{{tr('url')}}</th>
				<th>{{tr('totalClicks')}}</th>
					
			</tr>
					
		</thead>
		<tbody>
			{% for linkclick in clicks %}
			<tr>
				
					<td >{{linkclick.getLink().linknumber}}</td>
					<td >{{linkclick.url}}</td>
					<td>{{clickcounts[linkclick.linkuid]}}</td>
				
					
			</tr>
			{% endfor %}
		</tbody>
	</table>
	{% endif %}
</div>