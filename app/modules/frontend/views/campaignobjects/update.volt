
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
<div id="linkSelect" class="allPurposeLayer hidden">
	<label>{{ tr('linkSelect') }}</label>
	<select name="links" >
		<option value='0'><a href="#">Link 1</a></option>
		<option value='1'><a href="#">Link 2</a></option>
		<option value='3'><a href="#">Link 3</a></option>
		<option value='4'><a href="#">Link 4</a></option>
		<option value='5'><a href="#">Link 5</a></option>
		<option value='6'><a href="#">Link 6</a></option>
		
	</select>
</div>
<div id="conditionsModelerSelect" class="allPurposeLayer hidden">
	<label>{{ tr('segmentConditions') }}</label>
	
	<div id="conditionsWrapper">
		<form id="conditionsForm"> 
		<table>
			<thead>
				<td>{{tr('junktor')}}</td>
				<td>{{tr('basecondition')}}</td>
				<td>{{tr('operator')}}</td>
				<td>{{tr('condition')}}</td>
			</thead>
		<tbody>
		
			<tr id="conditionsRow_1" class="conditionsRow">
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
					<select name="fields[]" class="fields">
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
					<select name="operator[]" class="fieldOperators">
						<option value='0'>{{ tr('equals') }}</option>
						<option value='1'>{{ tr('contains') }}</option>
						<option value='2'>{{ tr('largerthan') }}</option>
						<option value='3'>{{ tr('largerequal') }}</option>
						<option value='4'>{{ tr('lowerthan') }}</option>
						<option value='5'>{{ tr('lowerequal') }}</option>
					</select>
					
				</td>
				<td>
					<input type="text" name="fieldconditions[]" class="fieldconditions">
					
				</td>
				<td>
					<button title="{{ tr('addConditionRow') }}" id="addconditions"><span class="glyphicon glyphicon-plus-sign"></span></button>
				</td>
			</tr>
			
		</tbody>
		</table>
		</form>
		<br><button class="ok conditions">{{ tr('ok') }}</button><button class="abort conditions">{{ tr('abort') }}</button>
	</div>
</div>
<div id="splitModelerSelect" class="allPurposeLayer hidden">
	<label>{{ tr('segmentConditions') }}</label>
	
	<div id="splitWrapper">
		<form id="splitForm"> 
		<table>
			<thead>
				<td>{{tr('junktor')}}</td>
				
				<td>{{tr('operator')}}</td>
				
				<td><span class="glyphicon glyphicon-link"></span></td>
			</thead>
		<tbody>
		
			<tr id="splitRow_1" class="splitRow">
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
					
					<select name="operator[]" class="actionOperators">
						<option value='0'>{{ tr('hasOpened') }}</option>
						<option value='1'>{{ tr('hasClicked') }}</option>						
					</select>
				</td>
				<td>					
					
					<select name="links[]" >
		<option value='0'><a href="#">Link 1</a></option>
		<option value='1'><a href="#">Link 2</a></option>
		<option value='3'><a href="#">Link 3</a></option>
		<option value='4'><a href="#">Link 4</a></option>
		<option value='5'><a href="#">Link 5</a></option>
		<option value='6'><a href="#">Link 6</a></option>
		
	</select>
			
				</td>
				<td>
					<button title="{{ tr('addConditionRow') }}" id="addsplit"><span class="glyphicon glyphicon-plus-sign"></span></button>
				</td>
			</tr>
			
		</tbody>
		</table>
		</form>
		<br><button class="ok split">{{ tr('ok') }}</button><button class="abort split">{{ tr('abort') }}</button>
	</div>
</div>


<div class="container">	
{%- if session.get('auth') -%}
<div id="menuWrapper" class="clearfix">
<div id="fileToolBar"><div class="glyphicon glyphicon-floppy-save" id="campaignSave" data-controller="campaign" data-action="update" title="{{ tr('save') }}"></div></div>
</div>
<form id="automationWorkflowForm">
	
	<label>{{tr('campaignCreateTitle')}}</label> <input type="text" value="" placeholder="{{tr('unnamedCampaign')}}" name="title">
	<input type="hidden" value="{{ campaignobjectUid }}" name="campaignobjectuid">
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
    
    <div class="window" data-controller="conditionobjects" data-action="add"><div class="glyphicon glyphicon-sort-by-attributes-alt"><form class="hidden"></form><br><span class="itemLabel">{{ link_to(language~'/conditionobjects/create/', tr('addConditions'),'class':'itemLabel'  )}}</span></div></div>
    
	<div class="window" data-controller="automationbjects" data-action="add"><div class="glyphicon glyphicon-random"><form class="hidden"></form><br><span class="itemLabel">{{ link_to(language~'/automationobjects/create/', tr('addAutomation'),'class':'itemLabel'  )}}</span></div></div>


</div> 	
</div>


<input type="hidden" id="language" value="{{ lang }}">
{%- endif -%}

</div>