$(document).ready(function() {
	
});

function validaCentrocusto(){
	let nome=$("#input-centrocusto-nome").val();
	let codigo=$("#input-centrocusto-codigo").val();

	if(nome =="" || nome<=2){
		$("#input-centrocusto-nome").tooltip("show");
		setTimeout(function(){
			$("#input-centrocusto-nome").tooltip("destroy");
		},2000);
		return;
	}
	if(codigo =="" || codigo <=0){
		$("#input-centrocusto-codigo").tooltip("show");
		setTimeout(function(){
			$("#input-centrocusto-codigo").tooltip("destroy");
		},2000);
		return;
	}else{
		cadastrarCentrocusto();
	}
}

function cadastrarCentrocusto(){
	let nome=$("#input-centrocusto-nome").val();
	let codigo=$("#input-centrocusto-codigo").val();
	$.post("ajax/centrocusto/cadastro-centrocusto.php",{nome:nome,codigo:codigo},function(data){
		swal({
					  title: "Bom trabalho!",
					  text: data,
					  type: "success",
					  html: true
			});
			$("#modal-cad-centrocusto").modal("toggle");
			setTimeout(function(){
				location.reload();
			},1000);
	});
}

function deletarCentrocusto(id){
	swal({
		  title: "Você tem certeza disso?",
		  text: "Você irá deletar todos os dados do usuário",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Sim, Deletar!",
		  cancelButtonText: "Não, Cancelar!",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm){
		  if (isConfirm) {
		  	$.post("ajax/centrocusto/deletar-centrocusto-unico.php",{id: id},function(data){
				swal({
					title: "Bom trabalho!",
					text: data,
					type: "success",
					html: true
				});
			});
			setTimeout(function(){
				location.reload();
			},1500);
		  } else {
		    swal("Cancelado", "Seu usuário se salvou :)", "error");
		  }
	});
}

function levaCentrocusto(id){
	$.post("ajax/centrocusto/listar-centrocusto-unico.php",{id: id},function(data){
		$("#input-centrocusto-id-edit").val(data.id_cent);
		$("#input-centrocusto-nome-edit").val(data.nome_cent);
		$("#input-centrocusto-codigo-edit").val(data.cod_cent);
		/*swal({
			title: "Bom trabalho!",
			text: data,
			type: "success",
			html: true
		});*/
	},"json");
}

	
function editarCentroCusto(){
	var nome = $("#input-centrocusto-nome-edit").val();
	var id = $("#input-centrocusto-id-edit").val();
	var codigo = $("#input-centrocusto-codigo-edit").val();
	$.post("ajax/centrocusto/atualizar-centrocusto.php",{id: id, codigo: codigo, nome: nome},function(data){

		swal({
			title: "Bom trabalho!",
			text: data,
			type: "success",
			html: true
		});

		setTimeout(function(){
			location.reload();
		},2000);
	});
}