<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="table-responsive">
<table class="table">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Nível Acesso</th>
                  <th>Ativo</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
              	<?php 
              	foreach ($usuarios as $usuario) { 
              	?>
          		<tr class="item" data-codigo="<?=$usuario->COD_USUARIO;?>">
                  <td><?=$usuario->DES_USUARIO;?></td>
                  <td><?=$usuario->EMAIL_USUARIO;?></td>
                  <td> 
                  <?php

                  	if($usuario->NIVEL_USUARIO == 1){
                  ?>
                  	<span class="badge badge-primary">Administrador</span>
                  <?php
                  	}else{
                  ?>
                  	<span class="badge badge-info">Usuário Comum</span>
                  <?php	 
              		}
                  ?>
                  </td>
                  <td><?=(boolean)$usuario->TIP_ATIVO == true ? "<b class='badge badge-success'>Ativo</b>" : "<b class='badge badge-danger'>Inativo</b>";?></td>
                  <td> 
                  	<span class="editar" style="cursor:pointer;"> 
                  		<i class="far fa-lg fa-edit text-primary"></i>
                  	</span> 
                  	<span class="excluir" style="cursor:pointer;"> 
                  		<i class="far fa-lg fa-trash-alt text-danger"></i>
                  	</span>
                  </td>
                </tr>
              	<?php 
              		}
              	?>
              </tbody>
            </table>
</div>