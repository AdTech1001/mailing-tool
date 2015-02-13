function pluginInit(){
	jQuery('input[type="checkbox"]').click(function(e){		
		var elVal=jQuery(this).val().split('_');
		ajaxIt('profiles','update','profileid='+elVal[0]+'&resourceid='+elVal[1]+'&resourceaction='+elVal[2],dummyEmpty);		
	});
	
	
		
};