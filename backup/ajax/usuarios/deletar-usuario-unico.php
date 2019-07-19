<?php

include "../../_app/Config.inc.php";

$id=$_POST['id'];

$delUser = new Delete;
$delUser->ExeDelete('usuarios','WHERE user_id=:idUser','idUser='.$id);
$delUser->getResult();

if($delUser->getResult()){
	echo "Deletado com sucesso!";
}else{
	echo "Ocorreu um erro :(";
}
?>