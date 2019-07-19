<div class="container" style="margin-top: 50px;">
        <div class="row">
            <article class="col-sm-12">
                <header>
                    <h3>Business Inteligence</h3>
                    <p>Gerencie e tenha uma visão de todos os dados gerados pela sua empresa.</p>
                </header>
                <div class="chart-wrapper">
                <form class="form-inline" align="center">
                  <div class="form-group">
                    <label for="exampleInputName2">Data Inicial</label>
                    <input id="dataInicial" type="date" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail2">Data Final</label>
                    <input id="dataFinal"  type="date" class="form-control">
                  </div>
                   <button id="gerar-grafico" type="button" class="btn btn-default" style="background: #385A7B;color: white;border:none;">Gerar Gráficos <small class="glyphicon glyphicon-signal" ></small></button>
                </form> 
                </hr>
                 </br>
                  <!--aqui é onde listará os relatórios-->
                  <div class="chart-wrapper">
                    <h3 class="text-center" id="limpatxt">INFORME A DATA INICIAL E FINAL AO QUAL DESEJA RESULTADOS.</h3>
                    <section class="row">
                        <div class="col-sm-6">
                          <div id="canvas-holder">
                              <canvas id="chart-area" />
                          </div>           
                        </div>
                        <div class="col-sm-6">
                          <div id="canvas-holder">
                              <canvas id="chart-area2" />
                          </div>           
                        </div>
                    </section>
                  </div>
                </div>

					
               
                  
                
                <footer>
                    <p class="text-center">&copy; Costs</p>
                </footer>
            </article>
        </div>
</div>
<script type="text/javascript">
var n=document.getElementById("gerar-grafico").addEventListener("click",function(){
        chart();
        chart2();
        $("#limpatxt").empty();
});

function pegaDadosChart(){
	var dtaInicial = $("#dataInicial").val();
	var dtaFinal = $("#dataFinal").val();
	$.ajax({
		method: "POST",
		url: "ajax/bi/totalUsuarios.php",
		data: {dataInicial:dtaInicial, dataFinal: dtaFinal},
		dataType: "json",
		success:function(data){
			console.log(data);
		},
		error: function(data){
			console.log(data);
		}
	});
}


function chart(){
		pegaDadosChart();
        var ctx = document.getElementById("chart-area").getContext("2d");
        window.myDoughnut = new Chart(ctx, config);
}
function chart2(){
        var ctx = document.getElementById("chart-area2").getContext("2d");
        window.myDoughnut = new Chart(ctx, config2);
}
	var config = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [

                	12, 19, 3, 2
                ],
                backgroundColor: [
                <?php
	            		$read = new Read();
	            		$read->ExeRead('categorias',"ORDER BY nome_cat");
	            		$read->getResult();
	            		foreach ($read->getResult() as $categorias) {?>
	            			"rgba(255, 99, 132, 0.8)",
            		<?php 
            			}
            		?>
                ],
                label: 'Dataset 1'
            }],
            labels: [
            		<?php
	            		$read = new Read();
	            		$read->ExeRead('categorias',"ORDER BY nome_cat");
	            		$read->getResult();
	            		foreach ($read->getResult() as $categorias) {?>
	            			"<?=$categorias['nome_cat'];?>",
            		<?php 
            			}
            		?>

            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Total Categoria'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };

    // charts dois
    var config2 = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [200.80, 350.20, 30.56, 500, 122.00],
                backgroundColor: [
                	<?php
	            		$read = new Read();
	            		$read->ExeRead('usuarios',"ORDER BY user_id");
	            		$read->getResult();
	            		$rg = 255;
	            		foreach ($read->getResult() as $categorias) {?>
	            			"rgba(<?=$rg+=10;?>, 99, 132, 0.8)",
            		<?php 
            			}
            		?>
                ],
                label: 'Dataset 2'
            }],
            labels: [
                    <?php
	            		$read = new Read();
	            		$read->ExeRead('usuarios',"ORDER BY user_id");
	            		$read->getResult();
	            		foreach ($read->getResult() as $categorias) {?>
	            			"<?=$categorias['user_name'];?>",
            		<?php 
            			}
            		?>
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Total Coordenadores'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };

</script>

