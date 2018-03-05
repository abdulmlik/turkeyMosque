<!DOCTYPE html>

<?php 
	session_start();
	require_once ("connect.php");
	$priv=0;
	if(!isset($_SESSION['user'])){
		header("Location: index.php");
	}
	if(isset($_SESSION['user'],$_SESSION['password'],$_SESSION['priv'])){
		require_once ("sess.php");
		$priv=$_SESSION['priv'];
	}
	$err=array(
		'N'=>true,
		'A'=>true,
		'T'=>true
	);
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$val=array(
			'N'=>$_POST['name'],
			'A'=>$_POST['address'],
			'T'=>$_POST['tel']
		);
		$N=is_string($_POST['name']);
		$A=is_string($_POST['address']);
		if(strlen($val['T'])>=11 && strlen($val['T'])<=13 || strlen($val['T'])==0){
			$T=true;
		}else{
			$T=false;
		}
		if($N && $A && $T){
			//insert data in databaes
			
			$sql="UPDATE user_info SET Name=:Name, address=:address, telphone=:telphone WHERE u_name=:u_name AND password=:password";
			$stmt = $conn->prepare($sql);
			$stmt->bindparam(':Name',$val['N'],PDO::PARAM_STR);
			$stmt->bindparam(':address',$val['A'],PDO::PARAM_STR);
			$stmt->bindparam(':telphone',$val['T'],PDO::PARAM_STR);
			$stmt->bindparam(':u_name',$_SESSION['user']);
			$stmt->bindparam(':password',$_SESSION['password']);
			$stmt->execute();
		}else{
			if(!$N){$err['N']=false;}
			if(!$A){$err['A']=false;}
			if(!$T){$err['T']=false;}
		}
	}
?>

<html dir="rtl">

<head>
	<title> صالة جامع التركي </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Abdulmalik Ben Ali">
	<link rel="stylesheet" href="css/styles.css" type="text/css" />
	<link rel="stylesheet" href="css/stylesMyAccount.css" type="text/css" />
	<style>
		.err {
			color: red; 
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
			<br/>
				<?php
					$sql="SELECT * FROM user_info WHERE u_name=:u_name AND password=:password";
					$stmt = $conn->prepare($sql);
					$stmt->bindparam(':u_name',$_SESSION['user']);
					$stmt->bindparam(':password',$_SESSION['password']);
					$stmt->execute();
					$row = $stmt->fetch(PDO::FETCH_ASSOC);
				?>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" accept-charset="utf-8" class="form-style-4">
					<label for="uname">
						<span>الاسم الحساب :</span>
						<input name="uname" type="text" value="<?php echo " ".$row['u_name']; ?>" readonly="readonly" />
					</label>
					<label for="name">
						<span><?php if(!$err['N']){ echo '<b class="err">الاسم :</b>';} else { echo "الاسم :"; } ?></span>
						<input name="name" type="text" value="<?php echo $row['Name']; ?>" placeholder=" ادخل اسم مستعار " 
							   pattern="([a-zA-Z]{1})([a-zA-Z0-9_-]{2,16})" title="يجب ان يتكون من 3 احرف وارقام والحرف الاول يكون حرف" maxlength="16" />
					</label>
					<label for="address">
						<span><?php if(!$err['A']){ echo '<b class="err">العنوان :</b>';} else { echo "العنوان :"; } ?></span>
						<input name="address" type="text" value="<?php echo $row['address']; ?>" placeholder=" ادخل العنوان " />
					</label>
					<label for="tel">
						<span><?php if(!$err['T']){ echo '<b class="err">رقم الهاتف :</b>';} else { echo "رقم الهاتف :"; } ?></span>
						<input name="tel" type="text" value="<?php echo $row['telphone']; ?>" placeholder=" ادخل رقم الهاتف xxx-xxxxxxx"/>
					</label>
					<label for="email">
						<span>الايميل :</span>
						<input name="email" type="text" value="<?php echo " ".$row['email']; ?>" readonly="readonly"/>
					</label>
					<label>
					<span>&nbsp;</span><input type="submit" value="حفظ التعديل" />
					</label>
				</form>
					
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
