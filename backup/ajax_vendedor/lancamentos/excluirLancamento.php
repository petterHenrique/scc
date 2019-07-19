<?php
include "../../_app/Config.inc.php";
//captura o id da despesa e edeleta
$coddespesa=$_POST["id"];
$deletaDespesa=new Delete;
$deletaDespesa->ExeDelete("despesas","WHERE cod_des=:coddespesa","coddespesa=".$coddespesa);
$deletaDespesa->getResult();

//busca caminho da imagem e exclui da pasta e deleta do banco de dados
$buscaCaminhoAnexoDespesa= new Read;
$buscaCaminhoAnexoDespesa->ExeRead("despesas_anexo",'WHERE cod_despesa=:coddespesa',"coddespesa=".$coddespesa);
$buscaCaminhoAnexoDespesa->getResult();
$dado=$buscaCaminhoAnexoDespesa->getResult()[0];
//deleta o arquivo da pasta
unlink("../uploads/".$dado["cam_anexo"]);

//deleta o dado inteiro da tabela anexo

$deletaDespesaAnexo=new Delete;
$deletaDespesaAnexo->ExeDelete("despesas_anexo","WHERE cod_despesa=:coddespesa","coddespesa=".$coddespesa);
$deletaDespesaAnexo->getResult();

if($deletaDespesa->getResult() && $deletaDespesaAnexo->getResult()){
	echo "Lançamento excluído!";
}else{
	echo "Erro ao deletar!";
}
?>