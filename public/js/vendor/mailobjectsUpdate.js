var reloadFrame=function(){
	document.getElementById('mailobjectFrame').src += '';	
};

var pollForTinymce=function(){
	if(typeof(tinymce) != 'undefined'){
		tinymce.init({
			selector: "#editFrame div.editable",
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
	jQuery('#campaignCreateElements .cElement').each(function(index,element){
		jQuery(element).draggable({
			appendToType: "#desktop",
			helper: "clone",
			snap: ".cElement",
			revert: "invalid",
			containment: "#desktop",
			start: function(event,ui) {
				
				jQuery(ui.helper).addClass("clone");
				
			 }
		});
	});
	
	
	jQuery('#editFrame .cElement').draggable({			
			containment: "#editFrame",
			snap: ".cElement",
			revert: 'invalid' 
	});
	
	
	
	jQuery('.editable')
	
	jQuery('.editable').droppable({
      activeClass: "ui-state-default",
      hoverClass: "ui-state-hover",
	  
      drop: function( event, ui ) {
		  console.log(ui.helper[0].offsetTop);
		  var elOffsetTop=ui.helper[0].offsetTop;
		  var cElementsOnPosition=jQuery(this).find('.cElement');
		  if(cElementsOnPosition.length===0){
			if(jQuery(ui.helper).hasClass('clone')){
				var newElement=jQuery(ui.draggable).clone();
				jQuery(this).append(newElement);
				jQuery(newElement).draggable({			
						containment: "#editFrame",
						snap: ".cElement",
						revert: 'invalid' 
				});
			}else{
				jQuery(this).append(jQuery(ui.draggable));
			}
		  }else{
			  for(var i=0; i<cElementsOnPosition.length; i++){
				  
				  if(elOffsetTop < cElementsOnPosition[i].offsetTop){
					  if(jQuery(ui.helper).hasClass('clone')){
						var newElement=jQuery(ui.draggable).clone();
						jQuery(this).append(newElement);
						jQuery(newElement).draggable({			
								containment: "#editFrame",
								snap: ".cElement",
								revert: 'invalid' 
						});
						jQuery(newElement).css({top:"",left:"",right:"",bottom:""});
					  }else{
						  jQuery(ui.draggable).insertBefore(jQuery(cElementsOnPosition[i]));
						  jQuery(ui.draggable).css({top:"",left:"",right:"",bottom:""});
					  }					  					  
					  break;
				  }
			  }
		  }
		  
		  
		 
	  }
	});
	
	
	
	jQuery('#mailobjectEditMode').click(function(){
		if(jQuery(this).hasClass('active')){
			tinymce.remove("#editFrame div.editable");
			jQuery(this).removeClass('active');
		}else{
			jQuery(this).addClass('active');
			pollForTinymce();
		}
		
	});
	
	jQuery('#mailobjectUpdate').bind('click', 
		
		function(e){
			var editElements='';
			jQuery('#editFrame .editable').each(function(posIndex,posEl){
				jQuery(posEl).children('.cElement').each(function(index,element){
					var content=jQuery(element)[0].outerHTML;

					content=content.replace(/position: relative;|left: 0px;|top: 0px;|contenteditable="true"|id="mce*"|mce-edit-focus|mce-content-body|mce-item-table|data-mce-selected="1"|ui-draggable-handle|ui-draggable/g,"");											
					
					
					
					editElements+='&contentElements['+posIndex+']['+index+']='+encodeURIComponent(content)+'';
				});
				
				
			});
			
			var formdata=jQuery('#editFrameForm').serialize();
			formdata+=editElements;			
			var mailobjectUid=jQuery('#mailobjectUid').val();
			ajaxIt(baseController,baseAction,formdata,reloadFrame,mailobjectUid);
		}
	);
		
	
});


