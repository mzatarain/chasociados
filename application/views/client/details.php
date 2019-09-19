<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-9">
            <div class="btn-group">
                <?php
                echo '<a class="btn btn-secondary" href="' . site_url('Client_controller/ClientCreate') . '">Agregar cliente</a>';
                echo '<a class="btn btn-secondary" href="' . site_url('Client_controller/ClientSearchForm') . '">Buscar cliente</a>';
                ?>
            </div>
            <br>
            <br>
            <div class="card">

                <div class="card-header"><center><h3><?php echo $client['name'], ' ', $client['fLastName'], ' ', $client['sLastName']; ?></h3></center></div>
                <div class="card-body">
                    <center>
                          
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">Opciones</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?php echo site_url('Agreement_controller/AgreementCreate/' . $client['idClient']."/".$client['debt']); ?>">Convenio</a>
                                            <a class="dropdown-item" href="<?php echo site_url('Payment_controller//' . $client['idClient']); ?>">Pagos</a>
                                            <a class="dropdown-item" href="<?php echo site_url('Main_controller/mapByClient/' . $client['idClient']); ?>">Mapa</a>
                                            <a class="dropdown-item"href="<?php echo site_url('Client_controller/ClientUpdate/' . $client['idClient']); ?>">Editar</a> 
                                            <a class="dropdown-item" href="<?php echo site_url('Client_controller/delete/' . $client['idClient']); ?>">Borrar</a>
                                        </div>
                                    </div>
                        <br>
                        <br>
                        <table border="1" width="100%" class="table table-bordered table-sm table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Cartera</th>
                                    <th>Id cliente</th>
                                    <th>Dirección</th>
                                    <th>Colonia</th>
                                    <th>Teléfono</th>
                                                                        
                                </tr>
                            </thead>
                            <tr>
                                <td><?php 
                                $portfolio = $this->portfolio_model->getPortfolioByID($client['idPortfolio']);
                                echo $portfolio['number']; ?></td>
                                <td><?php echo $client['number']; ?></td>
                                <td><?php echo $client['address']; ?></td>
                                <td><?php echo $client['neighborhood']; ?></td>
                                <td><?php echo $client['homePhone']; ?></td>
                                
                            </tr>
                            <thead class="thead-light">
                                <tr>
                                    <th>Deuda inicial</th>
                                    <th>Deuda actual</th>
                                    <th>Auto propio</th>
                                    <th>Casa propia</th>
                                    <th>Email</th>                                    
                                </tr>
                            </thead>
                            <tr>
                                
                                <td><?php echo '$' . number_format($client['debt']); ?></td>
                                <td>
                                    <?php
                                        $agreement = $this->agreement_model->getAgreementByClient($client['idClient']);
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
                                        ?>
                                </td>
                                <td><?php
                                    if ($client['hasACar'] == 1) {
                                        echo 'Si';
                                    } else {
                                        echo 'No';
                                    }
                                    ?></td>
                                <td><?php
                                    if ($client['hasAHouse'] == 1) {
                                        echo 'Si';
                                    } else {
                                        echo 'No';
                                    }
                                    ?></td>
                                <td><?php echo $client['email']; ?></td>
                                    
                            </tr>
                            <thead class="thead-light">
                                <tr>
                                    <th>Trabajo</th>
                                    <th>Puesto</th>
                                    <th>Salario</th>
                                    <th>Antiguedad</th>
                                    <th>Teléfono</th>
                                </tr>
                            </thead>
                            <tr>
                                <td><?php echo $client['workplace']; ?></td>
                                <td><?php echo $client['jobPosition']; ?></td>
                                <td><?php echo '$' . number_format($client['salary']); ?></td>
                                <td><?php echo $client['workAntiquity']; ?></td>
                                <td><?php echo $client['workphone']; ?></td>
                            </tr>
                        </table>
                    </center>
                </div> 
                <div class="card-footer"><center><h3><?php echo 'Celular: '. $client['cellPhone']; ?></h3></center></div>
            </div>
        </div>
    </div>
</div>



<?php
//                            echo '<br>';
//                            echo '<br>';
//                             echo 'Dirección: <u>' . $client['address']. '</u>';
//                            echo '<br>';
//                            echo '<br>';
//                            echo 'Colonia: <u>' . $client['neighborhood']. '</u>';
//                            echo '<br>';
//                            echo '<br>';
//                            echo 'Deuda: <u>$' . number_format($client['debt']). '</u>';
//                            echo '<br>';
//                            echo '<br>';
//                            if($client['hasACar']==1){
//                            echo 'Automóvil propio: <u>Si</u>';
//                            }
//                            else{
//                                echo 'Automóvil propio: <u>No</u>';
//                            }
//                            echo '<br>';
//                            echo '<br>';
//                            if($client['hasAHouse'] == 1){
//                                echo 'Casa propia: <u>Si</u>';
//                            }
//                            else{
//                                echo 'Casa propia: <u>No</u>';
//                            }                            
//                            echo '<br>';
//                            echo '<br>';
//                            echo 'Notas: <u>' . $client['notes']. '</u>';
//                            echo '<br>';
//                            echo '<br>';
//                            echo 'Lugar de trabajo: <u>' . $client['workplace']. '</u>';
//                            echo '<br>';
//                            echo '<br>';
//                            echo 'Puesto: <u>' . $client['jobPosition']. '</u>';
//                            echo '<br>';
//                            echo '<br>';
//                            echo 'Salario: <u>$'.number_format($client['salary']). '</u>';
//                            echo '<br>';
//                            echo '<br>';
//                            echo 'Antiguedad laboral: <u>' . $client['workAntiquity']. '</u>';
//                            echo '<br>';
//                            echo '<br>';
//                            echo 'Teléfono laboral: <u>' . $client['workphone']. '</u>';
//                            echo '<br>';
//                            echo '<br>';
//                            echo 'Horario laboral: <u>' . $client['workSchedule']. '</u>';
//                            echo '<br>';
//                            echo '<br>';
//                            ?>