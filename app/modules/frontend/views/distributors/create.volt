{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}


<h1>{{tr('distributorCreateTitle')}}</h1>
{{ form(language~'/distributors/create/', 'method': 'post') }}


	<label>{{ tr('distributorTitleLabel') }}</label><br>
	{{text_field('title')}}	
	<br><br>	
	<label>{{ tr('addressfolders') }}</label><br>
    {{ select('addressfolders[]', addressfolders, 'using':['uid','title'],'multiple':true) }}	
	<br><br>
	<label>{{ tr('segmenobjects') }}</label><br>
    {{ select('segmentobjects[]', segmentobjects, 'using':['uid','title'],'multiple':true) }}	
	
	<br><br>


    {{ submit_button(tr('ok'),'id':'uploadAndShowMap') }}

</form>

{%- endif -%}

</div>