<?php use Phalcon\Tag as Tag ?>

{% include 'partials\flash-messages.volt' %}
{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
	<div id="editFrame">
		<form id="editFrameForm">
		{{ compiledTemplatebodyRaw }} 
		<input type="hidden" value="{{ mailobjectuid }}" name="mailobjectUid" id="mailobjectUid">
		</form>
	</div>
	
	<div id="campaignCreateElements">
		
	</div>
</div>	
<div id="viewFrame">
	<iframe id="mailobjectFrame" style="border:1px solid; background:#e3e3e3;width:80%; min-height:100%;" src="{{ source }}" ></iframe>
</div>
{% endif %}
