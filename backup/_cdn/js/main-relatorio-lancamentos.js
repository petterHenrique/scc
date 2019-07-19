$(function(){
$("#loadingRelatorio").hide();
});
$("#gerar-relatorio-lancamentos").on("click",function(){

		//captura todos os dados do formulaário e efetua o post

		let categoria_relatorio=$("#categoria-relatorio").val();

		let funcionario_relatorio=$("#funcionario-relatorio").val();

		let mes_ref=$("#mes-ref").val();

		let data_fim_lancamento=$("#data-final-lancamento").val();

		$("#loadingRelatorio").show();

		setTimeout(function(){

			$("#loadingRelatorio").hide();

			//busca dados relatorio

				$.post("ajax/relatorios/relatorio_lancamento.php",{

					categoria: categoria_relatorio,

					funcionario: funcionario_relatorio, 

					mes_ref: mes_ref

				},function(data){

					/*swal({

					  title: "Debug",

					  text: data,

					  html: true

					});*/

					document.getElementById("listTable").innerHTML = data;

					//setList(data);

				});

		},2000);

});



function setList(data){

	if(data.length ==0){

		swal("Nenhum dado encontrado","Informe uma data mais recente","info");

	}else{

		var table = '<thead><tr><td>Categoria</td><td>Mês Referência</td><td>Despesa</td><td>Valor</td><td>Anexo</td><td>Data Lançamento</td></tr></thead><tbody>';

		for(var key in data){

			var limit = data[key].limit_cat;

			var valorDespesa=data[key].valor_des;

			table += '<tr><td>'+ 

			data[key].cat_nome +'</td><td>'+ 

			data[key].mes_ref +'</td><td>'+ 

			data[key].nome_des +'</td><td class="corpadrao">'+valorDespesa +'</p></td><td><a href=ajax_vendedor/uploads/'+data[key].cam_anexo+' target="_blank"><span style="color:green;" class="glyphicon glyphicon-paperclip"></span></a></td><td>'+

			dataAtualFormatada(data[key].data_des) +'</td><td></tr>';

		}

		table += '</tbody>';

		document.getElementById("listTable").innerHTML = table;

	}

}

function Imprimir(){
	$(".anexoImprimir").empty();
	$("#listTable").printThis();


}


function dataAtualFormatada(){

    var data = new Date();

    var dia = data.getDate();

    if (dia.toString().length == 1)

      dia = "0"+dia;

    var mes = data.getMonth()+1;

    if (mes.toString().length == 1)

      mes = "0"+mes;

    var ano = data.getFullYear();  

    return dia+"/"+mes+"/"+ano;

}