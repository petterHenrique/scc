<?php
include "../../_app/Config.inc.php";
//referentes a tabela despesas do banco de dados
$nome_despesa=$_POST["nome_despesa"];
$valor_despesa=$_POST["valor_despesa"];
$nome_categoria=$_POST["nome_categoria"];
$data_despesa=date("Y/m/d");
$mes_referencia=$_POST["mes_referencia"];
$usuario_id=$_POST["usuario_id"];
$centro_custo = $_POST["centro_custo"];
//nome do arquivo que será anexo
$nome_arquivo=$_POST["usuario_name"];


$dados["nome_des"]=strtolower($nome_despesa);
$dados["valor_des"]=$valor_despesa;
$dados["cat_nome"]=strtolower($nome_categoria);
$dados["data_des"]=$data_despesa;
$dados["mes_ref"]=strtolower($mes_referencia);
$dados["cod_user"]=$usuario_id;
$dados["centro_custo"]=$centro_custo;

$cadastraLancamento= new Create;
$cadastraLancamento->ExeCreate("despesas",$dados);
$cadastraLancamento->getResult();

//SELECT LAST_INSERT_ID() INTO
//pega o ultimo id inserido no banco e salva na tabela anexos

$buscaUltimoId=new Read;
$buscaUltimoId->FullRead("SELECT MAX(cod_des) AS codigo FROM despesas",null);
$buscaUltimoId->getResult()[0];

$dado=$buscaUltimoId->getResult()[0];
$mostrarultimoid=$dado["codigo"];

//salva na tabela anexo o caminho da imgem junto com o id que irá referenciar

$arquivo=$_FILES["arquivo"];

$upload=new Upload;
$upload->Image($arquivo, $nome_arquivo.time());
$upload->getResult();

$nomeCaminhoAnexo=$upload->getResult();

$dadosAnexo["cam_anexo"]=$nomeCaminhoAnexo;
$dadosAnexo["cod_despesa"]=$mostrarultimoid;

$cadastraAnexo=new Create;
$cadastraAnexo->ExeCreate("despesas_anexo",$dadosAnexo);
$cadastraAnexo->getResult();

if($cadastraAnexo->getResult()){
	echo "Lançamento efetuado com sucesso!";
}else{
	echo "Erro ao efetuar lançamento, tente mais tarde";
}
//fim dos processos
?>
