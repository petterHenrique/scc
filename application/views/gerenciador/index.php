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
    <script src="<?=base_url()?>assets/js/awesome.js"></script>
  </head>

  <body>
    	
    	<?php 
    		$this->load->view("/gerenciador/inc/nav.php");
    	?>

        <main style="margin-top:20px;" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <h2>Gastos Período Anual</h2>
          <div class="table-responsive">
            <canvas id="myChart" width="200" height="100"></canvas>
          </div>
        </main>
      </div>
    </div>

    <!-- Principal JavaScript do Bootstrap
    ================================================== -->
    <!-- Foi colocado no final para a página carregar mais rápido -->
    <script src="<?=base_url()?>assets/js/jquery3-4-1.js"></script>
	<script src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>
	<script src="<?=base_url()?>assets/js/Chart.min.js"></script>
	<script>
		$(() => {
			inicializaGrafico();
		});

		function inicializaGrafico(){

			$.get("<?=base_url()?>index.php/gerenciador/dashboard/graficohome", {}, function(data){

				console.log(data);
			},'json');


			var ctx = document.getElementById('myChart').getContext('2d');
			var myChart = new Chart(ctx, {
			    type: 'bar',
			    data: {
			        labels: ['Janeiro', 'Fevereiro', 'Yellow', 'Green', 'Purple', 'Orange'],
			        datasets: [{
			            label: 'Gastos Anuais',
			            data: [12, 19, 3, 5, 2, 3],
			            backgroundColor: [
			                'rgba(255, 99, 132, 0.2)',
			                'rgba(54, 162, 235, 0.2)',
			                'rgba(255, 206, 86, 0.2)',
			                'rgba(75, 192, 192, 0.2)',
			                'rgba(153, 102, 255, 0.2)',
			                'rgba(255, 159, 64, 0.2)'
			            ],
			            borderColor: [
			                'rgba(255, 99, 132, 1)',
			                'rgba(54, 162, 235, 1)',
			                'rgba(255, 206, 86, 1)',
			                'rgba(75, 192, 192, 1)',
			                'rgba(153, 102, 255, 1)',
			                'rgba(255, 159, 64, 1)'
			            ],
			            borderWidth: 1
			        }]
			    },
			    options: {
			        scales: {
			            yAxes: [{
			                ticks: {
			                    beginAtZero: true
			                }
			            }]
			        }
			    }
			});
		}
	</script>
  </body>
</html>
