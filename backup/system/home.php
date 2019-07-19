
<
<div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-sm-3 col-md-3 col-sx-3 text-center">
                <div class="chart-wrapper h" onclick="window.location.href='painel.php?exe=usuarios/index'">
                  <div class="chart-title">
                      Usuários
                  </div>
                  <h2>
                    <?php
                    echo $categorias = Contadores::setUsuarios();
                    ?>
                  </h2>
                </div>
            </div>
            <div class="col-sm-3 col-md-3 col-sx-3 text-center">
                <div class="chart-wrapper h" onclick="window.location.href='painel.php?exe=categorias/index'">
                  <div class="chart-title">
                      Categorias
                  </div>
                  <h2>
                  <?php
                    echo $categorias = Contadores::setCategorias();
                  ?>
                </h2>
                </div>
            </div>
            <div class="col-sm-3 col-md-3 col-sx-3 text-center">
                <div class="chart-wrapper h" onclick="window.location.href='painel.php?exe=cargos/index'">
                  <div class="chart-title">
                      Cargos
                  </div>
                  <h2>
                    <?php
                    echo $categorias = Contadores::setCargos();
                    ?>
                  </h2>
                </div>
            </div>
            <div class="col-sm-3 col-md-3 col-sx-3 text-center">
                <div class="chart-wrapper h" onclick="window.location.href='painel.php?exe=centrocusto/index'">
                  <div class="chart-title">
                      Centro de Custos
                  </div>
                  <h2>
                    <?php
                    echo $categorias = Contadores::setCentroCusto();
                    ?>
                  </h2>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-sx-12">
                <div class="chart-wrapper h">
                  <div class="chart-title">
                      Relatório de Gastos Mensais
                  </div>
                  <!--gráfico do relatório-->
                  <div id="myfirstchart" style="height: 250px;"></div>
                </div>
            </div>
        </div>
    </div>