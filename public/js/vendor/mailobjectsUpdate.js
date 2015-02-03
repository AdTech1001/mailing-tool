var reloadFrame=function(){
		location.reload()
	//document.getElementById('mailobjectFrame').src += '';	
};
var reloadFrameDelete=function(data){
	if(data=='1'){
		location.reload();
	}else{
		alert('An error occured');
	}
};

var pollForTinymce=function(){
	if(typeof(tinymce) != 'undefined'){
		tinymce.PluginManager.add('customem', function(editor, url) {
			// Add a button that opens a window
			editor.addButton('customem', {
				type : 'menubutton',
				text: jQuery('#dynamicFields').val(),
				icon: 'glyphicon-repeat',				
				menu: [
						{
						text: jQuery('#salutationTitle').val(),
						onclick: function(){
							editor.insertContent('<dynamic>{{' + jQuery('#salutationTitle').val() + '}}</dynamic>');
							}
						},
						{
						text: jQuery('#lastnameTitle').val(),
						onclick: function(){
							editor.insertContent('<dynamic>{{' + jQuery('#lastnameTitle').val() + '}}</dynamic>');
							}

						},
						{
						text: jQuery('#titleTitle').val(),
						onclick: function(){
							editor.insertContent('<dynamic>{{' + jQuery('#titleTitle').val() + '}}</dynamic>');
							}

						}
					]
					
					// Open window
					/*editor.windowManager.open({
						title: 'dynamic Field, will be substituted',
						body: [
							{type: 'textbox', name: 'description', label:jQuery('#salutationTitle').val() }
						],
						onsubmit: function(e) {
							// Insert content when the window form is submitted
							editor.insertContent('<dynamic><span>' + e.data.description + '</span></dynamic>');
						}
					});*/
				
			});

			// Adds a menu item to the tools menu
			/*editor.addMenuItem('customem', {
				text: jQuery('#salutationTitle').val(),
				context: 'tools',
				onclick: function() {
					editor.insertContent('<salutation>{{' + jQuery('#salutationTitle').val() + '}}</salutation>');
				}
			});*/
		});
		
		tinymce.init({
			selector: "#editFrame div.editable",
			theme: "modern",			
			schema: "html5",
			inline: true,
			language: lang,
			keep_styles: true,					
			relative_urls: false,
			remove_script_host: false,
			statusbar: true,
			menubar : "tools table format view insert edit",
			plugins: [
				"customem advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table contextmenu paste"
			],
			extended_valid_elements : "dynamic",
			custom_elements: "~dynamic",			
			toolbar: "customem | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code"
		});
		
		
		
		
		
		
	}else{
		window.setTimeout(pollForTinymce,10);
	}
}
var lang;
function pluginInit(){
	/*jQuery('.editable p, .editable a, .editable img, .editable h1, .editable h2, .editable h3, .editable h4, .editable h5, .editable h6').each(function(index,element){
		jQuery(element).attr('contenteditable','true');
	});*/
	lang=jQuery('#lang').val();
	var  arrangeMode=function(){
		
	
		jQuery('#editFrame a').click(function(e){		
			e.preventDefault();
			var r = confirm("Would you like to open the link?");
			if (r == true) {

				window.open(jQuery(this).attr('href'), "linkwindow", "scrollbars=auto");
			} 
		});
		jQuery('#closePrev').click(function(e){
			jQuery('#viewFrame').hide();
		});
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
		jQuery('#dynamicCElements .dynamicCElement').each(function(index,element){
			jQuery(element).draggable({
				appendTo: "#desktop",			
				scroll: false,
				helper: "clone",
				zIndex: 999,

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

				ajaxIt('contentobjects','delete',formdata,reloadFrameDelete);
			});
		});

		jQuery('#editFrame .cElement').mouseleave(function(e){
			jQuery('body').append(jQuery('#deleteOverlay'));
			jQuery('#deleteOverlay').addClass('hidden').off('click');

		});
	
	}
	arrangeMode();
	var modeAcvtivateFunction=function(e){
		e.stopPropagation();
		var modeToActivate=jQuery(this).attr('data-mode');
		
		switch(modeToActivate){
			case 'edit':
				pollForTinymce();
				break;
			case 'arrange':
				tinymce.remove("#editFrame div.editable");
				jQuery('#editFrame table').removeClass('mce-item-table');
				arrangeMode();
				break;
		}
		
		jQuery('.mode.active').removeClass('active').addClass('inactive').click(modeAcvtivateFunction);
		jQuery(this).removeClass('inactive').addClass('active');		
		
		jQuery(this).off( "click");
	};
	var cesToActivate=function(e){
		var mode=jQuery(this).attr('data-mode');		
		jQuery('.cemode').removeClass('active').addClass('inactive');
		jQuery(this).removeClass('inactive').addClass('active');
		jQuery('.tabs').each(function(index,element){
			if(jQuery(element).hasClass(mode)){
				jQuery(element).removeClass('hidden');
			}else{
				jQuery(element).addClass('hidden');
			}
			
		});
		
	}
	jQuery('.mode.inactive').click(modeAcvtivateFunction);
	jQuery('.cemode').click(cesToActivate);
	
	jQuery('.editable').droppable({
      activeClass: "ui-state-default",
      hoverClass: "ui-state-hover",
	  
      drop: function( event, ui ) {		  
		  
		  var elOffsetTop=event.pageY - $(this).offset().top;
		  
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
	jQuery('#mailobjectPreview').click(function(e){
		jQuery('#viewFrame').show();
		
	});
	
	jQuery('#deviceSelectBar ul li').click(function(e){
		var elem=jQuery(this).index();
		jQuery('#deviceSelectBar ul li').removeClass('active');
		jQuery(this).addClass('active');
		var deviceMap={0:{"width":1920,"height":1080},1:{"width":1320,"height":800},2:{"width":768,"height":1024},3:{"width":1024,"height":768},4:{"width":320,"height":568},5:{"width":568,"height":320}};
		jQuery('#mailobjectFrame').width(deviceMap[elem].width).height(deviceMap[elem].height);
		
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
		
	
};


