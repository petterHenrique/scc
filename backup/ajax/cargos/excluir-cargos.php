<?php
include "../../_app/Config.inc.php";
$idcargo=$_POST["idcargo"];

$excargo=new Delete;
$excargo->ExeDelete("cargos","WHERE cargo_id=:idcargo","idcargo=".$idcargo);
$excargo->getResult();

if($excargo->getResult()){
	echo "Excluido com sucesso!";
}else{
	echo "Erro ao excluir, entrar em contato (54) 99186-7667";
}
?>