
<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<h1>{{tr('composeTitle')}}</h1>


{%- endif -%}

</div>
