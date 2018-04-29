/*****************************************
* OWL
*****************************************/
jQuery(document).ready(function () {
	jQuery(".owl").each(function(index) {
		var items = 1;
		var autoPlay = true;
		var loop = true;
		var nav = true;
		var instance = jQuery(this);
		if(typeof instance.data('items') !== 'undefined')
		{
			var items =  instance.data('items');
		}
		if(typeof instance.data('autoplay') !== 'undefined')
		{
			var autoplay =  true;
		}
		if(typeof instance.data('loop') !== 'undefined')
		{
			var loop =  true;
		}
		if(typeof instance.data('nav') !== 'undefined')
		{
			var nav =  true;
		}
		instance.children('.items').owlCarousel({
			items: items,
			autoPlay: autoPlay,
			loop:true,
			nav:true,
			smartSpeed :900,
			navigation:true,
			navigationText: [
			"<i class='fa fa-chevron-left'></i>",
			"<i class='fa fa-chevron-right'></i>"
			]
		});
	});
});  

/*****************************************
* ISOTOPE
*****************************************/
jQuery(document).ready(function () {
	var jQuerycollectionIsotope = jQuery('.collection-isotope > .items').isotope({
		itemSelector: '.item'
	});
	jQuery('.collection-isotope > .filters').on( 'click', 'a', function() {
		var filterValue = jQuery( this ).attr('data-filter');
		filterValue = filterFns[ filterValue ] || filterValue;
		jQuerycollectionIsotope.isotope({ filter: filterValue });
	});
}); 

/*****************************************
* SWIPER
*****************************************/
jQuery(document).ready(function () {
	var modSwiper =  new Swiper('.swiper_standard', {
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		pagination: {
			el: '.swiper-pagination',
		},
	});
}); 

/*****************************************
* Stellar parallax
*****************************************/
jQuery(document).ready(function () {
	jQuery(".v_parallax").stellar();
});  