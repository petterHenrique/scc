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
  	.hidden{
  		display:none;
  	}
  </style>
  <body>
    	
    	<?php 
    		$this->load->view("/gerenciador/inc/nav.php");
    	?>

        <main style="margin-top:40px;" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div id="resultado">
          	<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item">
			    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#relatoriogeral" role="tab" aria-controls="home" aria-selected="true">Relatório Geral</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#relatoriolancamentos" role="tab" aria-controls="profile" aria-selected="false">Relatório de Lançamentos</a>
			  </li>
			</ul>
			<div class="tab-content" id="relatoriogeral">
			  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
			  <div class="tab-pane fade" id="relatoriolancamentos" role="tabpanel" aria-labelledby="profile-tab"> 

				  <div class="row" style="padding:20px;">
				  	<div class="col-md-4">
				  		<label>Categorias:</label>
				  		<select id="categoriadespesa">
					    	<option data-placeholder="true"></option>
					    </select>
				  	</div>
				  	<div class="col-md-4">
				  		<label>Funcionários/Usuários:</label>
				  		<select id="usuarios">
					    	<option data-placeholder="true"></option>
					    </select>
				  	</div>
				  	<div class="col-md-4">
				  		<label for="exampleInputEmail1">Mês Referência</label>
		                <div class="input-group date" id="mesreferencia" data-target-input="nearest">
		                    <input type="text" placeholder="Mês/Ano" class="form-control datades datetimepicker-input" data-target="#mesreferencia"/>
		                    <div class="input-group-append" data-target="#mesreferencia" data-toggle="datetimepicker">
		                        <div class="input-group-text c"><i class="fa fa-calendar"></i></div>
		                    </div>
		                </div>
				  	</div>
				  </div>
				  <hr>
				  <div class="row" style="padding:20px;">
				  	<div class="col-md-12">
				  	</div>
				  </div>
			  </div>
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
						<label for="exampleInputEmail1">Data da Nota Fiscal</label>
		                <div class="input-group date" id="datetimepicker11" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker11"/>
                <div class="input-group-append" data-target="#datetimepicker11" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
		            </div>
				</div>
			</div>
 <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group date" id="datetimepicker11" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker11"/>
                <div class="input-group-append" data-target="#datetimepicker11" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
    </div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
					    <label for="exampleInputEmail1">Categoria</label>
					    <select id="categoriadespesa">
					    	<option data-placeholder="true"></option>
					    </select>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					    <label for="exampleInputEmail1">Anexo</label>
					    <button onclick="$('#anexo').click();" class="btn btn-dark btn-block"> Upload Foto/Arquivo</button>
					    <input type="file" id="anexo" style="display:none;" />
					</div>
					<span class="msg-file hidden">

					</span>
					&nbsp;&nbsp;
					<span style="cursor:pointer;" class="remove-file hidden text-danger">
						<i class="far fa-trash-alt"></i> Remover Anexo
					</span>
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
			inicializaDrops();
			$("#anexo").on("change", function(e){
				let arquivo = $(this).get(0).files[0];
				$(".msg-file,.remove-file ").removeClass('hidden');
				$(".msg-file").html('<i class="fas fa-paperclip"></i> ' + arquivo.name);
			});

			$(document).on('click',".remove-file", function(){
				$("#anexo").val('');
				$(".msg-file,.remove-file ").addClass('hidden');
			});

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
					$("#desdespesa").focus();
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

				if(!$("#desdespesa").val()){
					$("#desdespesa").focus();
				}else{

					let formData = new FormData();

					formData.append("arquivo", $("#anexo").get(0).files[0]);
					formData.append("desdespesa", $("#desdespesa").val());
					formData.append("valordespesa", $("#valordespesa").val());
					formData.append("datadespesa", $(".datades").val().replace("/","-").replace("/","-"));
					formData.append("categoriadespesa", $("#categoriadespesa").val());

					$.ajax({
						method: "POST",
						url: "<?=base_url()?>index.php/gerenciador/despesas/Salvar",
						data: formData,
						contentType: false,
        				processData: false,
        				cache:false,
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

			$.getJSON('<?=base_url()?>index.php/gerenciador/usuarios/getAllJson', function(data){

				let opcoes = [];
				console.log(data);
				opcoes.push(new Option("", "", false, false));

				for (var item in data) {
					let entidade = data[item];
					let option = new Option(entidade.DES_USUARIO, entidade.COD_USUARIO, false, false);
					opcoes.push(option);
				}
				$("#usuarios").empty();
				$("#usuarios").append(opcoes);
			});

			
			new SlimSelect({
			  select: '#categoriadespesa'
			});
			new SlimSelect({
			  select: '#usuarios'
			});
			
			$("#mesreferencia").datetimepicker({
			    viewMode: 'years',
                format: 'MM/YYYY'
			});
		}

		
	</script>
  </body>
</html>
