<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-8">
            <div id="ListPortfolio">
                <h3>Lista de carteras</h3>
                <div class="btn-group">
                    <?php
                    echo '<a class="btn btn-secondary" href="' . site_url('Portfolio_controller/PortfolioCreate') . '">Agregar cartera</a>';
                    echo '<a class="btn btn-secondary" href="' . site_url('Portfolio_controller/PortfolioSearchForm') . '">Búsqueda avanzada</a>';
                    ?>
                </div>
                <div>
                    <br>
                    <table border="1" width="100%" class="table table-bordered table-hover" id="myTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>Número de cartera</th>
                                <th>Fuente</th>
                                <th>Fecha de compra</th>
                                <th>Cantidad de cuentas</th>
                                <th>Cuentas en el sistema</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <?php foreach ($portfolio as $p) { ?>
                            <tr>
                                <td><?php echo $p['number']; ?></td>
                                <td><?php echo $p['source']; ?></td>
                                <td><?php echo $p['dateOfPurchase']; ?></td>
                                <td><?php echo $p['amountOfAccounts']; ?></td>
                                <td><?php echo $p['clientCount']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">Opciones</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?php echo site_url('Client_controller/ClientCreateFromPortfolio/' . $p['idPortfolio']); ?>">Agregar Cliente</a>
                                            <a class="dropdown-item" href="<?php echo site_url('Portfolio_controller/PortfolioDetails/' . $p['idPortfolio']); ?>">Detalles</a>
                                            <a class="dropdown-item"href="<?php echo site_url('Portfolio_controller/PortfolioUpdate/' . $p['idPortfolio']); ?>">Editar</a> 
                                            <a class="dropdown-item" href="<?php echo site_url('Portfolio_controller/delete/' . $p['idPortfolio']); ?>">Borrar</a>
                                        </div>
                                    </div> 
                                </td>
                            </tr>
                        <?php } ?>

                    </table>
                </div>
                <br>
                <br>
            </div>
        </div> 
    </div> 
</div>