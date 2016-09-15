switchUrls = false;
function showWait(){
	$('#add-to-list-pop').bPopup({
		closeClass: 'x',
		modalClose: false
	},
	function() { 
		jQuery('#add-to-list-pop').css('z-index', 9999999999999999); 
	});
}

var lets_go = '&#1489;&#1493;&#1488;&#1493;&nbsp;&#1504;&#1510;&#1488;&nbsp;&#1500;&#1491;&#1512;&#1498;';
function doSwitch(){
	$('a[href*="survey.php"]').each(function(){
$(this).attr('href','javascript:showWait()');
$(this).addClass('LP');
	});
	$('.link-button.implement span.eng').css('width','auto').html(lets_go);
	$('.link-button.implement').unbind('click').css('background-image', 'none').addClass('LP').click(function () {
		showWait();	
	});

}

function loadSignupAction(){
$('#signupToList').click(function(){
	$('#waiting-list input[type="email"]').removeClass('redBorder');
	var email = $('#add-to-list-pop input[name="email"]').val();
	var reg_email = new RegExp(/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i); 
console.log(email, ' ', reg_email.test(email));
	if( reg_email.test(email)){
	$.post('/ajax/signup.php', {'action' : 'add_to_list', 'email': email},
		function(){
		$('.form').hide();
		$('.thank-you').show();
		});
	}
	else{
	$('#waiting-list input[type="email"]').addClass('redBorder');
}
});
	if(switchUrls){
		doSwitch();
	}
}

 if(window.addEventListener) window.addEventListener('load', loadSignupAction, false);
  else window.attachEvent('onload', loadSignupAction);

