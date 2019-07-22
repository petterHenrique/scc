	<?php 

	$usuarioLogado = $_SESSION['usuarioLogado'];

	$administrador = $usuarioLogado->NIVEL_USUARIO == 1 ? true : false;

	?>
	<style>
		.navbar-brand{
			background:none!important;
		}
		li.nav-item a{
			color:#01376f!important;
			font-size:16px!important;
		}
		li.nav-item a:hover li{
			margin-left:10px!important;
		}
	</style>
	<nav class="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"> 
      	<img style="width:130px;" src="<?=base_url()?>assets/img/logo.svg" class="img-fluid"/>
      </a>
      
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Sair</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav style="margin-top:20px;" class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="<?=base_url()?>index.php/home/">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(atual)</span>
                </a>
              </li>

              <?php
              if($administrador){
              ?>
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>index.php/gerenciador/cargos">
                  <span data-feather="shopping-cart"></span>
                  Cargos
                </a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>index.php/gerenciador/categorias">
                  <span data-feather="shopping-cart"></span>
                  Categorias
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>index.php/gerenciador/Centrocusto">
                  <span data-feather="bar-chart-2"></span>
                  Centro Custo
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>index.php/gerenciador/usuarios">
                  <span data-feather="users"></span>
                  Usuários
                </a>
              </li>
              <?php 
          		}
              ?>
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>index.php/gerenciador/lancamentos">
                  <span data-feather="users"></span>
                  Lançamentos de Despesas
                </a>
              </li>
              <?php
              if($administrador){
              ?>
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>index.php/gerenciador/relatorios">
                  <span data-feather="users"></span>
                  Relatórios
                </a>
              </li>
              <?php 
          		}
              ?>
            </ul>

           
          </div>
        </nav>