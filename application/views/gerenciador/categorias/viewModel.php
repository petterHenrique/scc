<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="table-responsive">
<table class="table">
  <thead>
    <tr>
      <th>Descrição</th>
      <th>Limite Gasto</th>
      <th>Conta Contábil</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
  	<?php 
  	foreach ($categorias as $categoria) { 
  	?>
		<tr class="item" data-codigo="<?=$categoria->COD_CATEGORIA;?>">
      <td><?=$categoria->DES_CATEGORIA;?></td>
      <td><span style="font-size:13px;" class="badge badge-success">R$ <?=number_format((float)$categoria->LIMITE_GASTO, 2, ',', '');?></span></td>
      <td><?=$categoria->CONTA_CONTABIL;?></td>
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