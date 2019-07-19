$(function(){
	$("#cadastrar-usuario").click(function(){
		validaFormularioUsuario();
	});

	//maskaras

	//$("#input-user-telefone").mask("(99)99999-9999");
	$("#input-user-cpf").mask("999.999.999-99");

});
//mascara celular
function mascara(telefone){ 
   if(telefone.value.length == 0)
     telefone.value = '(' + telefone.value; //quando começamos a digitar, o script irá inserir um parênteses no começo do campo.
   if(telefone.value.length == 3)
      telefone.value = telefone.value + ')'; //quando o campo já tiver 3 caracteres (um parênteses e 2 números) o script irá inserir mais um parênteses, fechando assim o código de área.
 
 if(telefone.value.length == 8)
     telefone.value = telefone.value + '-'; //quando o campo já tiver 8 caracteres, o script irá inserir um tracinho, para melhor visualização do telefone.
  
}
function validaFormularioUsuario(){

	let nome = $("#input-user-nome").val();
	let email = $("#input-user-email").val();
	let telefone = $("#input-user-telefone").val();
	let cpf = $("#input-user-cpf").val();
	let cargo = $("#input-user-cargo").val();
	let senha = $("#input-user-senha").val();
	let nivel = $("#input-user-nivel").val();
	let centrocusto = $("#input-user-centrocusto").val();

	if(nome=='' || nome <=2){
		$('#input-user-nome').focus();
		$('#input-user-nome').tooltip('show');
		setTimeout(function(){
			$('#input-user-nome').tooltip('destroy');
		},3000);
		return;
	}
	if(email=='' || email <=2){
		$('#input-user-email').focus();
		$('#input-user-email').tooltip('show');
		setTimeout(function(){
			$('#input-user-email').tooltip('destroy');
		},3000);
		return;
	}
	if(VeriricaEmail(email)){
		$('#input-user-email').focus();
		$('#input-user-email').tooltip('show');
		setTimeout(function(){
			$('#input-user-email').tooltip('destroy');
		},3000);
		return false;
	}
	if(telefone=='' || telefone <=2){
		$('#input-user-telefone').focus();
		$('#input-user-telefone').tooltip('show');
		setTimeout(function(){
			$('#input-user-telefone').tooltip('destroy');
		},3000);
		return;
	}
	if(cpf=='' || cpf <=2){
		$('#input-user-cpf').focus();
		$('#input-user-cpf').tooltip('show');
		setTimeout(function(){
			$('#input-user-cpf').tooltip('destroy');
		},3000);
		return;
	}
	if(VerificaCpf(cpf)){
		$('#input-user-cpf').focus();
		$('#input-user-cpf').tooltip('show');
		setTimeout(function(){
			$('#input-user-cpf').tooltip('destroy');
		},3000);
		return false;
	}

	if(cargo=='' || cargo <=2){
		$('#input-user-cargo').focus();
		$('#input-user-cargo').tooltip('show');
		setTimeout(function(){
			$('#input-user-cargo').tooltip('destroy');
		},3000);
		return;
	}


	if(senha=='' || senha <=2){
		$('#input-user-senha').focus();
		$('#input-user-senha').tooltip('show');
		setTimeout(function(){
			$('#input-user-senha').tooltip('destroy');
		},3000);
		return;
	}
	if(nivel=='' || nivel =='nenhum'){
		$('#input-user-nivel').focus();
		$('#input-user-nivel').tooltip('show');
		setTimeout(function(){
			$('#input-user-nivel').tooltip('destroy');
		},3000);
		return;
	}
	else{
		cadastraUser();
	}

}


function VeriricaEmail(ema){
	$.ajax({
		method: "POST",
		url: "ajax/usuarios/varificaEmail.php",
		data: {email: ema},
		dataType: "json",
		success: function(data){
			console.log(data);
			if(data.user_id != null){
				$('#input-user-email').focus();
				swal({
					  title: "E-mail já existente!",
					  text: "Outro usuário possuí este e-mail!",
					  type: "error",
					  html: true
				});
				return false;
			}
			if(email.value=="" || email.indexOf('@')==-1 || email.indexOf('.')==-1){
				swal({
					title: "Ocorreu um erro :(",
					text: "E-mail Inválido, informe um e-mail correto",
					type: "error"
				});
				return false;
			}
		},
		error:function(data){
			console.log(data);
		}
	});
	
}

function VerificaCpf(cp){
	$.ajax({
		method: "POST",
		url: "ajax/usuarios/verificaCpf.php",
		data: {cpf: cp},
		dataType: "json",
		success: function(data){
			if(data.user_cpf != null){
				$('#input-user-cpf').focus();
				swal({
					  title: "Cpf já existente!",
					  text: "Outro usuário possuí este cpf!",
					  type: "error",
					  html: true
				});
				return false;
			}
		},
		error:function(data){
			console.log(data);
		}
	});

}

function cadastraUser(){
	var formData=$("#form-cadastro-usuarios").serialize();
	$.ajax({
			 method:"POST",
             url:"ajax/usuarios/cadastro-usuarios.php",
             data:formData,
             success: function(data){
             	swal({
					  title: "Bom trabalho!",
					  text: data,
					  type: "success",
					  html: true
				});
				setTimeout(function(){
					$('#modal-cadastro-usuario').modal('toggle');
					location.reload();  
				},1000);
             },
             error: function(data){
                swal({
					  title: "Ocorreu um erro!",
					  text: data,
					  type: "error",
					  html: true
				});
             }
	});
} 

function editarUser(){
	var formData=$("#form-editar-usuarios").serialize();
	$.ajax({
			 method:"POST",
             url:"ajax/usuarios/editar-usuario-unico.php",
             data:formData,
             success: function(data){
             	swal({
					  title: "Bom trabalho!",
					  text: data,
					  type: "success",
					  html: true
				});
				setTimeout(function(){
					$('#modal-cadastro-usuario').modal('toggle');
					location.reload();  
				},1000);
             },
             error: function(data){
                swal({
					  title: "Ocorreu um erro!",
					  text: data,
					  type: "error",
					  html: true
				});
             }
	});
} 

function levaCodigo(iduser){
	//$("#iduser").val(iduser);
	$("#input-user-cod-edit").val(iduser);
	//$("#modal-editar-usuario").modal('show');
	$.post("ajax/usuarios/listar-usuario-unico.php",{id: iduser},function(data){
		$("#input-user-nome-edit").val(data.user_name);
		$("#input-user-email-edit").val(data.user_email);
		$("#input-user-telefone-edit").val(data.user_phone);
		$("#input-user-senha-edit").val(data.user_password);
		$("#input-user-cpf-edit").val(data.user_cpf);
		$("#input-user-cargo-edit").val(data.user_codcargo);
		$("#input-user-nivel-edit").val(data.user_level);
		$("#input-user-nivel-centrocusto").val(data.centrocusto);
		/*swal({
			title: "Bom trabalho!",
			text: data,
			type: "success",
			html: true
		});*/
	},"json");
}

function deletarUsuario(iduserdel){
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
		  	$.post("ajax/usuarios/deletar-usuario-unico.php",{id: iduserdel},function(data){
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

//funções de validação
/*function verificaEmail(email) {
if(email.value=="" || email.indexOf('@')==-1 || email.indexOf('.')==-1){
		swal({
			title: "Ocorreu um erro :(",
			text: "E-mail Inválido, informe um e-mail correto",
			type: "error"
		});
		return false;
	}
}*/
