$(function(){
	//mascaras
    /*$("#ajax-login").submit(function(){

        var form = $(this).serialize();

        $.ajax({
            method:"POST",
            url:"ajax/login.php",
            data:form,
            success: function(data){
                console.log(data);
            },
            error: function(data){
                swal(data);
            }
        });

        //return false;
    });*/
	$("#iconloading").hide();
	$(".btlogar").click(function(){
		$("#iconloading").toggle();
		$(this).text('Save');
		//alert("dede");
	});
	$("#verificaEmail").click(function(){
		verificaEmail();
	});
	
});
function SomenteNumero(e){
        var tecla=(window.event)?event.keyCode:e.which;   
        if((tecla>47 && tecla<58)) return true;
            else{
                if (tecla==8 || tecla==0) return true;
            else  return false;
        }
}

function verificaEmail(){
	//verificaEmail se existe e envia por email
	var email = document.getElementById("emailreset").value;
	if(email ==""){
			$('#emailreset').tooltip("show");
			setTimeout(function(){
				$('#emailreset').tooltip("destroy");
			},2000);
		return false;
	}else{
		$.post("ajax/login/verificaEmail.php",{email: email},function(data){
			swal({
			  title: "HTML <small>Title</small>!",
			  text: data,
			  html: true
			});
		});
	}

}


