<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-8">
            <div id="AddClient" >
                <h3>Crear convenio</h3>
                <?php
                $client = $this->client_model->getClientByID($idClient);
                ?>
                <br>
                <div class="card">

                    <div class="card-header"><center><h3><?php echo $client['name'], ' ', $client['fLastName'], ' ', $client['sLastName']; ?></h3></center></div>
                    <div class="card-body">
                        <center>
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
                                        echo $portfolio['number'];
                                        ?></td>
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
                                        if (isset($idAgreement)) {
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
                                            echo '$' . number_format($totalDebt);
                                        } else {
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
                    <div class="card-footer"><center><h3><?php echo 'Celular: ' . $client['cellPhone']; ?></h3></center></div>
                </div>
                <?php
                echo '<form action="' . site_url('Agreement_controller/createAgreement/') . '" method="post">';
                    ?>               
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="idClient" id="idClient" value="<?php if (isset($idClient)) {
                                            echo $idClient;
                                        } ?>">
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" name="initialDebt" id="initialDebt" value="<?php if (isset($debt)) {
                                            echo $debt;
                                        } ?>">
                    </div>
                    <div class="form-group">
                        <label for="totalAmountToPay">Cantidad a pagar acordada:</label>
                        <input type="text" class="form-control" name="totalAmountToPay" id="totalAmountToPay" required="required" placeholder="Ej. 12000">
                    </div>
                    <div class="form-group">
                        <label for="amountToPayByPeriod">Cantidad a abonar acordada:</label>
                        <input type="text" class="form-control" name="amountToPayByPeriod" id="amountToPayByPeriod" required="required" placeholder="Ej. 1000">
                    </div>
                    <div class="form-group">
                        <label for="recurrenceOfPayment">Frecuencia del pago:</label>
                        <select class="form-control" id="recurrenceOfPayment" name="recurrenceOfPayment">
                            <option value="Semanal">Semanal</option>
                            <option value="Catorcenal">Catorcenal</option>
                            <option value="Quincena">Quincena (Día 1 y 15)</option>
                            <option value="Mensual">Mensual</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="paymentStartDate">Fecha de primer pago del convenio:</label>
                        <input type="date" class="form-control" name="paymentStartDate" id="paymentStartDate" required="required">
                    </div>

                    <input type="hidden" class="form-check-input" id="reAgreement" name="reAgreement" value="0">

                    <button class="btn btn-primary">Crear convenio</button>
                </form>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>