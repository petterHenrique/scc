$(function(){

});

function validaCargo(){
	let nomecargo=$("#input-cargo-nome").val();
	if(nomecargo =="" || nomecargo <=2){
		$('#input-cargo-nome').focus();
		$('#input-cargo-nome').tooltip('show');
		setTimeout(function(){
			$('#input-cargo-nome').tooltip('destroy');
		},3000);
		return;
	}else{
		cadastraCargo();
	}
}
function cadastraCargo(){
	let nomecargo=$("#input-cargo-nome").val();
	$.post("ajax/cargos/cadastro-cargos.php",{nomecargo:nomecargo}, function(data) {
			swal({
					  title: "Bom trabalho!",
					  text: data,
					  type: "success",
					  html: true
			});

			setTimeout(function(){
				$("#modal-cad-cargo").modal("toggle");
			},1000);
	});
}
function deletarCargo(idcargo){
	swal({
	  title: "Você tem certeza disso?",
	  text: "Irá deletar permanentemente os dados!",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Sim, deletar!",
	  cancelButtonText: "Não, cancelar!",
	  closeOnConfirm: false,
	  closeOnCancel: false
	},
	function(isConfirm){
	  if (isConfirm) {
	    $.post("ajax/cargos/excluir-cargos.php",{idcargo:idcargo}, function(data) {
			swal({
					  title: "Bom trabalho!",
					  text: data,
					  type: "success",
					  html: true
			});
			setTimeout(function(){
				location.reload();
			},1000);
		});
	  } else {
	    swal("Cancelado", "Realizado com sucesso! :)", "error");
	  }
	});
	
}