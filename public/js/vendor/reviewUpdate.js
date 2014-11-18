var oksent=function(data){
	console.log(data);
};

jQuery('document').ready(function(){
	var sendoutobjectuid=jQuery('#sendoutobjectuid').val();
	jQuery('#deviceSelectBar ul li').click(function(e){
		var elem=jQuery(this).index();
		jQuery('#deviceSelectBar ul li').removeClass('active');
		jQuery(this).addClass('active');
		var deviceMap={0:{"width":1920,"height":1080},1:{"width":1320,"height":800},2:{"width":768,"height":1024},3:{"width":1024,"height":768},4:{"width":320,"height":568},5:{"width":568,"height":320}};
		jQuery('#mailobjectFrame').width(deviceMap[elem].width).height(deviceMap[elem].height);
		
	});
	
	jQuery('#testmailLayer button.ok').click(function(e){
		
		ajaxIt('testmail','create','&sendoutobjectuid='+sendoutobjectuid+'&email='+jQuery('#testmailLayer input').val(),oksent);	
	});
	
	jQuery('#testmail').click(function(e){		
		jQuery('#testmailLayer').show().css({"position":"fixed","top":((Math.round(viewportH/2))-(jQuery('#testmailLayer').height()*2)),"left":(Math.round((viewportW/2))-jQuery('#testmailLayer').width()/2)});
		
	});
});