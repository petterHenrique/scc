<?php

include "../../_app/Config.inc.php";

$cpf=$_POST['cpf'];

$cadastroUser = new Read;
$cadastroUser->ExeRead('usuarios','WHERE user_cpf=:cpf','cpf='.$cpf);
$cadastroUser->getResult();
$listar=$cadastroUser->getResult()[0];
//var_dump($listar);
echo json_encode($listar);
?>