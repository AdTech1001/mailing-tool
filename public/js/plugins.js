require.config({
    baseUrl: '/baywa-nltool/public/js/vendor',
    paths: {
        // the left side is the module ID,
        // the right side is the path to
        // the jQuery file, relative to baseUrl.
        // Also, the path should NOT include
        // the '.js' file extension. This example
        // is using jQuery 1.9.0 located at
        // js/lib/jquery-1.9.0.js, relative to
        // the HTML page.
        jquery: 'jquery-1.10.2.min',
		jqueryui:'jquery-ui.min',
		jqueryaddress:'jquery.address',
		main: 'main',
		bootstrap: 'bootstrap.min',
		jsplumb:'dom.jsPlumb-1.6.4',
		plumbscript:'automationWorkflowModule',
		mailobjectsUpdate: 'mailobjectsUpdate',
		tinymce:'tinymce.min',
		datetimepicker:'jquery.datetimepicker',
		addresses:'addresses'
		
    }
});

require(['jquery'], function( jQuery ) {
	require(['jqueryui']);
	require(['jqueryaddress'],function(){
		require(['main']);
	});
    
	require(['bootstrap']);
	
	
	
	
});

