<!DOCTYPE html>
<?php
	session_start();
	if(isset($_SESSION['user'])){
		header("Location: index.php");
	}
	$err=array(
		'E'=>true,
		'ET'=>"ادخل بريدك الالكتروني هنا",
		'N'=>true,
		'NT'=>"ادخل اسمك الكامل هنا",
		'P'=>true,
		'PT'=>"اعد ادخال كلمة المرور الموجودة في الحقل السابق"
	);
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$val=array(
			'E'=>$_POST['email'],
			'N'=>$_POST['name'],
			'P'=>$_POST['password'],
			'P2'=>$_POST['password2']
		);
		$E=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
		$FN=filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING);
		$N=is_string($_POST['name']);
		if($_POST['password'] == $_POST['password2']){
			$P=true;
		}else{
			$P=false;
		}
		if($E && $N && $FN==$val['N'] && $P){
			//insert data in databaes
			require_once ("connect.php");
			
			$sql="INSERT INTO user_info (u_no, u_name, password, priv, Name, address, telphone,email) VALUES (NULL, :name, :password, '2', NULL, NULL, NULL, :email);";
			$stmt = $conn->prepare($sql);
			$stmt->bindparam(':name',$val['N'],PDO::PARAM_STR); //bindparam($palceholders,$value,$datatype);
			$stmt->bindparam(':password',$val['P'],PDO::PARAM_STR);
			$stmt->bindparam(':email',$val['E']);
			$stmt->execute();
			
			header("Location: login.php?u=1");
		}else{
			if(!$E){$err['E']=false;$err['ET']="تاكد من البريد الالكتروني";}
			if(!$N){$err['N']=false;$err['NT']="تأكد من الاسم";}
			if(!$P){$err['P']=false;$err['PT']="اعد ادخال كلمة المرور الموجودة في الحقل السابق";}
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
			
				 <form name="sinup" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return funErr(this);" method="post" accept-charset="utf-8" class="form-style-7">
					<h1>التسجيل</h1>
					<ul>
						<li>
							<label for="name">الاسم</label>
							<input type="text" name="name" maxlength="100" value="<?php if(isset($val['N'])){echo $val['N'];} ?>" 
								   pattern="([a-zA-Z]{1})([a-zA-Z0-9_-]{2,16})" title="يجب ان يتكون من 3 احرف وارقام والحرف الاول يكون حرف" maxlength="16" required>
							<span id="Ename">
							<?php if(!$err['N']){ echo '<b class="err">{$err["NT"]}</b>';} else { echo $err['NT']; } ?> 
							</span>
						</li>
						<li>
							<label for="email">البريد الالكتروني</label>
							<input type="email" name="email" maxlength="100" value="<?php if(isset($val['E'])){echo $val['E'];} ?>" required>
							<span id="Eemail">
								<?php if(!$err['E']){ echo '<b class="err">{$err["ET"}</b>';} else { echo $err['ET']; } ?> 
							</span>
						</li>
						<li>
							<label for="password">كلمة المرور</label>
							<input type="password" name="password" maxlength="100" value="<?php if(isset($val['P'])){echo $val['P'];} ?>" required>
							<span id="Epass">ادخل كلمة المرور مكونة من  8 حروف و أرقام</span>
						</li>
						<li>
							<label for="password2">تاكيد كلمة المرور</label>
							<input type="password" name="password2" maxlength="100" value="<?php if(isset($val['P2'])){echo $val['P2'];} ?>" required>
							<span id="Epass2">
								<?php if(!$err['P']){ echo "<b class='err'>{$err['PT']}</b>";} else 
										{ echo $err['PT']; } ?> 
							</span>
						</li>
						<li>
							<input type="submit" value="إنشاء حساب جديد" >
						</li>
					</ul>
				</form>

				<!-- end main content -->
	
			</div>
			
			<!-- being validation -->
			
			<script>
				function funErr(form){
					alert("hgdskhm");
					var NA=form.name;
					var PA1=form.password;
					var PA2=form.password2;
					var Npatt="/^[a-z0-9_-]{3,16}$/g";
					var Ppatt="/^[a-zA-Z0-9]{8,10}$/g";
					var Enam=form.getElementById(Ename);
					var Epas=form.getElementById(Epass);
					var Epas2=form.getElementById(Epass2);
					var a=new Boolean;
					var c=new Boolean;
					var b=new Boolean;
					if(Npatt.test(NA) && NA.value.length>6){
						Enam.style.color="#C0C0C0";
						Enam.innerHTML="ادخل اسمك الكامل هنا";
						a=true;

					}else{
						Enam.style.color="#ff0000";
						Enam.innerHTML="الاسم يحتوي على حروف وارقام";
						a=false;
					}
					if((Ppatt.test(PA1)) && (PA1.value.length>8)){
						Epas.style.color="#C0C0C0";
						Epas.innerHTML="ادخل كلمة المرور مكونة من حروف وأرقام";
						c=true;
					}else{
						Epas.style.color="#ff0000";
						Epas.innerHTML="ادخل كلمة المرور مكونة من حروف وأرقام";
						c=false;
					}
					if(PA2.value==PA1.value)){
						Epas2.style.color="#C0C0C0";
						Epas2.innerHTML="اعد ادخال كلمة المرور الموجودة في الحقل السابق";
						b=true;
					}else{
						Epas2.style.color="#ff0000";
						Epas2.innerHTML="اعد ادخال كلمة المرور الموجودة في الحقل السابق";
						b=false;
					}
					if(a && c && b){
						return true;
					}else {return false;}
				}
			</script>
			<!-- end validation -->
			
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