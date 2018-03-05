<?php
	$sql="SELECT u_name AS username FROM user_info WHERE u_name=:u_name AND password=:password AND priv=:priv";
	$stmt = $conn->prepare($sql);
	$stmt->bindparam(':u_name',$_SESSION['user']);
	$stmt->bindparam(':password',$_SESSION['password']);
	$stmt->bindparam(':priv',$_SESSION['priv']);
	$stmt->execute();
	if($stmt->rowCount()==0){
		session_unset();
		session_destroy();
		header("Location: login.php?u=3");
	}
?>