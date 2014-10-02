
{% include 'partials\flash-messages.volt' %}
{{ content() }}
<div class="container">	
{%- if session.get('auth') -%}
<h1>{{tr('campaignCreateTitle')}}</h1>

<form><input type="text" value="" placeholder="{{tr('unnamedCampaign')}}"></form>
<div class="demo flowchart-demo automationWorkspace" id="flowchart-demo">
	                <div class="window" id="flowchartWindow1"><strong>1</strong><br/><br/></div>
                <div class="window" id="flowchartWindow2"><strong>2</strong><br/><br/></div>
                <div class="window" id="flowchartWindow3"><strong>3</strong><br/><br/></div>
                <div class="window" id="flowchartWindow4"><strong>4</strong><br/><br/></div>

	
</div>

{%- endif -%}

</div>
