<?
if($_SESSION["id_usuario"]==""){
	echo "<script>alert('La sesion ha expirado');window.location.href='logout.php'</script>";
}
?>