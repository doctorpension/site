<?php
session_start();
$_SESSION['user'] = 'sd';
require_once('includes/application.php');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js ie6 oldie" lang="en" itemscope itemtype="http://schema.org/Article"> <![endif]-->
<!--[if IE 7]>
<html class="no-js ie7 oldie" lang="en" itemscope itemtype="http://schema.org/Article"> <![endif]-->
<!--[if IE 8]>
<html class="no-js ie8 oldie" lang="en" itemscope itemtype="http://schema.org/Article"> <![endif]-->
<!--[if IE 9]>
<html class="no-js ie9" lang="en" itemscope itemtype="http://schema.org/Article"> <![endif]-->

<html class="no-js" lang="he" dir="rtl" xml:lang="he" itemscope itemtype="http://schema.org/Article">
	<head>
		<meta charset="utf-8">
		<title>Inner | WakeUp</title>
		<link rel="shortcut icon" href="favicon.ico"/>
		<meta name="description" content="WakeUp WebSite">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
		<meta name="format-detection" content="telephone=no">

		<!-- Le styles -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/font-awesome/font-awesome.css" rel="stylesheet">
		<link href="css/wakeupicons.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/layout.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

		<!--CONSOLESOFTWARE CSS FILE-->
		<link href="css/cs_style.css" rel="stylesheet">

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
		<style type='text/css'>

		</style>

	</head>

	<body class='account-section' id='form_body'>
		<div class="main-outercon">
			<!--Begin header section-->
<?php include('includes/header.php'); ?>
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
