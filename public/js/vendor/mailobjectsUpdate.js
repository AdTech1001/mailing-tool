var reloadFrame=function(){
	document.getElementById('mailobjectFrame').src += '';	
};

jQuery('document').ready(function(){
	jQuery('.editable p, .editable a, .editable img, .editable h1, .editable h2, .editable h3, .editable h4, .editable h5, .editable h6').each(function(index,element){
		jQuery(element).attr('contenteditable','true');
	});
	jQuery('#mailobjectUpdate').bind('click', 
		
		function(e){
			var editElements='';
			jQuery('.editable').each(function(index,element){
				var content=jQuery(element).html();
				content=(jQuery(element).html()).replace(/contenteditable="true"/g," ");
				
				editElements+='&contentElements[]='+encodeURIComponent(content)+'';
			});
			var formdata=jQuery('#editFrameForm').serialize();
			formdata+=editElements;			
			var mailobjectUid=jQuery('#mailobjectUid').val();
			ajaxIt(baseController,baseAction,formdata,reloadFrame,mailobjectUid);
		}
	);
});