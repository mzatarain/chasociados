<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-8">
            <div class="btn-group">
                <?php
                echo '<a class="btn btn-secondary" href="' . site_url('Portfolio_controller/PortfolioCreate') . '">Agregar cartera</a>';
                echo '<a class="btn btn-secondary" href="' . site_url('Portfolio_controller/PortfolioSearchForm') . '">Buscar cartera</a>';
                ?>
            </div>
            <br>
            <br>
            <div class="card">

                <div class="card-header"><center><h1><?php echo $portfolio['number']; ?></h1></center></div>
                <div class="card-body">
                    <center>
                        <h5>
                            <?php
                            echo 'Fuente: <u>'. $portfolio['source']. '</u>';
                            echo '<br>';
                            echo '<br>';
                            echo 'Fecha de compra: <u>'. $portfolio['dateOfPurchase']. '</u>';
                            echo '<br>';
                            echo '<br>';
                            echo 'Cantidad de cuentas de clientes: <u>' . $portfolio['amountOfAccounts'] . '</u>';
                            echo '<br>';
                            echo '<br>';
                            ?>
                        </h5>
                    </center>
                </div> 
                <div class="card-footer"><center><?php
                echo '<a class="btn btn-secondary" href="' . site_url('Client_controller/ClientsListByPortfolio/'.$portfolio['idPortfolio'] ). '">Ver cuentas de clientes</a>';
                ?></center></div>
            </div>
        </div>
    </div>
</div>