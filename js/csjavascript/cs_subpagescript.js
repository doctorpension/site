/**
 * Created by TOUMI Ilyes on 22/07/16.
 * Company : ConsoleSoftware (www.consolesoftware.com)
 */

var lastPopup = false;
var checkpopup = false;
var check = 0;

$(document).ready(function () {

	//    $(window).on('orientationchange', function (e) {
	//        window.location.replace('/subpage.php');
	//    })

	$(window).scroll(function () {
		var elem = $('.cs_popup_marker');
		if (!lastPopup && checkIfViewed(elem)) {
			$('.closepop-over').css('display', 'block');
			lastPopup = true;
		}
	})

	$('.cs_scross').click(function(){
		$('.closepop-over').css('display', 'none');
	})

	$('#cs_popup_to_charts').click(function(){
		console.log('GOING');
	})

	if(jQuery.cookie("tutorialDone")){
		jQuery('.mainpop-over').hide();
		jQuery('.closepop-over').hide();
		renderCharts();
		setUpScrolls();
		setupFundDetailPops();
	}else{

	}
})

function checkIfViewed(elem) {
	var docViewTop = $(window).scrollTop();
	var winHeight = $(window).height();
	var elemTop = $(elem).offset().top;
	// CHECK IF ELEMENT IS ON SCREEN
	if (((docViewTop + winHeight) > elemTop) && !checkpopup) {
		check = ((docViewTop + winHeight) + winHeight / 3);
		checkpopup = true;
	}
	// CHECK IF ELEMENT IS ON 50% OF SCREEN
	if ((checkpopup) && (check < (docViewTop +winHeight))) {
		return true;
	}
	return false;
}
