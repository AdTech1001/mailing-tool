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
	jQuery('#templatedCElements .cElementThumb').each(function(index,element){
		jQuery(element).draggable({
			appendTo: "#desktop",			
			helper: "clone",
			scroll: false,
			zIndex:999,
			handle: "img",
			snap: ".cElement",
			revert: "invalid",
			containment: "#desktop",
			start: function(event,ui) {
				
				jQuery(ui.helper).addClass("clone");
				var cElement=jQuery(ui.helper).find('.cElement');
				jQuery(cElement).addClass('hidden');
			 }
		});
	});
	
	jQuery('#recentCElements .cElement').each(function(index,element){
		jQuery(element).draggable({
			appendTo: "#desktop",			
			scroll: false,
			helper: "clone",
			zIndex: 999,
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
	
	jQuery('#editFrame .editable .cElement').mouseenter(function(e){		
		var elementToDelete=jQuery(this);
		var templateposition=jQuery('.editable').index(jQuery(this).parent());
		var positionsorting=jQuery(this).index();		
		jQuery(this).append(jQuery('#deleteOverlay'));
		jQuery('#deleteOverlay').removeClass('hidden').click(function(e){
			
			jQuery(elementToDelete).remove();
		var formdata=jQuery('#editFrameForm').serialize();
			formdata+='&templateposition='+templateposition+'&positionsorting='+positionsorting;			
			
			ajaxIt('contentobjects','delete',formdata,reloadFrame);
		});
	});
	
	jQuery('#editFrame .cElement').mouseleave(function(e){
		jQuery('body').append(jQuery('#deleteOverlay'));
		jQuery('#deleteOverlay').addClass('hidden').off('click');
		
	});
	
	
	
	var modeAcvtivateFunction=function(e){
		e.stopPropagation()
		var modeToActivate=jQuery(this).attr('data-mode');
		switch(modeToActivate){
			case 'edit':
				jQuery('#mailobjectEditMode').trigger('click');
				break;
			case 'arrange':
				jQuery('#mailobjectEditMode').trigger('click');
				break;
		}
		
		var currentActive=jQuery('#activeMode span');
		
		jQuery('#inactiveMode').append(currentActive);
		jQuery(currentActive).removeClass('active').addClass('inactive').click(modeAcvtivateFunction);
		jQuery(this).removeClass('inactive').addClass('active');
		
		jQuery('#activeMode').html(jQuery(this));
		jQuery(this).off( "click");
	};
	
	jQuery('#inactiveMode span').click(modeAcvtivateFunction);
	
	
	jQuery('.editable').droppable({
      activeClass: "ui-state-default",
      hoverClass: "ui-state-hover",
	  
      drop: function( event, ui ) {		  
		  var elOffsetTop=ui.draggable[0].offsetTop;
		  var cElementsOnPosition=jQuery(this).find('.cElement');
		  var newElement;
		  
		  if(jQuery(ui.helper).hasClass('clone')){
				if(jQuery(ui.helper).hasClass('cElementThumb')){
					newElement=jQuery(ui.draggable[0].lastElementChild).clone();
				}else{
					newElement=jQuery(ui.draggable).clone();
				}
				
				
					jQuery(newElement).draggable({			
									containment: "#editFrame",
									snap: ".cElement",
									revert: 'invalid' 
					});
				
		  }else{
				newElement=jQuery(ui.draggable);
				
		  }		  
		  jQuery(newElement).css({top:"",left:"",right:"",bottom:""});		  
		  
		  if(cElementsOnPosition.length===0){
				jQuery(this).append(newElement);
		  }else{
			  var inserted=false;
			  for(var i=0; i<cElementsOnPosition.length; i++){				  
				  
				  if(elOffsetTop <= cElementsOnPosition[i].offsetTop){					 					  											  
					jQuery(newElement).insertBefore(jQuery(cElementsOnPosition[i]));
					inserted=true;
					break;
				  }else{
					jQuery(newElement).insertAfter(jQuery(cElementsOnPosition[i]));
					inserted=true;  
				  }
		      }
			  if(!inserted){
				  jQuery(this).append(newElement);
			  }
			}
		 
}
	});
	
	
	
	jQuery('#mailobjectEditMode').click(function(e){
		e.stopPropagation();
		console.log(jQuery(this).hasClass('active'));
		if(jQuery(this).hasClass('active')){
			tinymce.remove("#editFrame div.editable");
			jQuery('#editFrame table').removeClass('mce-item-table');
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


