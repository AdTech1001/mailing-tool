<?php use Phalcon\Tag as Tag ?>

{% include 'partials/flash-messages.volt' %}
{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
<div id="menuWrapper" class="clearfix">
	<div id="activityModeBar"><h1>{{ tr('activeModeTitle') }}</h1>
		<h2 id="activeMode">
			<span class="mode active" data-mode="arrange">{{ tr('mailUpdateModeArrange') }}</span>
		</h2>
		<div class="mode glyphicon glyphicon-retweet"></div>
		<h2 id="inactiveMode" class="mode inactive"><span class="mode inactive" data-mode="edit">{{ tr('mailUpdateModeEdit') }}</span></h2>
			
		</div>
<div id="fileToolBar">
	<div class="glyphicon glyphicon-eye-open" id="mailobjectPreview" data-controller="mailobject" data-action="update" title="{{ tr('preview') }}">
	</div>
	<div class="glyphicon glyphicon-edit" id="mailobjectEditMode" data-controller="mailobject" data-action="update" title="{{ tr('edit') }}">
	</div>
	<div class="glyphicon glyphicon-floppy-save" id="mailobjectUpdate" data-controller="mailobject" data-action="update" title="{{ tr('save') }}">
	</div>
</div>	
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
		<div id="templatedCElements">
			<h3>{{ tr('templatedCElementsTitle') }}</h3>
			{% for templatedCElement in templatedCElements %}
			{%- if templatedCElement.sourcecode != '' -%}
			<div class="cElementThumbWrapper"><span>{{ templatedCElement.title }}</span>
				<div class="cElementThumb">
					{{ image(templatedCElement.templatefilepath) }}
					
					{{ templatedCElement.sourcecode }}
					
				</div>
			</div>
			{% endif %}
			{% endfor %}
		</div>
		<div id="dynamicCElements">
			<h3>{{ tr('dynamicCElementsTitle') }}</h3>
			
			<div class="cElementThumbWrapper"><span>Gegenwärtig nicht verfügbar</span>
				
			</div>
			
		</div>
		<div id="recentCElements">
			<h3>{{ tr('recentCElementsTitle') }}</h3>
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
	</div>	
	<div class="clearfix"></div>
</div>
	
</div>	
<div id="viewFrame" style="display:none">
	<div class="glyphicon glyphicon-remove" id="closePrev"></div>
	<div id="deviceSelectBar">
			<ul>
				<li class="active"><img src="{{baseurl}}public/images/device-icon-desktop.png"></li>
				<li><img src="{{baseurl}}public/images/device-icon-laptopt.png"></li>
				<li><img src="{{baseurl}}public/images/device-icon-tablet-vert.png"></li>
				<li><img src="{{baseurl}}public/images/device-icon-tablet-hor.png"></li>
				<li><img src="{{baseurl}}public/images/device-icon-smartphone-vert.png"></li>
				<li><img src="{{baseurl}}public/images/device-icon-smartphone-hor.png"></li>
			</ul>
	</div>
	<iframe id="mailobjectFrame" style="border:1px solid; background:#e3e3e3;width:100%;height:100%;" src="{{ source }}" ></iframe>
</div>
<div id="deleteOverlay" class="hidden" title="{{ tr('delete')}} "><span class='glyphicon glyphicon-remove'></span></div>
<input type="hidden" id="salutationTitle" value="{{tr('salutation')}}">
<input type="hidden" id="lastnameTitle" value="{{tr('lastname')}}">
  
{% endif %}
