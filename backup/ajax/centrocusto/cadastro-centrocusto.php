<?php

include "../../_app/Config.inc.php";

$nome=$_POST["nome"];
$codigo=$_POST["codigo"];

$dados["nome_cent"]=$nome;
$dados["cod_cent"]=$codigo;

$cadcentrocusto=new Create;
$cadcentrocusto->ExeCreate("centrocusto",$dados);
$cadcentrocusto->getResult();

if($cadcentrocusto->getResult()){
	echo "Cadastrado com sucesso!";
}else{
	echo "Erro ao cadastrar, entrar em contato (54) 99186-7667";
}

?>