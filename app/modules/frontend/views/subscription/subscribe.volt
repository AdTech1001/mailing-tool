
	
{{ content() }}


<form action="{{path}}/subscription/subscribe/" method="POST" >				
				<label>{{ tr('salutation') }}</label><br>
				<select name="salutation">
					<option value="0">{{tr('ms')}}</option>
					<option value="1">{{tr('mr')}}</option>
				</select><br><br>
				<label>{{ tr('title') }}</label><br>
				<input type="text" name="title"><br><br>
				<label>{{ tr('firstname') }}</label><br>
				<input type="text" name="firstname"><br><br>
				<label>{{ tr('lastname') }}</label><br>
				<input type="text" name="lastname"><br><br>
				
				<label>{{ tr('email')}}</label><br>
				<input type="text" name="email"><br><br>
                                {% if feuserscategories.length > 0  %}
				<label>{{ tr('feuserscategoryIndexTitle')}}</label><br>
				
				{% for feuserscategory in feuserscategories %}
				<label><input type="checkbox" name="feusercategories[]" value="{{feuserscategory.uid}}"> {{feuserscategory.title}}</label><br>
				{% endfor %}
                                {% endif %}
				{{ hidden_field('addressfolder',"value":subscriptionobject.addressfolder) }}
				<br><input type="submit" class="ok" value="{{ tr('ok') }}">
				</form>


