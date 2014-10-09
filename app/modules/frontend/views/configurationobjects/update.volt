{% include 'partials\flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
<div id="fileTollBar"><div class="glyphicon glyphicon-floppy-save" id="configurationobjectsSave" data-controller="configurationsobjects" data-action="create"><span class="itemLabel">{{ tr('save') }}</span></div></div>	

<h1>{{tr('confTitle')}}</h1>
{{ form(language~'/configurationobjects/update/', 'method': 'post') }}

	<label>{{ tr('confTitleLabel') }}</label><br>
    {{ form.render("title") }}
	<br>
    <label>{{ tr('confSendermailLabel') }}</label><br>
    {{ form.render("sendermail") }}
<br>
    <label>{{ tr('confSendernameLabel') }}</label><br>
    {{ form.render("sendername") }}
	<br>
	<label>{{ tr('confAnswermailLabel') }}</label><br>
    {{ form.render("answermail") }}
<br>
<label>{{ tr('confAnswernameLabel') }}</label><br>
    {{ form.render("answername") }}
<br>
<label>{{ tr('confReturnpathLabel') }}</label><br>
    {{ form.render("returnpath") }}
<br>
<label>{{ tr('confOrganisationLabel') }}</label><br>
    {{ form.render("organisation") }}
<br>
<label>{{ tr('confhtmlplainLabel') }}</label><br>
	 {{ form.render("htmlplain") }}
	 {{form.render('uid')}}
    {{ submit_button(tr('ok')) }}

</form>
{%- endif -%}

</div>
