<?php
session_start();
$_SESSION['user'] = 'sd';
require_once('includes/application.php');
$body_class= 'account-section' ;
$body_id = 'form_body';
include('includes/header.php'); ?>
			<!--End header section-->
			<!--Begin Page Content-->
			<section id="home" class="content-maincont common-blk subtop-content">
<div class='inner-contentblk'>
<div class='container'>
	<h1 class='eng'>WakeUp &amp; Go!</h1>
	<div class='row' id='form_container'>
		<h2>נא לענות על השאלות הבאות כדי שנוכל ליישם את המלצותינו</h2>
		<form id='digital_form' method="post"  enctype="multipart/form-data" accept-charset="UTF-8">
			<table>
				<tr><td><input type="text" name="fname" placeholder="שם פרטי"/></td></tr>
				<tr><td><input type="text" name="lname" placeholder="שם משפחה"/></td></tr>
				<tr><td><input type="text" name="email" placeholder="דו''אל"></td></tr>
				<tr><td><button class="link-button" type="submit" value="submit"/><span class='eng'>Go</span></button></td></tr>
				<tr><td id='error'></td></tr>
			</table>
		</form>
	</div>
	<div id='progress'>
		<img src='/images/loading.gif' height='100'/><br/>
<p>		מיישם...<br/>
מעבד נתונים...</p>
	</div>
	<div id='success'>
<p>
תבדוק/י את תיבת הדואר שלך.<br/> נשלח זה עתה בקשה לחתימת הטפסים הנדרשים ליישום ההמלצות.<br/>
אנא תחתום/מי בכל מקום הנדרש, ואנו נדאג להעביר את הטפסים לחברות הביטוח.
</div>
</div>
</div>
			</section>
			<!--End Page Content-->
			<!--Begin Footer section-->
			<?php include('includes/footer.php') ?>
			<div class="mob-view"></div>
			<!--End Footer section-->
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
