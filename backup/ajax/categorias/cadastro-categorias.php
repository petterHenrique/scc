<?php

include "../../_app/Config.inc.php";

$nomeCat=$_POST["nomeCat"];
$contaCat=$_POST["contaCat"];
$limiteCat=$_POST["limiteCat"];

$dados["nome_cat"]=$nomeCat;
$dados["cont_cat"]=$contaCat;
$dados["limit_cat"]=$limiteCat;

$cadcategoria=new Create;
$cadcategoria->ExeCreate("categorias",$dados);
$cadcategoria->getResult();

if($cadcategoria->getResult()){
	echo "Cadastrado com sucesso!";
}else{
	echo "Erro ao cadastrar, entrar em contato (54) 99186-7667";
}

?>