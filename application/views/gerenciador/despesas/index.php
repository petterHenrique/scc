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
    <link href="<?=base_url()?>assets/css/pnotify.custom.min.css" rel="stylesheet"><link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.23.0/slimselect.min.css" rel="stylesheet"></link>
    <script src="<?=base_url()?>assets/js/awesome.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />

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
        			 <h4>Despesas</h4>
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
                  <th>Valor</th>
                  <th>Categoria</th>
                  <th>Data</th>
                  <th>Centro Custo</th>
                  <th>Anexo</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
              	<?php 
              	foreach ($despesas as $despesa) { 
              	?>
          		<tr class="item" data-codigo="<?=$despesa->COD_DESPESA;?>">
                  <td><?=$despesa->DES_DESPESA;?></td>
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
	        <h5 class="modal-title" id="exampleModalLabel">Despesa</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<input type="hidden" id="codigodespesa" value="0"/>
	        <div class="form-group">
			    <label for="exampleInputEmail1">Descrição Despesa</label>
			    <input type="text" class="form-control" id="desdespesa" placeholder="Preencha a identificação da despesa" autofocus>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					    <label for="exampleInputEmail1">Valor</label>
					    <input type="text" class="form-control" onKeyPress="return(moeda(this,'.',',',event))" id="valordespesa" placeholder="Preencha a identificação da despesa" autofocus>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="exampleInputEmail1">Data</label>
		                <div class="input-group date" id="datadespesa" data-target-input="nearest">
		                    <input type="text" class="form-control datades datetimepicker-input" data-target="#datadespesa"/>
		                    <div class="input-group-append" data-target="#datadespesa" data-toggle="datetimepicker">
		                        <div class="input-group-text c"><i class="fa fa-calendar"></i></div>
		                    </div>
		                </div>
		            </div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
					    <label for="exampleInputEmail1">Categoria</label>
					    <select id="categoriadespesa">
					    </select>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					    <label for="exampleInputEmail1">Anexo</label>
					    <button onclick="$('#anexo').click();" class="btn btn-dark btn-block"> Upload Foto/Arquivo</button>
					    <input type="file" id="anexo" style="display:none;" />
					</div>
				</div>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/pt-br.js">
	</script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
	<script>
		$(() => {
			$('#datadespesa').datetimepicker({
                locale: 'pt-br',
                format: 'L'
            });


			$(".datades").on('click', function(){

				$('.c').click();
			});


			$(".adicionar").on('click', function(){
				$("#modalCargos").modal('show');
				inicializaDrops();
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

				  	$.ajax({
				  		url: "<?=base_url()?>index.php/gerenciador/Cargos/excluir",
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

		function moeda(a, e, r, t) {
		    let n = ""
		      , h = j = 0
		      , u = tamanho2 = 0
		      , l = ajd2 = ""
		      , o = window.Event ? t.which : t.keyCode;
		    if (13 == o || 8 == o)
		        return !0;
		    if (n = String.fromCharCode(o),
		    -1 == "0123456789".indexOf(n))
		        return !1;
		    for (u = a.value.length,
		    h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
		        ;
		    for (l = ""; h < u; h++)
		        -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
		    if (l += n,
		    0 == (u = l.length) && (a.value = ""),
		    1 == u && (a.value = "0" + r + "0" + l),
		    2 == u && (a.value = "0" + r + l),
		    u > 2) {
		        for (ajd2 = "",
		        j = 0,
		        h = u - 3; h >= 0; h--)
		            3 == j && (ajd2 += e,
		            j = 0),
		            ajd2 += l.charAt(h),
		            j++;
		        for (a.value = "",
		        tamanho2 = ajd2.length,
		        h = tamanho2 - 1; h >= 0; h--)
		            a.value += ajd2.charAt(h);
		        a.value += r + l.substr(u - 2, u)
		    }
		    return !1
		}

		function inicializaDrops(){
			$.getJSON('<?=base_url()?>index.php/gerenciador/categorias/getAllJson', function(data){

				let opcoes = [];
				console.log(data);
				opcoes.push(new Option("", "", false, false));

				for (var item in data) {
					let entidade = data[item];
					let option = new Option(entidade.DES_CATEGORIA, entidade.COD_CATEGORIA, false, false);
					opcoes.push(option);
				}
				$("#categoriadespesa").empty();
				$("#categoriadespesa").append(opcoes);
			});

			new SlimSelect({
			  select: '#categoriadespesa',
			});
		}

		
	</script>
  </body>
</html>
