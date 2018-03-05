<?php
	$host ="localhost";
	$user ="root";
	$pass ="";
	$db   ="turkey_mosque";
	$dsn  ="mysql:host=$host;dbname=$db";
	$options = array( 
		PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8', 
	);
	
	try{
		$conn = new PDO($dsn,$user,$pass,$options);
		
	}
	catch(PDOException $e){
		echo "Not connected : ".$e->getMessage();
	}

?>