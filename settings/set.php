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

	$title = "صالة جامع التركي" ;
	$name_page = str_replace(array(dirname($_SERVER['SCRIPT_NAME']), ".php"), "", $_SERVER['SCRIPT_NAME']);
	$name_page = trim($name_page , '\/');
	$PATH = "http://localhost/turkeyMosque/";
?>

<!-- begin footer and page end -->
<?php include("../header.php"); ?>
<!-- end footer and page end -->
	
		<div id="page">
		
			
			<div id="main-content">
			
				<!-- begin main content -->
			
				<table class="table">
					<tr class="s">
						<td class="td">رقم الحجز</td>
						<td class="td">اسم الزبون</td>
						<td class="td">تاريخ الحجز</td>
						<td class="td">نوع الحجز</td>
						<td class="td">إلغاء الحجز</td>
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
										<td class='td'>{$id}</td>
										<td class='td'>{$row['name']}</td>
										<td class='td'>{$row['date']}</td>
										<td class='td'>حجز نهائي</td>
										<td class='td'><a href='set.php?box=delete&id={$row['no']}'>إلغاء</a></td>
									</tr>
								";
							}else{
								echo"
									<tr class='$class'>
										<td class='td'>{$id}</td>
										<td class='td'>{$row['name']}</td>
										<td class='td'>{$row['date']}</td>
										<td class='td'><a href='set.php?box=active&id={$row['no']}'>حجز مبدئي</a></td>
										<td class='td'><a href='set.php?box=delete&id={$row['no']}'>إلغاء</a></td>
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
						echo'<tr class="e"><td  class="td" colspan="5">لا توجد حجوزات</td></tr>';
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
