<!DOCTYPE html>

<?php 
	session_start();
	$priv=0;
	if(isset($_SESSION['user'],$_SESSION['password'],$_SESSION['priv'])){
		require_once ("../connect.php");
		require_once ("../sess.php");
		$priv=$_SESSION['priv'];
	}
		
	$x=0; //
	if(isset($_POST['date']) && $priv != 0){
		$sql= "SELECT * FROM resv_info WHERE r_date=:date";
		$stmt = $conn->prepare($sql);
		$stmt->bindparam(':date',$_POST['date']);
		$stmt->execute();
		$Count = $stmt->rowCount();
		if($Count == 0){
			//
			$sql= "SELECT * FROM resv_info WHERE u_no=:no AND type=0";
			$stmt = $conn->prepare($sql);
			$stmt->bindparam(':no',$_SESSION['no']);
			$stmt->execute();
			$Count = $stmt->rowCount();
			//
			if($Count == 0){
				$sql= "INSERT INTO resv_info (r_no, u_no, paid, r_date, type) VALUES (NULL, :user, '0.0', :date, '0')";
				$stmt = $conn->prepare($sql);
				$stmt->bindparam(':user',$_SESSION['no']);
				$stmt->bindparam(':date',$_POST['date']);
				$stmt->execute();
				//goto x;
				$x=1;
			}else{
				$err="لديك يوم محجوز غير مؤكد للحجز يرجى حذف اليوم المحجوز او تأكيده من 
				<a href='../call'>هنا</a>";
			}
		}else{
			$err="يوم ".$_POST['date']." تم حجزه";
		}
	}
	$title = "صالة جامع التركي" ;
	$name_page = str_replace(array(dirname($_SERVER['SCRIPT_NAME']), ".php",'/'), "", $_SERVER['SCRIPT_NAME']);
	$name_page = trim($name_page , '\/');
	$PATH = "http://localhost/turkeyMosque/";

?>

<!-- begin footer and page end -->
<?php include("../header.php"); ?>
<!-- end footer and page end -->
		
	
		<div id="page">
		
			
			<div id="main-content">
				
			
				<!-- begin main content -->
				
				<?php if(($priv==1 || $priv==2) && $x==0){ ?>
				<div class="form-style-6">
					<h1>ادخل التاريخ</h1>
					<form action="insert.php" method="post" >
						<input name="date" type="date" min="<?php echo date('Y-m-d',time()+(24*60*60)); ?>" 
							   max="<?php $d=time()+(18*30*24*60*60); echo date('Y-m-d',$d) ?>"
							   height="15px" width="50px" value="<?php if(isset($_POST['date'])){echo $_POST['date'];} ?>"
							   placeholder="dd-mm-yyyy" pattern="\d{1,2}-\d{1,2}-\d{4}" required />
						<input name="submit" type="submit" value="حجز" />

					</form>
				</div>
				<br/>
				<?php } ?>
				
				<?php if($priv==0){ ?>
				<div class="r"><h2> يجب <a href="../login.php">تسجيل الدخول</a> او <a href="../sinup.php">التسجيل</a> للحجز </h2></div>
				<?php }
					if(isset($err)){
							echo '<div class="err2">'.$err.'</div>';
					} 
					if($x==1){
						//x :
							echo "<div class='t'> <h2>تم الحجز لاتمام اجراءات الحجز يرجى مراسلة احد مستشاري الحجز من<a href='../call'> هنا</a></h2> </div>";
				    } 
				
				    if(($priv==1 || $priv==2) && $x==0){ ?><p>ملاحظة: يتم حجز الايام من 
					<?php echo date('Y-m-d',time()+(24*60*60)); ?> 
					الى 
					<?php $d=time()+(18*30*24*60*60); echo date('Y-m-d',$d) ?>
					ويجب التاكد من ان اليوم غير محجوز من 
					<a href="../show/show.php">هنا</a></p><?php } ?>
				
				<!-- end main content -->
	
			</div>
			
			<div id="main-sidebar">
			
				<!-- being sidebar content -->
				
				<?php include("../sidebar.php"); ?>
				
				<!-- end sidebar content -->
				
			</div>
			
			<div class="clear"></div>
			
		</div>
		
		<!-- end footer and page end -->
		<?php include("../footer.php"); ?>
		<!-- end footer and page end -->
		
	</div>


</body>
</html>
