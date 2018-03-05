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
				
				<div class="form-style-6">
					<h1>اختر الشهر</h1>
					<form action="set2.php" method="post" >
						<select name="date">
							<option value="01">1</option>
							<option value="02">2</option>
							<option value="03">3</option>
							<option value="04">4</option>
							<option value="05">5</option>
							<option value="06">6</option>
							<option value="07">7</option>
							<option value="08">8</option>
							<option value="09">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
						</select>
						
						<input name="submit" type="submit" value="عرض" />

					</form>
				</div>
				
			<?php if(isset($_POST['date'])){
				
						// get data
						$year = date('Y');
						if($_POST['date'] < date('m'))
						{
							$year += 1;
						}
						$sql="SELECT user_info.u_name AS name,resv_info.r_no AS no,resv_info.paid AS paid,resv_info.r_date AS date,resv_info.type AS type,user_info.address AS address,user_info.telphone AS telphone,user_info.email AS email FROM resv_info JOIN user_info ON user_info.u_no = resv_info.u_no WHERE MONTH(resv_info.r_date)=:mon && YEAR(resv_info.r_date)=:year ORDER BY resv_info.r_no";
						$stmt = $conn->prepare($sql);
						
						$stmt->bindparam(':mon',$_POST['date']);
						$stmt->bindparam(':year',$year);
						$stmt->execute();
						$Count = $stmt->rowCount();
						//$id=0;
						$class="w";
	
				?>
				<table class="table">
					<tr class="s">
						<td class="bb">رقم الحجز</td>
						<td class="bb">اسم الزبون</td>
						<td class="bb">تاريخ الحجز</td>
						<td class="bb">نوع الحجز</td>
						<td class="bb">العنوان</td>
						<td class="bb">رقم الهاتف</td>
						<td class="bb">المبلغ المدفوع</td>
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
										<td class='bb'>{$id}</td>
										<td class='bb'>{$row['name']}</td>
										<td class='bb'>{$row['date']}</td>
										<td class='bb'>حجز نهائي</td>
										<td class='bb'>{$row['address']}</td>
										<td class='bb'>{$row['telphone']}</td>
										<td class='bb'>{$row['paid']}</td>
									</tr>
								";
							}else{
								echo"
									<tr class='$class'>
										<td class='bb'>{$id}</td>
										<td class='bb'>{$row['name']}</td>
										<td class='bb'>{$row['date']}</td>
										<td class='bb'>حجز مبدئي</td>
										<td class='bb'>{$row['address']}</td>
										<td class='bb'>{$row['telphone']}</td>
										<td class='bb'>{$row['paid']}</td>
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
					}else{
						echo'<tr class="e"><td class="bb" colspan="7">لا توجد حجوزات</td></tr>';
						echo"</table>";
					}
					
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
