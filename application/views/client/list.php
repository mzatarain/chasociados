<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-8">
            <div id="ListClient">
                <h3>Lista de clientes</h3>
                <div class="btn-group">
                    <?php
                    echo '<a class="btn btn-secondary" href="' . site_url('Client_controller/ClientCreate') . '">Agregar cliente</a>';
                    echo '<a class="btn btn-secondary" href="' . site_url('Client_controller/ClientSearchForm') . '">Búsqueda avanzada</a>';
                    ?>
                </div>
                <div>

                    <br>
                    <table border="1" width="100%" class="table table-bordered table-sm table-hover" id="myTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>Cartera</th>
                                <th>Id cliente</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Celular</th>
                                <th>Lugar de trabajo</th>
                                <th>Deuda inicial</th>
                                <th>Deuda actual</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($client as $c) { ?>
                                <tr>
                                    <td><?php 
                                    $portfolio= $this->portfolio_model->getPortfolioByID($c['idPortfolio']);
                                    echo $portfolio['number']; ?></td>
                                    <td><?php echo $c['number']; ?></td>
                                    <td><?php echo $c['fLastName'], ' ', $c['sLastName'], ' ', $c['name']; ?></td>
                                    <td><?php echo $c['address']; ?></td>
                                    <td><?php echo $c['cellPhone']; ?></td>
                                    <td><?php echo $c['workplace']; ?></td>
                                    <td><?php echo '$' . number_format($c['debt']); ?></td>
                                    <td><?php
                                        $agreement = $this->agreement_model->getAgreementByClient($c['idClient']);
                                        $idAgreement = $agreement['idAgreement'];
                                        if(isset($idAgreement)){
                                        $payment = $this->payment_model->getPaymentsByidAgreement($idAgreement);
                                        
                                        $paidAmount = 0;
                                        $penaltyDays = 0;
                                        foreach ($payment as $p) {
                                            if ($p['alreadyPaid'] == 1) {
                                                $paidAmount = $paidAmount + $p['amountToPay'];
                                            }

                                            if (isset($p['paymentDate'])) {
                                                $today = $p['paymentDate'];
                                            } else {
                                                $today = date("Y-m-d");
                                            }
                                            if ($today > $p['paymentDueDate']) {
                                                $date1 = date_create($today);
                                                $date2 = date_create($p['paymentDueDate']);
                                                $diff = date_diff($date1, $date2);
                                                $diff = $diff->format("%a");
                                                $penaltyDays = $penaltyDays + $diff;
                                            }
                                            $penaltyFee = $penaltyDays * 30;
                                        }

                                        $totalDebt = $agreement['totalAmountToPay'] - $paidAmount + $penaltyFee;
                                        echo '$'.number_format($totalDebt);
                                        }
                                        else{
                                            echo 'Sin convenio.';
                                        }
                                        ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary">Opciones</button>
                                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?php echo site_url('Client_controller/ClientDetails/' . $c['idClient']); ?>">Detalles</a>
                                                <a class="dropdown-item" href="<?php echo site_url('Agreement_controller/AgreementCreate/' . $c['idClient'] . "/" . $c['debt']); ?>">Convenio</a>
                                                <a class="dropdown-item" href="<?php echo site_url('Main_controller/mapByClient/' . $c['idClient']); ?>">Mapa</a>
                                                <a class="dropdown-item"href="<?php echo site_url('Client_controller/ClientUpdate/' . $c['idClient']); ?>">Editar</a> 
                                                <a class="dropdown-item" href="<?php echo site_url('Client_controller/delete/' . $c['idClient']); ?>">Borrar</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
<?php } ?>
                        </tbody>
                    </table>
                </div> 
            </div>
            <br>
            <br>
        </div>
    </div>
</div>