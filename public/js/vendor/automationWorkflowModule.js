var instance;
var newElementCounter=0;
var activeElement;
var lang;
var exampleDropOptions = {
				tolerance:"touch",
				hoverClass:"dropHover",
				activeClass:"dragActive"
			};
var connectorPaintStyle = {
		lineWidth:4,
		strokeStyle:"#61B7CF",
		joinstyle:"round",
		outlineColor:"white",
		outlineWidth:2
	};			
var color1 = "#e32c3a";
var mainflowConnector = {
	endpoint:["Dot", {radius:13} ],
	anchor:"Right",
	paintStyle:{ fillStyle:color1, opacity:0.5 },
	isSource:true,
	scope:'red',
	connectorStyle:{ strokeStyle:color1, lineWidth:3 },
	connector : [ "Flowchart", { stub:[40, 60], gap:10, cornerRadius:5, alwaysRespectStubs:true } ],
	isTarget:false,
	dropOptions : exampleDropOptions,
	beforeDetach:function(conn) { 
		return confirm("Detach connection?"); 
	},
	onMaxConnections:function(info) {
		alert("Cannot drop connection " + info.connection.id + " : maxConnections has been reached on Endpoint " + info.endpoint.id);
	}
};

var mainflowConnectorTarget = {
	endpoint:["Dot", {radius:13} ],
	anchor:"Left",
	paintStyle:{ fillStyle:color1, opacity:0.5 },
	isSource:false,
	scope:'red',
	connectorStyle:{ strokeStyle:color1, lineWidth:3 },
	connector : [ "Flowchart", { stub:[40, 60], gap:10, cornerRadius:5, alwaysRespectStubs:true } ],
	isTarget:true,
	dropOptions : exampleDropOptions,
	beforeDetach:function(conn) { 
		return confirm("Detach connection?"); 
	},
	onMaxConnections:function(info) {
		alert("Cannot drop connection " + info.connection.id + " : maxConnections has been reached on Endpoint " + info.endpoint.id);
	}
};


			
var color2 = "#009650";
var sendDateConnectorSource = {
	endpoint:["Dot", { radius:11 }],
	paintStyle:{ fillStyle:color2 },
	isSource:true,
	scope:"green",
	connectorStyle:{ strokeStyle:color2, lineWidth:6 },
	connector : [ "Flowchart", { stub:[40, 60], gap:10, cornerRadius:5, alwaysRespectStubs:true } ],
	maxConnections:1,
	isTarget:false
	
};	
		
var sendDateConnectorTargert = {
	endpoint:["Dot", { radius:11 }],
	paintStyle:{ fillStyle:color2 },
	anchor:"Top",
	isSource:false,
	scope:"green",
	connectorStyle:{ strokeStyle:color2, lineWidth:6 },
	connector: ["Bezier", { curviness:63 } ],
	maxConnections:1,
	isTarget:true,
	dropOptions : exampleDropOptions
};			


var color3 = "#6d6e72";
var addressesConnectorSource = {
	endpoint:["Rectangle", { width:10, height:8 } ],
	paintStyle:{ fillStyle:color3 },
	anchor:"Top",
	isSource:true,
	scope:"grey",
	connectorStyle:{ strokeStyle:color3, lineWidth:3 },
	connector : [ "Flowchart", { stub:[40, 60], gap:10, cornerRadius:5, alwaysRespectStubs:true } ],
	maxConnections:1,
	isTarget:false
	
};

var addressesConnectorTarget = {
	endpoint:["Rectangle", { width:15, height:20 } ],
	paintStyle:{ fillStyle:color3 },
	anchor:"Bottom",
	isSource:false,
	scope:"grey",
	connectorStyle:{ strokeStyle:color3, lineWidth:3 },
	connector : [ "Flowchart", { stub:[40, 60], gap:10, cornerRadius:5, alwaysRespectStubs:true } ],
	maxConnections:1,
	isTarget:true
	
};
			

jQuery('#campaignSave').click(function(e){
	e.stopPropagation();	
	Save();
	
});

var connections = [];
var	updateConnections = function(conn, remove) {
		if (!remove) connections.push(conn);
		else {
			var idx = -1;
			for (var i = 0; i < connections.length; i++) {
				if (connections[i] == conn) {
					idx = i; break;
				}
			}
			if (idx != -1) connections.splice(idx, 1);
		}
			
};

var IterateConnections= function (){      
	var list = [];    
        for (var i = 0; i < connections.length; i++) {
            var source = connections[i].source.id;
            var target = connections[i].target.id;
            try{
                var label = connections[i].getOverlay("label-overlay").labelText;
            }
            catch(err) {
                label = null
            }
            //list.push([source, target])
            if (source != null && target != null){
                list.push([source, target, label]);
            };
        }
      return list;
    }


function Save() {
	var fullCampaign=jQuery('#automationWorkflowForm').serialize();	
	console.log(fullCampaign);	
    console.log(connections);
    Objs = [];
    jQuery('.jsplumbified').each(function() {
        Objs.push({id:jQuery(this).attr('id'), html:jQuery(this).html(),left:jQuery(this).css('left'),top:jQuery(this).css('top'),width:jQuery(this).css('width'),height:jQuery(this).css('height')});
    });
 console.log(Objs);
}

var selectMailobject=function (data){
	var jsObject = JSON.parse( data );
	var selectString='<select id="mailobjectSelect">';
	for(var i=0;i<jsObject.length;i++){
		selectString+='<option value="'+jsObject[i].uid+'">'+jsObject[i].title+' | '+jsObject[i].date+'</option>';
}
	selectString+='</select>';
	jQuery('#selectWrapper').html(selectString);
	jQuery('#mailobjectSelect').removeClass('hidden');
	
};

jQuery('#mailobjectSelect button.ok').click(function(e){
	var elementDefinition=jQuery(activeElement).parent().find('input');	
	jQuery(elementDefinition[0]).val(jQuery('#mailobjectSelect select').val());
	
	jQuery(activeElement).html(jQuery('#mailobjectSelect select')[0].selectedOptions[0].innerHTML.split(' | ')[0]);
	jQuery('#mailobjectSelect').addClass('hidden');
});

jQuery('#mailobjectSelect button.abort').click(function(e){
	jQuery('#mailobjectSelect').addClass('hidden');
});

var setsendDate=function(){
	jQuery('#sendoutDatePicker').removeClass('hidden');
	jQuery('#datepicker').datetimepicker({
		lang:lang
	});
};

jQuery('#sendoutDatePicker button.ok').click(function(e){
	var elementDefinition=jQuery(activeElement).parent().find('input');	
	var sendoutDate=jQuery('#sendoutDatePicker input').val();
	jQuery(elementDefinition[0]).val(sendoutDate);
	jQuery(activeElement).html(sendoutDate);
	jQuery("#sendoutDatePicker").addClass('hidden');
});

jQuery('#sendoutDatePicker button.abort').click(function(e){
	jQuery("#sendoutDatePicker").addClass('hidden');
});


jsPlumb.ready(function() {
	jsPlumb.setContainer(jQuery("#automationWorkspace"));
	
	instance = jsPlumb.getInstance({
			DragOptions : { cursor: 'pointer', zIndex:2000 },
			PaintStyle : { strokeStyle:'#666' },
			EndpointStyle : { width:20, height:16, strokeStyle:'#666' },
			Endpoint : "Rectangle",
			Anchors : ["TopCenter", "TopCenter"],
			Container:"automationWorkspace"
		});	
	
	instance.bind("connection", function(info) {
		instance.repaintEverything();
			updateConnections(info.connection, false);
		//jsPlumb.connect({source:info.source, target:info.target})
   		console.log(jQuery("#"+info.source.id).attr('data-controller')+' -> '+jQuery("#"+info.source.id).attr('data-action'));
   		
	});
	
	instance.bind("connectionDetached", function(info, originalEvent) {
				updateConnections(info.connection, true);
			});
			
			instance.bind("connectionMoved", function(info, originalEvent) {
				//  only remove here, because a 'connection' event is also fired.
				// in a future release of jsplumb this extra connection event will not
				// be fired.
				updateConnections(info.connection, true);
			});
	
	
});

jQuery( ".window" ).draggable({
    appendTo: "#automationWorkspace",
    helper: "clone",
    containment: "#automationWorkspace",	  
	zIndex:999      
});

jQuery( "#automationWorkspace" ).droppable({
      drop: function( event, ui ) {
      	
      	if(!jQuery(ui.draggable).hasClass('jsplumbified')){
      	newElementCounter++;
		
      	var newElement=jQuery(ui.helper).clone();
         jQuery(this).append(newElement);
         
         jQuery(newElement).css('top', ui.offsetTop);
		 jQuery(newElement).css('right', (ui.offsetLeft));
		 jQuery(newElement).removeClass('ui-draggable');		 		 
		 jQuery(newElement).addClass('jsplumbified');
		 jQuery(newElement).css('position','absolute');
		 /* Wahrscheinliuch ID notwendig für dragging*/
		var elController=jQuery(newElement).attr('data-controller');
		
		switch(elController){
			case 'sendoutobject':
			instance.addEndpoint(jQuery(newElement), mainflowConnector);
			instance.addEndpoint(jQuery(newElement), mainflowConnectorTarget);
			instance.addEndpoint(jQuery(newElement), addressesConnectorTarget);			
			instance.addEndpoint(jQuery(newElement), sendDateConnectorTargert);			
			break;
			case 'senddate':
			instance.addEndpoint(jQuery(newElement), sendDateConnectorSource);
			break;
			case "dummy":
			instance.addEndpoint(jQuery(newElement), mainflowConnector);
			break;
			case "addresses":
			instance.addEndpoint(jQuery(newElement), addressesConnectorSource);
			break;
			case "mailobject":
			instance.addEndpoint(jQuery(newElement), mailTemplateConnectorSource);
			break;
			
			default:
			
			break;
			
			 
		}
		
		 
		 
		var newElementId=jQuery(newElement).attr('id');		
         instance.draggable(jQuery('#'+newElementId));
		 
		 switch(elController){
			case 'sendoutobject':
				 jQuery('#'+newElementId+' a').click(function(e)
				{
					e.preventDefault();
					activeElement=jQuery(this);
					ajaxIt('mailobjects','','',selectMailobject);										
				});
			break;
			case 'senddate':
				jQuery('#'+newElementId+' a').click(function(e){
					e.preventDefault();
					activeElement=jQuery(this);
					setsendDate();
				});
			
			break;
			case "dummy":
			
			break;
			case "addresses":
			
			break;			
			
			default:
			
			break;
			
			 
		}
		 
        
         var label = jQuery("#"+newElementId+".jsplumbified .itemLabel");
         /*if(elController !== 'dummy'){
			instance.on(label, "click", function(e) {
				e.stopPropagation();
				showTitleInput(label);				
			});
		}*/
      	}
      	
       }
    });



var showTitleInput=function(showElement){
	
	var confirmTitleInputTemplate=jQuery('#confirmTitleInputTemplate');
		jQuery(confirmTitleInputTemplate).removeClass('hidden');
		jQuery('#tooltipOverlay').append(confirmTitleInputTemplate).show();
		jQuery('#titleInput').bind('keyup',function(e) {
			e.stopPropagation();	
			if(e.keyCode === 13) {
				jQuery(showElement).html(jQuery('#titleInput').val());		
				closeTitleInput(jQuery(this));
							
			}
			
		});
		
		
				
};

jQuery('#confirmTitleInputTemplate button.ok').click(function(e){
			e.stopPropagation();
			console.log(showElement);
			jQuery(showElement).html(jQuery('#titleInput').val());
		
			closeTitleInput(jQuery(this));
			
		});
		
jQuery('#confirmTitleInputTemplate button.abort').click(function(){closeTitleInput();});

var closeTitleInput=function(destroyEl){
	jQuery('#titleInput').unbind('keyup');
	jQuery(destroyEl).unbind('click');
		
	var confirmTitleInputTemplate=jQuery('#confirmTitleInputTemplate');
		jQuery(confirmTitleInputTemplate).addClass('hidden');
		jQuery('body').append(confirmTitleInputTemplate);
		jQuery('#tooltipOverlay').hide();
		
		
		
};


jQuery('document').ready(function(){
	lang=jQuery('#language').val();
	jQuery('.window a').click(function(e){
		e.preventDefault();
	});
});