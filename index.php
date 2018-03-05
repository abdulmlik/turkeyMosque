<!DOCTYPE html>

<?php 
	session_start();
	$priv=0;
	if(isset($_SESSION['user'],$_SESSION['password'],$_SESSION['priv'])){
		require_once ("connect.php");
		require_once ("sess.php");
		$priv=$_SESSION['priv'];
	}
	$title = "صالة جامع التركي" ;
	$name_page = str_replace(array(dirname($_SERVER['SCRIPT_NAME']), ".php"), "", $_SERVER['SCRIPT_NAME']);
	$name_page = trim($name_page , '\/');
	$PATH = "http://localhost/turkeyMosque/";
?>

<!-- begin footer and page end -->
<?php include("header.php"); ?>
<!-- end footer and page end -->
		
	
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
				
				<?php include("sidebar.php"); ?>
				
				<!-- end sidebar content -->
				
			</div>
			
			<div class="clear"></div>
			
		</div>
		
		<!-- end footer and page end -->
		<?php include("footer.php"); ?>
		<!-- end footer and page end -->
		
	</div>


</body>
</html>
