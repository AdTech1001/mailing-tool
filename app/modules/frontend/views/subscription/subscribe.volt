
	
{{ content() }}


<form action="{{path}}/subscription/subscribe/" method="POST" >				
    {% if in_array(2,addressfields) %}
    <label>{{ tr('salutation') }}</label><br>
    <select name="salutation">
            <option value="0">{{tr('ms')}}</option>
            <option value="1">{{tr('mr')}}</option>
    </select><br><br>
    {% endif %}
    {% if in_array(3,addressfields) %}
    <label>{{ tr('title') }}</label><br>
    <input type="text" name="title"><br><br>
    {% endif %}
    {% if in_array(0,addressfields) %}
    <label>{{ tr('firstname') }}</label><br>
    <input type="text" name="firstname"><br><br>
    {% endif %}
    {% if in_array(1,addressfields) %}
    <label>{{ tr('lastname') }}</label><br>
    <input type="text" name="lastname"><br><br>
    {% endif %}
    {% if in_array(5,addressfields) %}
    <label>{{ tr('phone') }}</label><br>
    <input type="text" name="phone"><br><br>
    {% endif %}
    {% if in_array(6,addressfields) %}
    <label>{{ tr('address') }}</label><br>
    <input type="text" name="address"><br><br>
    {% endif %}
    {% if in_array(7,addressfields) %}
    <label>{{ tr('place') }}</label><br>
    <input type="text" name="city"><br><br>
    {% endif %}
    {% if in_array(9,addressfields) %}
    <label>{{ tr('zip') }}</label><br>
    <input type="text" name="zip"><br><br>
    {% endif %}
    {% if in_array(8,addressfields) %}
    <label>{{ tr('company') }}</label><br>    
    <input type="text" name="company"><br><br>
    {% endif %}
    {% if in_array(4,addressfields) %}
    <label>{{ tr('email')}}</label><br>
    <input type="text" name="email"><br><br>
    {% endif %}
    {% if in_array(10,addressfields) %}
    <label>{{ tr('region')}}</label><br>
    <input type="text" name="region"><br><br>
    {% endif %}
    {% if in_array(11,addressfields) %}
    <label>{{ tr('province')}}</label><br>
    <input type="text" name="province"><br><br>
    {% endif %}
    {% if in_array(12,addressfields) %}
    <label>{{ tr('language')}}</label><br>
    <input type="text" name="language"><br><br>
    {% endif %}
    {% if in_array(13,addressfields) %}
    <label>{{ tr('gender')}}</label><br>
    <input type="text" name="salutation"><br><br>
    {% endif %}
    {% if in_array(14,addressfields) %}
    <label>{{ tr('birthday')}}</label><br>
    <input type="text" name="birthday"><br><br>
    {% endif %}
    {% if feuserscategories.count() > 0 %}
    <label>{{ tr('feuserscategoryIndexTitle')}}</label><br>

    {% for feuserscategory in feuserscategories %}
    <label><input type="checkbox" name="feusercategories[]" value="{{feuserscategory.uid}}"> {{feuserscategory.title}}</label><br>
    {% endfor %}
    {% endif %}
    {{ hidden_field('addressfolder',"value":subscriptionobject.addressfolder) }}
    <br><input type="submit" class="ok" value="{{ tr('ok') }}">
</form>