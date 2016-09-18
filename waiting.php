<?php
session_start();
$_SESSION['user'] = 'sd';
if(isset($_GET['account_id'])){
	$_SESSION['user'] = $_GET['account_id'];
}
require_once('includes/application.php');
$page_title = 'Coming Soon';
$body_class='account-section';
$body_id = 'waiting_body';
include("includes/header.php");
?>
	<style type='text/css'>
#home{
	padding-top:50px;
}
h2{ line-height:70px;}
#clock{
margin-top:50px;
	font-size:50px;
line-height:55px;
margin-bottom:50px;
}
</style>		<!--Begin Page Content-->
			<section id="home" class="content-maincont common-blk subtop-content">
				<div class="container">
					<div class="row">
<h2>מחכים לנתונים מהמסלקה,<br/> ודוח היעוץ שלכם יהיה מוכן!</h2>
<div id='clock'>

</div>

</div>
</div>
</section>
<?php include('includes/footer.php');?>
<script src="/js/jquery.min.js"></script>
<script type='text/javascript' src='/js/plugins/jquery.countdown.min.js'></script>
<script type='text/javascript'>
var dat = new Date();
 dat.setDate(dat.getDate() + 3);
$(document).ready(function(){
$('#clock').countdown(dat.toLocaleDateString(), function(event) {
	  var totalHours = event.offset.totalDays * 24 + event.offset.hours;
	  console.log(totalHours);
	  $(this).html(event.strftime(totalHours + ' שעות %M דקות %S שניות'));
});
});
</script>
</body></html>
