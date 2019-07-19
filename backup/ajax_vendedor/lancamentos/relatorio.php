<?php
	include "../../_app/Config.inc.php";
	$data_atual=date("d/m/Y");
	
	$busca_dados=new Read;
	$busca_dados->FullRead("SELECT SUM(valor_des) as TOTAL, data_des as MES FROM despesas WHERE data_des BETWEEN TIMESTAMP(DATE_SUB(NOW(), INTERVAL 6 day)) AND NOW()");
	$busca_dados->getResult();
	
	$listar=$busca_dados->getResult()[0];
	
	//var_dump($listar);
	echo json_encode($listar);
?>