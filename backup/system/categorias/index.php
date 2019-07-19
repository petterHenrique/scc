<div class="container" style="margin-top: 50px;">
        <div class="row">
            <article class="col-sm-12">
                <header>
                    <h3>Gerenciamento de Categorias</h3>
                </header>
                <div class="chart-wrapper" style="overflow-x: scroll;">
                <button data-toggle="modal" data-target="#modal-cad-categorias" class="btn btn-default" style="background: #385A7B;color: white;border:none;">Adicionar <small class="glyphicon glyphicon-plus"></small></button>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Conta Contábil</th>
                        <th>Limite Gasto</th>
                        <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
                      $pager = new Pager('painel.php?exe=categorias/index&page=', '<<', '>>', 3);
                      $pager->ExePager($getPage, 5);

                      $readUsers = new Read;
                      $readUsers->ExeRead('categorias', "LIMIT :limit OFFSET :offset", "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                      if ($readUsers->getResult()):
                            foreach ($readUsers->getResult() as $usuarios):
                                ?>
                                <tr>
                                    <td><?=$usuarios['id_cat']; ?></td>
                                    <td><?=$usuarios['nome_cat']; ?></td>
                                    <td><?=$usuarios['cont_cat']; ?></td>
                                    <td><?=$usuarios['limit_cat']; ?></td>
                                    <td><button onclick="levaCategoria(<?=$usuarios['id_cat'];?>)" class="btn btn-primary">Editar</button><button onclick="deletarCategoria(<?=$usuarios['id_cat'];?>)" class="btn btn-danger">Excluir</button></td>
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
                      $pager->ExePaginator('categorias');
                      echo $pager->getPaginator();
                    ?>
                <footer>
                    <p class="text-center">&copy; Costs</p>
                </footer>
            </article>
        </div>
</div>

<!-- Modal Cad Cargo -->
<div id="modal-cad-categorias" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal Cadastrar-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cadastrar Categoria</h4>
      </div>
      <div class="modal-body">
      <div id="mostra">
        
      </div>
            <form id="form-cadastro-categorias">
            <div class="row">
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="nome">Nome:</label>
                <input autocomplete="off" type="text" class="form-control" id="input-categoria-nome"  
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Nome Categoria corretamente!"/>
              </div>  
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="nome">Conta Contábil:</label>
                <input autocomplete="off" type="text" class="form-control" id="input-categoria-conta"  
                data-toggle="tooltip" onkeypress='return SomenteNumero(event)' value="" data-placement="top" title="Preencha o campo Conta Contábil (Somente Números)"/>
              </div>  
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="nome">Limite de Gasto R$:</label>
                <input autocomplete="off" type="text" class="form-control" id="input-categoria-limite" 
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Nome Cargo corretamente!"/>
              </div>  
              
              </div>
            </form>
      </div>
      <div class="modal-footer">
        <div class="form-group">
              <center>
			<button class="btn btn-primary" onclick="validaCategoria()"><span  class="glyphicon glyphicon-floppy-save"></span> Salvar</button>
			<button class="btn btn-default" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Fechar</button>
			</center>
      </div>
    </div>

  </div>
</div>

<!-- Modal Edit Cargo -->
<div id="modalEdit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal Cadastrar-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Categoria</h4>
      </div>
      <div class="modal-body">
      <div id="mostra">
        
      </div>
            <form id="form-cadastro-categorias">
              <div class="form-group col-sm-6 col-xs-12 col-md-6 hidden">
                <label for="nome">ID:</label>
                <input autocomplete="off" value="" class="form-control" id="input-categoria-id-edit"  
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Nome Categoria corretamente!"/>
              </div> 
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="nome">Nome:</label>
                <input autocomplete="off" value="" type="text" class="form-control" id="input-categoria-nome-edit"  
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Nome Categoria corretamente!"/>
              </div>  
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="nome">Conta Contábil:</label>
                <input autocomplete="off" value="" type="text" class="form-control" id="input-categoria-conta-edit"  
                data-toggle="tooltip" onkeypress='return SomenteNumero(event)' value="" data-placement="top" title="Preencha o campo Conta Contábil (Somente Números)"/>
              </div>  
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="nome">Limite de Gasto R$:</label>
                <input autocomplete="off" value="" type="text" class="form-control" id="input-categoria-limite-edit" 
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Nome Cargo corretamente!"/>
              </div>  
              <div class="form-group">
                <button onclick="alteraCategoria()" type="button" class="btn btn-success">Salvar</button>
              </div>
            </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
