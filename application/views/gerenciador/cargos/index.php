<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Gerenciamento de Contas</title>
    <!-- Principal CSS do Bootstrap -->
	<link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos customizados para esse template -->
    <link href="<?=base_url()?>assets/css/dashboard.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/pnotify.custom.min.css" rel="stylesheet">
    <script src="<?=base_url()?>assets/js/awesome.js"></script>
  </head>
  <style>
  	.panel-header-top{
  		padding:10px;
  	}
  </style>
  <body>
    	
    	<?php 
    		$this->load->view("/gerenciador/inc/nav.php");
    	?>

        <main style="margin-top:40px;" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          
        <div class="row">
        	<div class="col-md-6">
        		<div class="panel-header-top">
        			 <h4>Cargos</h4>
        		</div>
        	</div>
        	<div class="col-md-6">
        		<div class="panel-header-top">
        		 	<button type="button" class="btn btn-primary float-right adicionar">Adicionar <i class="fas fa-plus-circle"></i></button>
        		</div>
        	</div>
        </div>

         
          
          <div id="resultado">
          	<div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Descrição</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
              	<?php 
              	foreach ($cargos as $cargo) { 
              	?>
          		<tr class="item" data-codigo="<?=$cargo->COD_CARGO;?>">
                  <td><?=$cargo->DES_CARGO;?></td>
                  <td> 
                  	<span class="editar" style="cursor:pointer;"> 
                  		<i class="far fa-lg fa-edit text-primary"></i>
                  	</span> 
                  	<span class="excluir" style="cursor:pointer;"> 
                  		<i class="far fa-lg fa-trash-alt text-danger"></i>
                  	</span>
                  </td>
                </tr>
              	<?php 
              		}
              	?>
              </tbody>
            </table>
          </div>
          </div>
        </main>
      </div>
    </div>

    <div class="modal fade" id="modalCargos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Cargo</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<input type="hidden" id="codigocargo" value="0"/>
	        <div class="form-group">
			    <label for="exampleInputEmail1">Nome</label>
			    <input type="text" class="form-control" id="descargo" placeholder="Preencha o nome do cargo" autofocus>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
	        <button type="button" class="btn btn-success btn-salvar">Salvar</button>
	      </div>
	    </div>
	  </div>
	</div>

    <!-- Principal JavaScript do Bootstrap
    ================================================== -->
    <!-- Foi colocado no final para a página carregar mais rápido -->
    <script src="<?=base_url()?>assets/js/jquery3-4-1.js"></script>
	<script src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>
	<script src="<?=base_url()?>assets/js/pnotify.custom.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

	<script>
		$(() => {

			$(".adicionar").on('click', function(){
				$("#modalCargos").modal('show');
				setTimeout(function(){
					$("#descargo").focus();
				},400);
			});

			$(".excluir").on('click', function(){

				let codigoExclusao = $(this).closest(".item").data('codigo');
				
				Swal.fire({
				  title: 'Deseja remover este registro?',
				  text: "",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Sim',
				  cancelButtonText: 'Cancelar'
				}).then((result) => {
				  if (result.value) {
				    Swal.fire(
				      'Deleted!',
				      'Your file has been deleted.',
				      'success'
				    )
				  }
				});
			});

			$(".btn-salvar").on('click', function(){

				let contexto = $(this);

				if(!$("#descargo").val()){
					$("#descargo").focus();
				}else{
					$.ajax({
						method: "POST",
						url: "<?=base_url()?>index.php/gerenciador/cargos/Salvar",
						data: {
							codigo: $("#codigocargo").val(),
							descargo: $("#descargo").val()
						},
						beforeSend: function(){
							contexto.html('<i class="fas fa-circle-notch fa-spin"></i>');
						},
						success: function(data){
							if(data.sucesso){
								new PNotify({
								    title: 'Sucesso',
								    text:  data.msg,
								    addclass: 'custom',
								    type: 'success',
								    delay: 1200,
								    hide: true
								});

								$("#modalCargos").modal('hide');

								$.post("<?=base_url()?>index.php/gerenciador/cargos/listarTodosCargos", {}, function(data){
									$("#resultado").html(data);
								});
							}else{
								new PNotify({
								    title: 'Sucesso',
								    text:  data.msg,
								    addclass: 'custom',
								    type: 'notice',
								    delay: 1200,
								    hide: true
								});
							}
						},
						error: function(){

						},
						complete: function(){
							contexto.html("Salvar");
							$("#codigocargo").val("0");
							$("#descargo").val("");
						}
					});
				}
			});
		});
	</script>
  </body>
</html>


</html>
