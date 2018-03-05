<!DOCTYPE html>

<?php
	session_start();
	if(isset($_SESSION['user'])){
		header("Location: index.php");
	}
	$err=array(
		'N'=>true,
		'P'=>true
	);
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$val=array(
			'N'=>$_POST['name'],
			'P'=>$_POST['password']
		);
		require_once ("connect.php");
		$sql="SELECT u_name AS username,u_no AS no,password,priv,email FROM user_info WHERE ( u_name=:u_name OR email=:email ) AND password=:password";
		$stmt = $conn->prepare($sql);
		$stmt->bindparam(':u_name',$val['N']); //bindparam($palceholders,$value,$datatype);
		$stmt->bindparam(':email',$val['N']);
		$stmt->bindparam(':password',$val['P']);
		$stmt->execute();
		
		if($stmt->rowCount()==1){
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$_SESSION['user']=$row['username'];
			$_SESSION['password']=$val['P'];
			$_SESSION['priv']=$row['priv'];
			$_SESSION['no']=$row['no'];
			header("Location: index.php");
		}else{
			$sql="SELECT u_name AS username FROM user_info WHERE u_name=:u_name OR email=:email";
			$stmt = $conn->prepare($sql);
			$stmt->bindparam(':u_name',$val['N']);
			$stmt->bindparam(':email',$val['N']);
			$stmt->execute();
			if($stmt->rowCount()>0){
				$err['P']=false;
			}else{
				$err['N']=false;
				$err['P']=false;
			}
		}
		
	}
?>

<html dir="rtl">

<head>
	<title> صالة جامع التركي </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Abdulmalik Ben Ali">
	<link rel="stylesheet" href="css/styles.css" type="text/css" />
	<link rel="stylesheet" href="css/stylesinup.css" type="text/css" />
	<style>
		.err {
			color: red;
		}
		div#box-call{
			border: 2px solid #cccccc;
			border-radius: 25px;
			padding: 30px;
		}
	</style>
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
					
					<li><a href="index.php" >الرئيسية</a></li>
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
			
				 <form name="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" accept-charset="utf-8" class="form-style-7">
					<h1>تسجيل الدخول</h1>
					<ul>
						<li>
							<label for="name">الاسم</label>
							<input type="text" name="name" value="<?php if(isset($val['N'])){echo $val['N'];} ?>" maxlength="100">
							<span><?php if(!$err['N']){ echo '<b class="err">ادخل الاسم او البريدك الالكتروني هنا</b>';} else { echo "ادخل الاسم او البريدك الالكتروني هنا"; } ?> </span>
						</li>
						<li>
							<label for="password">كلمة المرور</label>
							<input type="password" name="password" value="<?php if(isset($val['P'])){echo $val['P'];} ?>" maxlength="100">
							<span><?php if(!$err['P']){ echo '<b class="err">ادخل كلمة المرور مكونة من حروف وأرقام</b>';} else {echo "ادخل كلمة المرور مكونة من حروف وأرقام"; } ?></span>
							
							
						</li>
						<li>
							<input type="submit" value="تسجيل الدخول" >
						</li>
					</ul>
				</form>

				<!-- end main content -->
			
				<?php if(isset($_GET['u'])){ ?>
					<div id="box-call">
						<?php 
							if($_GET['u']==1){ echo "سجل الدخول لينتهي التسجيل"; }
							elseif($_GET['u']==2){ echo "سجل الدخول لحجز الصالة"; }
							elseif($_GET['u']==3){ echo "<b class='err'>اعد تسجيل الدخول</b>"; }
						?>
					</div>
				<?php } ?>
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
						<li><a href="login.php">تسجيل الدخول</a></li>
						<li><a href="sinup.php">التسجيل</a></li>

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