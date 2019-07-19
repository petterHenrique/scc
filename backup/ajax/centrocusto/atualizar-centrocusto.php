<?php
include "../../_app/Config.inc.php";

$id=$_POST["id"];
$cod_cent=$_POST["codigo"];
$nome_cent=$_POST["nome"];
$dados["nome_cent"]=$nome_cent;
$dados["cod_cent"]=$cod_cent;

$upcategoria=new Update;
$upcategoria->ExeUpdate("centrocusto",$dados,"WHERE id_cent=:idcat","idcat=".$id);
$upcategoria->getResult();

if($upcategoria->getResult()){
	echo "Editado com sucesso!";
}else{
	echo "Erro ao editar, entrar em contato (54) 99186-7667";
}
?>