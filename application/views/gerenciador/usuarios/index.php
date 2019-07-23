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
    
	<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.23.0/slimselect.min.css" rel="stylesheet"></link>
    <script src="<?=base_url()?>assets/js/awesome.js"></script>
  </head>
  <style>
  	.panel-header-top{
  		padding:10px;
  	}

  	.switch {
	  position: relative;
	  display: inline-block;
	  width: 60px;
	  height: 34px;
	}
	.switch input { 
	  opacity: 0;
	  width: 0;
	  height: 0;
	}

	.slider {
	  position: absolute;
	  cursor: pointer;
	  top: 0;
	  left: 0;
	  right: 0;
	  bottom: 0;
	  background-color: #ccc;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	.slider:before {
	  position: absolute;
	  content: "";
	  height: 26px;
	  width: 26px;
	  left: 4px;
	  bottom: 4px;
	  background-color: white;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	input:checked + .slider {
	  background-color: #2196F3;
	}

	input:focus + .slider {
	  box-shadow: 0 0 1px #2196F3;
	}

	input:checked + .slider:before {
	  -webkit-transform: translateX(26px);
	  -ms-transform: translateX(26px);
	  transform: translateX(26px);
	}

	/* Rounded sliders */
	.slider.round {
	  border-radius: 34px;
	}

	.slider.round:before {
	  border-radius: 50%;
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
        			 <h4>Usuários</h4>
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
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Nível Acesso</th>
                  <th>Ativo</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
              	<?php 
              	foreach ($usuarios as $usuario) { 
              	?>
          		<tr class="item" data-codigo="<?=$usuario->COD_USUARIO;?>">
                  <td><?=$usuario->DES_USUARIO;?></td>
                  <td><?=$usuario->EMAIL_USUARIO;?></td>
                  <td> 
                  <?php

                  	if($usuario->NIVEL_USUARIO == 1){
                  ?>
                  	<span class="badge badge-primary">Administrador</span>
                  <?php
                  	}else{
                  ?>
                  	<span class="badge badge-info">Usuário Comum</span>
                  <?php	 
              		}
                  ?>
                  </td>
                  <td><?=(boolean)$usuario->TIP_ATIVO == true ? "<b class='badge badge-success'>Ativo</b>" : "<b class='badge badge-danger'>Inativo</b>";?></td>
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

    <div class="modal fade" data-backdrop="static" id="modalCategorias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Usuário</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<input type="hidden" id="codigousuario" value="0"/>

	      	<div class="row">
	      		<div class="col-md-6">
	      			 <div class="form-group">
					    <label for="exampleInputEmail1">Nome</label>
					    <input type="text" class="form-control" maxlength="100" id="desusuario" placeholder="Preencha o nome" autofocus>
					</div>
	      		</div>
	      		<div class="col-md-6">
	      			<div class="form-group">
					    <label for="exampleInputEmail1">E-mail</label>
					    <input type="text" class="form-control" maxlength="100" id="emailusuario" placeholder="Preencha e-mail" autofocus>
					</div>
	      		</div>
	      	</div>

	      	<div class="row">
	      		<div class="col-md-6">
	      			<div class="form-group">
					    <label for="exampleInputEmail1">Senha</label>
					    <input type="password" class="form-control" maxlength="100" id="senhausuario" placeholder="**********" autofocus>
					</div>
	      		</div>
	      		<div class="col-md-6">
	      			<div class="form-group">
					    <label for="exampleInputEmail1">Nível Acesso</label>
					    <select id="nivelusuario">
					    	<option></option>
					    	<option value="1">Administrador</option>
					    	<option value="2">Usuário</option>
					    </select>
					</div>
	      		</div>
	        </div>
	        <div class="row">
	      		<div class="col-md-6">
		        	<div class="form-group">
					    <label for="exampleInputEmail1">Cargo</label>
					    <select id="cargousuario">
					    </select>
					</div>
	        	</div>
	        	<div class="col-md-6">
	        		<div class="form-group">
					    <label for="exampleInputEmail1">Centro custo</label>
					    <select id="centrocusto">
					    </select>
					</div>
	        	</div>
	        </div>
			<div class="form-group">
				<label>Ativo:</label>
				<label class="switch">
				  <input type="checkbox" id="ativo">
				  <span class="slider round"></span>
				</label>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.23.0/slimselect.min.js"></script>
	<script>
		$(() => {

			
			//inicializaSelects();

			$(".adicionar").on('click', function(){
				$("#modalCategorias").modal('show');
				inicializaSelects();
				setTimeout(function(){
					$("#desusuario").focus();
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

				  	$.ajax({
				  		url: "<?=base_url()?>index.php/gerenciador/usuarios/excluir",
				  		method: "POST",
				  		data: {
				  			codigo:codigoExclusao
				  		},
				  		success: function(data){
				  			if(data.sucesso){
				  				Swal.fire(
							      'Sucesso!',
							      'Removido com sucesso',
							      'success'
							    )
							    
							    setTimeout(function(){
							    	$("tr[data-codigo='"+codigoExclusao+"']").fadeOut(500, function(){

								    	$(this).remove();

								    });
							    },400);
				  			}
				  		},
				  		error: function(data){

				  		},
				  		complete: function(){
				  			
				  		}
				  	});
				  }
				});
			});

			$(document).on('click',".btn-salvar", function(){
	
				let contexto = $(this);

				if(!$("#desusuario").val()){
					$("#desusuario").focus();
				}
				
				else{
					$.ajax({
						method: "POST",
						url: "<?=base_url()?>index.php/gerenciador/usuarios/Salvar",
						data: {
							codigousuario: $("#codigousuario").val(),
							desusuario: $("#desusuario").val(),
							emailusuario: $("#emailusuario").val(),
							senhausuario: $("#senhausuario").val(),
							nivelusuario: $("#nivelusuario").val(),
							codigocargo: $("#cargousuario").val(),
							codigocentrocusto: $("#centrocusto").val(),
							tipativo: $("#tipativo").is(":checked") ? true : false
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

								$("#modalCategorias").modal('hide');

								$.post("<?=base_url()?>index.php/gerenciador/usuarios/listarTodosUsuarios", {}, function(data){
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

		function inicializaSelects(){

			$.getJSON('<?=base_url()?>index.php/gerenciador/centrocusto/getAllJson', function(data){

				let opcoes = [];

				opcoes.push(new Option("", "", false, false));

				for (var item in data) {
					let entidade = data[item];
					let option = new Option(entidade.DES_CENTROCUSTO, entidade.COD_CENTROCUSTO, false, false);
					opcoes.push(option);
				}
				$("#centrocusto").empty();
				$("#centrocusto").append(opcoes);
			});

			$.getJSON('<?=base_url()?>index.php/gerenciador/cargos/getAllJson', function(data){

				console.log(data);
				let opcoes = [];

				opcoes.push(new Option("", "", false, false));

				for (var item in data) {
					let entidade = data[item];
					let option = new Option(entidade.DES_CARGO, entidade.COD_CARGO, false, false);
					opcoes.push(option);
				}
				$("#cargousuario").empty();
				$("#cargousuario").append(opcoes);
			});

			new SlimSelect({
			  select: '#cargousuario',
			});

			new SlimSelect({
			  select: '#centrocusto',
			});

			new SlimSelect({
			  select: '#nivelusuario'
			});
		}

	   
	</script>
  </body>
</html>


</html>
