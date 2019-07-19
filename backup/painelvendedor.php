<?php
ob_start();
session_start();
require('_app/Config.inc.php');

$login = new Login(1);
$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);
$getexe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);

if (!$login->CheckLogin()):
    unset($_SESSION['userlogin']);
    header('Location: loginvendedor.php?exe=restrito');
else:
    $userlogin = $_SESSION['userlogin'];
endif;

if ($logoff):
    unset($_SESSION['userlogin']);
    header('Location: loginvendedor.php?exe=logoff');
endif;


?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Costs Gerenciamento de Contas</title>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
        <link rel="stylesheet" type="text/css" href="_cdn/css/style.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
		<!--tag verifica mobile-->
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<!--não indexa página-->
		<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
  </head>
  <style type="text/css">
    body{
      background: #f2f2f2;
    }
    a{
      color: white!important;
    }
    /*efeito*/
    .hvr-underline-from-left {
      display: inline-block;
      vertical-align: middle;
      -webkit-transform: perspective(1px) translateZ(0);
      transform: perspective(1px) translateZ(0);
      box-shadow: 0 0 1px transparent;
      position: relative;
      overflow: hidden;
    }
    .hvr-underline-from-left:before {
      content: "";
      position: absolute;
      z-index: -1;
      left: 0;
      right: 100%;
      bottom: 0;
      background: white;
      height: 2px;
      -webkit-transition-property: right;
      transition-property: right;
      -webkit-transition-duration: 0.3s;
      transition-duration: 0.3s;
      -webkit-transition-timing-function: ease-out;
      transition-timing-function: ease-out;
    }
    .hvr-underline-from-left:hover:before, .hvr-underline-from-left:focus:before, .hvr-underline-from-left:active:before {
      right: 0;
    }
    .chart-wrapper {
        background: #fff;
        border: 1px solid #e2e2e2;
        border-radius: 3px;
        margin-bottom: 10px;
        padding: 10px;
    }
    .chart-wrapper .chart-title {
        border-bottom: 1px solid #d7d7d7;
        color: #666;
        font-size: 14px;
        font-weight: 200;
        padding: 7px 10px 4px;
    }
    .navbar-nav li a{
      font-family: 'Raleway', sans-serif;
    }
  </style>
    <body>
         <!--menu-->
        <nav class="navbar navbar-fixed-top navbar-inverse" style="background: #3d4a57;">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" style="color: white;" href="painelvendedor.php">CO&#36;TS</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="hvr-underline-from-left"><a style="color: white;" href="painelvendedor.php?exe=lancamentos/index">Lançamentos</a></li>
                <li class="hvr-underline-from-left">
                <a style="color: white;" href="painelvendedor.php?logoff=true"><span style="color: white;" class="glyphicon glyphicon-off"></span></a>
                </li>
              </ul>
            </div><!-- /.nav-collapse -->
          </div><!-- /.container -->
        </nav><!-- /.navbar -->
        <!--fim menu-->
        </br>
    <!--painel dashboard-->
     <?php
            //QUERY STRING
            if (!empty($getexe)):
                $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'systemvendedor' . DIRECTORY_SEPARATOR . strip_tags(trim($getexe) . '.php');
            else:
                $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'systemvendedor' . DIRECTORY_SEPARATOR . 'home.php';
            endif;

            if (file_exists($includepatch)):
                require_once($includepatch);
            else:
                echo "<div class=\"content notfound\">";
                WSErro("<b>Erro ao incluir tela:</b> Erro ao incluir o controller /{$getexe}.php!", WS_ERROR);
                echo "</div>";
            endif;
    ?>
  <!--fim painel dashboard-->
  </body>
  <!--JS-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js">
  </script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="_cdn/js/jmask.js"></script>
   <!--funcionalidades-->
  <script type="text/javascript" src="_cdn/jsv/lancamentos.js"></script>
  <script type="text/javascript" src="_cdn/jsv/excluirLancamento.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <script>
  $(function(){
		MontaGrafico();
  });
  	function MontaGrafico(){
<?php

$read  = new Read();
$read->FullRead("SELECT * FROM v_relatorio_vendedor_home");
$read->getResult();
$dados=$read->getResult();

$janeiro = 0;
$fevereiro = 0;
$marco = 0;
$abril = 0;
$maio = 0;
$junho =0;
$julho =0;
$agosto =0;
$setembro =0;
$outubro =0;
$novembro =0;
$dezembro =0;

foreach ($dados as $valores) {
	if($valores["MES"] == "January"){
		$janeiro = (int)$valores["VALOR"];
	}
	if($valores["MES"] == "February"){
		$fevereiro = (int)$valores["VALOR"];
	}
	if($valores["MES"] == "March"){
		$marco = (int)$valores["VALOR"];
	}
	if($valores["MES"] == "April"){
		$abril = (int)$valores["VALOR"];
	}
	if($valores["MES"] == "May"){
		$maio = (int)$valores["VALOR"];
	}
	if($valores["MES"] == "June"){
		$junho = (int)$valores["VALOR"];
	}
	if($valores["MES"] == "July"){
		$julho = (int)$valores["VALOR"];
	}
	if($valores["MES"] == "August"){
		$agosto = (int)$valores["VALOR"];
	}
	if($valores["MES"] == "September"){
		$setembro = (int)$valores["VALOR"];
	}
	if($valores["MES"] == "October"){
		$outubro = (int)$valores["VALOR"];
	}
	if($valores["MES"] == "November"){
		$novembro = (int)$valores["VALOR"];
	}
	if($valores["MES"] == "December"){
		$dezembro = (int)$valores["VALOR"];
	}
}
?>


new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
    { mouth: '1', value: <?=$janeiro;?> },
    { mouth: '2', value: <?=$fevereiro;?> },
    { mouth: '3', value: <?=$marco;?>},
    { mouth: '4', value: <?=$abril;?> },
    { mouth: '5', value: <?=$maio;?> },
    { mouth: '6', value: <?=$junho;?> },
    { mouth: '7', value: <?=$julho;?> },
    { mouth: '8', value: <?=$agosto;?> },
    { mouth: '9', value: <?=$setembro;?> },
    { mouth: '10', value:<?=$outubro;?> },
    { mouth: '11', value: <?=$novembro;?> },
    { mouth: '12', value: <?=$dezembro;?> }
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'mouth',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value']
});






}
</script>
  <!--JS-->
 
</html>
<?php
ob_end_flush();
