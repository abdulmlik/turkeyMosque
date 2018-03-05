<!DOCTYPE html>

<?php 
	session_start();
	$priv=0;
	if(isset($_SESSION['user'],$_SESSION['password'],$_SESSION['priv'])){
		require_once ("connect.php");
		require_once ("sess.php");
		$priv=$_SESSION['priv'];
	}
?>

<html dir="rtl">

<head>
	<title> صالة جامع التركي </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Abdulmalik Ben Ali">
	<link rel="stylesheet" href="css/styles.css" type="text/css" />
</head>

<body>

	<div id="wrap">
		
		<div id="header">
		
			<div id="logo">
			
				<!--  begin sitename/logo -->
			
				<h1><a href="index.php">جامع التركي</a></h1>
				
				<!-- end sitename/logo -->
				
			</div>
		
			<div id="nav">
				<ul>
				
					<!-- begin top navigation -->
					
					<li class="selected"><a href="index.php" >الرئيسية</a></li>
					<li><a href="insert/insert.php">حجز الصالة</a></li>
					<li><a href="show/show.php">عرض الحجوزات</a></li>
					<!--<li><a href="login.php">تسجيل الدخول</a></li>-->
					<!--<li><a href="sinup.php">التسجيل</a></li>-->
					<li><a href="call.php">اتصل بنا</a></li>
					
					<!-- end top navigation -->
					
				</ul>
				
			</div>
			<div class="clear"></div>
		</div>
		
	
		<div id="page">
		
			
			<div id="main-content">
			
				<!-- begin main content -->
			
				<h2>مرحباً بكم في صالة مسجد التركي </h2>
				<p>تم تصميم هذا الموقع لحجز صالة المسجد للافراح العامة للشباب المقبل على الزواج</p>
		<br/>
				<h2>كيف يتم الحجز</h2>
				<p>
					<ol>
						<li> يجب التسجيل من <a href="sinup.php">هنا</a></li>
						<li> يجب تسجيل الدخول من <a href="login.php?u=2">هنا</a></li>
						<li> تحديد يوم وتاكد من عدم حجزه من <a href="show/show.php">هنا</a></li>
						<li> بعد تاكد من ان اليوم غير محجوز يتم الحجز من <a href="insert/insert.php">هنا</a></li>
						<li> ثم التواصل مع مشرفي الحجز لدفع رسوم الحجز من <a href="call.php">هنا</a> </li>
					</ol>
				</p>
		<br/>
				<img src="images/Screenshot.png" alt="خطا" height="300" width="400" />
		<br/><br/><br/>
				<h2 style="text-align:center;">موقع المسجد</h2>
				<div id="map" style="width:500px;height:400px;background:yellow">
				</div>
				<script>
					function myMap(){
						var mapCanvas=document.getElementById("map");
						var mapOptions={
							center:new google.maps.latlng(32.8753433,13.2443471),
							zoom:15
						};
						var map = new google.maps.map(mapCanvas,mapOptions);
					}
				</script>
				<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_KDIKU0aU&callback=myMap"></script>
		<br/>

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
						<?php if($priv==0){ ?><li><a href="login.php">تسجيل الدخول</a></li>
						<li><a href="sinup.php">التسجيل</a></li><?php } elseif($priv==1) { ?>
						<li><a href="myaccount.php">حسابي </a></li>
						<li><a href="settings/set.php">تعديل الحجوزات</a></li>
						<li><a href="settings/set2.php">عرض الحجوزات حسب شهر</a></li><?php } elseif($priv==2) { ?>
						<li><a href="myaccount.php">حسابي </a></li><?php } if( $priv!=0 ){ ?>
						<li><a href="show/usershow.php" >حجوزاتي</a></li>
						<li><a href="logout.php" >تسجيل الخروج</a></li><?php } ?>

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
					<a href="index.php">الرئيسية</a>
					<a href="call.php">اتصل بنا</a>
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
