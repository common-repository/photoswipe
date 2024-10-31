jQuery(document).ready(function($) {
	
	if($('a.psw_lightbox ').length ) {
		var myPhotoSwipe = $("a.psw_lightbox").photoSwipe({
			enableMouseWheel: false, 
			enableKeyboard: true 
		});
	}
});