<div class="container" style="margin-top: 50px;">

        <div class="row">

            <article class="col-sm-12 col-md-12 col-xs-12">

                <header>

                    <h3>Cadastro de mês de referência</h3>

                    <p>Siga o seguinte padrão (mês + / + ano) para que o sistema possa entender. OBS: sem espaços.</p>

                </header>

                <div class="chart-wrapper">

					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#cadreferencia">Cadastrar</button>

					<table class="table table-condensed" id="heheteste">

						<thead>

							<tr>

								<td>Id</td>

								<td>Nome</td>

								<td>Ações</td>

							</tr>

						</thead>

						<tbody>

						<?php

							$read=new Read;

							$read->ExeRead("mesref","");

							$read->getResult();

							foreach($read->getResult() as $dados){

						?>

							<tr>

								<td><?=$dados["id"];?></td>

								<td><?=$dados["nome"];?></td>

								<td><button class="btn btn-danger" onclick="deletaMesRef(<?=$dados["id"];?>)">Deletar</button>

								<button class="btn btn-primary" onclick="editMesRef(<?=$dados["id"];?>)">Editar</button></td>

							</tr>

							<?php

							}	

							?>

						</tbody>

					</table>

                </div>

                 </br>

                  <!--aqui é onde listará os relatórios-->

                <footer>

                    <p class="text-center">&copy; Costs</p>

                </footer>

            </article>

        </div>

</div>



<!-- Trigger the modal with a button -->

<!-- Modal -->

<div id="cadreferencia" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-body">

			<form id="cadreferencia-form">
			<div class="row">
				<div class="form-group col-xs-12 col-md-12 col-lg-12">

					<label for="nome">Nome:</label>

					<input type="text" name="nome_ref" class="form-control" id="nome-ref" required>

				</div>
				</div>
				 <center>
				<button type="submit" class="btn btn-primary"><span  class="glyphicon glyphicon-floppy-save"></span> Salvar</button>
				<button class="btn btn-default" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Fechar</button>
				</center>
				</form>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

      </div>

    </div>

  </div>

</div>



<!-- Modal edit -->

<div id="cadreferenciaedit" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-body">

			<form id="cadreferencia-form-edit">

				<div class="form-group">

					<label for="nome">Nome:</label>

					<input type="text" name="nome-refe" class="form-control" id="nome-ref-edit2" required>

				</div>

				<div class="form-group hidden">

					<label for="nome">Id:</label>

					<input type="text" name="nome-refe" class="form-control" id="id2" required>

				</div>
				<center>
				<button type="button" class="btn btn-primary" onclick="editMesRefOk()"><span  class="glyphicon glyphicon-floppy-save"></span> Salvar</button>
				<button class="btn btn-default" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Fechar</button>
				</center>
			</form>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

      </div>

    </div>

  </div>

</div>



