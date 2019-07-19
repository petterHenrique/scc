<?php

include "../../_app/Config.inc.php";

$dataInicial = $_POST['dataInicial'];
$dataFinal=$_POST['dataFinal'];

$cadastroUser = new Read;
$cadastroUser->FullRead("SELECT * FROM v_total_user_bi WHERE (DATADESPESA BETWEEN :dtaIni AND :dtaFi",
	"dtaIni=".$dataInicial."&dtaFi=".$dataFinal);
$cadastroUser->getResult();
$listar=$cadastroUser->getResult();
//var_dump($listar);
echo json_encode($listar);
?>