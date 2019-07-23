<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Upsy Tecnologia">
    <title>Gerenciador Controle Contas</title>
    <meta name="robots" CONTENT="noindex,follow">
    <!-- Bootstrap core CSS -->
	<link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/css/floating-labels.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/font-awesome.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/pnotify.custom.min.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .hidden{
      	display:none;
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="<?=base_url()?>assets/css/floating-labels.css" rel="stylesheet">
    <script src="<?=base_url()?>assets/js/awesome.js"></script>
  </head>
  <body>
    <div class="form-signin">
	  <div class="text-center mb-4">
	    <h1 class="h3 mb-3 font-weight-normal"> 
	   	 	<img src="<?=base_url()?>assets/img/logo.svg" class="img-fluid"/>
	    </h1>
	  </div>

	  <div class="form-label-group">
	    <input type="email" autocomplete="off" id="inputEmail" class="form-control" placeholder="Email address" autofocus>
	    <label for="inputEmail">E-mail</label>
	  </div>

	  <div class="form-label-group">
	    <input type="password" autocomplete="off" id="inputPassword" class="form-control" placeholder="Password">
	    <label for="inputPassword">Senha</label>
	  </div>
	  <div class="form-label-group">
	  	<a href="<?=base_url()?>index.php/home/esqueceusenha" class="text-primary">Esqueceu sua senha?</a>
	  </div>



	  <div class="alert alert-success alertasucesso hidden" role="alert">
	  	<strong class="msgsucesso"></strong>
	  </div>
	  <div class="alert alert-danger alertaerro hidden" role="alert">
		<strong class="msgerro"></strong>
	  </div>
	  <button class="btn btn-outline-primary btn-block btn-logar" type="button">Logar-se</button>
	  <p class="mt-5 mb-3 text-muted text-center">&copy; Todos os Direitos Reservados <?=date("Y")?></p>
	</div>
   </body>
	<script src="<?=base_url()?>assets/js/jquery3-4-1.js"></script>
	<script src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>

	<script>

		$(() => {

			$(".btn-logar").on("click", function(e){
				e.preventDefault();
				logar($(this));
			});

			$("#inputPassword").on("keypress", function(e){
				//e.preventDefault();
				if(e.keyCode == 13){
					logar($(".btn-logar"));
				}
			});

		});


		function logar(){
			if(Validar()){

					let btn = $(this);

					//btn.html('<i class="fas fa-circle-notch fa-spin"></i>');
					btn.html('<img style="width:30px;" src="<?=base_url()?>assets/img/loader.gif" />');

				
					$.ajax({
						url: "<?=base_url()?>index.php/home/auth",
						method:"POST",
						data: {
							email: $("#inputEmail").val(),
							senha: $("#inputPassword").val()
						},
						beforeSend: function(){

						},
						success: function(data){
					
							if(data.sucesso){
								$(".alertasucesso").removeClass("hidden");
								$(".msgsucesso").text(data.msg);

								setTimeout(function(){
									location.reload();
								},2000);

							}else{
								$(".alertaerro").removeClass("hidden");
								$(".msgerro").text(data.msg);
							}

						},
						error: function(data){
							console.log(data);
						},
						complete: function(){
							btn.html('Logar-se');
						}
					});

				}

				setTimeout(function(){
						$(".alertaerro,.alertasucesso").addClass("hidden");
					},2000);
		}

		function Validar(){

			let email = $("#inputEmail");
			let senha = $("#inputPassword");

			if(!email.val()){
				email.focus();

				return false;
			}
			else if(!senha.val()){
				senha.focus();
				return false;
			}

			return true;
		}
	</script>
</html>
