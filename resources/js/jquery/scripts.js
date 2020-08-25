import 'owl.carousel2/dist/assets/owl.carousel.min.css'
import 'owl.carousel2/dist/assets/owl.theme.default.min.css'
import owlCarousel from 'owl.carousel2'

$(document).ready(function () {
	$('.general-slider').owlCarousel({
	    loop: true,
	    margin: 0,
	    nav: false,
	   	items: 1,
	   	dots: true
	})

	let mh = 0

	$(".products .products__item .products__item-body").each(function () {
		let h_block = parseInt($(this).height())

		if(h_block > mh) {
			mh = h_block;
		}
	})

	$(".products .products__item .products__item-body").height(mh)
})