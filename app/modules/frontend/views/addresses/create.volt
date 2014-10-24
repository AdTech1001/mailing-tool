{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}

<div id="mapWrapper" class="{{ filehideshow }}">
<h1>{{tr('addressesCreateTitle')}}</h1>
{{ form(language~'/addresses/create/', 'method': 'post', 'enctype': 'multipart/form-data') }}


<label>{{ tr('firstRowContainsFieldName') }}</label><br>
    {{ check_field('firstRowFieldNames')}}
	
	<br><br>	
	<label>{{ tr('dateFieldsWrapped') }}</label><br>
    {{ select_static('dataFieldWrap', [ '0' : '" ('~tr('quotesign')~")", '1' : "' ("~tr('invertedcomma')~")"]) }}

	
	<br><br>
	<label>{{ tr('divider') }}</label><br>
    {{ select_static('divider', [ '0' : '; ('~tr('semicolon')~')', '1' : ', ('~tr('comma')~')','2': ': ('~tr('colon')~')', '3':'	 ('~tr('tabs')~')']) }}
	
	<br><br>
<label>{{ tr('templateFilepathLabel')}}</label><br>
{{ file_field("addresslistFile") }}
<br><br>

    {{ submit_button(tr('ok'),'id':'uploadAndShowMap') }}

</form>
</div>
<div id="mapWrapper" class="{{ maphideshow }}">
	{{ form(language~'/addresses/create/', 'method': 'post') }}


<label>{{ tr('addressSegmentSelectLabel') }}</label><br>
    {{ select('addresssegmentobjectsUid', addresssegmentobjects, 'using': ['uid', 'title'],
    'useEmpty': true, 'emptyText': tr('pleaseSelect'), 'emptyValue': '@') }}
<br>{{ tr('or') }}<br>
<label>{{ tr('addressSegmentNewLabel') }} ({{ tr('overwritesPreviousSelection') }})</label><br>
    {{ text_field("addresssegmentobjectsCreate","size": 32) }}
<br><br>
<label>{{ tr('deleteAllExistingAddresses') }}</label><br>
    {{ check_field('deleteallexisting') }}
	
	<br><br>	
	
	<table id="mapTable">
		<thead><th>Dateifelder</th><th>&nbsp;</th><th>Datenbankfelder</th></thead>
	{% for index,uploadfield in uploadfields %}
	<tr>
		<td>{{uploadfield}}</td>
		<td> >> </td>
		<td>
			{{ select('addresssegmentobjectsUid', [ '0' : tr('firstname'), '1' : tr('lastname'), '2' : tr('title'), '3' : tr('email'), '4' : tr('company'), '5' : tr('phone'), '6' : tr('address'), '7' : tr('place'), '8' : tr('zip'), '9' : tr('userlanguage'), '10' : tr('gender')]) }}
		</td>
		
	</tr>
	{% endfor %}
	</table>
	
	<br><br>
	{{ hidden_field("time","value": tstamp) }}
	{{ hidden_field("filename","value": filename) }}
    {{ submit_button(tr('ok')) }}

</form>
</div>

{%- endif -%}

</div>