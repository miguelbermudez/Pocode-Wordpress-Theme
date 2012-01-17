/* Javascript for Reference Page
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
    
    // //Load in index
    // $("#index").load(ajaxurl + " #index > *");
    // 
    // //Load in content
    // $("#code_content").load(ajaxurl + " #content > *");
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
