/**
 * Created by mind-in-motion on 20/07/16.
 */
$(document).ready(function(){

    $(document).scroll(function (){
		var elem = $('footer');
		if(checkspandispayed(elem)){
			console.log('the maslul is in the footer');
			hideMaslul();
			return;
		}
        elem = $('#cs_section_01');
        if(checkspandispayed(elem)){
            $('.cs_path_outer_img01').addClass('cs_path_outer_img_visible');
            $('.cs_path_outer_img02').removeClass('cs_path_outer_img_visible');
            $('.cs_path_outer_img03').removeClass('cs_path_outer_img_visible');
            $('.cs_path_outer_img04').removeClass('cs_path_outer_img_visible');
			return;
        }
		elem = $('#cs_section_02');
		if(checkspandispayed(elem)){
			$('.cs_path_outer_img01').removeClass('cs_path_outer_img_visible');
			$('.cs_path_outer_img02').addClass('cs_path_outer_img_visible');
			$('.cs_path_outer_img03').removeClass('cs_path_outer_img_visible');
			$('.cs_path_outer_img04').removeClass('cs_path_outer_img_visible');
			return;
		}
		elem = $('#cs_section_03');
		if(checkspandispayed(elem)){
			$('.cs_path_outer_img01').removeClass('cs_path_outer_img_visible');
			$('.cs_path_outer_img02').removeClass('cs_path_outer_img_visible');
			$('.cs_path_outer_img03').addClass('cs_path_outer_img_visible');
			$('.cs_path_outer_img04').removeClass('cs_path_outer_img_visible');
			return;
		}
		elem = $('#cs_section_04');
		if(checkspandispayed(elem)){
			$('.cs_path_outer_img01').removeClass('cs_path_outer_img_visible');
			$('.cs_path_outer_img02').removeClass('cs_path_outer_img_visible');
			$('.cs_path_outer_img03').removeClass('cs_path_outer_img_visible');
			$('.cs_path_outer_img04').addClass('cs_path_outer_img_visible');
			return;
		}
    })

})

function hideMaslul(){
	$('.cs_path_outer_img').removeClass('cs_path_outer_img_visible');
}

function checkspandispayed(elem){
console.log('the elem: ', elem);
	var maslul = $('.path-outer');
	var maslulTop = maslul.offset().top ;
	var maslulBottom = maslulTop + maslul.height();
    var elemTop = (elem.offset().top)+70;
    var elemBottom = elemTop + $(elem).height();
	console.log('~~~~~~~~~~~~~~~~~~~~~~~~~~~~'+ elem.attr('id'));
	console.log('the maslulTop:', maslulTop, 'the elem top:', elemTop, 'maslul bottom:', maslulBottom, ', elem botom:', elemBottom);
	console.log('not checking footer: maslultop - elemtop:', maslulTop - elemTop, ', malsul bottom - elemBottom:', maslulBottom - elemBottom);
	return ((Math.abs(maslulTop - elemTop) <= 150) || (Math.abs(maslulBottom - elemBottom) <= 250));
}
