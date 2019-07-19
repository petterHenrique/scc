<div class="container" style="margin-top: 50px;">
        <div class="row">
            <article class="col-sm-12">
                <header>
                    <h3>Gerenciamento de Centro de Custo</h3>
                </header>
                <div class="chart-wrapper">
                <button data-toggle="modal" data-target="#modal-cad-centrocusto" class="btn btn-default" style="background: #385A7B;color: white;border:none;">Adicionar <small class="glyphicon glyphicon-plus"></small></button>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Código</th>
                        <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
                      $pager = new Pager('painel.php?exe=centrocusto/index&page=', '<<', '>>', 3);
                      $pager->ExePager($getPage, 5);

                      $readUsers = new Read;
                      $readUsers->ExeRead('centrocusto', "LIMIT :limit OFFSET :offset", "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                      if ($readUsers->getResult()):
                            foreach ($readUsers->getResult() as $usuarios):
                                ?>
                                <tr>
                                    <td><?=$usuarios['id_cent']; ?></td>
                                    <td><?=$usuarios['nome_cent']; ?></td>
                                    <td><?=$usuarios['cod_cent']; ?></td>
                                    <td><button data-toggle="modal" data-target="#modal-editar-centrocusto" onclick="levaCentrocusto(<?=$usuarios['id_cent'];?>)" class="btn btn-primary">Editar</button><button onclick="deletarCentrocusto(<?=$usuarios['id_cent'];?>)" class="btn btn-danger">Excluir</button></td>
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
                      $pager->ExePaginator('centrocusto');
                      echo $pager->getPaginator();
                    ?>
                <footer>
                    <p class="text-center">&copy; Costs</p>
                </footer>
            </article>
        </div>
</div>

<!-- Modal Cad centrocusto -->
<div id="modal-cad-centrocusto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal Cadastrar-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cadastrar Centro de Custo</h4>
      </div>
      <div class="modal-body">
            <form id="form-cadastro-categorias">
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="nome">Nome:</label>
                <input autocomplete="off" type="text" class="form-control" id="input-centrocusto-nome"  
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Nome corretamente!"/>
              </div>  
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="nome">Código:</label>
                <input autocomplete="off" type="text" class="form-control" id="input-centrocusto-codigo"  
                data-toggle="tooltip" onkeypress='return SomenteNumero(event)' value="" data-placement="top" title="Preencha o campo Código (Somente Números)"/>
              </div>   
            </form>
      </div>
      <div class="modal-footer">
      <center>
			<button class="btn btn-primary" onclick="validaCentrocusto()"><span  class="glyphicon glyphicon-floppy-save"></span> Salvar</button>
			<button class="btn btn-default" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Fechar</button>
			</center>
      </div>
    </div>

  </div>
</div>

<!-- Modal Edit Cargo -->
<div id="modal-editar-centrocusto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal Cadastrar-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Centro de Custo</h4>
      </div>
      <div class="modal-body">
      <div id="mostra">
        
      </div>
            <form id="form-cadastro-categorias">
              <div class="form-group col-sm-6 col-xs-12 col-md-6 hidden">
                <label for="nome">Id:</label>
                <input autocomplete="off" type="text" class="form-control" id="input-centrocusto-id-edit"  
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Nome corretamente!"/>
              </div>  
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="nome">Nome:</label>
                <input autocomplete="off" type="text" class="form-control" id="input-centrocusto-nome-edit"  
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Nome corretamente!"/>
              </div>  
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="nome">Código:</label>
                <input autocomplete="off" type="text" class="form-control" id="input-centrocusto-codigo-edit"  
                data-toggle="tooltip" onkeypress='return SomenteNumero(event)' value="" data-placement="top" title="Preencha o campo Código (Somente Números)"/>
              </div>
              <center>
			<button type="button" class="btn btn-primary" onclick="editarCentroCusto()"><span  class="glyphicon glyphicon-floppy-save"></span> Salvar</button>
			<button class="btn btn-default" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Fechar</button>
			</center>   
            </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
