$(document).ready(function(){
	
});

function deletaLancamento(id){
	//captura o id do lancamento na função
	swal({
		  title: "Você tem certeza disso?",
		  text: "Ao deletar você excluirá todos os dados inclusive o anexo da Nota Fiscal",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Sim Deletar!",
		  cancelButtonText: "Não Cancelar!",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm){
		  if (isConfirm) {
				$.ajax({
					method: "POST",
					url: "ajax_vendedor/lancamentos/excluirLancamento.php",
					data: {id:id},
					success: function(data){
						swal("Deleted!", "Deletado com sucesso!"+data+" ", "success");
						setTimeout(function(){
							window.location.href='painelvendedor.php?exe=lancamentos/index';
						},2000);
					},
					error: function(data){
						swal("Erro!", "Erro ao deletar!"+data+" ", "error");
					}
				});
		  } else {
				swal("Cancelado", "Seus dados permanecem intactos :)", "error");
		  }
		});
	
	
}