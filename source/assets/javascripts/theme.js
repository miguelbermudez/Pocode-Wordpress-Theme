/* Reference Page
 * DO an ajax load of specific divs from documenations' html
 * ---------------------------------------------------------------------------- */
if( $("body").hasClass("page-template-reference-php") ) {
    var url = 'http://localhost:8888/web/pocode/docs/';
    var filename = 'poObject.h.html';    
    var ajaxurl = url + filename;
    //Load in google fonts
    WebFontConfig = {
        google: { families: [ 'Terminal+Dosis::latin' ] }
    };
    loadGoogleFonts();
    
    
    $("#ref_iframe").load( function() {
        var iframe_height  = 0;
        var content_height = 0;
        var index_height   = 0;
        var activeHeader;
        
        //grab content height
        content_height = $("#ref_iframe").contents().find("#content").height();
        //grab index height 
        index_height = $("#ref_iframe").contents().find("#index").height();        
        iframe_height = content_height > index_height ? content_height : index_height;
            
        //set iframe height
        $("#ref_iframe").height(iframe_height);
        //set index height
        $("#ref_iframe").contents().find("#index").height(iframe_height);
        //set content height
        $("#ref_iframe").contents().find("#content").height(iframe_height);
        
               
       
    });
    
}

/* About Page
 * Align "People" Section
 * ---------------------------------------------------------------------------- */
if ( $("body").hasClass("page-template-about-php") ) {
    $("#container dl").each(function(index) {
       if (index % 2) { 
           $(this).addClass("push");
       } 
    });
}


function loadGoogleFonts() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
}