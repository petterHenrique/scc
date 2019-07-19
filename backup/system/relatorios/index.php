<div class="container" style="margin-top: 50px;">
        <div class="row">
            <article class="col-sm-12 col-md-12 col-xs-12">
                <header>
                    <h3>Relatórios Gerais</h3>
                </header>
                <div class="chart-wrapper">
					<div class="row">
						<div class="col-sm-3 col-xs-12 col-md-3">
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
						<div class="col-sm-3 col-xs-12 col-md-3">
						    <button class="btn btn-primary">Relatório total por Vendedor</button>
						</div>
						<div class="col-sm-3 col-xs-12 col-md-3">
							<button class="btn btn-primary">Relatório total por Vendedor</button>
						</div>
						<div class="col-sm-3 col-xs-12 col-md-3">
							<button class="btn btn-primary">Relatório total por Vendedor</button>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-12 col-xs-12 col-md-12">
							<table class="table">
								<thead>
									<tr>
										<td>Nome</td>
										<td>C/C</td>
										<td>Total</td>
									</tr>
								</thead>
								<tbody>
								
								</tbody>
							</table>
						</div>
					</div>
					<hr>
                </div>
                <footer>
                    <p class="text-center">&copy; Costs</p>
                </footer>
            </article>
        </div>
</div>

