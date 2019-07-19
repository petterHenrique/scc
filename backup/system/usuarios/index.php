<div class="container" style="margin-top: 50px;">
        <div class="row">
            <article class="col-sm-12">
                <header>
                    <h3>Gerenciamento de Usuários</h3>
                </header>
                <div class="chart-wrapper" style="overflow-x: scroll;">
                <button data-toggle="modal" data-target="#modal-cadastro-usuario" class="btn btn-default" style="background: #385A7B;color: white;border:none;">Adicionar <small class="glyphicon glyphicon-plus"></small></button>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
                      $pager = new Pager('painel.php?exe=usuarios/index&page=', '<<', '>>', 3);
                      $pager->ExePager($getPage, 5);

                      $readUsers = new Read;
                      $readUsers->ExeRead('usuarios', "ORDER BY user_id DESC LIMIT :limit OFFSET :offset", "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                      if ($readUsers->getResult()):
                            foreach ($readUsers->getResult() as $usuarios):
                                //gambiarra para ver se é usuario
                                $n=$usuarios['user_email'];
                                $button="";
                                 if($n=="admin@admin.com.br"){
                                   $button="hidden";
                                 }else{
                                   $button="button";
                                 }
                                 //gambiarra para ver se é usuario
                                ?>
                                <tr>
                                    <td><?=$usuarios['user_id']; ?></td>
                                    <td><?=$usuarios['user_name']; ?></td>
                                    <td><?=$usuarios['user_email']; ?></td>
                                    <td><button data-toggle="modal" data-target="#modal-editar-usuario" onclick="levaCodigo(<?=$usuarios['user_id'];?>)" class="btn btn-primary <?php echo $button;?>">Editar</button><a onclick="deletarUsuario(<?=$usuarios['user_id'];?>)" class="btn btn-danger <?php echo $button;?>">Excluir</a></td>
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
                      $pager->ExePaginator('usuarios');
                      echo $pager->getPaginator();
                    ?>
                <footer>
                    <p class="text-center">&copy; Costs</p>
                </footer>
            </article>
        </div>
</div>

<!-- Modal Cadastrar -->
<div id="modal-cadastro-usuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal Cadastrar-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cadastrar Usuário</h4>
      </div>
      <div class="modal-body">
      <div id="mostra">
        
      </div>
            <form id="form-cadastro-usuarios">
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="nome">Nome:</label>
                <input autocomplete="off" type="text" class="form-control" id="input-user-nome" name="nome" 
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Nome corretamente!"/>
              </div>  
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="email">E-mail:</label>
                <input autocomplete="off" type="email" onchange="VeriricaEmail(this.value)" class="form-control" id="input-user-email" name="email"
                data-toggle="tooltip" data-placement="top" title="Preencha o campo E-mail corretamente!"/>
              </div>
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="telefone">Telefone:</label>
                <input maxlength="15" onkeypress="mascara(this)" autocomplete="off" type="text" class="form-control" id="input-user-telefone" name="telefone" 
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Telefone corretamente!"/>
              </div>
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="cpf">Cpf:</label>
                <input autocomplete="off" type="text" onchange="VerificaCpf(this.value)" class="form-control" id="input-user-cpf" name="cpf" 
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Cpf corretamente!"/>
              </div>
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="cargo">Cargo:</label>
				<select name="cargo" data-toggle="tooltip" data-placement="top" title="Preencha uma das opções." class="form-control" id="input-user-cargo">
                  <?php
					$ler = new Read;
					$ler->ExeRead("cargos",'ORDER BY cargo_id');
					$ler->getResult();
					foreach($ler->getResult() as $dado){
				  ?>
					<option><?=$dado["nome_cargo"];?></option>
				  <?php
					}
				  ?>
                </select>
 			  </div>
			   <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="cargo">Centro de Custo:</label>
				<select name="centrocusto" id="input-user-centrocusto" class="form-control" tabindex="-1">
                  <?php
					$ler = new Read;
					$ler->ExeRead("centrocusto",'ORDER BY id_cent');
					$ler->getResult();
					foreach($ler->getResult() as $dado){
				  ?>
					<option value="<?=$dado["cod_cent"];?>"><?=$dado["nome_cent"];?></option>
				  <?php
					}
				  ?>
                </select>
 			  </div>
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="senha">Senha:</label>
                <input autocomplete="off" type="password" class="form-control" id="input-user-senha" name="senha" 
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Senha corretamente!"/">
              </div>
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="sel1">Selecione o nível:</label>
                <select name="nivel" data-toggle="tooltip" data-placement="top" title="Preencha uma das opções." class="form-control" id="input-user-nivel">
                  <option>nenhum</option>
                  <option value="3">administrador</option>
                  <option value="1">usuario</option>
                </select>
              </div>
            </form>
			<hr>
			</br>
			</br>
			<center>
			<button class="btn btn-primary" id="cadastrar-usuario"><span  class="glyphicon glyphicon-floppy-save"></span> Salvar</button>
			<button class="btn btn-default" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Fechar</button>
			</center>
      </div>
      <div class="modal-footer">
      </div>
    </div>

  </div>
</div>
<!-- Modal Editar -->
<div id="modal-editar-usuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal Editar-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Usuário</h4>
      </div>
      <div class="modal-body">
            <form id="form-editar-usuarios">
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="nome">Nome:</label>
                <input autocomplete="off" type="text" class="form-control" id="input-user-nome-edit" name="nome" 
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Nome corretamente!"/>
              </div> 
              <div class="form-group col-sm-6 col-xs-12 col-md-6 hidden">
                <label for="nome">Id:</label>
                <input autocomplete="off" type="text" class="form-control" id="input-user-cod-edit" name="id" 
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Nome corretamente!"/>
              </div>  
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="email">E-mail:</label>
                <input autocomplete="off" type="email" onchange="verificaEmail(this.value)" class="form-control" id="input-user-email-edit" name="email"
                data-toggle="tooltip" data-placement="top" title="Preencha o campo E-mail corretamente!"/>
              </div>
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="telefone">Telefone:</label>
                <input autocomplete="off" type="text" class="form-control" id="input-user-telefone-edit" name="telefone" 
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Telefone corretamente!"/>
              </div>
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="cpf">Cpf:</label>
                <input autocomplete="off" type="text" class="form-control" id="input-user-cpf-edit" name="cpf" 
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Cpf corretamente!"/>
              </div>
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="cargo">Cargo:</label>
                <input autocomplete="off" type="text" class="form-control" id="input-user-cargo-edit" name="cargo" 
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Cargo corretamente!"/>
              </div>
			  <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="cargo">Centro de Custo:</label>
				<select name="centrocusto" id="input-user-centrocusto" class="form-control" tabindex="-1">
                  <?php
					$ler = new Read;
					$ler->ExeRead("centrocusto",'ORDER BY id_cent');
					$ler->getResult();
					foreach($ler->getResult() as $dado){
				  ?>
					<option value="<?=$dado["cod_cent"];?>"><?=$dado["nome_cent"];?></option>
				  <?php
					}
				  ?>
                </select>
 			  </div>
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="senha">Senha:</label>
                <input autocomplete="off" type="password" class="form-control" id="input-user-senha-edit" name="senha" 
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Senha corretamente!"/">
              </div>
              <div class="form-group col-sm-6 col-xs-12 col-md-6">
                <label for="nivel">Nível:</label>
                <input autocomplete="off" type="text" class="form-control" id="input-user-nivel-edit" name="nivel" 
                data-toggle="tooltip" data-placement="top" title="Preencha o campo Nível corretamente!"/>
              </div>
              <div class="form-group">
                <button id="editar-usuario" onclick="editarUser()" type="button" class="btn btn-success">Salvar</button>
              </div>
            </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>

