{% include 'partials\flash-messages.volt' %}
{{ content() }}
<div class="container">
<div id="fileTollBar"><div class="glyphicon glyphicon-floppy-save" id="mailobjectSave" data-controller="mailobject" data-action="create"><span class="itemLabel">{{ tr('save') }}</span></div></div>	
{%- if session.get('auth') -%}
<h1>{{tr('composeTitle')}}</h1>
<form action="/baywa-nltool/{{language}}/mailobjects/create/" method="POST">
	<label>{{ tr('nameLabel')}}</label><br>
	<input name="title" type="text" syle="width:400px;"><br><br>

	<ul id="templateCarousel">
		
{% for templateobject in templateobjects %}
<li data-uid="{{ templateobject.uid }}"><h3>{{ templateobject.title }}</h3><br>
	<img src="{{ templateobjectsthumbs[templateobject.uid] }}">
	
</li>
    
{% endfor  %}
	</ul>
	<div class="clearfix"></div>
<input type="hidden" name="templateobject" value="0">
<input type="submit" value="{{ tr('ok') }}">
</form>
{%- endif -%}

</div>
