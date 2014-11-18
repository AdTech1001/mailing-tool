{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
{%- if session.get('auth') -%}
	<div id="menuWrapper" class="clearfix">
	<div id="activityModeBar"><h1>{{ tr('reviewUpdateLabel') }}</h1>
	</div>
<div id="fileToolBar">	
	<div class="glyphicon glyphicon-envelope" id="testmail" data-controller="mailobject" data-action="update" title="{{ tr('testmail') }}"></div>
	<div class="glyphicon" style="font-size: 1em;top: -1px;">
	{{ link_to(language~'/mailobjects/update/'~sendoutobject.mailobjectuid, '', 'title': tr('mailobjectsRetrieve'), 'id':'mailobjectEditMode', 'class':'glyphicon glyphicon-edit') }}
	</div>
	<div class="glyphicon glyphicon-floppy-save" id="mailobjectUpdate" data-controller="review" data-action="update" title="{{ tr('save') }}">
	</div>
</div>	
</div>		
	<div id="reviewConfiguration">
		<label>{{tr('sendoutDateLabel')}}:</label><span>{{ date('d.m.Y',sendoutobject.tstamp) }}</span><br>
		<label>{{tr('sendoutSubject')}}: </label><span>{{ sendoutobject.subject }}</span><br><br>
		<h4>{{tr('addConfigurationobject')}}</h4><br>
		<label>{{tr('confSendernameLabel')~' ('~tr('confSendermailLabel')~')'}}:</label><span>{{ sendoutobject.configuration.sendername }} ({{ sendoutobject.configuration.sendermail }})</span><br>
		<label>{{tr('confAnswernameLabel')~' ('~tr('confAnswermailLabel')~')'}}:</label><span>{{ sendoutobject.configuration.answername }} ({{ sendoutobject.configuration.answermail }})</span><br>
		<label>{{tr('confReturnpathLabel')}}</label><span>{{ sendoutobject.configuration.returnpath }}</span>

	</div>

	<div id="viewFrame" style="position:relative;overflow:hidden;">
	
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
<div id="testmailLayer" class="prompt">
	<h1>{{ tr('testmailLabel')}}</h1>
	<input type="text" placeholder="beispiel@mailadresse.de"><br>
	<br><button class="ok split">{{ tr('ok') }}</button><button class="abort split">{{ tr('abort') }}</button>
</div> 
<input type="hidden" id="sendoutobjectuid" value="{{sendoutobject.uid}}">
{%- endif -%}
</div>