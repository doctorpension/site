jQuery(function() {
    
    
    
     
    jQuery('.mainpop-over').delay(600).queue(function(){
        jQuery(this).addClass('active-popup').clearQueue();
    });
       
    jQuery(".insurance-title").hover(
        function () {
            jQuery(this).addClass("result_hover");
        },
        function () {
            jQuery(this).removeClass("result_hover");
        }
    );                                 
    
	jQuery("body").on('click', '.popupbtns', function(e) {
		e.preventDefault();    
		if(jQuery(this).attr('href')) {
			var $hash = jQuery(this).attr('href').slice(1);
			var toppos= jQuery( jQuery(this).attr('href') ).offset().top;
			
			jQuery("body, html").animate(
				{ scrollTop: toppos+-100 },
				{
					duration: 1000,
					complete: function () {
						$classrefer = '.rightfirst-blk';
						if($hash === 'firstpopup') {
							$classrefer = '.rightfirst-blk';
						} else if($hash === 'secondpopup') {
							$classrefer = '.rightsec-blk';
						} else if($hash === 'thirdpopup') {
							$classrefer = '.rightthird-blk';
						}
						jQuery($classrefer).addClass("active-tabover");
						jQuery('.mainpop-over').removeClass("active-popup");						
					}
				}
				
			);		
		}
    });
    
    
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
    
    
  
    
    
    
    
    
    
if(jQuery(".single-tabblock").length) {
    
    var scroll_pos = 0;
	
	var $adjusted_distance = 400;
	
	var $rightfirst_height = parseInt(jQuery('.rightfirst-blk').outerHeight(true));
	var $rightfirst_top = parseInt(jQuery('.rightfirst-blk').offset().top);
	
	var $rightsec_height = parseInt(jQuery('.rightsec-blk').outerHeight(true));
	var $rightsec_top = parseInt(jQuery('.rightsec-blk').offset().top);
	
	var $rightthird_height = parseInt(jQuery('.rightthird-blk').outerHeight(true));
	var $rightthird_top = parseInt(jQuery('.rightthird-blk').offset().top);
	
	var $rightfourth_height = parseInt(jQuery('.rightfourth-blk').outerHeight(true));
	var $rightfourth_top = parseInt(jQuery('.rightfourth-blk').offset().top);
	
	
	 jQuery(document).scroll(function() { 
		scroll_pos = $(this).scrollTop();
		
		$adjusted_scroll_pos = ($adjusted_distance + scroll_pos); 
		
		 
		
		if(($adjusted_scroll_pos > $rightfourth_top) && ($adjusted_scroll_pos - 100) < ($rightfourth_top + $rightfourth_height)) {
			jQuery('.insurance-title').addClass("result_hover");
		} else {
		}
		
	}); 
    
    
}
    
    
	jQuery("body").on('click', '.normalpop-over .link-button', function() {
        jQuery(this).parents().removeClass("active-tabover"); 
    });
    
    
	jQuery("body").on('click', '.closepop-over .title-blk span', function() {
        jQuery(this).parents().removeClass("activepopuoverclse"); 
    });
    
    
    

    
    
    
    
    
    
    jQuery(".recommendations-btn").click(function() {
        jQuery(".listing_blk_tabs").addClass('active-tabblk');
    });

	
	jQuery("body").on('click', '.cont-singleouterblock', function() {
		if(jQuery(this).hasClass('active-tabover')) {
		} else {
			jQuery('.firstsub-popupblk').bPopup({
				closeClass: 'close-pop',
				modalClose: false
			});
		}
    });

	jQuery("body").on('click', '.overlayblock', function() {
		jQuery(this).closest('.single-tabblock').removeClass('active-tabover');
    });
    
    
    
    
    
    
    
    
    
    
    
    
    jQuery(".alrm-icon.normalpop").click(function(){
        jQuery(this).addClass("activepopuover");
    });
    jQuery('body').on('click', '.overlayblock', function() {
        jQuery(this).parent().removeClass("activepopuover");
    });
    
    
    jQuery(".alrm-icon.closepopover").click(function(){
        jQuery(this).addClass("activepopuoverclse");
    });
    
    jQuery('body').on('click', '.closepop-over .title-blk span', function() {
        jQuery(".alrm-icon.closepopover").removeClass("activepopuoverclse");
    });
    
    
    
    
    
    
    
    jQuery(".down-block span i").click(function() {
        jQuery('.second-popupblk').bPopup({
            closeClass: 'close-pop',
            modalClose: false
        });
    });

    jQuery(".thumbs-up").click(function() {
        jQuery('.third-popupblk').bPopup({
            closeClass: 'close-pop',
            modalClose: false
        });
    });
    
    jQuery('.light-hand').hover(function() {
         jQuery(this).parent(".stack-right-inner").toggleClass('hover');
    });




    jQuery(window).scroll(function() {
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
            begin: function() {
                /* jQuery(".one-navigation ul").animate({
					opacity: 0.4
				}); */
            },
            end: function() {
                if (jQuery('.one-navigation').is('.in')) {
                    jQuery(".one-navigation").animate({
                        opacity: 0
                    }, {
                        duration: 300,
                        complete: function() {
                            jQuery('.one-navigation').removeClass('in');
                            jQuery('.one-navigation').css({
                                height: "1px",
                                opacity: 1
                            });
                        }
                    });
                }
            },
            scrollChange: function($currentListItem) {

            }
        });
    }
    //one page section 
    jQuery(".tab_content").hide(); //Hide all content
    jQuery("ul.listing-outer li:first").addClass("active").show(); //Activate first tab
    jQuery(".tab_content:first").show(); //Show first tab content

    //On Click Event
    jQuery("ul.listing-outer li").click(function() {
        jQuery("ul.listing-outer li").removeClass("active"); //Remove any "active" class
        jQuery(this).addClass("active"); //Add "active" class to selected tab
        jQuery(".tab_content").hide(); //Hide all tab content
        var activeTab = jQuery(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
        jQuery(activeTab).fadeIn(1500); //Fade in the active content		
        return false;
    });

    // footer menu
    jQuery(".links-single h6").click(function() {
        if (jQuery(".mob-view").is(":visible")) {
            jQuery(this).parent().children(".links-single ul").slideToggle("slow");
            jQuery(this).parent().toggleClass('open');
        }
    });
    jQuery(".input-block h6").click(function() {
        if (jQuery(".mob-view").is(":visible")) {
            jQuery(this).parent().children(".input-inner").slideToggle("slow");
            jQuery(this).parent().toggleClass('open');
        }
    });

    jQuery(window).on("debouncedresize", function(event) {
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
    jQuery(".male").click(function() {
        var parent = jQuery(this).parents('.switch');
        jQuery('.female', parent).removeClass('selected');
        jQuery(this).addClass('selected');
        jQuery('.checkbox', parent).attr('checked', true);
    });
    jQuery(".female").click(function() {
        var parent = $(this).parents('.switch');
        jQuery('.male', parent).removeClass('selected');
        jQuery(this).addClass('selected');
        jQuery('.checkbox', parent).attr('checked', false);
    });





    if (jQuery.fn.iCheck) {
        jQuery('.single-check').iCheck({
            checkboxClass: 'icheckbox_minimal',
            increaseArea: '-10%' // optional
        }).on('ifChanged', function(e) {
            // Get the field name
            var isChecked = e.currentTarget.checked;

            if (isChecked == true) {
                jQuery(this).parent().parent().addClass("check-active");
            } else {
                jQuery(this).parent().parent().removeClass("check-active");
            }
        }); 
        
        jQuery('.single-check > .icheckbox_minimal').each(function(i){
			if(jQuery(this).is('.checked')) {
				jQuery(this).parent().addClass("check-active");
			}
		});

    }



 if (jQuery('.survey-outercont').length) {
     jQuery("ul.staking-outer li:first").addClass("active").show(); 
	 jQuery(".maintab_content:first").addClass("activeitem").show(); 
	 jQuery("ul.staking-outer li").click(function() {
			var oldele=$("ul.staking-outer li.active").index();
			jQuery("ul.staking-outer li").removeClass("active"); 			
			jQuery(this).addClass("active"); 
			var newele=$("ul.staking-outer li.active").index();					
			jQuery(".maintab_content").removeClass("activeitem").removeClass('olditem');	
			jQuery(".maintab_content:eq("+newele+")").addClass('animate');
			jQuery(".maintab_content:eq("+oldele+")").addClass('olditem').clearQueue();					
			
			jQuery(".maintab_content").delay(500).queue(function(){
				jQuery(".maintab_content:eq("+newele+")").addClass("activeitem").clearQueue();
				jQuery(".maintab_content:eq("+newele+")").removeClass('animate');
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
        
      
        jQuery("#bars li .bar").each(function(key, bar) {
                var percentage = $(this).data('percentage');

                jQuery(this).animate({
                    'height': percentage + '%'
                }, 1000);
            });

});
 function goToByScroll(id){
      // Remove "link" from the ID
    id = id.replace("link", "");
    jQuery('html,body').animate({
      scrollTop: jQuery("#"+id).offset().top},
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