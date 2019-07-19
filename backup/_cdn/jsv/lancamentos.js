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
	//formata moeda
	$('#valor_despesa').bind('keypress',mask.money);
    $('#form-lancamento').submit(function(event){
				event.preventDefault();
				var arquivo=$("#arquivo").val();
				if(arquivo==""){
					alert("Selecione um arquivo!");
					return false;
				}else{
					$.ajax({
							url: "ajax_vendedor/lancamentos/lancamentoDespesa.php",
							method: "POST",
							data: new FormData(this),
							processData: false,
							contentType: false,
							cache: false,
							beforeSend: function(){
								$("#modalLoading").modal('show');
							},
							success: function(data){
								$("#modalLoading").modal('toggle');
								swal({
								  title: "<small>Sucesso</small>!",
								  text: data,
								  html: true
							   });
							   
							   setTimeout(function(){ 
									 window.location.href='painelvendedor.php?exe=lancamentos/index';
							   }, 2000);
							   
							}
					});
				}
				
				return false;
    });
});

/*function validaCadLancamento(){

	let nomedesp=$("#nome-despesa").val();
	let valordesp=$("#valor-despesa").val();
	let nomecat=$("#nome-categoria").val();
	let mesref=$("#mes-ref").val();


	if(nomedesp==""){
		$("#nome-despesa").focus();
		return;
	}
	if(valordesp=="" || isNaN(valordesp)){
		$("#valor-despesa").focus();
		return;
	}
	if(nomecat==""){
		$("#nome-categoria").focus();
		return;
	}
	/*if(form.getAll('myFile').length===0){
			alert("ERRO: selecione um arquivo");
			return false;
	}
	else{
		cadastraLancamento();
	}
}
function cadastraLancamento(){
	//captura dados e lança via ajax
	//var form = $("#form-lancamento").serialize();
	//var valores = $("#form").serialize();
	//let nomedesp=$("#nome-despesa").val();
	//formdata.append("nome-despesa", nomedesp);
				$form = $("#form-lancamento");				
				var formdata = new FormData($form[0]);
				let nomedesp=$("#nome-despesa").val();
	$.ajax({
		    method: "POST",
			url: "ajax_vendedor/lancamentos/lancamentoDespesa.php",
			data: formdata,
			//contentType: false,
			//processData: false,
			success: function(data){
				swal({
				  title: "HTML <small>Title</small>!",
				  text: data,
				  html: true
				});
			},
			error: function(data){
				console.log("deu erro nessa merda");
			}
	});
	
}
function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}*/
