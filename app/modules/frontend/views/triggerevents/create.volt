{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('triggereventsCreate')}}</h1>
		<div class='listelementContainer'>
			<div id="mailobjectSelect">
				<form id="templateobjectCreateForm" action="{{path}}/triggerevents/create/" method="POST" >
					<label>{{ tr('title')}}</label><br>
				<input type="text" name="title"><br><br>
				<label>{{ tr('selectMailobjectLabel')}}</label><br>
				<select name="mailobject">
					<option value="0">{{tr('pleaseSelect')}}</option>
					{% for mailobject in mailobjects %}
					<option value="{{mailobject.uid}}">{{mailobject.title}} | {{ date('d.m.Y',mailobject.tstamp) }}</option>
					{% endfor %}
				</select>
				<br><br>
				<label>{{ tr('addConfigurationobject')}}</label><br>
				<select name="configurationsobject">
					<option value="0">{{tr('pleaseSelect')}}</option>
					{% for configurationobject in configurationsobjects %}
					<option value="{{configurationobject.uid}}">{{configurationobject.title}} | {{ date('d.m.Y',configurationobject.tstamp) }}</option>
					{% endfor %}
				</select>
				<br><br>
				<label>{{ tr('addressFolderSelectLabel')}}</label><br>
				<select name="addressfolder">
					<option value="0">{{tr('pleaseSelect')}}</option>
					{% for addressfolder in addressfolders %}
					<option value="{{addressfolder.uid}}">{{addressfolder.title}} | {{ date('d.m.Y',addressfolder.tstamp) }}</option>
					{% endfor %}
				</select>
				<br><br>
				<label>{{ tr('addressListLabel')}}</label><br>
				<select name="addresslistobject">
					<option value="0">{{tr('pleaseSelect')}}</option>
					{% for addresslistobject in addresslistobjects %}
					<option value="{{addresslistobject.uid}}">{{addresslistobject.title}} | {{ date('d.m.Y',addresslistobject.tstamp) }}</option>
					{% endfor %}
				</select><br><br>
				<label>{{ tr('eventtype')}}</label><br>
				<select name="eventtype">
					<option value="0">{{tr('pleaseSelect')}}</option>
					{% for index,eventtype in eventtypes %}
					<option value="{{index}}">{{eventtype}}</option>
					{% endfor %}
				</select><br><br>
				<label>{{ tr('sendoutSubject')}}</label><br>
				<input type="text" name="subject"><br><br>
				<label>{{ tr('sendoutDateLabel')}}</label><br>
				<input type="text" id="datepicker" name="sendoutdate"><br><br>

				</div>
				<br><input type="submit" class="ok" value="{{ tr('ok') }}">
				</form>
			</div>
		</div>
	</div>
	{% endif %}
</div>