<?php

include "../../_app/Config.inc.php";

//captura os dados abaixo



$categoria=$_POST["categoria"];

//cod funcionário efetua busca no banco pegando o codigo

$funcionario=$_POST["funcionario"];

$buscaIdFuncionario=new Read;

$buscaIdFuncionario->ExeRead("usuarios",'WHERE user_name=:nome',"nome=".$funcionario);

$buscaIdFuncionario->getResult()[0];

$nomefunc=$buscaIdFuncionario->getResult()[0];

$funcionario2=$nomefunc["user_id"];



/////////////////////////////////////

/*$datainicial=$_POST["datainicial"];

$datainicial2=date('Y/m/d', strtotime($datainicial));

$datafinal=$_POST["datafinal"];

$datafinal2=date('Y/m/d', strtotime($datafinal));

*/

$mesRef = $_POST["mes_ref"];

//efetua a listagem do relatório

$relatorio=new Read;

$relatorio->FullRead("SELECT * FROM v_relatorio_gastos WHERE cat_nome=:categoria AND cod_user=:funcionario AND mes_ref = :mesRef","categoria=".$categoria."&funcionario=".$funcionario2."&mesRef=".$mesRef);

$relatorio->getResult();

$dados=$relatorio->getResult();

//echo json_encode($dados);

?>

<?php

	if($dados){

?>

<thead>

	<tr>

		<td>Categoria</td>

		<td>Mês Referência</td>

		<td>Despesa</td>

		<td>Valor</td>

		<td class="anexoImprimir">Anexo</td>

		<td>Data Lançamento</td>

	</tr>

</thead>

<tbody>
    <?php $total = 0; ?>
	<?php foreach($dados as $dado){?>

		<tr>

		<td><?=$dado["cat_nome"];?></td>

		<td><?=$dado["mes_ref"];?></td>

		<td><?=$dado["nome_des"];?></td>

		<?php

		$valorCategoria = $dado["valor_des"];

		$valorLimite = $dado["limit_cat"];

		if($valorCategoria>$valorLimite){

			$cor = 'label-danger';

		}else{

			$cor="label-success";

		}
		$total += $dado["valor_des"];
		 
		?>

		<td>

			<span class="label <?=$cor;?>"><?=$dado["valor_des"];?></span>

		</td>

		<td class="anexoImprimir"><a href='ajax_vendedor/uploads/<?=$dado["cam_anexo"];?>' target="_blank"><span style="color:green;" class="glyphicon glyphicon-paperclip"></span></a></td>

		<td><?=date('d/m/Y', strtotime($dado["data_des"]));?></td>

	</tr>

	<?php } ?>
	
</tbody>
<tfoot>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td><h4 class="text-left text-primary" ><?php echo 'Total: R$ '.number_format($total, 2, ',', '.');  ?></h4></td>
</tr>

</tfoot>
	
	
	<?php } else {?>

	</br>

	<div class="alert alert-info text-center">

	  <strong class="text-center">Nenhum registro encontrado :(</strong>

	</div>

	<?php } ?>

