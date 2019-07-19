<?php

include "../../_app/Config.inc.php";



$id=$_POST["id"];
$nome=$_POST["nome"];
$conta=$_POST["conta"];
$limite=$_POST["limite"];

$dados["nome_cat"]=$nome;
$dados["cont_cat"]=$conta;
$dados["limit_cat"]=$limite;

$upcategoria=new Update;
$upcategoria->ExeUpdate("categorias",$dados,"WHERE id_cat=:idcat","idcat=".$id);
$upcategoria->getResult();

if($upcategoria->getResult()){
	echo "Editado com sucesso!";
}else{
	echo "Erro ao editar, entrar em contato (54) 99186-7667";
}

?>