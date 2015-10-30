{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('triggereventsCreate')}}</h1>
		<div class='listelementContainer'>
			<div id="mailobjectSelect">
				<form id="templateobjectCreateForm" action="{{path}}/subscriptionsobjects/create/" method="POST" >
				<label>{{ tr('selectMailobjectLabel')}}</label><br>
				<select name="mailobject">
					{% for mailobject in mailobjects %}
					<option value="{{mailobject.uid}}">{{mailobject.title}} | {{ date('d.m.Y',mailobject.tstamp) }}</option>
					{% endfor %}
				</select>
				<br>
				<label>{{ tr('addConfigurationobject')}}</label><br>
				<select name="configurationsobject">
					{% for configurationobject in configurationsobjects %}
					<option value="{{configurationobject.uid}}">{{configurationobject.title}} | {{ date('d.m.Y',configurationobject.tstamp) }}</option>
					{% endfor %}
				</select>
				<br>
				<label>{{ tr('addressListLabel')}}</label><br>
				<select name="addresslistobject">
					{% for addresslistobject in addresslistobjects %}
					<option value="{{addresslistobject.uid}}">{{addresslistobject.title}} | {{ date('d.m.Y',addresslistobject.tstamp) }}</option>
					{% endfor %}
				</select>

				<br><label>{{ tr('eventtype')}}</label><br>
				<select name="eventtype">
					{% for index,eventtype in eventtypes %}
					<option value="{{index}}">{{eventtype}}</option>
					{% endfor %}
				</select><br>
				<label>{{ tr('sendoutSubject')}}</label><br>
				<input type="text" id="subject"><br>
				<label>{{ tr('sendoutDateLabel')}}</label><br>
				<input type="text" id="datepicker"><br><br>

				</div>
				<br><input type="submit" class="ok" value="{{ tr('ok') }}">
				</form>
			</div>
		</div>
	</div>
	{% endif %}
</div>