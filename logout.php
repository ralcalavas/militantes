<? session_start();

 	$_SESSION["usuario"]="";
	$_SESSION["id_usuario"]="";
	$_SESSION["id_rol"]="";
		
	session_destroy();

	echo "<script>window.location.href='login.php';</script>";
	
?>
