   <?php
	//armazena o id do usuário logado
	$idUsuario=$userlogin['user_id'];
	//armazena o id do usuário logado
   ?>

   <div class="container" style="margin-top: 50px;">
            <div class="col-sm-12 col-md-12 col-sx-12">
                <div class="chart-wrapper">
                  <div class="chart-title">
                      Listagem de Lançamentos Mensais 
                  </div>
				  <div class="row" style="padding:10px;">
						<div class="col-sm-8 col-sm-12 col-md-8">
							<input class="form-control hidden"  placeholder="Pesquise pelo Nome da Categoria" id="buscardados"/>
						</div>
						<div class="col-sm-4 col-sm-12 col-md-4">
							<div class="chart-title" style="border: none;">
								<button data-toggle="modal" data-target="#cadLancamento" class="btn btn-success pull-right">Adicionar +</button>
							</div>
							<div class="chart-title" style="border: none;">
								<button style="margin-top:-11px;margin-right:5px;" class="btn btn-primary pull-right buscarbotao">Pesquisar</button>
							</div>
							
						</div>						
				  </div>
				  <div style="overflow-x:scroll;">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Nome Despesa</th>
                        <th>Valor Despesa</th>
                        <th>Categoria</th>
                        <th>Data Lançamento</th>
                        <th>Mês Referência</th>
						<th>Imagem</th>
                        <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php 
						//busca por paginação
						 $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
                         $pager = new Pager('painelvendedor.php?exe=lancamentos/index&page=', '<<', '>>', 2);
                         $pager->ExePager($getPage, 10);
						//efeuta inner join
						$buscaDadosLancamentos= new Read;
						$buscaDadosLancamentos->FullRead("SELECT d.cod_des,d.nome_des,d.valor_des, d.cat_nome,d.data_des, d.mes_ref as referenciames, a.cam_anexo,a.cod_despesa FROM despesas d INNER JOIN despesas_anexo a ON d.cod_des=a.cod_despesa WHERE d.cod_user=:idUsuario LIMIT :limit OFFSET :offset","idUsuario=".$idUsuario."&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
						if ($buscaDadosLancamentos->getResult()){
						foreach($buscaDadosLancamentos->getResult() as $dadoslan){
						//$buscaAnexo->FullRead("SELECT cam_anexo FROM despesas_anexo WHERE cod_despesa =:idreferencia","idreferencia=".$idreferencia);
					?>
                      <tr>
                        <td><?=$dadoslan["nome_des"];?></td>
						<td>R$:<?=$dadoslan["valor_des"];?></td>
						<td><?=$dadoslan["cat_nome"];?></td>
						<td><?=date('d/m/Y',strtotime($dadoslan["data_des"]));?></td>
						<td><?=$dadoslan["referenciames"];?></td>
						<td class="text-center">
						<a style="color:green;" href="<?='ajax_vendedor/uploads/'.$dadoslan["cam_anexo"];?>" target="_blank">	
							<span style="color:green;" class="glyphicon glyphicon-paperclip"></span>
						</a>
						</td>
						<td class="text-center">
							<a href="#" class="label label-danger" onclick="deletaLancamento(<?=$dadoslan["cod_des"];?>);">
								<span class="glyphicon glyphicon-remove-sign"></span>
							</a>
						</td>
                      </tr>
					  <?php
							}
						}
						else{
							 $pager->ReturnPage();
						}
					  ?>
                    </tbody>
                  </table>
                  </div>
				  <?php
                      $pager->ExePaginator('despesas');
                      echo $pager->getPaginator();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!--modal cadastrp de lançamentos-->
    <div id="cadLancamento" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Lançamentos</h4>
          </div>
          <div class="modal-body">
            <form id="form-lancamento" >         
              <div class="form-group">
                <label for="nome-despesa">Nome Despesa:</label>
                <input type="text" class="form-control" id="nome_despesa" name="nome_despesa" >
              </div>
              <div class="form-group">
                <label for="valor-despesa">Valor Despesa:</label>
                <input type="text" class="form-control" id="valor_despesa" name="valor_despesa" > 
              </div>
			  <!--campo novo-->
			  <div class="form-group hidden">
                <input type="hidden" value="<?=$userlogin['centrocusto'];?>" class="form-control" id="centro_custo" name="centro_custo" > 
              </div>
              <div class="form-group">
                <label for="nome-despesa">Categoria:</label>
                <select class="form-control" id="nome_categoria" name="nome_categoria">
                  <?php
                    $read=new Read;
                    $read->ExeRead('categorias');
                    $read->getResult();
                    foreach ($read->getResult() as $cat) { ?>
                    <option><?=$cat['nome_cat'];?></option>
                  <?php
                      }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="nome-despesa">Mês de Referência:</label>
                <select class="form-control" id="mes_referencia" name="mes_referencia">
				  <?php
                    $read=new Read;
                    $read->ExeRead('mesref');
                    $read->getResult();
                    foreach ($read->getResult() as $cat) { ?>
                    <option><?=$cat['nome'];?></option>
                  <?php
                      }
                  ?>
                </select>
              </div>
			  <div class="form-group">
                <label for="anexo-despesa">Arquivo Foto:</label>
                <input class="form-control" type="file" name="arquivo" id="arquivo">
              </div>	
			  <div class="form-group hidden">
                <label for="valor-despesa">Id Usuário:</label>
                <input type="text" class="form-control" name="usuario_id" id="usuario_id" value="<?= $userlogin['user_id']; ?>">
              </div>
			  <div class="form-group hidden">
                <label for="valor-despesa">Nome Usuário:</label>
                <input type="text" class="form-control" name="usuario_name" id="usuario_name" value="<?= $userlogin['user_name']; ?>">
              </div>
              <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          </div>
        </div>

      </div>
    </div>
	
	
	<!---MODAL RESPONSÁVEL POR MOSTRAR O LOADING-->
	<!-- Modal -->
  <div class="modal fade" id="modalLoading" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
				<h3 class="text-center">Aguarde Processando...</h3>
        </div>
      </div>
    </div>
  </div>
</div>