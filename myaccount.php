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
