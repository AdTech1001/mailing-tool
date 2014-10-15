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
var color2 = "#009650";
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

var mainflowConnector2 = {
	endpoint:["Dot", {radius:13} ],
	anchor:"Bottom",
	paintStyle:{ fillStyle:color1, opacity:0.5 },
	isSource:true,
	scope:'red',
	connectorStyle:{ strokeStyle:color1, lineWidth:3 },
	connector : [ "Flowchart", { stub:[40, 60], gap:10, cornerRadius:5, alwaysRespectStubs:true } ],
	connectorOverlays : [
			["Label", {													   					
				cssClass:"l1 component label",
				label : "alle anderen", 
				location:0.7,
				id:"label",
				events:{
					"click":function(label, evt) {
						alert("clicked on label for connection " + label.component.id);
					}
				}
			}]
	],
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
	endpoint:["Dot", {radius:20} ],
	anchor:"Top",
	paintStyle:{gradient:{
      stops:[[0,color2],[0.5,color2], [0.5,color1], [1,color1]],
		
			  
    }},
	isSource:false,
	scope:'red green',
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


			

var sendDateConnectorSource = {
	anchor:"Right",
	endpoint:["Dot", { radius:11 }],
	paintStyle:{ fillStyle:color2 },
	isSource:true,
	scope:"green",
	connectorOverlays : [
			["Label", {													   					
				cssClass:"l1 component label",
				label : "Bedingungen erfüllt", 
				location:0.7,
				id:"label",
				events:{
					"click":function(label, evt) {
						alert("clicked on label for connection " + label.component.id);
					}
				}
			}]
	],
	connectorStyle:{ strokeStyle:color2, lineWidth:6 },
	connector : [ "Flowchart", { stub:[40, 60], gap:10, cornerRadius:5, alwaysRespectStubs:true } ],
	maxConnections:1,
	isTarget:false
	
};	
		
var sendDateConnectorTarget = {
	endpoint:["Dot", { radius:11 }],
	paintStyle:{ fillStyle:color2 },
	anchor:"Left",
	isSource:false,
	scope:"green",
	connectorStyle:{ strokeStyle:color2, lineWidth:6 },
	connector: ["Bezier", { curviness:63 } ],
	maxConnections:1,
	isTarget:true,
	dropOptions : exampleDropOptions
};			


var color4 = "#61baff";
var conditionConnectorSource = {
	endpoint:["Dot", { radius:10 }],
	paintStyle:{ fillStyle:color4 },
	anchor:"Right",
	isSource:true,
	scope:"blue",
	connectorStyle:{ strokeStyle:color4, lineWidth:6 },
	connector : [ "Flowchart", { stub:[40, 60], gap:10, cornerRadius:5, alwaysRespectStubs:true } ],
	maxConnections:1,
	isTarget:false
	
};	
		
var conditionConnectorTarget = {
	endpoint:["Dot", { radius:10 }],
	paintStyle:{ fillStyle:color4 },
	anchor:"Left",
	isSource:false,
	scope:"blue",
	connectorStyle:{ strokeStyle:color4, lineWidth:6 },
	connector: ["Bezier", { curviness:63 } ],
	maxConnections:1,
	isTarget:true,
	dropOptions : exampleDropOptions
};	




var color3 = "#6d6e72";
var splitConnectorSource = {
	endpoint:["Rectangle", { width:15, height:20 } ],
	paintStyle:{ fillStyle:color3 },
	anchor:"Right",
	isSource:true,
	scope:"grey",
	connectorStyle:{ strokeStyle:color3, lineWidth:3 },
	connector : [ "Flowchart", { stub:[40, 60], gap:10, cornerRadius:5, alwaysRespectStubs:true } ],
	maxConnections:1,
	isTarget:false
	
};

var splitConnectorTarget = {
	endpoint:["Rectangle", { width:15, height:20 } ],
	paintStyle:{ fillStyle:color3 },
	anchor:"Left",
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

var elementsPathArr=[];
function dummyTest(data){
	jQuery('#automationWorkspace').html(decodeURI(data));
	
}
function Save() {
	var campaignTitle=jQuery('#automationWorkflowForm').serialize();	
	//var conditions=jQuery('#conditionsForm').serialize();
	console.log(connections);
	var firstConn=instance.getConnections({scope:'red',source:'startpoint'});
	elementsPathArr=[];
	if(firstConn.length>0){
	getPath(firstConn[0].targetId);		
	}else{
		alert('Please connect the start point.');
	}
	var saveStrng='';
	var objects='';
	var sendoutobjectelements='';
	
	
	jQuery('.window.jsplumbified').each(function(index,element){
		if(jQuery(element).attr('id')!=='startpoint'){
			objects+=encodeURI(jQuery(element)[0].outerHTML);
		}
	});
	for(var i=0; i<elementsPathArr.length; i++ ){
		var confValues=jQuery('#'+elementsPathArr[i]+' input');
		
		//var elementItself=JSON.stringify(jQuery('#'+elementsPathArr[i])[0].outerHTML);
		var conditionsJson=getSendoutObjectConditions(elementsPathArr[i]);
		var elementJson='{"id":"'+elementsPathArr[i]+'","mailobjectuid":'+jQuery(confValues[0]).val()+',"configurationuid":'+jQuery(confValues[1]).val()+',"tstamp":"'+jQuery(confValues[2]).val()+'","position":{"left":'+jQuery('#'+elementsPathArr[i]).position().left+',"top":'+jQuery('#'+elementsPathArr[i]).position().top+'}, "conditions":'+conditionsJson+'}';
		sendoutobjectelements+='&sendoutobjectelements[]='+elementJson;
		

	}
	var connJson='{[';
	
	for(var j=0; j<connections.length; j++){
		
		connJson+='{"source":"'+connections[j].sourceId+'","target":"'+connections[j].targetId+'"},';
	}
	connJson=connJson.substring(0,connJson.length-1)+']}';
	ajaxIt('campaignobjects','create',campaignTitle+'&htmlobjects='+objects+sendoutobjectelements+'&connections='+connJson,dummyEmpty);	
	
    /*jQuery('.jsplumbified.sendoutobject').each(function(index,element){
		var elementId=jQuery(element).attr('id');
		var sendoutObjectsConnections=instance.getConnections({scope:'*',target:elementId});
		
	});
    Objs = [];
    jQuery('.jsplumbified').each(function() {
        Objs.push({id:jQuery(this).attr('id'), html:jQuery(this).html(),left:jQuery(this).css('left'),top:jQuery(this).css('top'),width:jQuery(this).css('width'),height:jQuery(this).css('height')});
    });		*/
}
function getSendoutObjectConditions(sendoutObjectId){
	var splitTargets=instance.getConnections({scope:'*',source:'*', target:sendoutObjectId});
	
	var conditions='[';
	for(var i=0; i<splitTargets.length;i++){
		if(splitTargets[i].sourceId !== 'startpoint'){
		var condVals=JSON.stringify(jQuery('#'+splitTargets[i].sourceId+' form').serializeArray());
		
		var elItself=JSON.stringify(jQuery('#'+splitTargets[i].sourceId)[0].outerHTML);
		 conditions+='{"condValues":'+condVals+'},';
		
		}
		
	}
	if(conditions.length > 1){
	conditions=conditions.substring(0,conditions.length-1)+']';
	}else{
		conditions+=']';
	}
	return conditions;
}
function getSplitTargets(split){
	var splitTargets=instance.getConnections({scope:['red','green'],source:split, target:'*'},true);
	return splitTargets;
}

function getPath(sendoutObject){
	elementsPathArr.push(sendoutObject);	
	var nextElement=instance.getConnections({scope:['grey'],source:sendoutObject, target:'*'});
	
	if(nextElement.length >0){
		var splitTargets=getSplitTargets(nextElement[0].targetId);
		
		if(splitTargets.length >0){
			for(var i=0; i<splitTargets.length; i++){
				
				/*Recursion is dead, long live recursion*/
				getPath(splitTargets[i].targetId);
			}
		}
	}
}




var selectMailobject=function (data){
	var jsObject = JSON.parse( data );
	var selectString='<select id="mailobjectSelectElements">';
	for(var i=0;i<jsObject.length;i++){
		selectString+='<option value="'+jsObject[i].uid+'">'+jsObject[i].title+' | '+jsObject[i].date+'</option>';
}
	selectString+='</select>';
	jQuery('#mailobjectSelectWrapper').html(selectString);
	ajaxIt('configurationobjects','','',selectConfigurationobject);										
	
};


jQuery('#mailobjectSelect button.ok').click(function(e){
	var elementDefinition=jQuery(activeElement).parent().find('input');		

	jQuery(elementDefinition[0]).val(jQuery('#mailobjectSelectElements').val());
	jQuery(elementDefinition[1]).val(jQuery('#configurationobjectSelect').val());
	jQuery(elementDefinition[2]).val(jQuery('#datepicker').val());
	jQuery(activeElement).parent().parent().append('<div class="info glyphicon glyphicon-info-sign"></div>');
	jQuery(activeElement).html(jQuery('#mailobjectSelect select')[0].selectedOptions[0].innerHTML.split(' | ')[0]);
	jQuery('#mailobjectSelect').addClass('hidden');
});

jQuery('#mailobjectSelect button.abort').click(function(e){
	jQuery('#mailobjectSelect').addClass('hidden');
});


var selectConfigurationobject= function(data){
	var jsObject= JSON.parse(data);
	var selectString='<select id="configurationobjectSelect">';
	for(var i=0;i<jsObject.length;i++){
		selectString+='<option value="'+jsObject[i].uid+'">'+jsObject[i].title+' | '+jsObject[i].date+'</option>';
	}
	selectString+='</select>';
	jQuery('#configurationobjectSelectWrapper').html(selectString);
	jQuery('#mailobjectSelect').removeClass('hidden');
	jQuery('#datepicker').datetimepicker({
		lang:lang
	});
	
};

/*jQuery('#configurationobjectSelect button.ok').click(function(e){
	var elementDefinition=jQuery(activeElement).parent().find('input');	
	jQuery(elementDefinition[0]).val(jQuery('#configurationobjectSelect select').val());
	
	jQuery(activeElement).html(jQuery('#configurationobjectSelect select')[0].selectedOptions[0].innerHTML.split(' | ')[0]);
	jQuery('#configurationobjectSelect').addClass('hidden');
});

jQuery('#configurationobjectSelect button.abort').click(function(e){
	jQuery('#configurationobjectSelect').addClass('hidden');
});*/





var assembleSendoutobjectConf=function(activeElement){
	ajaxIt('mailobjects','','',selectMailobject);					
};

var conditionRowCounter=1;
var conditionsFormBlueprint=jQuery('#conditionsForm')[0].outerHTML;
var conditionsBlueprint=jQuery('#conditionsRow_1')[0].outerHTML;	
var splitFormBlueprint=jQuery('#splitForm')[0].outerHTML;
var splitBlueprint=jQuery('#splitRow_1')[0].outerHTML;	
var conditionModeler=function(activeElement,splitCond){	
	var appendRow=conditionsBlueprint;
	if(splitCond=='split'){
		appendRow=splitBlueprint;
	}
	var actElId=jQuery(activeElement).parent().parent().parent().attr('id');
	if(jQuery('#'+actElId+' div.hidden').html() != ''){
		jQuery('#'+splitCond+'Form').html(jQuery('#'+actElId+' div.hidden').html());
		
		conditionRowCounter=jQuery('#'+splitCond+'Wrapper table tbody tr:last-child').attr('id').split('_')[1];
	}
	var rowId=splitCond+'Row_'+conditionRowCounter;
	jQuery('#'+splitCond+'ModelerSelect').removeClass('hidden');		
	
	jQuery('#'+splitCond+'Wrapper').on('click','#add'+splitCond,function(e){	
		e.preventDefault();
		conditionRowCounter++;
		rowId=splitCond+'Row_'+conditionRowCounter;
		
		jQuery('#add'+splitCond).remove();
		jQuery('#'+splitCond+'Wrapper table tbody').append(appendRow);		
		jQuery('#'+splitCond+'Wrapper table tbody tr:last-child').attr({'id':rowId});
		jQuery('#'+splitCond+'Wrapper table tbody tr:last-child .junctor0').removeClass('hidden');
		addRowEvents(rowId, splitCond);
	});
	for(var i=1; i<=conditionRowCounter; i++){
		addRowEvents(splitCond+'Row_'+i, splitCond);
	}
	
};

jQuery('#conditionsModelerSelect button.ok, #splitModelerSelect button.ok').click(function(e){
	var splitCond='conditions';
	var prependRow=conditionsFormBlueprint;
	if(jQuery(this).hasClass('split')){
		splitCond='split';
		prependRow=splitFormBlueprint
	}
	jQuery('#'+splitCond+'Wrapper').off('click');
	e.preventDefault();
	conditionRowCounter=1;
	
	var actElId=jQuery(activeElement).parent().parent().parent().attr('id');
	jQuery('#'+actElId+' form.hidden').html(jQuery('#'+splitCond+'Form').html());
	
	jQuery('#'+splitCond+'Form').remove();
	jQuery('#'+splitCond+'Wrapper').prepend(prependRow);
	jQuery('#'+splitCond+'ModelerSelect').addClass('hidden');
});

var addRowEvents=function(rowId, splitCond){
	
	jQuery('#'+splitCond+'Form #'+rowId+' select').change(function(e){
		var selectIndex=jQuery(this)[0].selectedIndex;	
		jQuery(this).children().each(function(index,el){
			if(index===selectIndex){
				jQuery(el).attr({'selected':'selected'});
			}else{
				jQuery(el).removeAttr('selected');
			}
		});
	});
	jQuery('#'+splitCond+'Form #'+rowId+' input').change(function(e){
		jQuery(this).attr({'value':jQuery(this).val()});
	});
	jQuery('#'+splitCond+'Form #'+rowId+' select.baseArgument').change(function(e){
		
		switch(jQuery(this).val()){
			case "1":
			jQuery('#'+splitCond+'Form #'+rowId+' select.actionOperators').addClass('hidden');
			jQuery('#'+splitCond+'Form #'+rowId+' select.fields').removeClass('hidden');
			jQuery('#'+splitCond+'Form #'+rowId+' select.fieldOperators').removeClass('hidden');
			jQuery('#'+splitCond+'Form #'+rowId+' .fieldconditions').removeClass('hidden');
			jQuery('#'+splitCond+'Form #'+rowId+' .clickconditions').addClass('hidden');						
			break;
			case "2":
			jQuery('#'+splitCond+'Form #'+rowId+' select.actionOperators').removeClass('hidden');
			jQuery('#'+splitCond+'Form #'+rowId+' select.fields').addClass('hidden');
			jQuery('#'+splitCond+'Form #'+rowId+' select.fieldOperators').addClass('hidden');
			jQuery('#'+splitCond+'Form #'+rowId+' .fieldconditions').addClass('hidden');
			jQuery('#'+splitCond+'Form #'+rowId+' .clickconditions').removeClass('hidden');
			break;
		}
	});
};

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
	
	instance.addEndpoint(jQuery('#startpoint'), mainflowConnector);
	instance.draggable(jQuery('#startpoint'));
	
});

jQuery( "#campaignCreateElements .window" ).draggable({
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
			instance.addEndpoint(jQuery(newElement), splitConnectorSource);
			instance.addEndpoint(jQuery(newElement), mainflowConnectorTarget);						
			instance.addEndpoint(jQuery(newElement), conditionConnectorTarget);									
			break;
			case 'senddate':
			instance.addEndpoint(jQuery(newElement), sendDateConnectorSource);
			break;			
			case "addresses":
			instance.addEndpoint(jQuery(newElement), addressesConnectorSource);
			break;
			case "mailobject":
			instance.addEndpoint(jQuery(newElement), mailTemplateConnectorSource);
			break;
			case "conditionobjects":
				instance.addEndpoint(jQuery(newElement), conditionConnectorSource);
			break;
			case "automationbjects":
				instance.addEndpoint(jQuery(newElement), splitConnectorTarget);
				instance.addEndpoint(jQuery(newElement), sendDateConnectorSource);
				instance.addEndpoint(jQuery(newElement), mainflowConnector2);
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
					assembleSendoutobjectConf(activeElement);
				});
			break;
			case 'conditionobjects':
				jQuery('#'+newElementId+' a').click(function(e)
				{
					e.preventDefault();
					activeElement=jQuery(this);
					conditionModeler(activeElement,'conditions');
				});
			break;
			case 'automationbjects':
				jQuery('#'+newElementId+' a').click(function(e)
				{
					e.preventDefault();
					activeElement=jQuery(this);
					conditionModeler(activeElement,'split');
				});
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