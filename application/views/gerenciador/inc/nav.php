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
      
      <div class="col-md-3">
      	<div class="dropdown">
		  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
		    <?=$_SESSION['usuarioLogado']->DES_USUARIO;?>
		  </button>
		  <div class="dropdown-menu">
		    <a class="dropdown-item" href="#">Configurações</a>
		    <a class="dropdown-item" href="<?=base_url()?>index.php/home/deslogar">Sair</a>
		  </div>
		</div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav style="margin-top:20px;" class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="<?=base_url()?>index.php/home/">
                  <i class="fas fa-tachometer-alt"></i>
                  Dashboard 
                </a>
              </li>

              <?php
              if($administrador){
              ?>
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>index.php/gerenciador/cargos">
                  <i class="fas fa-briefcase"></i>
                  Cargos
                </a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>index.php/gerenciador/categorias">
                  <i class="fas fa-bars"></i>
                  Categorias
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>index.php/gerenciador/Centrocusto">
                  <i class="fas fa-funnel-dollar"></i>
                  Centro Custo
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>index.php/gerenciador/usuarios">
                  <i class="fas fa-user"></i>
                  Usuários
                </a>
              </li>
              <?php 
          		}
              ?>
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>index.php/gerenciador/despesas">
                  &nbsp;<i class="fas fa-dollar-sign"></i>
                  Despesas
                </a>
              </li>
              <?php
              if($administrador){
              ?>
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>index.php/gerenciador/relatorios">
                  <i class="fas fa-chart-line"></i>
                  Relatórios
                </a>
              </li>
              <?php 
          		}
              ?>
            </ul>

           
          </div>
        </nav>