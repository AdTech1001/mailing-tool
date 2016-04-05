
	
{{ content() }}


<form action="{{path}}/subscription/subscribe/" method="POST" >				
    {% if in_array(2,addressfields) %}
    <label>{{ tr('salutation') }}<br></label>
    <select name="salutation">
            <option value="0">{{tr('ms')}}</option>
            <option value="1">{{tr('mr')}}</option>
    </select><br><br>
    {% endif %}
    {% if in_array(3,addressfields) %}
    
    <label>{{ tr('title') }}<br></label>
    <input type="text" name="title" {{ subscriptionobject.placeholder ? 'placeholder="'~tr('title')~'"' : '' }}><br><br>
    {% endif %}
    {% if in_array(0,addressfields) %}
    <label>{{ tr('firstname') }}<br></label>
    <input type="text" name="firstname"  {{ subscriptionobject.placeholder ? 'placeholder="'~tr('firstname')~'"' : '' }}><br><br>
    {% endif %}
    {% if in_array(1,addressfields) %}
    <label>{{ tr('lastname') }}<br></label>
    <input type="text" name="lastname"  {{ subscriptionobject.placeholder ? 'placeholder="'~tr('lastname')~'"' : '' }}><br><br>
    {% endif %}
    {% if in_array(5,addressfields) %}
    <label>{{ tr('phone') }}<br></label>
    <input type="text" name="phone"  {{ subscriptionobject.placeholder ? 'placeholder="'~tr('phone')~'"' : '' }}><br><br>
    {% endif %}
    {% if in_array(6,addressfields) %}
    <label>{{ tr('address') }}<br></label>
    <input type="text" name="address"  {{ subscriptionobject.placeholder ? 'placeholder="'~tr('address')~'"' : '' }}><br><br>
    {% endif %}
    {% if in_array(7,addressfields) %}
    <label>{{ tr('place') }}<br></label>
    <input type="text" name="city"  {{ subscriptionobject.placeholder ? 'placeholder="'~tr('city')~'"' : '' }}><br><br>
    {% endif %}
    {% if in_array(9,addressfields) %}
    <label>{{ tr('zip') }}<br></label>
    <input type="text" name="zip"  {{ subscriptionobject.placeholder ? 'placeholder="'~tr('zip')~'"' : '' }}><br><br>
    {% endif %}
    {% if in_array(8,addressfields) %}
    <label>{{ tr('company') }}<br></label>    
    <input type="text" name="company"  {{ subscriptionobject.placeholder ? 'placeholder="'~tr('company')~'"' : '' }}><br><br>
    {% endif %}
    {% if in_array(4,addressfields) %}
    <label>{{ tr('email')}}<br></label>
    <input type="text" name="email"  {{ subscriptionobject.placeholder ? 'placeholder="'~tr('email')~'"' : '' }}><br><br>
    {% endif %}
    {% if in_array(10,addressfields) %}
    <label>{{ tr('region')}}<br></label>
    <input type="text" name="region"  {{ subscriptionobject.placeholder ? 'placeholder="'~tr('region')~'"' : '' }}><br><br>
    {% endif %}
    {% if in_array(11,addressfields) %}
    <label>{{ tr('province')}}<br></label>
    <input type="text" name="province"  {{ subscriptionobject.placeholder ? 'placeholder="'~tr('province')~'"' : '' }}><br><br>
    {% endif %}
    {% if in_array(12,addressfields) %}
    <label>{{ tr('language')}}<br></label>
    <input type="text" name="language"  {{ subscriptionobject.placeholder ? 'placeholder="'~tr('language')~'"' : '' }}><br><br>
    {% endif %}
    {% if in_array(13,addressfields) %}
    <label>{{ tr('gender')}}<br></label>
    <input type="text" name="salutation"  {{ subscriptionobject.placeholder ? 'placeholder="'~tr('salutation')~'"' : '' }}><br><br>
    {% endif %}
    {% if in_array(14,addressfields) %}
    <label>{{ tr('birthday')}}<br></label>
    <input type="text" name="birthday"  {{ subscriptionobject.placeholder ? 'placeholder="'~tr('birthday')~'"' : '' }}><br><br>
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