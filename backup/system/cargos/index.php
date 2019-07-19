<div class="container" style="margin-top: 50px;">
        <div class="row">
            <article class="col-sm-12">
                <header>
                    <h3>Gerenciamento de Cargos</h3>
                </header>
                <div class="chart-wrapper">
                <button data-toggle="modal" data-target="#modal-cad-cargo" class="btn btn-default" style="background: #385A7B;color: white;border:none;">Adicionar <small class="glyphicon glyphicon-plus"></small></button>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
                      $pager = new Pager('painel.php?exe=cargos/index&page=', '<<', '>>', 3);
                      $pager->ExePager($getPage, 5);

                      $readUsers = new Read;
                      $readUsers->ExeRead('cargos', "LIMIT :limit OFFSET :offset", "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                      if ($readUsers->getResult()):
                            foreach ($readUsers->getResult() as $usuarios):
                                ?>
                                <tr>
                                    <td><?=$usuarios['cargo_id']; ?></td>
                                    <td><?=$usuarios['nome_cargo']; ?></td>
                                    <td><button data-toggle="modal" data-target="#modal-editar-usuario" onclick="levaCodigo(<?=$usuarios['cargo_id'];?>)" class="btn btn-primary">Editar</button><button onclick="deletarCargo(<?=$usuarios['cargo_id'];?>)" class="btn btn-danger">Excluir</button></td>
                                </tr>
                                <?php
                            endforeach;
                        else:
                            $pager->ReturnPage();
                        endif;
                        ?>
                    </tbody>
                  </table>
                </div>
                    <?php
                      $pager->ExePaginator('cargos');
                      echo $pager->getPaginator();
                    ?>
                <footer>
                    <p class="text-center">&copy; Costs</p>
                </footer>
            </article>
        </div>
</div>

<!-- Modal Cad Cargo -->
<div id="modal-cad-cargo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal Cadastrar-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cadastrar Cargo</h4>
      </div>
      <div class="modal-body">
      <div id="mostra">
        
      </div>
            <form id="form-cadastro-cargos">
              <div class="row"> 
				<div class="form-group col-sm-12 col-xs-12 col-md-12">
                <label for="nome">Nome:</label>
                <input autocomplete="off" type="text" class="form-control" id="input-cargo-nome" name="nomecargo" 
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Nome Cargo corretamente!"/>
              </div>  
              </div>	
              
            </form>
			<center>
			<button class="btn btn-primary" onclick="validaCargo()"><span  class="glyphicon glyphicon-floppy-save"></span> Salvar</button>
			<button class="btn btn-default" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Fechar</button>
			</center>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
