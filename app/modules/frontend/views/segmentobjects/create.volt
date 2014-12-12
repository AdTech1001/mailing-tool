{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
<div id="menuWrapper" class="clearfix">
<div id="fileToolBar"><div class="glyphicon glyphicon-floppy-save" id="segmentSave" data-controller="campaign" data-action="update" title="{{ tr('save') }}"></div></div>
</div>	
<h1>{{tr('addressFolderSelectLabel')}}</h1>

<div id="filters">
	<h1>{{ tr('filtersTitle') }}</h1>
	<label>{{ tr('addressfolders') }}</label><br>
	{{ select('addressfolders[]',addressfolders,"using":['uid','title'],'multiple':true) }}<br><br>
	<div class="filterSet">
	{{ tr('commaseperatedList')}}<br>
	<label>{{ tr('firstnames') }}</label>
	{{ text_field('firstname')}}<br>
	<label>{{ tr('lastname')}}</label>
	{{ text_field('lastname')}}<br>
	<label>{{ tr('zip')}}</label>
	{{ text_field('zip')}}<br>
	<label>{{ tr('company')}}</label>
	{{ text_field('company')}}<br>
	<label>{{ tr('address')}}</label>
	{{ text_field('address')}}<br>
	</div>
	<br><br>
</div>
<table id="adressfolderTable" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
				<th>{{tr('email')}}</th>
                <th>{{tr('lastname')}}</th>
                <th>{{tr('firstname')}}</th>
				<th>{{tr('salutation')}}</th>				
				<th>{{tr('title')}}</th>				
				<th>{{tr('company')}}</th>
				<th>{{tr('phone')}}</th>
				<th>{{tr('address')}}</th>
				<th>{{tr('place')}}</th>
				<th>{{tr('zip')}}</th>
				<th>{{tr('userlanguage')}}</th>
				<th>{{tr('gender')}}</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>{{tr('email')}}</th>
                <th>{{tr('lastname')}}</th>
                <th>{{tr('firstname')}}</th>
				<th>{{tr('salutation')}}</th>				
				<th>{{tr('title')}}</th>				
				<th>{{tr('company')}}</th>
				<th>{{tr('phone')}}</th>
				<th>{{tr('address')}}</th>
				<th>{{tr('place')}}</th>
				<th>{{tr('zip')}}</th>
				<th>{{tr('userlanguage')}}</th>
				<th>{{tr('gender')}}</th>
            </tr>
        </tfoot>
    </table>





{%- endif -%}

</div>