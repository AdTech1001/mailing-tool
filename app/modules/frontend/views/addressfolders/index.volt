
{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">	
{%- if session.get('auth') -%}

{%- if detail -%}
<h1>{{tr('addressFolderSelectLabel')}}: {{foldertitle}}</h1>


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
	{{ hidden_field("folderuid","value": folderuid) }}
{%- else -%}
<h1>{{tr('addressFolderSelectLabel')}}</h1>
<ul class="listviewList">
	{%- for addressfolder in addressfolders -%}
	<li><a href='{{ path }}/addressfolders/index/{{ addressfolder.uid }}'>>> {{addressfolder.title}} | {{ date('d.m.Y',addressfolder.tstamp) }}</a></li>
	{%- endfor -%}
</ul>
{%- endif -%}	
{%- endif -%}

</div>