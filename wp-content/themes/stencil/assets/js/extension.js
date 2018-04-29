/*****************************************
* OWL
*****************************************/
$(document).ready(function () {
	$(".carousel-standard").owlCarousel({
		autoPlay: true
	});
	$(".embed > .owl-carousel").owlCarousel({
		items: 1,
		autoPlay: true,
		loop:true,
		nav:true,
	});
	
	$(".v_owl > .items" ).each(function(index) {

		var items = 1;

		if(typeof $(this).data('items') !== 'undefined')
		{
			var items =  $(this).data('items');
		}
		$(this).owlCarousel({
			items: items,
			autoPlay: true,
			loop:true,
			nav:true,
		});
		
	});
});  

/*****************************************
* ISOTOPE
*****************************************/
$(document).ready(function () {
	var $collectionIsotope = $('.collection-isotope > .items').isotope({
		itemSelector: '.item'
	});
	$('.collection-isotope > .filters').on( 'click', 'a', function() {
		var filterValue = $( this ).attr('data-filter');
		filterValue = filterFns[ filterValue ] || filterValue;
		$collectionIsotope.isotope({ filter: filterValue });
	});
}); 

/*****************************************
* SWIPER
*****************************************/
$(document).ready(function () {
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
* Stellar Paralax
*****************************************/
$(document).ready(function () {
	
	$(".v_paralax").stellar();
});  