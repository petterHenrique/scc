<div class="container" style="margin-top: 50px;">

        <div class="row">

            <article class="col-sm-12 col-md-12 col-xs-12">

                <header>

                    <h3>Relatório de Lançamentos</h3>

                    <p>Obtenha todos os dados lançados pelos seus funcionários.</p>

                </header>

                <div class="chart-wrapper">

					<div class="row">

						<form class="form-inline" align="center">

                  <div class="form-group col-xs-12 col-md-4 col-sm-4">

                    <label for="Categoria">Categorias Lançamento</label></br>

					<select style="color:black;" id="categoria-relatorio" class="form-control chosen-select" tabindex="-1" data-placeholder="Pesquise por Categoria" >

							<?php

								$lercategorias=new Read; 

								$lercategorias->ExeRead('categorias','');

								$lercategorias->getResult();

								foreach($lercategorias->getResult() as $dados){

							?>

							<option><?=$dados["nome_cat"];?></option>

							<?php

								}

							?>

					</select>

                  </div>

				  <div class="form-group col-xs-12 col-md-4 col-sm-4">

                    <label for="Categoria">Funcionários</label></br>

					<select  id="funcionario-relatorio" class="form-control chosen-select" data-placeholder="Pesquise por Funcionários" >

							<?php

								$lercategorias=new Read;

								$lercategorias->ExeRead('usuarios','');

								$lercategorias->getResult();

								foreach($lercategorias->getResult() as $dados){

							?>

							<option><?=$dados["user_name"];?></option>

							<?php

								}

							?>

					</select>

                  </div>

				  <div class="form-group col-xs-12 col-md-4 col-sm-4">

                    <label for="Categoria">Mês Referência</label></br>

					<select  id="mes-ref" class="form-control chosen-select" data-placeholder="Pesquise por Funcionários" >

							<?php

								$lercategorias=new Read;

								$lercategorias->ExeRead('mesref','');

								$lercategorias->getResult();

								foreach($lercategorias->getResult() as $dados){

							?>

							<option><?=$dados["nome"];?></option>

							<?php

								}

							?>

					</select>

                  </div>

				  <div class="form-group col-xs-12 col-md-12 col-sm-12">

				  </br>

                    <button id="gerar-relatorio-lancamentos" type="button" class="btn btn-default" style="background: #385A7B;color: white;border:none;">Gerar Relatório <small class="glyphicon glyphicon-signal" ></small></button>

                  </div>

                </form> 

					</div>

                </hr>

                 </br>

                  <!--aqui é onde listará os relatórios-->

                  <div class="chart-wrapper"  style="overflow-x: scroll;">

                    <h3 class="text-center" id="loadingRelatorio"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></h3>

                    <section class="row">
                        <div class="col-sm-12 col-xs-12 col-md-12">
                            <table id="listTable" class="table" >

								   <!--busca pelo javascript automaticamente-->

							</table>

                        </div>

                    </section>
                  </div>
                  <button class="btn btn-default" onclick="Imprimir()"><span class="glyphicon glyphicon-print"> 
                  </span> Imprimir</button>
                </div>
                <footer>
                    <p class="text-center">&copy; Costs</p>
                </footer>
            </article>
        </div>
</div>



