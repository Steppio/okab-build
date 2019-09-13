function slideToMe( href , distance ) {

    jQuery('html, body').animate({
        scrollTop: jQuery( href ).offset().top - distance
    }, 500);

}

jQuery(document).ready(function(){

	console.log('bleh');

	jQuery('.acorn-clickable').click(function(event) {

		console.log('bleh');

	    var href = jQuery(this).attr('rel'),
	        distance = 0;

	    slideToMe( href , distance );

	    return false;

	});

});