{% include 'partials\flash-messages.volt' %}
{{ content() }}
<div class="container">
	
{%- if session.get('auth') -%}
<h1>{{tr('composeTitle')}}</h1>
<form action="/baywa-nltool/{{language}}/mailobjects/update/" method="POST">
	<label>{{ tr('nameLabel')}}</label><br>
	<input name="title" type="text" syle="width:400px;"><br><br>
<select name="templateobject">
<option value="0">{{tr('selectTemplateLabel') }}</option>
{% for templateobject in templateobjects %}
<option value="{{ templateobject.uid }}">{{ templateobject.title }}</option>
    
{% endfor  %}
</select>
<input type="submit" value="{{ tr('ok') }}">
</form>
{%- endif -%}

</div>
