/**
 * Created by mind-in-motion on 20/07/16.
 */
$(document).ready(function(){

    $(document).scroll(function (){
        var elem = $('#cs_section_01');
        if(checkspandispayed(elem)){
            $('.cs_path_outer_img01').addClass('cs_path_outer_img_visible');
            $('.cs_path_outer_img02').removeClass('cs_path_outer_img_visible');
            $('.cs_path_outer_img03').removeClass('cs_path_outer_img_visible');
            $('.cs_path_outer_img04').removeClass('cs_path_outer_img_visible');
        }else{
            elem = $('#cs_section_02');
            if(checkspandispayed(elem)){
                $('.cs_path_outer_img01').removeClass('cs_path_outer_img_visible');
                $('.cs_path_outer_img02').addClass('cs_path_outer_img_visible');
                $('.cs_path_outer_img03').removeClass('cs_path_outer_img_visible');
                $('.cs_path_outer_img04').removeClass('cs_path_outer_img_visible');

            }else{
                elem = $('#cs_section_03');
                if(checkspandispayed(elem)){
                    $('.cs_path_outer_img01').removeClass('cs_path_outer_img_visible');
                    $('.cs_path_outer_img02').removeClass('cs_path_outer_img_visible');
                    $('.cs_path_outer_img03').addClass('cs_path_outer_img_visible');
                    $('.cs_path_outer_img04').removeClass('cs_path_outer_img_visible');

                }else{
                    elem = $('#cs_section_04');
                    if(checkspandispayed(elem)){
                        $('.cs_path_outer_img01').removeClass('cs_path_outer_img_visible');
                        $('.cs_path_outer_img02').removeClass('cs_path_outer_img_visible');
                        $('.cs_path_outer_img03').removeClass('cs_path_outer_img_visible');
                        $('.cs_path_outer_img04').addClass('cs_path_outer_img_visible');
                    }else{
                    }
                }
            }
        }
    })

})

function checkspandispayed(elem){
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();
    var elemTop = ($(elem).offset().top)+70;
    var elemBottom = elemTop + $(elem).height();
	console.log('~~~~~~~~~~~~~~~~~~~~~~~~~~~~'+ elem.attr('id'));
	console.log('docViewTop | height | elemTop | elemBottom');
	console.log(docViewTop + ' | ' + $(elem).height() + ' | ' +elemTop + ' | ' +elemBottom + ' | ');
    if ((docViewTop <= elemTop) && (docViewBottom >= elemBottom)) {
        return true;
    }
    return false;
}
