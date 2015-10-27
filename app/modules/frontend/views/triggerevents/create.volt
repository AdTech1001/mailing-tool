{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<div id="mailobjectSelect">
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

			<br><br>
			<label>{{ tr('sendoutSubject')}}</label><br>
			<input type="text" id="subject"><br>
			<label>{{ tr('sendoutDateLabel')}}</label><br>
			<input type="text" id="datepicker"><br><br>
			
			</div>
			<br><button class="ok">{{ tr('ok') }}</button><button class="abort">{{ tr('abort') }}</button>
		</div>
	</div>
</div>