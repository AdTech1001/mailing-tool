{% include 'partials\flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
<div id="fileTollBar"><div class="glyphicon glyphicon-floppy-save" id="configurationobjectsSave" data-controller="configurationsobjects" data-action="create"><span class="itemLabel">{{ tr('save') }}</span></div></div>	

<h1>{{tr('confTitle')}}</h1>
{{ form(language~'/configurationobjects/create/', 'method': 'post') }}

	<label>{{ tr('confTitleLabel') }}</label><br>
    {{ text_field("title", "size": 32) }}
	<br>
    <label>{{ tr('confSendermailLabel') }}</label><br>
    {{ text_field("sendermail", "size": 32) }}
<br>
    <label>{{ tr('confSendernameLabel') }}</label><br>
    {{ text_field("sendername", "size": 32) }}
	<br>
	<label>{{ tr('confAnswermailLabel') }}</label><br>
    {{ text_field("answermail","size": 32) }}
<br>
<label>{{ tr('confAnswernameLabel') }}</label><br>
    {{ text_field("answername","size": 32) }}
<br>
<label>{{ tr('confReturnpathLabel') }}</label><br>
    {{ text_field("returnpath","size": 32) }}
<br>
<label>{{ tr('confOrganisationLabel') }}</label><br>
    {{ text_field("organisation","size": 32) }}
<br>
<label>{{ tr('confhtmlplainLabel') }}</label><br>
	 {{ select("htmlplain",  [ '0' : tr('html'), '1' : tr('plain'), '2' : tr('both')]) }}
    {{ submit_button(tr('ok')) }}

</form>
{%- endif -%}

</div>