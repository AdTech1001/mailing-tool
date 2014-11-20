var viewportW = Math.max(document.documentElement.clientWidth, window.innerWidth || 0)
var viewportH = Math.max(document.documentElement.clientHeight, window.innerHeight || 0)
var baseurl=document.getElementById('baseurl').value;
function init(jQuery){
	jQuery('.container').append('<div id="loadingimg"><h3>Einen Moment bitte</h3><div><img src="/baywa-nltool/images/ajax-loader.gif"></div></<div>');
	jQuery('body').append('<div id="tooltipOverlay"></div>');
	//jQuery.address.init().bind('change', navigation);
	
	if(typeof(requirePlugins) != 'undefined'){
		requireControllerPlugins();
	}
	
	jQuery('#addImage').click(function(e){
		e.stopPropagation();
		jQuery("#addImageDialog").trigger('click');
		
	});
	
	jQuery('#templateCarousel li').click(function(){
		
		if(jQuery(this).hasClass('active')){
			jQuery(this).removeClass('active');
			jQuery('[name="templateobject"').val(0);
		}else{
			var templateobject=jQuery(this).attr('data-uid');
			jQuery(this).addClass('active');
			jQuery('[name="templateobject"').val(templateobject);
		}
		
	});
	
}




var requireControllerPlugins=function(){
	if(requirePlugins[0]=='jsplumb'){
			require([requirePlugins[0]],function(jsPlumb){
				require([requirePlugins[1]]);
			});
			for(var i=2; i<requirePlugins.length; i++){
				require([requirePlugins[i]]);
			}
	}else if(requirePlugins[0]=='datatables'){
		
		require([requirePlugins[0]],function(datatables){
				
				require([requirePlugins[1]]);
			});
	}
	else{
		for(var i=0; i<requirePlugins.length; i++){
			require([requirePlugins[i]]);
		}	
	}
	
};

var navigation=function(e)
{
	var userparam='';
	count=jQuery.address.parameter('count');
	if(jQuery.address.parameter('action') && jQuery.address.parameter('testid') && jQuery.address.parameter('count')){
		testid=jQuery.address.parameter('testid');
		if(jQuery('#tx_dfselfassessment_wrapper_'+testid+' [name="userid"]')){
			userid=jQuery('#tx_dfselfassessment_wrapper_'+testid+' [name="userid"]').val();
			userparam='&userid='+userid;
		}
		var startParams="action="+jQuery.address.parameter('action')+"&testid="+jQuery.address.parameter('testid')+"&count="+jQuery.address.parameter('count')+userparam;
		ajaxIt(startParams,showQuestion);
	}								
};

var dummyEmpty=function(){	
};

var ajaxIt=function(controller,action,formdata,successhandler, parameters){
	 parameters = typeof parameters !== 'undefined' ? '/'+parameters : '';
	if(successhandler != dummyEmpty){
	jQuery('#loadingimg').show();
	}

	jQuery.ajax({
		url: baseurl+controller+'/'+action+parameters,
		cache: false,
		async: true,
		data: formdata,   
		type: 'POST',
		success: function(data) {
			jQuery('#loadingimg').hide();	
			successhandler(data);
		},
		error: function(e){
			console.log(e);
			jQuery('#loadingimg').hide();
			}
		});
		
};

$(document).ready(function(jQuery){
	init(jQuery);
	
});

