jQuery(document).ready(function(e){	
	var filters={'folderuid':'','firstname':'','lastname':'','zip':'','company':'','address':''};
	var save=false;
	var update=false;
	var load=true;
	var segmentobjectUid=0;
	var segmentobjectState='';
	var aoObject=new Object();
	var searchterms;
	if(typeof(jQuery('#segmentobjectState').attr('data-src')) !== 'undefined'){
		
		segmentobjectState=JSON.parse(jQuery('#segmentobjectState').attr('data-src'));
		
		
		for(key in segmentobjectState){
			var keyName=segmentobjectState[key].name;
			var keyVal=segmentobjectState[key].value;
				aoObject[keyName]=keyVal;
			var filterKeys=Object.keys(filters);
			for(var i=0;i<filterKeys.length;i++){
				if(segmentobjectState[key].name===filterKeys[i]){
					filters[filterKeys[i]]=segmentobjectState[key].value;
					/*TODO HIER*/															
					if(filterKeys[i]==='folderuid'){							
						var folderUids=segmentobjectState[key].value;						
						
						jQuery('select[name="addressfolders[]"] option').each(function(index,element){							
							for(var j=0;j<folderUids.length;j++){																
								if(parseInt(jQuery(element).val())===parseInt(folderUids[j])){
									jQuery(this).attr('selected', 'selected');
								}
							}
						});						
					}else{						
						jQuery('input[name="'+segmentobjectState[key].name+'"]').val(segmentobjectState[key].value);
					}
				}
			 
			}
			
			if(segmentobjectState[key].name === 'sSearch'){
				searchterms=segmentobjectState[key].value;
				
			}
		}
		
		
	}
	if(typeof(jQuery('#segmentobjectUid').val()) !== 'undefined'){
		segmentobjectUid=jQuery('#segmentobjectUid').val();
	}
	jQuery('#adressfolderTable').on('preXhr.dt',function(e, settings, data){
		
	});
	
	var dt = jQuery('#adressfolderTable').dataTable({
	        "bProcessing": true,	        
	        "sAjaxSource": baseurl+"segmentobjects",
	        "bServerSide": true,        
	        "sServerMethod": 'POST',
			
	        "oLanguage": {
         		"sSearch": "Suchen:",
         		"sLengthMenu": "_MENU_ Einträge anzeigen",
         		/*"sInfo": "Es werden Einträge _START_ bis _END_ von insgesamt _TOTAL_ angezeigt",
         		"sInfoEmpty": "keine passenden Veranstaltungen gefunden",*/
         		"sInfoFiltered":"(gefiltert von _MAX_  Einträgen)",
         		"oPaginate":{
         			"sPrevious" : "Vorherige",
         			"sNext" : "Nächste"
         			}
       		},									
			"preDrawCallback": function( settings ) {
				
			  },
					 
			 "fnServerParams": function ( aoData ) {
				 
				 for(filter in filters){					 
					 if(filters[filter] !=''){
						 aoData.push( { "name": filter,"value":filters[filter]} );				 
					 }
				 }
				 if(load){
					 console.log('load');
					 /*
					//Seems to work, but might be unreliable
					for(key in segmentobjectState){
						if(typeof(aoData[key]) !== 'undefined' && aoData[key].name ==segmentobjectState[key].name){
						aoData[key].value=segmentobjectState[key].value;
						}else{
							aoData.push(segmentobjectState[key]);
						}
					}
					*/
				   for(key in aoData){
					   if(aoData[key].name=='sSearch'){
						   aoData[key].value=searchterms;
					   }
					   
				   }
					jQuery('#adressfolderTable_filter input').val(searchterms);
					load=false;
				 }
				 
				 
				 
				 if(save){
					 console.log('save');
					 var stateObject=JSON.stringify(aoData);
					 aoData.push({"name":"save","value":1});
					 aoData.push({"name":"stateObject","value":stateObject});
					 save=false;
				 }
				 if(update){
					 console.log('update');
					 var stateObject=JSON.stringify(aoData);
					 aoData.push({"name":"update","value":1});
					 aoData.push({"name":"segmentobjectUid","value":segmentobjectUid});
					 aoData.push({"name":"stateObject","value":stateObject});
					 update=false;
					 /* Search Input seemingly disappears before sending, so 
					 for(key in aoData){
						console.log(jQuery('#adressfolderTable_filter input'));
					   if(aoData[key].name=='sSearch' && aoData[key].value=='' && jQuery('#adressfolderTable_filter input').val() !== ''){
						   aoData[key].value=jQuery('#adressfolderTable_filter input').val();
					   }
					   
					 }*/
				 }				 
			 }
		});
	
	jQuery('select[name="addressfolders[]"]').change(function(){
		filters.folderuid=jQuery(this).val() || [];					
		dt.fnDraw();
	});
	
	jQuery('#filters input[type="text"]').change(function(){
		var filtername=jQuery(this).attr('name');
		filters[filtername]=jQuery(this).val()		
		dt.fnDraw();
	});
	
	jQuery('#segmentSave').click(function(){
		save=true;
		dt.fnDraw();
		
	});
	jQuery('#segmentUpdate').click(function(){
		update=true;
		dt.fnDraw();
	});
	
	
	
	
});