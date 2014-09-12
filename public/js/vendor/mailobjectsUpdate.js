var reloadFrame=function(){
	document.getElementById('mailobjectFrame').src += '';	
};

jQuery('document').ready(function(){
	jQuery('#editFrame .editarea').bind('input propertychange', 
		function(e){
			var formdata=jQuery('#editFrameForm').serialize();
			var mailobjectUid=jQuery('#mailobjectUid').val();
			ajaxIt(baseController,baseAction,formdata,reloadFrame,mailobjectUid);
		}
	);
});