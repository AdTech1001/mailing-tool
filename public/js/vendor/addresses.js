


jQuery(document).ready(function(e){
	var dt = jQuery('#calender').dataTable( {
	        "bProcessing": true,	        
	        "sAjaxSource": "addresses/index/",
	        "bServerSide": true,        
	        "sServerMethod": 'POST',
	        "oLanguage": {
         		"sSearch": "Suchen:",
         		"sLengthMenu": "_MENU_ Einträge anzeigen",
         		"sInfo": "Es werden Einträge _START_ bis _END_ von insgesamt _TOTAL_ angezeigt",
         		"sInfoEmpty": "keine passenden Veranstaltungen gefunden",
         		"sInfoFiltered":"(gefiltert von _MAX_  Einträgen)",
         		"oPaginate":{
         			"sPrevious" : "Vorherige",
         			"sNext" : "Nächste"
         			}
       		}
		});
});


