<?php

include_once 'classes/FuncionesDao.php';

if (isset($_POST)) {
    $username = (string)$_POST['username'];
    
    $row=FuncionesDao::ConsultarUsuariosSis($username);
	if (count($row) > 0) {
        echo '<center><div id="result-username" class="alert alert-danger" style="width:80%">El numero de identificacion ya se encuentra registrado en el sistema.</div></center>';
    } 
}
?>
