<?php
ob_start();
session_start();
require('_app/Config.inc.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
     <head>
        <meta charset="UTF-8">
        <title>Sistema de Controle de Contas</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="_cdn/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js"></script>
		<!--tag verifica mobile-->
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<!--não indexa página-->
		<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
	</head>
	 <style>
    body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
    </style>
    <body>
           
            <?php
            $err = "";
            if(isset($_POST["logar"])){
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $login = new Login(1);

            if ($login->CheckLogin()):
                header('Location: painelvendedor.php');
            endif;

            $dataLogin["email"]=$email;
            $dataLogin["senha"]=$senha;

            $login->ExeLogin($dataLogin);

            if (!$login->getResult()){
                $err = $login->getError()[0].$login->getError()[1];
            }else{
                header('Location: painelvendedor.php');
            }
        }
            ?>
             <div class="container">
      <form class="form-signin" method="POST">
        <h2 class="form-signin-heading"><img style=" display: block;
    margin-left: auto;
    margin-right: auto;" class="img-responsive text-center" src="http://www.lubritec.com.br/z10/imagens/logo-lubritec-scherer.png"/></h2>
        <label for="inputEmail" class="sr-only">E-mail:</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Informe seu E-mail" required autofocus>
        <label for="inputPassword" class="sr-only">Senha</label>
        <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Informe sua senha" required>
        <p style="cursor:pointer;"><a class="text-left text-primary" onclick="ModalSenha()">Esqueceu sua senha?</a></p>
        <button type="submit" name="logar" class="btn btn-lg btn-primary btn-block" >Logar-se</button>
        </br>
      			<?php
						$get = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
						if ($get == 'restrito'):
		                    echo '
		                        <div class="alert alert-danger">
		                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                          <strong>Acesso Restrito.!</strong> Não foi possível logar no sistema.</a>.
		                        </div>
		                ';
		                elseif ($get == 'logoff'):
		                    echo '
		                       <div class="alert alert-success alert-dismissable">
  <a href="#"  class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Sucesso!</strong> Deslogado com sucesso!.
</div>
		                ';
		            	endif;
		            	//verifica o erro
		            	if($err!=""){
		            		echo '
		                        <div class="alert alert-danger">
		                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                          <strong>Atenção!</strong> Usuário ou senha inválidos.</a>.
		                        </div>
		                ';
		            	}
		                	 
				?>
      </form>

    </div> <!-- /container -->


<!--modal esqueci senha-->

<div id="modalSenha" class="modal fade" role="dialog">
  <div class="modal-dialog  modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Atualizar Senha.</h4>
      </div>
      <div class="modal-body">
        <form name="resetSenha">
		  <div class="form-group">
		    <label for="cpf">Informe seu CPF:</label>
		    <input name="cpf" type="tel" class="form-control" id="cpf">
		  </div>
		  <button type="button" id="enviarResetSenha" style="width:100%;" class="btn btn-primary">Enviar</button>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">X</button>
      </div>
    </div>

  </div>
</div>
    </body>
    <script>
    $(function(){
    	$("#cpf").mask("999.999.999-99");
    	//reseta senha
    	$("#enviarResetSenha").click(function(){
				Ajax();
    	});
    });
    function ModalSenha(){
    	$("#modalSenha").modal('show');
		$('#modalSenha').on('shown.bs.modal', function(e) {
			  $("#cpf").focus();
			  $(this).keypress(function(e){
					  if(e.KeyCode == 13){
						  Ajax();
					  }
			  });
		})
    }
	function Ajax(){
		$.ajax({
    			method: "POST",
    			data:{ cpf: $("#cpf").val()},
    			url: "ajax/senha/resetarSenha.php",
    			beforeSend: function(){
    				$("#enviarResetSenha").text("");
    				$("#enviarResetSenha").append('<i class="fa fa-spinner fa-spin fa-fw"></i>');
    			},
    			success: function(data){
					if(data =="1"){
						swal(
						  'Sucesso!',
						  'E-mail enviado com sucesso!!',
						  'success'
						)
					}else{
						swal(
						  'Atenção!',
						  'Usuário não encontrado!',
						  'error'
						)
					}
					setTimeout(function(){
						$("#modalSenha").modal('hide');
						swal.close();
					},2500);
				},
    			error: function(data){
					console.log(data);
    			},
    			complete: function(){
    				$("#enviarResetSenha").empty();
    				$("#enviarResetSenha").text("Enviar");
    			}
		});
	}
    </script>
</html>
<?php
ob_end_flush();
