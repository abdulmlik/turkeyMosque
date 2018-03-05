<!DOCTYPE html>

<?php 
	session_start();
	$priv=0;
	require_once ("../connect.php");
	if(isset($_SESSION['user'],$_SESSION['password'],$_SESSION['priv'])){
		require_once ("../sess.php");
		$priv=$_SESSION['priv'];
	}
	if($priv == 0){
		header("Location: ../index.php");
	}
			
			
	// set data
	if(isset($_GET['box'],$_GET['id']))
	{
		if($_GET['box']=="active")
		{
			$id= intval($_GET['id']);
			$sql="UPDATE resv_info SET paid = 40.0, type = 1 WHERE r_no = :id";
			$stmt = $conn->prepare($sql);
			$stmt->bindparam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();
			header("Location: set.php");
		}elseif($_GET['box']=="delete")
		{
			$id= intval($_GET['id']);
			$sql="DELETE FROM resv_info WHERE r_no = :id";
			$stmt = $conn->prepare($sql);
			$stmt->bindparam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();
			header("Location: set.php");
		}
	}//end set data
		
	// get data
	$sql="SELECT user_info.u_name AS name,resv_info.r_no AS no,resv_info.r_date AS date,resv_info.type AS type FROM resv_info JOIN user_info ON user_info.u_no = resv_info.u_no WHERE resv_info.r_date>CURDATE() ORDER BY resv_info.r_no";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$Count = $stmt->rowCount();
	//$id=0;
	$class="w";
?>

<html dir="rtl">

<head>
	<title> صالة جامع التركي </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Abdulmalik Ben Ali">
	<link rel="stylesheet" href="../css/styles.css" type="text/css" />
	<style>
		table{
			padding: 40px;
			
		}
		td{
			padding-left: 30px;
			padding-right: 30px;
			padding-bottom: 15px;
			padding-top: 15px;
			text-align: right;
		}
		.s{
			background-color: darkslategrey;
			color: white;
		}
		.w{
			background-color: whitesmoke;
		}
		.q{
			background-color: darkgray;
		}
		.e{
			background-color: #991111;
			color: white;
		}
		.e td{
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
					<li><a href="../insert/insert.php">حجز الصالة</a></li>
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
			
				<table>
					<tr class="s">
						<td>رقم الحجز</td>
						<td>اسم الزبون</td>
						<td>تاريخ الحجز</td>
						<td>نوع الحجز</td>
						<td>إلغاء الحجز</td>
					</tr>
					<?php
					if($Count > 0){
						while($row= $stmt->fetch(PDO::FETCH_ASSOC))
						{
							$id=$row['no'];
							//$id++;
							if($row['type']==1){
								echo"
									<tr class='$class'>
										<td>{$id}</td>
										<td>{$row['name']}</td>
										<td>{$row['date']}</td>
										<td>حجز نهائي</td>
										<td><a href='set.php?box=delete&id={$row['no']}'>إلغاء</a></td>
									</tr>
								";
							}else{
								echo"
									<tr class='$class'>
										<td>{$id}</td>
										<td>{$row['name']}</td>
										<td>{$row['date']}</td>
										<td><a href='set.php?box=active&id={$row['no']}'>حجز مبدئي</a></td>
										<td><a href='set.php?box=delete&id={$row['no']}'>إلغاء</a></td>
									</tr>
								";
							}
							if($class=="w"){
								$class="q";
							}else{
								$class="w";
							}
						}
						echo"</table>";
						echo"<p>ملاحظة: اضغط على الحجز المبدئي لتاكيد الحجز</p>";
					}else{
						echo'<tr class="e"><td colspan="5">لا توجد حجوزات</td></tr>';
						echo"</table>";
					}
					?>
					<!--<tr class="w">
					</tr>
					<tr class="q">
					</tr>-->

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
						<li><a href="set.php">تعديل الحجوزات</a></li>
						<li><a href="set2.php">عرض الحجوزات حسب شهر</a></li><?php } elseif($priv==2) { ?>
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
