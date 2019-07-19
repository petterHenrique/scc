<?php
include "../../_app/Config.inc.php";
$relatorio=new Read;
$relatorio->FullRead("SELECT * FROM v_relatorio_home");
$relatorio->getResult();
$dados=$relatorio->getResult();
echo json_encode($dados);
?>
