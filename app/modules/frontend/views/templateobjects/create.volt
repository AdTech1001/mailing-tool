
{% include 'partials\flash-messages.volt' %}
{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
<form id="templateobjectCreateForm" action="/baywa-nltool/{{language}}/templateobjects/create/" method="POST">
	<label>{{ tr('templateNameLabel')}}</label><br>
	<input name="title" type="text" syle="width:400px;"><br><br>
	
	<label>{{ tr('templateSourceLabel')}}</label><br>
	<textarea name="sourcecode" style="width:800px;height:600px;"></textarea><br><br>
	<label>{{ tr('templateFilepathLabel')}}</label><br>
	<input name="templatefilepath" type="text" syle="width:400px;"><br><br>
	<input type="submit" value="{{ tr('ok') }}">
	
		
	
</form>
</div>
{%- endif -%}