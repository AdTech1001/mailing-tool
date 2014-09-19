var reloadFrame=function(){
	document.getElementById('mailobjectFrame').src += '';	
};

var pollForTinymce=function(){
	if(typeof(tinymce) != 'undefined'){
		tinymce.init({
			selector: "div.editable",
			theme: "modern",			
			schema: "html5",
			inline: true,			
			statusbar: false,
			menubar : false,
			plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table contextmenu paste"
			],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code"
		});
		
	}else{
		window.setTimeout(pollForTinymce,10);
	}
}

jQuery('document').ready(function(){
	/*jQuery('.editable p, .editable a, .editable img, .editable h1, .editable h2, .editable h3, .editable h4, .editable h5, .editable h6').each(function(index,element){
		jQuery(element).attr('contenteditable','true');
	});*/
	
	jQuery('.cElement').each(function(index,element){
		jQuery(element).attr('contenteditable','true');
	});
	jQuery('#mailobjectUpdate').bind('click', 
		
		function(e){
			var editElements='';
			jQuery('.editable').each(function(posIndex,posEl){
				jQuery(posEl).children('.cElement').each(function(index,element){
					var content=jQuery(element)[0].outerHTML;

					content=content.replace(/contenteditable="true"/g," ");

					editElements+='&contentElements['+posIndex+']['+index+']='+encodeURIComponent(content)+'';
				});
				
				
			});
			
			var formdata=jQuery('#editFrameForm').serialize();
			formdata+=editElements;			
			var mailobjectUid=jQuery('#mailobjectUid').val();
			ajaxIt(baseController,baseAction,formdata,reloadFrame,mailobjectUid);
		}
	);
		
	pollForTinymce();
});


