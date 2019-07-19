    <div class="container" style="margin-top: 50px;">
            <div class="col-sm-12 col-md-12 col-sx-12">
                <div class="chart-wrapper">
                  <div class="chart-title">
                      Últimos Lançamentos
                  </div>
                  <!--gráfico do relatório-->
                  <div> 
                  <?php
                  	$read = new Read();
                  	$read->ExeRead("despesas","WHERE cod_user=:codUser","codUser=".$userlogin['user_id']);
                  	$read->getResult();
                  	foreach ($read->getResult() as $valor) {?>
                  	<ul class="list-group">
					  <li class="list-group-item text-center"><h4><?=$valor["nome_des"];?> || <?=$valor["cat_nome"];?></h4></li>
					</ul>
                  	<?php 
                  	}
                  	?>
                  </div>
                </div>
            </div>
        </div>
    </div>