<?php

include "../../_app/Config.inc.php";

$email=$_POST['email'];

$cadastroUser = new Read;
$cadastroUser->ExeRead('usuarios','WHERE user_email=:email','email='.$email);
$cadastroUser->getResult();
$listar=$cadastroUser->getResult()[0];
//var_dump($listar);
echo json_encode($listar);
?>