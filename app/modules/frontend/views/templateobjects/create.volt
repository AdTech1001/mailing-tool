
{% include 'partials\flash-messages.volt' %}
{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
<form id="templateobjectCreateForm" action="/baywa-nltool/{{language}}/templateobjects/create/" method="POST" enctype="multipart/form-data">
	<label>{{ tr('templateNameLabel')}}</label><br>
	<input name="title" type="text" style="width:400px;"><br><br>
	<label>{{ tr('templateTypeLabel')}}</label><br>
	<select name="templatetype">
		<option value="0">{{ tr('templateTypeMail') }}</option>
		<option value="1">{{ tr('templateTypeContent') }}</option>
	</select>
	<br><br>
	<label>{{ tr('templateSourceLabel')}}</label><br>
	<textarea name="sourcecode" style="width:800px;height:600px;"></textarea><br><br>
	<label>{{ tr('templateFilepathLabel')}}</label><br>
	<div id="addImage" class="glyphicon glyphicon-camera" style="font-size:28px;cursor:pointer;"></div><input name="templatefilepath" id="addImageDialog" type="file" style="opacity:0;filter:alpha(opacity = 0)">
	<br><br>
	<input type="submit" value="{{ tr('ok') }}">
	
		
	
</form>
</div>
{%- endif -%}