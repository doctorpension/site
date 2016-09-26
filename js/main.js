var lastPopup = false;
var checkpopup = false;
var check = 0;

jQuery(function () {


	jQuery(window).scroll(function () {
		jQuery(".collapse.navbar-collapse.in").removeClass("in");
	});

	jQuery('.mainpop-over').delay(600).queue(function () {
		var top_pos = $('#guide-template').offset().top + 150;
		if($('.mob-view').is(':visible')){
			top_pos -= 250;
		}
		$(this).css('top', top_pos).addClass('active-popup').clearQueue();
	});


	jQuery(".closepop-over .title-blk span").click(function () {
		jQuery(".insurance-title.result_hover").removeClass("result_hover").addClass('close-triggered');
	});

	var isMobLand = false;
	var dw = jQuery(window).width();
	var dh = jQuery(window).height();

	if(dw < 768){
		if(dw > dh){
			// mobile in lanscape mode.
			var isMobLand = true;
		}
	}

	//report walkthrough
	jQuery("body").on('click', '.popupbtns', function (e) {
		e.preventDefault();
		console.log('in click popupbtns');
		var ref = $(this).attr('href');
			console.log('the ref: ', ref);

		if (typeof(ref) != "undefined" ) {
			var next_pop = $(this).attr('href') + '-walkthrough';
			var target = $(this).data('targetLocation');
			if(typeof(target) != 'undefined'){
				var attach_to = $(target);
				var add_to_height = $(this).data('targetBelowTop');

				console.log('the add to: ', add_to_height, ' the attach to: ', attach_to);
				var top_pos = attach_to.offset().top + add_to_height;
				console.log('the next pop: ', next_pop);
				if(ref == '#fourth' && $('.mob-view').is(':visible')){
					top_pos -= 200;
				}
				$(next_pop).css('top',top_pos);
			}
			if (ref == '#second') {
				jQuery("body, html").animate(
					{scrollTop: top_pos + -100},
					{duration: 1000});
			}
			else if (ref == '#fourth') {
				var scrollTo= jQuery( '#guide-template' ).offset().top;
				console.log('scrollto: ', scrollTo);
				if (jQuery(".mob-view").is(":visible")) {
					console.log('in is mobile');
					if(isMobLand){
						scrollTo -= 200;
					}else{
						scrollTo -= 200;
					}
					console.log('scrollto: ' , scrollTo);
				}
				jQuery("body, html").animate(
					{scrollTop: scrollTo},
					{
						duration: 1000,
						complete: function () {
							renderCharts();
							setUpScrolls();
							setupFundDetailPops();
							jQuery.cookie("tutorialDone", 1, { expires : 30 });
						 stickHeaders();
						}
					});
			}
			$('.active-popup, .active-tabover').removeClass("active-popup");
			$(next_pop).addClass("active-tabover");

		}
	});

	if (jQuery.fn.typed) {
		jQuery(".cd-words-wrapper").typed({
			strings: ["מותאם אישית", "בלי עמלות נסתרות", "בלי סוכנים", "בלי ניירת"],
			typeSpeed: 80,
			backSpeed: 80,
			backDelay: 2000,
			loop: true
		});
	}


	/* $('.mainpop-over a').click(function() {
     $('body').delay(100).queue(function(){
     jQuery('.rightfirst-blk').addClass("active-tabover");
     jQuery('.mainpop-over').removeClass("active-popup");
     });
     });

     $('.normalpop-over a').click(function() {
     $('body').delay(100).queue(function(){
     jQuery('.rightthird-blk').addClass("active-tabover");
     });
     }); */


	if (jQuery(".single-tabblock").length) {

		var scroll_pos = 0;

		var $adjusted_distance = 400;

		jQuery(document).scroll(function () {
			scroll_pos = $(this).scrollTop();
			var $skippoint = parseInt(jQuery('.bluebottomboxspan').offset().top) - 1200;
			if (jQuery('.insurance-title').hasClass('close-triggered')) {
			} else {
				if ($skippoint == scroll_pos || $skippoint < scroll_pos) {
					jQuery('.insurance-title').addClass("result_hover");
				} else {
					jQuery('.insurance-title').removeClass("result_hover");
				}
			}

		});


	}


	jQuery("body").on('click', '.normalpop-over .link-button', function () {
		jQuery(this).parents().removeClass("active-tabover");
	});


	jQuery("body").on('click', '.closepop-over .title-blk span', function () {
		jQuery(this).parents().removeClass("activepopuoverclse");
	});


	jQuery(".recommendations-btn").click(function () {
		jQuery(".listing_blk_tabs").addClass('active-tabblk');
	});


	function setupFundDetailPops() {
		console.log('about to setup fund deatils');
		$('.down-block .single-tabblock ul li').click(function () {
			if (jQuery(this).hasClass('active-tabover')) {
				console.log('this has an active tabover class');
			}
			else {
				showDetails($(this).data('name'), $(this).data('details'), $(this).data('tracks'), 'current');
			}
		});
		$('.right-blk .single-tabblock ul li').click(function () {
			if (jQuery(this).hasClass('active-tabover')) {
				console.log('this has an active tabover class');
			}
			else {
				showDetails($(this).data('name'), $(this).data('details'), $(this).data('tracks'), 'recommendations');
			}
		});

	}


	jQuery("body").on('click', '.thumbspopup-trigger', function () {
		jQuery('.thumbs-popupblk').bPopup({
			closeClass: 'close-pop',
			modalClose: false
		});
	});

	jQuery("body").on('click', '.overlayblock', function () {
		jQuery(this).closest('.single-tabblock').removeClass('active-tabover');
	});


	jQuery(".alrm-icon.normalpop").click(function () {
		jQuery(this).addClass("activepopuover");
	});
	jQuery('body').on('click', '.overlayblock', function () {
		jQuery(this).parent().removeClass("activepopuover");
	});


	jQuery(".alrm-icon.closepopover").click(function () {
		jQuery(this).addClass("activepopuoverclse");
	});

	jQuery('body').on('click', '.closepop-over .title-blk span', function () {
		jQuery(".alrm-icon.closepopover").removeClass("activepopuoverclse");
	});


	jQuery(".down-block span i").click(function () {
		jQuery('.second-popupblk').bPopup({
			closeClass: 'close-pop',
			modalClose: false
		});
	});

	jQuery(".thumbs-up").click(function () {
		jQuery('.third-popupblk').bPopup({
			closeClass: 'close-pop',
			modalClose: false
		});
	});

	jQuery('.light-hand').hover(function () {
		jQuery(this).parent(".stack-right-inner").toggleClass('hover');
	});


	jQuery(window).scroll(function () {
		var wScrollTop = jQuery(window).scrollTop();
		if (wScrollTop > 0) {
			if (jQuery('.header-fixed').length == 0) {
				jQuery('.header-sticky').addClass('header-fixed');
			}
		} else {
			jQuery('.header-sticky').removeClass('header-fixed');
		}
	});


	// Create a clone of the menu, right next to original.
	if (jQuery('.sticky-menu').length) {
		jQuery('.sticky-menu').addClass('original').clone().insertAfter('.sticky-menu').addClass('cloned').css('position', 'fixed').css('top', '0').css('margin-top', '0').css('z-index', '500').removeClass('original').hide();
		scrollIntervalID = setInterval(stickIt, 10);
	}


	//one page section
	if (jQuery.fn.onePageNav) {
		jQuery('.one-navigation ul').onePageNav({
			currentClass: 'menu-active-item',
			scrollThreshold: 0.2,
			scrollOffset: 40,
			begin: function () {
				/* jQuery(".one-navigation ul").animate({
                 opacity: 0.4
                 }); */
			},
			end: function () {
				if (jQuery('.one-navigation').is('.in')) {
					jQuery(".one-navigation").animate({
						opacity: 0
					}, {
						duration: 300,
						complete: function () {
							jQuery('.one-navigation').removeClass('in');
							jQuery('.one-navigation').css({
								height: "1px",
								opacity: 1
							});
						}
					});
				}
			},
			scrollChange: function ($currentListItem) {

			}
		});
	}
	//one page section 
	jQuery(".tab_content").hide(); //Hide all content
	jQuery("ul.listing-outer li:first").addClass("active").show(); //Activate first tab
	jQuery(".tab_content:first").show(); //Show first tab content

	//On Click Event
	jQuery("ul.listing-outer li").click(function () {
		jQuery("ul.listing-outer li").removeClass("active"); //Remove any "active" class
		jQuery(this).addClass("active"); //Add "active" class to selected tab
		jQuery(".tab_content").hide(); //Hide all tab content
		var activeTab = jQuery(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		jQuery(activeTab).fadeIn(1500); //Fade in the active content		
		return false;
	});

	// footer menu
	jQuery(".links-single h6").click(function () {
		if (jQuery(".mob-view").is(":visible")) {
			jQuery(this).parent().children(".links-single ul").slideToggle("slow");
			jQuery(this).parent().toggleClass('open');
		}
	});
	jQuery(".input-block h6").click(function () {
		if (jQuery(".mob-view").is(":visible")) {
			jQuery(this).parent().children(".input-inner").slideToggle("slow");
			jQuery(this).parent().toggleClass('open');
		}
	});

	jQuery(window).on("debouncedresize", function (event) {
		if (jQuery(".mob-view").is(":visible")) {
			jQuery(".links-single ul").hide();
			jQuery(".input-inner").hide();
		} else {
			jQuery(".links-single ul").show();
			jQuery(".input-inner").show();
		}
	});


	if (jQuery.fn.selectbox) {
		jQuery('.select-box').selectbox({
			effect: "fade",
			speed: 400
		});
	}

	//yes or no buttons
	jQuery(".male").click(function () {
		var parent = jQuery(this).parents('.switch');
		jQuery('.female', parent).removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery('.checkbox', parent).attr('checked', true);
	});
	jQuery(".female").click(function () {
		var parent = $(this).parents('.switch');
		jQuery('.male', parent).removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery('.checkbox', parent).attr('checked', false);
	});


	if (jQuery.fn.iCheck) {
		jQuery('.single-check').iCheck({
			checkboxClass: 'icheckbox_minimal',
			increaseArea: '-10%' // optional
		}).on('ifChanged', function (e) {
			// Get the field name
			var isChecked = e.currentTarget.checked;

			if (isChecked == true) {
				jQuery(this).parent().parent().addClass("check-active");
			} else {
				jQuery(this).parent().parent().removeClass("check-active");
			}
		});

		jQuery('.single-check > .icheckbox_minimal').each(function (i) {
			if (jQuery(this).is('.checked')) {
				jQuery(this).parent().addClass("check-active");
			}
		});

	}


	if (jQuery('.survey-outercont').length) {
		jQuery("ul.staking-outer li:first").addClass("active").show();
		jQuery(".maintab_content:first").addClass("activeitem").show();
		jQuery("ul.staking-outer li").click(function () {
			var oldele = $("ul.staking-outer li.active").index();
			jQuery("ul.staking-outer li").removeClass("active");
			jQuery(this).addClass("active");
			var newele = $("ul.staking-outer li.active").index();
			jQuery(".maintab_content").removeClass("activeitem").removeClass('olditem');
			jQuery(".maintab_content:eq(" + newele + ")").addClass('animate');
			jQuery(".maintab_content:eq(" + oldele + ")").addClass('olditem').clearQueue();

			jQuery(".maintab_content").delay(500).queue(function () {
				jQuery(".maintab_content:eq(" + newele + ")").addClass("activeitem").clearQueue();
				jQuery(".maintab_content:eq(" + newele + ")").removeClass('animate');
			});

			var activeTab = jQuery(this).find("a").attr("href");
			jQuery(activeTab).fadeIn(1500);

			return false;
		});


	}

	if (jQuery('.datepick-outer').length) {
		Hammer.plugins.fakeMultitouch();
		function getIndexForValue(elem, value) {
			for (var i = 0; i < elem.options.length; i++)
				if (elem.options[i].value == value)
					return i;
		}

		function pad(number) {
			if (number < 10) {
				return '0' + number;
			}
			return number;
		}

		function update(datetime) {
			jQuery("#date").drum('setIndex', datetime.getDate() - 1);
			jQuery("#month").drum('setIndex', datetime.getMonth());
			jQuery("#fullYear").drum('setIndex', getIndexForValue($("#fullYear")[0], datetime.getFullYear()));
		}


		jQuery("select.date").drum({
			onChange: function (elem) {
				var arr = {
					'date': 'setDate',
					'month': 'setMonth',
					'fullYear': 'setFullYear'
				};
				var date = new Date();
				for (var s in arr) {
					var i = (jQuery("form[name='date'] select[name='" + s + "']"))[0].value;
					eval("date." + arr[s] + "(" + i + ")");
				}
				date.setSeconds(0);
				update(date);

				var format = date.getFullYear() + '-' + pad(date.getMonth() + 1) + '-' + pad(date.getDate());

				jQuery('.date_header .selection').html(format);
			}
		});
		update(new Date());
	}

	jQuery('.link-button.implement').click(function () {
		location.href = '/digital_form.php';
	});

	jQuery("#bars li .bar").each(function (key, bar) {
		var percentage = $(this).data('percentage');

		jQuery(this).animate({
			'height': percentage + '%'
		}, 1000);
	});

	if($('body#report_page').length > 0){
		/* Report Page Doc Ready */
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

		if(jQuery.cookie("tutorialDone")){
			jQuery('.mainpop-over').hide();
			jQuery('.closepop-over').hide();
			renderCharts();
			setUpScrolls();
			setupFundDetailPops();
		}
	}

	$('#show_video').click(function(){
		$('#video_popup').bPopup({
			closeClass: 'x'	,
			onClose: function() { $('#video_popup iframe').attr('src', ''); }
		},
		function() { 
			$('#video_popup iframe').attr('src', "https://www.youtube.com/embed/OQFv9rP_Q4c?autoplay=1&amp;rel=0&amp;show_info=0&amp;origin=https%3A%2F%2Fstaging.doctorpension.com&amp;enablejsapi=1");
			jQuery('#video_popup').css('z-index', 999999999); }
		);
	});

	$('#digital_form').submit(function(e){e.preventDefault();sendForm(e);});

});

function sticky_relocate() {
	var window_top = $(window).scrollTop();
	if ($('#sticky-anchor').length == 0) {
		return;
	}
	var div_top = $('#sticky-anchor').offset().top;
	var div_bottom = $('.bluebottomboxspan').offset().top;
	if (window_top > div_top && window_top < div_bottom) {
		$('#sticky').addClass('stick');
		$('#sticky-anchor').height($('#sticky').outerHeight());
	} else {
		$('#sticky').removeClass('stick');
		$('#sticky-anchor').height(0);
	}
}

function goToByScroll(id) {
	// Remove "link" from the ID
	id = id.replace("link", "");
	jQuery('html,body').animate({
		scrollTop: jQuery("#" + id).offset().top
	},
								'slow');
}

function stickIt() {

	var orgElementPos = jQuery('.original').offset();
	orgElementTop = orgElementPos.top;

	if (jQuery(window).scrollTop() >= (orgElementTop)) {
		// scrolled past the original position; now only show the cloned, sticky element.

		// Cloned element should always have same left position and width as original element.     
		orgElement = jQuery('.original');
		coordsOrgElement = orgElement.offset();
		leftOrgElement = coordsOrgElement.left;
		widthOrgElement = orgElement.css('width');
		jQuery('.cloned').css('left', leftOrgElement + 'px').css('top', 0).css('width', widthOrgElement).show();
		jQuery('.original').css('visibility', 'hidden');
	} else {
		// not scrolled past the menu; only show the original menu.
		jQuery('.cloned').hide();
		jQuery('.original').css('visibility', 'visible');
	}
}
function renderCharts(){
//	alert('sddfs');

	// CS ORIGINALLY USED CHARTS --------------------
	// ----------------------------------------------
	// createPie(".pieID.legend", ".pieID.pie", '0');
	// createPie(".pieID2.legend", ".pieID2.pie", '1');
	// ----------------------------------------------

	// NEW CHARTS -----------------------------------
	// ----------------------------------------------

	// Left Chart parameters ----
	var chartleft = new CanvasJS.Chart("chartContainerleft",{
		backgroundColor: "transparent",
		animationEnabled: true,
		data: [
			{
				type: "doughnut",
				indexLabelFontFamily: "Garamond",
				innerRadius: "50%",
				indexLabelFontSize: 20,
				startAngle: 0,
				indexLabelFontColor: "dimgrey",
				indexLabelLineColor: "darkgrey",
				toolTipContent: "{y}% {text}",

				// Chart sections parameters (y : value) - (color : assigned color)
				dataPoints: [
					{y: leftPoints[0], text: "ביטוח מנהלים",  cursor: "pointer", color: "#00BD9C", mouseover: function(e){registerPie('Pie-RB',leftPoints[0]);}},
					{y: leftPoints[1], text: "קרן השתלמות",  cursor: "pointer", color: "#9458B9", mouseover: function(e){registerPie('Pie-RH',leftPoints[1]);}},
					{y: leftPoints[2], text: "קופת גמל",  cursor: "pointer", color: "#6A69D5", mouseover: function(e){registerPie('Pie-RG',leftPoints[2]);}},
					{y: leftPoints[3], text: "קרן פנסיה",  cursor: "pointer", color: "#2C97DD", mouseover: function(e){registerPie('Pie-RP',leftPoints[3]);}},
				]
			},
		]
	});
	// Left Chart render -------
	chartleft.render();
	// -------------------------
	// Right Chart parameters --
	var chartright = new CanvasJS.Chart("chartContainerright",{
		backgroundColor: "transparent",
		animationEnabled: true,
		cursor: 'pointer',
		data: [
			{
				type: "doughnut",
				indexLabelFontFamily: "Garamond",
				innerRadius: "50%",
				indexLabelFontSize: 20,
				startAngle: 0,
				indexLabelFontColor: "dimgrey",
				indexLabelLineColor: "darkgrey",
				toolTipContent: "{y}%  {text}",

				// Chart sections parameters (y : value) - (color : assigned color)
				dataPoints: [
					{y: rightPoints[0], text: "ביטוח מנהלים",   cursor: "pointer", color: "#63BDC0", mouseover: function(e){registerPie('Pie-CB',leftPoints[0]);}},
					{y: rightPoints[1], text: "קרן השתלמות",   cursor: "pointer", color: "#B07FCF", mouseover: function(e){registerPie('Pie-CH',leftPoints[1]);}},
					{y: rightPoints[2], text: "קופת גמל",   cursor: "pointer", color: "#6D8BD5", mouseover: function(e){registerPie('Pie-CG',leftPoints[2]);}},
					{y: rightPoints[3], text: "קרן פנסיה",   cursor: "pointer", color: "#44C6E6", mouseover: function(e){registerPie('Pie-CP',leftPoints[3]);}},
				]
			},
		]
	});
	// Right Chart render ------
	chartright.render();
	// ----------------------------------------------
}


function setUpScrolls(){
	if (jQuery(".mob-view").is(":visible")) {
		var myScroll = new IScroll('.listing_blk_tabs',
								   {
			scrollX: true,
			scrollY: true,
			mouseWheel: true,
			click: true,
			eventPassthrough: true
		});
		myScroll.scrollToElement('.listing-singleblk.down-block', 0);
		var myScroll2 = new IScroll('.bottom-outercont',
									{
			scrollX: true,
			scrollY: true,
			mouseWheel: true,
			click: true,
			eventPassthrough: true
		});
		myScroll2.scrollToElement('.bothaf-singleblk.rightblk', 0, 0, -90);
	}

}

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

/* Report Page Doc Ready */
$(document).ready(function () {
	$('a.button-main-blk').click(function(){showWorstCase(this);});
	$('.worst-case-scenario span').click(function(){hideWorstCase(this);});
	$('a.refer-link').click(function(){showRefer();});
});

function showWorstCase(obj){
  $(obj).closest('.progress-con').next('.worst-case-scenario').show();
}

function hideWorstCase(obj){
	$(obj).parent().hide();
}

function showRefer(){
	jQuery('#refer-friend-pop').bPopup({
		closeClass: 'x',
		modalClose: false,
		positionStyle: 'fixed'
	},
		function() { console.log('about to set z index to 999999'); jQuery('#refer-friend-pop').css('z-index', 999999999); });
}

function showDetails(title, details, tracks, popup_class){
	var the_det = details.split(' ');
	var html = '<h5>' + title + '</h5>'; 
	for(var i in tracks){
		html += '<h3>' + tracks[i]['name'] + '</h3>';
	}
		html += '<h5><span>₪' + the_det[0] + '</span></h5>'; 
			'<ul><li><label>דמי ניהול מצבירה</label><span>' +
			the_det[1] + '%</span></li><li><label>דמי ניהול מצבירה</label>' +
			'<span>' + the_det[2] + '%</span></li></ul>';
	var right_string = the_det[3] * 10;
 	right_string += "%";
	$('.new-popupouter.' + popup_class + ' .main-popup-content .top-popblock').html(html);
	jQuery('.new-popupouter.' + popup_class + ' .main-popup-content .progress-con .link-btnblk').css('right', right_string);
	jQuery('.new-popupouter.' + popup_class).bPopup({
		closeClass: 'close-pop',
		modalClose: false
	});
}

function sendForm(){
	$('#form_container').hide();
	$('#progress').show();
	$.post('ajax/form.php',
			$('#digital_form').serialize(),
			function(data){
				$('#progress').hide();
				if(data.status == 'success'){
					$('#success').show();
				}
				else{
					$('#form_container').show();
					$('#error').html(data.error).show();
				}
			});
	return false;
}

function stickHeaders(){
	   $(window).scroll(function(){
		sticky_relocate();
	   });
}

function hideLastPop(){
	$('.rightfourth-blk').removeClass('active-tabover');
}

function registerPie(element,  percentage){
	var eventData = {
		event : 'Chart Hover',
		eventAction:element,
		'pieChartSection' : element,
		'pieChartSectionPercent' : percentage
	}
	dataLayer.push(eventData);
	console.log('just pushed: ' ,eventData);
}
