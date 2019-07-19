<?php

include "../../_app/Config.inc.php";

$id=$_POST["id"];

$delcategoria=new Delete;
$delcategoria->ExeDelete("categorias","WHERE id_cat=:id","id=".$id);
$delcategoria->getResult();

if($delcategoria->getResult()){
	echo "Excluído com sucesso!";
}else{
	echo "Erro ao excluir, entrar em contato (54) 99186-7667";
}

?>