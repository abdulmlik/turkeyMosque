<!DOCTYPE html>

<?php 
	session_start();
	$priv=0;
	if(isset($_SESSION['user'],$_SESSION['password'],$_SESSION['priv'])){
		require_once ("../connect.php");
		require_once ("../sess.php");
		$priv=$_SESSION['priv'];
	}
?>

<html dir="rtl">

<head>
	<title> صالة جامع التركي </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Abdulmalik Ben Ali">
	<link rel="stylesheet" href="../css/styles.css" type="text/css" />
	<link href='../js/fullcalendar-3.1.0/fullcalendar.min.css' rel='stylesheet' />
	<link href='../js/fullcalendar-3.1.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />
	<script src='../js/fullcalendar-3.1.0/lib/moment.min.js'></script>
	<script src='../js/fullcalendar-3.1.0/lib/jquery.min.js'></script>
	<script src='../js/fullcalendar-3.1.0/fullcalendar.min.js'></script>
	<script src='../js/fullcalendar-3.1.0/locale-all.js'></script>
	
	<script>

		$(document).ready(function() {
			var initialLocaleCode = 'ar-ly';  //local time and language

			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month'
				},
				//defaultDate: '2017-1-14', //show star Date
				locale: initialLocaleCode,
				buttonIcons: false, // show the prev/next text
				weekNumbers: false,  //show the col week number
				navLinks: false, // can click day/week names to navigate views
				businessHours: false, // display business hours (show end week)
				editable: false,  // move events
				eventLimit: false, // allow "more" link when too many events
				events: {
							url: 'get-events.php', // get events in database
							type: 'POST', // Send post data
							error: function() {
								alert('There was an error while fetching events.');
							}
						}
					/*[
						{
							start:'xxxx-x-x',
							end:'xxxx-x-(x+1)',
							overlap:false,
							allDay:true,
							rendering:'background',
							color:'#ff9f00'

						},
						{
							start:'xxxx-x-x',
							end:'xxxx-x-(x+1)',
							overlap:false,
							allDay:true,
							rendering:'background',
							color:'#ff5500'

						}
					]*/
			});

		});

	</script>
	<style>
		#calendar {
			max-width: 900px;
			margin: 0 auto;
			padding: 15px;
		}
		#rsl{
			margin-top: 40px;
		}
		#T{
			list-style-image: url(../images/new.T.png);
		}
		#R{
			list-style-image: url(../images/new.R.png);
		}
	</style>


</head>

<body>

	<div id="wrap">
		
		<div id="header">
		
			<div id="logo">
			
				<!--  begin sitename/logo -->
			
				<h1><a href="../index.php">جامع التركي</a></h1>
				
				<!-- end sitename/logo -->
				
			</div>
		
			<div id="nav">
				<ul>
				
					<!-- begin top navigation -->
					
					<li><a href="../index.php" >الرئيسية</a></li>
					<li><a href="../insert/insert.php">حجز الصالة</a></li>
					<li class="selected"><a href="show.php">عرض الحجوزات</a></li>
					<!--<li><a href="login.php">تسجيل الدخول</a></li>-->
					<!--<li><a href="sinup.php">التسجيل</a></li>-->
					<li><a href="../call.php">اتصل بنا</a></li>
					
					<!-- end top navigation -->
					
				</ul>
				
			</div>
			<div class="clear"></div>
		</div>
		
	
		<div id="page">
		
			
			<div id="main-content">
			
				<!-- begin main content -->
				
				<div id='calendar'></div>

				<div id='rsl'>
					<ul>
						<li id='T'>حجوزات مؤقتة</li>
					</ul>
					<ul>
						<li id="R" >حجوزات نهائية</li>
					</ul>
				</div>

				
				<!-- end main content -->
	
			</div>
			
			<div id="main-sidebar">
			
				<!-- being sidebar content -->
				
				<div class="sidebar-box brown-box">
					<p>هذا الموقع يقوم بتنظيم الحجوزات صالة جامع التركي</p>
				</div>
					<br/>
				<div class="sidebar-box">
					<h4>الروابط</h4>
					<ul>
						<?php if($priv==0){ ?><li><a href="../login.php">تسجيل الدخول</a></li>
						<li><a href="../sinup.php">التسجيل</a></li><?php } elseif($priv==1) { ?>
						<li><a href="../myaccount.php">حسابي </a></li>
						<li><a href="../settings/set.php">تعديل الحجوزات</a></li>
						<li><a href="../settings/set2.php">عرض الحجوزات حسب شهر</a></li><?php } elseif($priv==2) { ?>
						<li><a href="../myaccount.php">حسابي </a></li><?php } if( $priv!=0 ){ ?>
						<li><a href="../show/usershow.php" >حجوزاتي</a></li>
						<li><a href="../logout.php" >تسجيل الخروج</a></li><?php } ?>

					</ul>
				</div>
				

				
				<!-- end sidebar content -->
				
			</div>
			
			<div class="clear"></div>
			
		</div>
		
		<div class="footer">
			<div class="footer-level-2">
			
				<!-- begin footer -->
				
				<p>
					<a href="../index.php">الرئيسية</a>
					<a href="../call.php">اتصل بنا</a>
				</p>
				
				<!-- end footer -->
				
			</div>
		</div>
		<div class="page-end">
			
			<!-- begin page end -->
			
			<p>جميع الحقوق محفوظة &copy 2016-<?php echo date('Y'); ?> جامع التركي </p>
			
			<!-- end page end -->
		
		</div>
		
	</div>


</body>
</html>