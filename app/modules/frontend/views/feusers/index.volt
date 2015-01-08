

	{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
<h1>{{tr('feusersIndexTitle')}}</h1>

<table class="maintable">
	<thead>
		<tr>
			<th>{{ tr('feusers.username') }}</th>
			<th>{{ tr('feusers.lastname') }}</th>
			<th>{{ tr('feusers.firstname') }}</th>
			<th>{{ tr('feusers.title') }}</th>
			<th>{{ tr('feusers.email') }}</th>
			<th>{{ tr('feusers.phone') }}</th>
			<th>{{ tr('feusers.address') }}</th>
			<th>{{ tr('feusers.city') }}</th>
			<th>{{ tr('feusers.zip') }}</th>
			<th>{{ tr('feusers.company') }}</th>
			<th>{{ tr('feusers.usergroup') }}</th>
			<th>{{ tr('feusers.profile') }}</th>
			<th>{{ tr('feusers.superuser') }}</th>
			<th>{{ tr('feusers.userlanguage') }}</th>
		</tr>
	</thead>
	<tr>
	{% for feuser in feusers %}
	<td>{{feuser.username}}</td>
	<td>{{feuser.last_name}}</td>
	<td>{{feuser.first_name}}</td>
	<td>{{feuser.title}}</td>
	<td>{{feuser.email}}</td>
	<td>{{feuser.phone}}</td>
	<td>{{feuser.address}}</td>
	<td>{{feuser.city}}</td>
	<td>{{feuser.zip}}</td>
	<td>{{feuser.company}}</td>
	<td>{{feuser.getUsergroup().title}}</td>
	<td>{{feuser.getProfile().title}}</td>
	<td>{{feuser.superuser}}</td>
	<td>{{feuser.getUserlanguage().shorttitle}}</td>
	<td><a href='{{ path }}{{ feuser.uid }}'>>> {{tr('update')}}</a></td>
	{% endfor %}
	</tr>
</table>


{%- endif -%}

</div>
