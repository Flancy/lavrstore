import 'owl.carousel2/dist/assets/owl.carousel.min.css'
import 'owl.carousel2/dist/assets/owl.theme.default.min.css'
import owlCarousel from 'owl.carousel2'

$(document).ready(function () {
    const path = window.location.origin

	$('img.img-svg').each(function(){
        let $img = $(this)
        let imgClass = $img.attr('class')
        let imgURL = $img.attr('src')

        $.get(imgURL, function(data) {
            let $svg = $(data).find('svg')

            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg')
            }

            $svg = $svg.removeAttr('xmlns:a')

            if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }
            $img.replaceWith($svg)
        }, 'xml')
    })
    
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
			mh = h_block
		}
	})

	$(".products .products__item .products__item-body").height(mh)

	$('.count-minus').click(function () {
        let $input = $(this).parent().find('input')
        let count = parseInt($input.val()) - 1

        count = count < 1 ? 1 : count

        $input.val(count)
        $input.change()

        return false
    })
    $('.count-plus').click(function () {
        let $input = $(this).parent().find('input')

        $input.val(parseInt($input.val()) + 1)
        $input.change()

        return false
    })

    $('.cart .form-order button[type="submit"]').click(function (e) {
        e.preventDefault()

        const data = $(this).closest('form').serialize()
        let errors = ''

        axios.post(path + '/cart/order', data)
            .then((res) => {
                console.log(res)

                $('#modal-order').modal('show')

                $("#modal-order").on("hidden.bs.modal", function () {
                    window.location = path
                })
            })
            .catch((err) => {
                $.each(err.response.data.errors, function (key, value) {
                    errors += '<li>' + value + '</li>'
                })

                $('.order-alert-error').show()
                $('.order-alert-error').find('.error-message').html(errors)

                setTimeout(function () {
                    $('.order-alert-error').hide().find('.error-message').html('')
                }, 5000)
            })

        return false
    })
})