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
				<div id="box-call">
					<h2>تواصل معنا</h2>
					<p>
						مهما كان استفسارك فهو محط اهتمامنا,<br/>
						اتصل باحد ممثلي خدمات العملاء او مستشاري الحجز على الرقم<br/>
						xxx-xxxxxxx

					</p>
				</div>
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
