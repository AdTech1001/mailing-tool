
{% include 'partials\flash-messages.volt' %}
{{ content() }}

<div id="confirmTitleInputTemplate" class="hidden"><input type="text" id="titleInput" name="title"><br><button class="ok">{{ tr('ok') }}</button><button class="abort">{{ tr('abort') }}</button></div>
<div id="mailobjectSelect" class="allPurposeLayer hidden">
	<label>{{ tr('selectMailobjectLabel')}}</label><br>
	<div id="mailobjectSelectWrapper">
		
	</div><br>
	<label>{{ tr('selectMailobjectLabel')}}</label><br>
	<div id="configurationobjectSelectWrapper">
		
	</div><br>
	<label>{{ tr('sendoutDateLabel')}}</label><br>
	<input type="text" id="datepicker"><br>
	<br><button class="ok">{{ tr('ok') }}</button><button class="abort">{{ tr('abort') }}</button>
</div>



<div class="container">	
{%- if session.get('auth') -%}
<div id="menuWrapper" class="clearfix">
<div id="fileToolBar"><div class="glyphicon glyphicon-floppy-save" id="campaignSave" data-controller="campaign" data-action="update" title="{{ tr('save') }}"></div></div>
</div>
<form id="automationWorkflowForm">
	
	<label>{{tr('campaignCreateTitle')}}</label> <input type="text" value="" placeholder="{{tr('unnamedCampaign')}}" name="wkTitle">
</form>	
<div class="demo flowchart-demo automationWorkspace" id="automationWorkspace">
	        <div class="window jsplumbified" id="startpoint" data-controller="dummy" data-action="start"><div class="glyphicon glyphicon-play"><br><span class="itemLabel">{{ tr('startCampaign') }}</span></div></div>

<div id="campaignCreateElements">
	
	<div class="window sendoutobject" data-controller="sendoutobject" data-action="create">
		<div class="glyphicon glyphicon-envelope"><br>{{ link_to(language~'/sendoutobject/create/', tr('createSendObject'),'class':'itemLabel'  )}}
			<input type='hidden' value='0' name="mailobject" >
			<input type='hidden' value='0' name="configurationobject" >
			<input type='hidden' value='0' name="date" >
		</div>
	</div>
    
    <div class="window" data-controller="automation" data-action="add"><div class="glyphicon glyphicon-random"><br><span class="itemLabel">{{ tr('addConditions') }}</span></div></div>
    
</div> 	
</div>


<input type="hidden" id="language" value="{{ lang }}">
{%- endif -%}

</div>
