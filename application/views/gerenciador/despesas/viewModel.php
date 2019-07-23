<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="table-responsive">
<table class="table">
  <thead>
    <tr>
      <th>Descrição</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
  	<?php 
  	foreach ($cargos as $cargo) { 
  	?>
	<tr class="item"  data-codigo="<?=$cargo->COD_CARGO;?>">
      <td><?=$cargo->DES_CARGO;?></td>
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