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
    <script src="<?=base_url()?>assets/js/awesome.js"></script>
  </head>
  <style>
  	.panel-header-top{
  		padding:10px;
  	}
  </style>
  <body>
    	
    	<?php 

    	include 'inc/nav.php';

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
          		<tr>
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
	      	<input type="hidden" id="codigocargo"/>
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
	<script>
		$(() => {

			$(".adicionar").on('click', function(){
				$("#modalCargos").modal('show');
				setTimeout(function(){
					$("#descargo").focus();
				},400);
			});

			$(".btn-salvar").on('click', function(){
				if(!$("#descargo").val()){
					$("#descargo").focus();
				}else{

					$.ajax({

					});

				}

			});
		});
	</script>
  </body>
</html>


</html>
