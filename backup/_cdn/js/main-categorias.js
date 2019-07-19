var mask = {
 money: function() {
 	var el = this
 	,exec = function(v) {
 	v = v.replace(/\D/g,"");
 	v = new String(Number(v));
 	var len = v.length;
 	if (1== len)
 	v = v.replace(/(\d)/,"0.0$1");
 	else if (2 == len)
 	v = v.replace(/(\d)/,"0.$1");
 	else if (len > 2) {
 	v = v.replace(/(\d{2})$/,'.$1');
 	}
 	return v;
 	};

 	setTimeout(function(){
 	el.value = exec(el.value);
 	},1);
 }

}

$(function(){

	 $('#input-categoria-limite').bind('keypress',mask.money);

});

function validaCategoria(){

	let nomeCat=$("#input-categoria-nome").val();
	let contaCat=$("#input-categoria-conta").val();
	let limiteCat=$("#input-categoria-limite").val();

	if(nomeCat =="" || nomeCat <=2){
		$("#input-categoria-nome").focus();
		$("#input-categoria-nome").tooltip("show");
		setTimeout(function(){
			$("#input-categoria-nome").tooltip("destroy");
		},2000);
		return;
	}

	if(contaCat =="" || contaCat <=2){
		$("#input-categoria-conta").focus();
		$("#input-categoria-conta").tooltip("show");
		setTimeout(function(){
			$("#input-categoria-conta").tooltip("destroy");
		},2000);
		return;
	}

	if(limiteCat =="" || limiteCat <=2){
		$("#input-categoria-limite").focus();
		$("#input-categoria-limite").tooltip("show");
		setTimeout(function(){
			$("#input-categoria-limite").tooltip("destroy");
		},2000);
		return;
	}else{
		cadastraCategoria();
	}

}

function cadastraCategoria(){
	let nomeCat=$("#input-categoria-nome").val();
	let contaCat=$("#input-categoria-conta").val();
	let limiteCat=$("#input-categoria-limite").val();
	$.post("ajax/categorias/cadastro-categorias.php",{nomeCat:nomeCat,contaCat:contaCat,limiteCat:limiteCat},function(data){
			swal({
					  title: "Bom trabalho!",
					  text: data,
					  type: "success",
					  html: true
			});
			$("#modal-cad-categorias").modal("toggle");
			setTimeout(function(){
				location.reload();
			},1000);
	});
}

function deletarCategoria(id){
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
	    $.post("ajax/categorias/excluir-categoria.php",{id:id}, function(data) {
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

function levaCategoria(id){
	$("#modalEdit").modal("show");
	$.post("ajax/categorias/listar-categoria.php",{id:id}, function(data) {
			$("#input-categoria-id-edit").val(data.id_cat);
			$("#input-categoria-nome-edit").val(data.nome_cat);
			$("#input-categoria-conta-edit").val(data.cont_cat);
			$("#input-categoria-limite-edit").val(data.limit_cat);
	},"json");
}

function alteraCategoria(){
	let id=$("#input-categoria-id-edit").val();
	let nome=$("#input-categoria-nome-edit").val();
	let conta=$("#input-categoria-conta-edit").val();
	let limite=$("#input-categoria-limite-edit").val();
	$.post("ajax/categorias/editar-categoria.php",{id:id,nome:nome,conta:conta,limite:limite}, function(data) {
		swal({
			title: "Bom trabalho!",
			text: data,
			type: "success",
			html: true
		});

		setTimeout(function(){
			location.reload();
		})
	});
}
function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}