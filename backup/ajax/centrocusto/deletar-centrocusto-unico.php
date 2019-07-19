<?php

include "../../_app/Config.inc.php";

$id=$_POST["id"];

$delcentrocusto=new Delete;
$delcentrocusto->ExeDelete("centrocusto","WHERE id_cent=:id","id=".$id);
$delcentrocusto->getResult();

if($delcentrocusto->getResult()){
	echo "Excluído com sucesso!";
}else{
	echo "Erro ao excluir, entrar em contato (54) 99186-7667";
}

?>