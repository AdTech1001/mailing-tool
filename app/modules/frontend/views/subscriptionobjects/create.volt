{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('triggereventsCreate')}}</h1>
		<div class='listelementContainer'>
			<div id="mailobjectSelect">
				<form id="templateobjectCreateForm" action="{{path}}/subscriptionobjects/create/" method="POST" >				
				<label>{{ tr('title')}}</label><br>
				<input type="text" name="title"><br><br>
				<label>{{ tr('addressFolderSelectLabel')}}</label><br>
				<select name="addressfolder">
					{% for addressfolder in addressfolders %}
					<option value="{{addressfolder.uid}}">{{addressfolder.title}} | {{ date('d.m.Y',addressfolder.tstamp) }}</option>
					{% endfor %}
				</select>
				<br><br>
				<label>{{ tr('feuserscategoryIndexTitle')}}</label><br>
				<select name="feuserscategories[]" multiple="multiple">
					{% for feuserscategory in feuserscategories %}
					<option value="{{feuserscategory.uid}}">{{feuserscategory.title}} | {{ date('d.m.Y',feuserscategory.tstamp) }}</option>
					{% endfor %}
				</select>
				<br><br>
                                <label>{{tr('subscriptionAddressFields')}}</label><br>
                                    {% for fieldindex,addressfield in addressfields %}
                                    <label for="{{addressfield}}"><input id="{{addressfield}}" name="addressfields[{{fieldindex}}]" type="checkbox" value="{{fieldindex}}">{{tr(addressfield)}}</label> <br>
                                    {% endfor %}
                                <br><br>
				<label>{{ tr('catsTitle')}}</label><br>
				<div id="newAddressfolders">
					<input type="text" name="newfeuserscategories[]"> <button title="{{ tr('catsTitle') }}" id="addfolderinput"><span class="glyphicon glyphicon-plus-sign"></span></button>
                                </div>
                                <br><br>
				<label>CSS</label><br>
                                <textarea name="css"></textarea><br><br>
                                <label>Placeholder?</label><br>
                                <select name="placeholder">
                                    <option value="0">{{tr('no')}}</option>
                                    <option value="1">{{tr('yes')}}</option>
                                </select>
                                
				<input type="submit" class="ok" value="{{ tr('ok') }}">
				</form>
			</div>
		</div>
	</div>
	{% endif %}
</div>