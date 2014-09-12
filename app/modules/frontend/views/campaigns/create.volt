
{% include 'partials\flash-messages.volt' %}
{{ content() }}
<div id="confirmTitleInputTemplate" class="hidden"><input type="text" id="titleInput" name="title"><br><button class="ok">{{ tr('ok') }}</button><button class="abort">{{ tr('abort') }}</button></div>
{% for mailobject in mailobjects %}
                <li></li>
            {% endfor %}
<div class="container">	
{%- if session.get('auth') -%}
<form id="automationWorkflowForm"><label>{{tr('campaignCreateTitle')}}</label> <input type="text" value="" placeholder="{{tr('unnamedCampaign')}}" name="wkTitle">
	<div id="fileTollBar"><div class="glyphicon glyphicon-floppy-save" id="campaignSave" data-controller="campaign" data-action="update"><span class="itemLabel">{{ tr('save') }}</span></div></div>
<div class="demo flowchart-demo automationWorkspace" id="automationWorkspace">
	        

<div id="campaignCreateElements">
	<div class="window" data-controller="dummy" data-action="start"><div class="glyphicon glyphicon-play"><br><span class="itemLabel">{{ tr('startCampaign') }}</span></div> </div>
	<div class="window" data-controller="sendobject" data-action="create"><div class="glyphicon glyphicon-envelope"><br><span class="itemLabel">{{ tr('createSendObject') }}</span></div> </div>
	<div class="window" data-controller="mailobject" data-action="add"><div class="glyphicon glyphicon-file"><br><span class="itemLabel">{{ tr('addMail') }}</span></div></div>
    <div class="window" data-controller="senddate" data-action="create"><div class="glyphicon glyphicon-time"><br><span class="itemLabel">{{ tr('addSendDate') }}</span></div></div>
	<div class="window" data-controller="addresses" data-action="add"><div class="glyphicon glyphicon-user"><br><span class="itemLabel">{{ tr('addAdrresses') }}</span></div></div>
    <div class="window" data-controller="automation" data-action="add"><div class="glyphicon glyphicon-random"><br><span class="itemLabel">{{ tr('addConditions') }}</span></div></div>
    
</div> 	
</div>

</form>
{%- endif -%}

</div>
