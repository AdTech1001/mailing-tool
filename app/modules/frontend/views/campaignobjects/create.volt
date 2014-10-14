
{% include 'partials/flash-messages.volt' %}
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
<div id="conditionsModelerSelect" class="allPurposeLayer hidden">
	<label>{{ tr('segmentConditions') }}</label>
	
	<div id="conditionWrapper">
		<form id="conditionsForm"> 
		<table>
			<thead>
				<td>{{tr('junktor')}}</td>
				<td>{{tr('basecondition')}}</td>
				<td>{{tr('operator')}}</td>
				<td>{{tr('condition')}}</td>
			</thead>
		<tbody>
		
			<tr id="conditionRow_1" class="conditionRow">
				<td>
					<select name="junctor0[]" class="junctor0 hidden">
						<option value='0'>{{ tr('and') }}</option>
						<option value='1'>{{ tr('or') }}</option>
						<option value='2'>{{ tr('xor') }}</option>
					</select>
					<select name="junctor1[]" class="junctor1">
						<option value='0'>{{ tr('if') }}</option>
						<option value='1'>{{ tr('ifnot') }}</option>
					</select>
				</td>
				<td>
					<select name="baseArgument[]" class="baseArgument">
						<option value='0'>{{ tr('pleaseSelect') }}</option>
						<option value='1'>{{ tr('field') }}</option>						
						<option value='2'>{{ tr('action') }}</option>
					</select>
					<select name="fields[]" class="fields hidden">
						<option value='0'>{{ tr('gender') }}</option>
						<option value='1'>{{ tr('firstname') }}</option>
						<option value='2'>{{ tr('lastname') }}</option>
						<option value='3'>{{ tr('email') }}</option>
						<option value='4'>{{ tr('zip') }}</option>
						<option value='5'>{{ tr('region') }}</option>
						<option value='6'>{{ tr('place') }}</option>
						<option value='7'>{{ tr('state') }}</option>
						<option value='8'>{{ tr('organisation') }}</option>
						<option value='9'>{{ tr('subscription') }}</option>
						<option value='10'>{{ tr('clickprofile') }}</option>
					</select>
				</td>
				<td>
					<select name="operator[]" class="fieldOperators hidden">
						<option value='0'>{{ tr('equals') }}</option>
						<option value='1'>{{ tr('contains') }}</option>
						<option value='2'>{{ tr('largerthan') }}</option>
						<option value='3'>{{ tr('largerequal') }}</option>
						<option value='4'>{{ tr('lowerthan') }}</option>
						<option value='5'>{{ tr('lowerequal') }}</option>
					</select>
					<select name="operator[]" class="actionOperators hidden">
						<option value='0'>{{ tr('hasOpened') }}</option>
						<option value='1'>{{ tr('hasClicked') }}</option>						
					</select>
				</td>
				<td>
					<input type="text" name="fieldconditions[]" class="fieldconditions hidden">
					<button class="clickconditions hidden" title="{{ tr('selectLink') }}"><span class="glyphicon glyphicon-link"></span></button>
					<input type="hidden" name="clickconditions[]" class="clickconditions hidden">
				</td>
				<td>
					<button title="{{ tr('addConditionRow') }}" id="addCondition"><span class="glyphicon glyphicon-plus-sign"></span></button>
				</td>
			</tr>
			
		</tbody>
		</table>
		</form>
		<br><button class="ok">{{ tr('ok') }}</button><button class="abort">{{ tr('abort') }}</button>
	</div>
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
			<input type="hidden" value="0" name="mailobject" >
			<input type="hidden" value="0" name="configurationobject" >
			<input type="hidden" value="0" name="date" >
		</div>
	</div>
    
    <div class="window" data-controller="conditionobjects" data-action="add"><div class="glyphicon glyphicon-sort-by-attributes-alt"><div class="hidden"></div><br><span class="itemLabel">{{ link_to(language~'/conditionobjects/create/', tr('addConditions'),'class':'itemLabel'  )}}</span></div></div>
    <div class="window" data-controller="abtest" data-action="add"><div class="glyphicon glyphicon-transfer"><br><span class="itemLabel">{{ link_to(language~'/conditionobjects/create/', tr('abtest'),'class':'itemLabel'  )}}</span></div></div>
	<div class="window" data-controller="automationbjects" data-action="add"><div class="glyphicon glyphicon-random"><div class="hidden"></div><br><span class="itemLabel">{{ link_to(language~'/automationobjects/create/', tr('addAutomation'),'class':'itemLabel'  )}}</span></div></div>
	
</div> 	
</div>


<input type="hidden" id="language" value="{{ lang }}">
{%- endif -%}

</div>
