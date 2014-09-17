var reloadFrame=function(){
	document.getElementById('mailobjectFrame').src += '';	
};

jQuery('document').ready(function(){
	jQuery('.editable p, .editable a, .editable img, .editable h1, .editable h2, .editable h3, .editable h4, .editable h5, .editable h6').each(function(index,element){
		jQuery(element).attr('contenteditable','true');
	});
	jQuery('#mailobjectUpdate').bind('click', 
		function(e){
			var formdata=jQuery('#editFrameForm').serialize();
			var mailobjectUid=jQuery('#mailobjectUid').val();
			ajaxIt(baseController,baseAction,formdata,reloadFrame,mailobjectUid);
		}
	);
});