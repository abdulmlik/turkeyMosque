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

?>

<html dir="rtl">

<head>
	<title> صالة جامع التركي </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Abdulmalik Ben Ali">
	<link rel="stylesheet" href="../css/styles.css" type="text/css" />
	<link rel="stylesheet" href="../css/stylesinup2.css" type="text/css"/>
	<style>
		#w{
			margin: auto;
			padding: 20px;
		}
		.r{
			margin: auto;
			padding: 20px;
			margin-top: 40px;
		}
		.err{
			margin: auto;
			padding: 20px;
			background-color: brown;
			color: white;
			width: 400px;
			text-align: center;
		}
		.t{
			margin: auto;
			padding: 20px;
			background-color:aquamarine;
			color: white;
			width: 400px;
			text-align: center;
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
					<li class="selected"><a href="insert.php">حجز الصالة</a></li>
					<li><a href="../show/show.php">عرض الحجوزات</a></li>
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
							echo '<div class="err">'.$err.'</div>';
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
