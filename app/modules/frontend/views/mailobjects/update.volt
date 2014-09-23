<?php use Phalcon\Tag as Tag ?>

{% include 'partials\flash-messages.volt' %}
{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
<div id="fileToolBar">
	<div class="glyphicon glyphicon-edit" id="mailobjectEditMode" data-controller="mailobject" data-action="update"><span class="itemLabel">{{ tr('edit') }}</span>
	</div>
	<div class="glyphicon glyphicon-floppy-save" id="mailobjectUpdate" data-controller="mailobject" data-action="update"><span class="itemLabel">{{ tr('save') }}</span>
	</div>
</div>		
	<div id="tooltipOverlay" class="hidden">
		<form id="contentElements">
			<label>tr('contentTypeLabel')</label><br>
			<select name="contentType">
				<option value="0">tr('plaintext')</option>
				<option value="1">tr('rte')</option>
				<option value="2">tr('devider')</option>
				<option value="3">tr('image')</option>
				<option value="4">tr('custom')</option>
				<option value="5">tr('dynamic')</option>
			</select><br><br>
			<div class="hidden">
			<label>tr('contentCustom')</label>
			<select name="contentElement">
				<option value="0">tr('pleaseSelect')</option>
				{% for contentElement in contentElements %}
				<option value="{{ contentElement.uid }}">{{ contentElement.title }}</option>
				{% endfor %}
			</select>
			</div>
		</form>
	</div>
<div class="clearfix"></div>
<div id="desktop">
	<div id="editFrame">
		<form id="editFrameForm">
		{{ compiledTemplatebodyRaw }} 
		<input type="hidden" value="{{ mailobjectuid }}" name="mailobjectUid" id="mailobjectUid">
		</form>
	
	</div>
	<div id="campaignCreateElements">
		
		{% for cElement in cElements %}
		{%- if cElement.sourcecode != '' -%}
		<div class="cElementThumbWrapper"><span>{{ cElement.title }}</span>
			<div class="cElementThumb">
				{{ cElement.sourcecode }}
			</div>
		</div>
		{% endif %}
        {% endfor %}
		
	</div>	
	<div class="clearfix"></div>
</div>
	
</div>	
<div id="viewFrame">
	<iframe id="mailobjectFrame" style="border:1px solid; background:#e3e3e3;width:80%; min-height:100%;" src="{{ source }}" ></iframe>
</div>
{% endif %}
