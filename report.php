<?php
session_start();
$_SESSION['user'] = 'sd';
if(isset($_GET['account_id'])){
	$_SESSION['user'] = $_GET['account_id'];
}
require_once('includes/application.php');
$report = new Report($_SESSION['user']);
if(isset($_SERVER['REDIRECT_URL'])){
	//echo 'the user was redirected';
	//CUSTOMIZE HERE
}
$page_title = 'Report';
$body_class='account-section';
$body_id = 'report_body';
include("includes/header.php");
?>
			<!--Begin Page Content-->
			<section id="home" class="content-maincont common-blk subtop-content">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div class="top-cont-blk">

								<h1 class='wake-call eng'><img src='/images/wakeup_logo_outlined.png'/><strong class='eng'>Call<sup>&trade;</sup></strong></h1>
								<div class="date-block" id="topblock">
									<p>תאריך הפקת דוח: 11/06/2016</p>
								</div>
								<!--Making Text closer in size to the sentense below-->
								<div class="cs_subpage_title">היי <?=$report->firstName;?>,</div>
								<p class='top_summary'>יש לך נכון להיום <br/><strong> <?=number_format($report->getCurrentTotal());?> ₪</strong> בחסכונותיך לפנסיה <br>
									המלצותינו אובייקטיביות ומותאמות אישית לצרכיך</p>
								<span id="guide-template"><i
															 class="fa fa-check"></i>הצבירה שלך לגיל הפרישה יכולה לגדול <strong>ב  <?=number_format($report->getIncrease());?> ₪</strong> אם תבחר ליישם את המלצותינו.</span>

							</div>
						</div>
					</div>
				</div>
				<div class="inner-contentblk">
					<div class="container">

						<!--tab section-->
						<div class='scroll_holder'>


							<div class="listing_blk_tabs">
								<div class="tab_container">
								<!--main popover-->
								<div class="mainpop-over">
									<p>ברוכים הבאים לדוח הייעוץ הפנסיוני שלך.<br/>
										מימין מופיעות הקופות שיש ברשותך כיום.<br/>
										משמאל מופיעות המלצות <span class='eng'>WakeUp</span>
									</p>
									<a href="#firstpopup" id='RepNote1' class="link-button popupbtns">הבנתי</a>
								</div>
								<!--main popover-->
										<div class='normalpop-over rightfourth-blk'>
<p>
צריך עוד הסברים?
<br/>
תמיד תוכל להקיש על
<img src='/images/guide_cue_on.png'/>
שלמעלה
</p>
<a href="javascript:hideLastPop()" class="link-button" id='RepNote4'>הבנתי</a>
</div>
									<div id="sticky-anchor"></div>
									<div class="header-outercont hidden-xs" id="sticky">
										<div class="header-innercont">
											<h4>מצבך היום</h4>
											<h4>המלצות <img src='/images/wakeup_logo_outlined.png'/></h4>
										</div>
									</div>

									<div class="listing-singleblk down-block">
							<img src='/images/swipe-hand.png' class='swipe'/>

										<h4 class="visible-xs cs_chart_equilibre_right">מצבך היום</h4>
										<!--pie chart section-->
										<div class="chart-outercont">
											<div id="chartContainerright" class="cs_chart_container">
											</div>
										</div>
										<!--pie chart section-->
										<div class="single-tabblock first-blk" id='firstpopup-mob'>
											<div class="cont-singleouterblock old-cont">
												<!--normal popover-->
												<div class="normalpop-over long">
													<p>לצפייה במידע נוסף לגבי כל
														קופה, ניתן ללחוץ עם הסמן
														על שם הקופה.</p>
													<p>לצפייה במידע נוסף לגבי כל קופה, ניתן ללחוץ עם הסמן על שם הקופה.</p>
													<a href="#secondpopup" class="link-button popupbtns" id='MRepNote2' >הבנתי</a></div>
												<!--normal popover-->
												<div class="compare-fieldtitle">
													<label>קופת גמל</label>
												</div>
												<?php $report->displayBoxFunds('current', 'gemel');?>
											</div>
										</div>
										<div class="single-tabblock sec-blk" id='secondpopup-mob'>
											<div class="cont-singleouterblock old-cont">
												<!--normal popover-->
												<div class="normalpop-over long">
													<p>זהו תיק החיסכון הפנסיוני המומלץ לך.
														ליד כל שינוי ביחס לתיק החיסכון הקיים
														יהיה פעמון. קופה שאין לידה פעמון
														משמע שאיננו ממליצים לבצע לגביה
														שינוי.
													</p>
													<a href="#topblock" class="link-button popupbtns" id='MRepNote3'>הבנתי</a></div>
												<!--normal popover-->
												<div class="compare-fieldtitle">
													<label>קרן השתלמות</label>
												</div>
													<?php 
												$report->displayBoxFunds('current', 'hishtalmut') ;
												?>
											</div>
										</div>
										<div class="single-tabblock third-blk" id='thirdpopup-mob'>
											<div class="cont-singleouterblock old-cont">
												<div class="compare-fieldtitle">
													<label>ביטוח מנהלים</label>
												</div>
												<?php 
												$report->displayBoxFunds('current', 'minhalim');
												?>
											</div>
										</div>
										<div class="single-tabblock fourth-blk">
											<div class="cont-singleouterblock old-cont">
												<div class="compare-fieldtitle">
													<label>קרן פנסיה</label>
												</div>
													<?php 
												$report->displayBoxFunds('current', 'pensia'); ?>
											</div>
										</div>
									</div>
									<div class="listing-singleblk right-blk">
										<h4 class="visible-xs cs_chart_equilibre">המלצות <img src='/images/wakeup_logo_outlined.png'/></h4>
										<!--pie chart section-->
										<div class="chart-outercont">
											<div id="chartContainerleft" class="cs_chart_container">
											</div>
										</div>
										<!--pie chart section-->

										<!--first bold bell-->
										<div class="single-tabblock rightfirst-blk" id="firstpopup">
											<div class="alrm-icon closepopover"></div>
											<div class="alrm-icon normalpop">
												<!--normal popover-->
												<div class="normalpop-over">
													<p>לצפייה במידע נוסף לגבי כל
														קופה, ניתן ללחוץ עם הסמן
														על שם הקופה.</p>
													<a href="#secondpopup" class="link-button popupbtns" id='RepNote2'>הבנתי</a></div>
												<!--normal popover-->
											</div>
											<div class="cont-singleouterblock new-cont">
												<div class="compare-fieldtitle">
													<label>קופת גמל</label>
												</div>
													<?php 
												$report->displayBoxFunds('recommended', 'gemel');
?>
											</div>
										</div>
										
										<!--second bold bell-->
										<div class="single-tabblock rightsec-blk" id="secondpopup">
											<div class="alrm-icon normalpop">
												<!--normal popover-->
												<div class="normalpop-over long">
													<p>זהו תיק החיסכון הפנסיוני המומלץ לך.
														ליד כל שינוי ביחס לתיק החיסכון הקיים
														יהיה פעמון. קופה שאין לידה פעמון
														משמע שאיננו ממליצים לבצע לגביה
														שינוי.
													</p>
													<a id="cs_popup_to_charts" href="#topblock" class="link-button popupbtns" id='RepNote3'>הבנתי</a>
												</div>
												<!--normal popover-->
											</div>
											<div class="alrm-icon closepopover"></div>

											<div class="cont-singleouterblock new-cont">
												<div class="compare-fieldtitle">
													<label>קרן השתלמות</label>
												</div>
												<?php 
												$report->displayBoxFunds('recommended', 'hishtalmut');
												?>
											</div>
										</div>
										<!--third bold bell-->
										<div class="single-tabblock rightthird-blk" id="thirdpopup">
											<div class="<?php if($d->hishtalmutBell) { ?>alrm-icon<?php }?> normalpop">
											</div>
											<div class="alrm-icon closepopover"></div>
											<div class="cont-singleouterblock new-cont">
												<div class="compare-fieldtitle">
													<label>ביטוח מנהלים</label>
												</div>
												<?php 
												$report->displayBoxFunds('recommended', 'minhalim') ;
												?>
											</div>
										</div>
										<!--fourth bold bell-->
										<div class="single-tabblock rightfourth-blk">
											<div class="<?php if($d->minhalimBell) { ?>alrm-icon <?php }?>normalpop"></div>
											<div class="alrm-icon closepopover"></div>
											<div class="cont-singleouterblock new-cont">
												<div class="compare-fieldtitle">
													<label>קרן פנסיה</label>
												</div>
												<?php 
												$report->displayBoxFunds('recommended', 'pensia');
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--popup blocks section-->

							<!--popup blocks section-->
							<!--current portfolio popup-->
							<div class="new-popupouter firstsub-popupblk current">
								<div class="close-pop"><i class="wake-cross"></i></div>
								<div class="">
									<div class="main-popup-content">
										<div class="top-popblock">
											<h5><span>₪ 13,458</span></h5>
											<ul>
												<li>
													<label>דמי ניהול מצבירה</label>
													<span>0.50%</span></li>
												<li>
													<label>דמי ניהול מצבירה</label>
													<span>6.00%</span></li>
											</ul>
										</div>
										<div class="progress-con">
											<p>רמת סיכון התיק</p>
											<div class="progress-outercon">
												<div class="start-blk">שמרני</div>
												<div class="endvalue">אגרסיבי</div>
												<div class="link-btnblk"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--first popup-->
							<!--first popup-->
							<div class="new-popupouter newfirstsub-popupblk recommendations">
								<div class="close-pop"><i class="wake-cross"></i></div>
								<div class="single-halfblk">
									<div class="main-popup-content">
										<div class="top-popblock">
											<h5>אקסלנס גמל מט”ח מסלו<span>₪ 35,024</span></h5>
											<ul>
												<li>
													<label>דמי ניהול מצבירה</label>
													<span>0.50%</span></li>
												<li>
													<label>דמי ניהול מצבירה</label>
													<span>6.00%</span></li>
											</ul>
										</div>
										<div class="progress-con">
											<p>רמת סיכון התיק</p>
											<div class="progress-outercon">
												<div class="start-blk">שמרני</div>
												<div class="endvalue">אגרסיבי</div>
												<div class="link-btnblk"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="single-leftblk">
									<div class="main-popup-content">
										<h5>ההמלצות <img src='/images/wakeup_logo_outlined.png'/></h5>
										<ul>
											<li>הביצועים של הקופה הולמים את הפרופיל האישי שלך</li>
											<li>דמי הניהול המצטברים בגין קופה זו יפחתו ביחס למצבך הקודם</li>
										</ul>
									</div>
								</div>
							</div>
							<!--recommendations popup-->

							<!--popup blocks section-->

						</div>
						<div class='scroll_holder'>
							<div class="bottom-outercont">
								<div class='bottom-scroller'>
							<img src='/images/swipe-hand.png' class='swipe'/>
									<div class="bothaf-singleblk rightblk cs_bottom_blocks_right">
										<h4 class="cs_chart_equilibre_right_bottom">מצבך היום</h4>
										<!--risk block section-->
										<div class="riskblock-outer">
											<div class="pensions-outer">
												<div class="half-block">
													<div class="inner-txtcontblk rightcontblk">
												<h5>₪<?=number_format($report->getProjectedTotal('current'));?></h5>
														<p>צבירה צפויה לפרישה</p>
													</div>
												</div>
												<div class="half-block">
													<div class="inner-txtcontblk">
														<div class="single-blockhlf">
																<h6>₪<?=number_format($report->getSettlement('current'));?></h6>
															<p>סכום חד פעמי צפוי לפרישה</p>
														</div>
														<div class="single-blockhlf">
													<h6>
															₪<?=number_format($report->getPension('current'));?></h6>
																<p <?php if($report->isTakzivit){ echo 'class="takzivit"';}?>> 
קצבה צפויה לפרישה</p>
														</div>
													</div>
												</div>
											</div>
											<p>רמת סיכון התיק</p>
											<div class="progress-con cs_popup_marker">
												<div class="progress-outercon">
													<div class="start-blk">שמרני</div>
													<div class="endvalue">אגרסיבי</div>
											<div class="link-btnblk risk_level<?=$report->getRisk('current');?>" style="left:<?=(100 - ($report->getRisk('current') * 9.9));?>%">
												<?php 
												$thumb = $report->riskMatches('current');
												?>
													<a href="javascript:void(0);" id='CRisk' class="button-main-blk <?=$thumb;?>"> <i class=" wake-icon14"></i><span><strong>רמת סיכון <?php echo $report->getRiskFitText('current');?>!</strong>קליק להסבר</span></a> </div>
													</div>
												</div>
												<div class='worst-case-scenario current'><span>X</span>
במקרה של מפולת בשווקים
תרחיש הקיצון השלילי הוא
 ירידה של עד
<?php echo $report->getWorstCase('current')?>%
בשווי התיק</div>
									<div class="feesouter-cont"> <span><em>₪<?=number_format($report->getYearlyFee('current'));?></em>דמי ניהול חזויים לשנה</span> </div>
										</div>
										<!--risk block section-->
									</div>
									<div class="bothaf-singleblk left-block cs_bottom_blocks_left">
										<h4>המלצות <img src='/images/wakeup_logo_outlined.png'/></h4>
										<!--risk block section-->
										<div class="riskblock-outer success-bock">
											<div class="pensions-outer">
												<div class="half-block">
													<div class="inner-txtcontblk rightcontblk">
												<h5>₪<?=number_format($report->getProjectedTotal('recommended'));?></h5>
														<p>צבירה צפויה לפרישה</p>
													</div>
												</div>
												<div class="half-block high-block">
													<div class="inner-txtcontblk">
														<div class="single-blockhlf">
															<h6>₪<?=number_format($report->getSettlement('recommended'));?></h6>
															<p>סכום חד פעמי צפוי לפרישה</p>
														</div>
														<div class="single-blockhlf">
													<h6>
₪<?=number_format($report->getPension('recommended'));?></h6>
																<p <?php if($report->isTakzivit){ echo 'class="takzivit"';}?>> 
קצבה צפויה לפרישה</p>
														</div>
													</div>
												</div>
											</div>
											<p>רמת סיכון התיק</p>
											<div class="progress-con">
												<div class="progress-outercon">
													<div class="start-blk">שמרני</div>
													<div class="endvalue">אגרסיבי</div>
											<div class="link-btnblk risk_level<?=$report->getRisk('recommended');?>" style="left:<?=(100 - ($report->getRisk('recommended') * 9.9));?>%"> 
												<?php 
												$thumb = $report->riskMatches('recommended');
												?>
													<a class="button-main-blk <?=$thumb;?>" id='RRisk' href="javascript:void(0);" > <i class=" wake-iconup"></i><span><strong>רמת סיכון <?php echo $report->getRiskFitText('recommended')?>!</strong>קליק להסבר</span></a> </div>
													</div>
												</div>
												<div class='worst-case-scenario recommended'><span>X</span>במקרה של מפולת בשווקים
תרחיש הקיצון השלילי הוא
 ירידה של עד
<?php echo $report->getWorstCase('recommended')?>%
בשווי התיק</div>
									<div class="feesouter-cont"> <span><em>₪<?=number_format($report->getYearlyFee('recommended'));?></em>דמי ניהול חזויים לשנה</span> </div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							<div class='pensia-takzivit <?php if(!$report->isTakzivit){ echo 'hidden';}?>'>
<sup>1</sup>הסכום כולל את הפנסיה התקציבית שלך
</div>
							<div class="bluebottomboxspan"><i class="fa fa-check"></i> הצבירה שלך לגיל הפרישה יכולה לגדול ב
								<strong><?=number_format($report->getIncrease());?>&nbsp;₪</strong> אם תבחר ליישם את המלצותינו.
							</div>
							<div class="insurance-block">
								<div class="container">
									<div class="row">
										<div class="col-sm-12">
											<div class="insurance-inner">
												<!--popup blocks section-->
												<!--thumbs popup-->
												<div class="new-popupouter thumbs-popupblk">
													<div class="close-pop"><i class="wake-cross"></i></div>
													<div class="content-mainblk">
														<div class="main-popup-content">
															<h5>כיסוי ביטוחי</h5>
															<div class="single-popblock">
																<div class="single-fildout small-box">&nbsp;</div>
																<div class="single-fildout"><span>מצבך היום</span></div>
																<div class="single-fildout hidden-xs"><span>המלצות <img
																														src='/images/wakeup_logo_outlined.png'/></span></div>
															</div>
															<div class="single-popblock">
																<div class="single-fildout small-box">
																	<div class="table-header">
																		<ul>
																			<li>נכות</li>
																			<li>שארים</li>
																		</ul>
																	</div>
																</div>
																<div class="single-fildout mobicontent-box">
																	<div class="mobiheader-block  visible-xs">נכות</div>
																	<div class="mobiheader-block-bot  visible-xs">שארים</div>
																	<div class="table-blocksouter">
																		<ul class="header-block">
																			<li>קצבה חודשית</li>
																			<li>סכום חד פעמי</li>
																		</ul>
																		<ul>
																		<li>₪<?php echo $report->getInsuranceFormatted('current', 'disabilityPension')?></li>
																		<li>₪<?php echo $report->getInsuranceFormatted('current', 'disabilityBenefit')?></li>
																		</ul>
																		<ul>
																		<li>₪<?php echo $report->getInsuranceFormatted('current', 'survivorPension')?></li>
																		<li>₪<?php echo $report->getInsuranceFormatted('current', 'survivorBenefit')?></li>
																		</ul>
																	</div>

																	<div class="single-fildout visible-xs"><span>המלצות <img
																															 src='/images/wakeup_logo_outlined.png'/></span></div>
																</div>
																<div class="single-fildout mobicontent-box active-block">
																	<div class="mobiheader-block  visible-xs">נכות</div>
																	<div class="mobiheader-block-bot  visible-xs">שארים</div>
																	<div class="table-blocksouter">
																		<ul class="header-block">
																			<li>קצבה חודשית</li>
																			<li>סכום חד פעמי</li>
																		</ul>
																		<ul>
																		<li>₪<?php echo $report->getInsuranceFormatted('recommended', 'disabilityPension')?></li>
																		<li>₪<?php echo $report->getInsuranceFormatted('recommended', 'disabilityBenefit')?></li>
																		</ul>
																		<ul>
																		<li>₪<?php echo $report->getInsuranceFormatted('recommended', 'survivorPension')?></li>
																		<li>₪<?php echo $report->getInsuranceFormatted('recommended', 'survivorBenefit')?></li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!--thumbs popup-->
												<div class="insurance-title">
													<!--close popover-->

													<div class="closepop-over">
														<div class="title-blk"><span class="fa fa-times cs_scross"></span>שים לב
														</div>
														<div class="content">
															<p>בחלק זה ניתן לצפות בתחזית לגבי סך הצבירה הכספית שלך לגיל

																הפרישה החוקי, וכן בקצבה החודשית ובחיסכון ההוני הנובעים

																ממנה.</p>
															<p>
															לחץ על האייקון למטה לצפייה בפרטים נוספים אודות הכיסוי

																הביטוחי שלך.</p>
														</div>
													</div>
													<!--close popover-->

													<h6>כיסוי ביטוחי היום:</h6>
													<a href="javascript:void(0);" id='Insurance' class="thumbspopup-trigger <?php echo $report->insuranceMatches() ? 'up' : 'down';?>">
						<img  src="/images/thumbs_up.png" height='84' width='84' alt="קליק כאן לפרטים נוספים אודות הכיסוי הביטוחי שלך"> </a></div>
												<div class='rec_partial'>
				התקדם אל
				<div class="wake-call eng">
					<strong class="eng">&amp; Go<sup>™</sup></strong>
					<img src="/images/wakeup_logo_outlined.png">
				</div>
על מנת ליישם את כל המלצותינו או את חלקן
												</div>
												<div class="button-outer cs_button-outer bottom-blk">
													<button class="link-button implement cs_link-button implement" type="submit"
															value="Submit">
															<span class='eng implement'>&amp; Go<sup>&trade;</sup></span>
													<i class="fa fa-angle-left implement" aria-hidden="true"></i></button>
												</div>
<a class='refer-link' id='ReportRefer'>שתף חבר וקבלו שניכם הטבה</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
<div id='refer-friend-pop'>
<div class='top_container'>
	<span class='x'>X</span>
	<div class='top'>
	</div>

<h4>
	שתף עם חברים ותוכל לזכות בעד 100 ₪ הנחה
</h4> 
</div>
	<div class='main'>
<span class='arrow-up'></span>
		<div class='share'>
		<h2> שתף</h2>
		<div class='social-container'>
		<span class='facebook'>פייסבוק</span>
<span class='twitter'>טוויטר</span>
<span class='email'>מייל</span>
</div>
<p>		שלח את ההטבות של <span class='eng'>WakeUp</span>
לחברים</p>
		</div>
		<div class='win'>
			<h2>
וזכה
</h2>
			<div class='questionnaire'>
				<span class='man'>חבר</span>
<p> כל חבר שתוך 14 יום יחליט להתעורר עם <span class='eng'>WakeUp Call</span> יזכה אותך ב 20 ₪ הנחה  </p>
			</div>
			<div class='join'>
				<span class='gift'>מתנה</span>
<p> כל חבר שיתקדם אל<span class='eng'>WakeUp &amp; Go </span> יקבל אוטומטית 20 ₪ הנחה </p>
			</div>
		</div>
<br/>
	</div>
</div>
					</div>

					<!--tab section-->
			</section>
			<!--End Page Content-->
			<div class="mob-view"></div>

			<!--Begin Footer section-->
			<?php include('includes/footer.php') ?>
			<!--End Footer section-->
		</div>
		<!-- Le javascript
================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->

		<script src="/js/jquery.min.js"></script>
		<script src="/js/plugins/jquery.cookie.js"></script>
		<script src="/js/migrate.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/plugins/jquery.cycle2.min.js"></script>
		<script src="/js/plugins/jquery.plugin.js"></script>
		<script src="/js/plugins/jquery.debouncedresize.js"></script>
		<script src="/js/plugins/bpopup.min.js"></script>
		<script src="/js/csjavascript/piechart.js"></script>
		<script src="/js/main.js"></script>
		<script src="/js/iscroll.js"></script>

		<!--CONSOLESOFTWARE ADDED JAVASCRIPT FILES-->
		<script src="/js/canvasjs.min.js"></script>
		<script type='text/javascript'>
			var rightPoints = [<?php echo $report->getProductPoints('current');?>];
			var leftPoints = [<?php echo $report->getProductPoints('recommended');?>];
		</script>
	</body>
</html>
