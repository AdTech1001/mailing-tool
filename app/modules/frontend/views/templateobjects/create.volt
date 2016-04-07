
{% include 'partials/flash-messages.volt' %}
{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
	<div class="ceElement medium">		
		<h1>{{tr('templateobjectsCreate')}}</h1>
		<div class='listelementContainer'>
		<form id="templateobjectCreateForm" action="{{path}}/templateobjects/create/" method="POST" enctype="multipart/form-data">
			<label>{{ tr('templateNameLabel')}}</label><br>
			<input name="title" type="text" style="width:400px;"><br><br>
			<label>{{ tr('templateTypeLabel')}}</label><br>
			<select name="templatetype">
				<option value="0">{{ tr('templateTypeMail') }}</option>
				<option value="1">{{ tr('templateTypeContent') }}</option>
				<option value="2">{{ tr('templateTypeContentDynamic') }}</option>
			</select>
			<br><br>                        
			<label>{{ tr('templateSourceLabel')}}</label><br>
			<textarea name="sourcecode" style="width:400px;height:600px;"></textarea><br><br>
			<label>{{ tr('templateFilepathLabel')}}</label><br>
			<div id="addImage" class="glyphicon glyphicon-camera" style="font-size:28px;cursor:pointer;"></div><input name="templatefilepath" id="addImageDialog" type="file" style="opacity:0;filter:alpha(opacity = 0)">
			<br>
                        <p>Für dynamische Elemente:</p>
                        <label>Api</label><br>
			<select name="api">
				<option value="0">{{ tr('pleaseSelect') }}</option>
				<option value="1">Tecparts</option>
				<option value="2">Landingpage-Modul</option>
			</select>
			<br><br>
                        <label>Typ</label><br>
			<select name="dytype">
				<option value="0">{{ tr('pleaseSelect') }}</option>
				<option value="1">nur automatisches Auslesen von Inhalten</option>
				<option value="2">voll dynamisch mit Personalisierung</option>
			</select>
			
                        <br><br>   
			<input type="submit" value="{{ tr('ok') }}">



		</form>
		</div>
	</div>
</div>
{%- endif -%}