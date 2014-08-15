require.config({
    baseUrl: '/baywa-nltool/js/vendor',
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
		main: 'main',
		bootstrap: 'bootstrap.min'
		
    }
});

require(['jquery'], function( jQuery ) {
    require(['main']);
	require(['bootstrap']);
});