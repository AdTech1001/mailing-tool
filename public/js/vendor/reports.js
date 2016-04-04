function pluginInit(){
	jQuery('.maintable').DataTable( {
        "order": [[ 1, "desc" ]],
         dom: 'Bfrtip',
		buttons: [
			'copy', 'csv', 'excel'
		]
    } );
}

