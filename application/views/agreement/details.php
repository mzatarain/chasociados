<?php
$paidAmount = 0;
$penaltyDays = 0;
$totalCollectionCostPayment = 0;
$totalPenaltyFeePayment = 0;
$collectionCostsSum = 0;

foreach ($penaltyfeepayment as $p) {
    $totalPenaltyFeePayment = $totalPenaltyFeePayment + $p['penaltyFeePayment'];
}

foreach ($collectioncostpayment as $c) {
    $totalCollectionCostPayment = $totalCollectionCostPayment + $c['collectionCostPayment'];
}

foreach($payment as $p){
    $collectionCostsSum = $collectionCostsSum + $p['collectionCost'];
}

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
        $sundaysCount = $this->agreement_model->countSundays($date2, $date1);
        $penaltyDays = $penaltyDays + $diff-$sundaysCount;
    }
    $penaltyFee = $penaltyDays * 30;
}



















$totalDebt = $agreement['totalAmountToPay'] + $penaltyFee + $collectionCostsSum - $paidAmount - $totalPenaltyFeePayment - $totalCollectionCostPayment;
?>
<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-10">
            <div id="ListClient">
                <h3>Convenio <?php echo $agreement['idAgreement']; ?></h3>
                <div>
                    <table border="1" width="100%" class="table table-bordered table-sm table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Cartera</th>
                                <th>Id cliente</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Colonia</th>                    
                            </tr>
                        </thead>
                        <tr>
                            <td><?php
                                $portfolio = $this->portfolio_model->getPortfolioByID($client['idPortfolio']);
                                echo $portfolio['number'];
                                ?></td>
                            <td><?php echo $client['number']; ?></td>
                            <td><?php echo $client['name'], ' ', $client['fLastName'], ' ', $client['sLastName']; ?></td>
                            <td><?php echo $client['address']; ?></td>
                            <td><?php echo $client['neighborhood']; ?></td>


                        </tr>
                        <thead class="thead-dark">
                            <tr>
                                <th>Teléfono</th>
                                <th>Celular</th>
                                <th>Inicio del convenio</th>
                                <th>Reconvenio</th>
                                <th>Frecuencia del pago</th>
                            </tr>
                        </thead>
                        <tr>
                            <td><?php echo $client['homePhone']; ?></td>
                            <td><?php echo $client['cellPhone']; ?></td>
                            <td><?php echo $agreement['paymentStartDate']; ?></td>
                            <td><?php
                                if ($agreement['reAgreement'] == 1) {
                                    echo 'Si';
                                } else {
                                    echo 'No';
                                }
                                ?></td>

                            <td><?php echo $agreement['recurrenceOfPayment']; ?></td>
                        </tr>

                        <thead class="thead-dark">
                            <tr>
                                <th>Deuda inicial</th>
                                <th>Cantidad acordada a pagar</th>
                                <th>Abonado</th>
                                <th>Multas</th>
                                <th>Deuda actual</th>


                            </tr>
                        </thead>
                        <tr>
                            <td><?php echo '$' . number_format($client['debt']); ?></td>

                            <td><?php echo '$' . number_format($agreement['totalAmountToPay']); ?></td>
                            <td>
                                <?php
                                echo '$' . number_format($paidAmount);
                                ?>
                            </td>
                            <td><?php echo '$' . number_format($penaltyFee) . '(' . $penaltyDays . 'días)'; ?></td>
                            <td><?php echo '<font color="red"><h5>$'.number_format($totalDebt).'</h5></font>'; ?></td>



                        </tr>
                    </table>
                    <br>

                    <table border="1" width="100%" class="table table-bordered table-sm table-hover" id="myTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>Número de pago</th>
                                <th>Cantidad a pagar</th>
                                <th>Fecha límite del pago</th>
                                <th>Pago realizado</th>
                                <th>Cobrador</th>
                                <th>Fecha de pago</th>
                                <th>Atraso</th>
                                <th>Multa</th>
                                <th>Gasto de cobranza</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $date = strtotime($date);
                            $today = date("Y-m-d", $date);
                            $diffSum = 0;
                            
                            foreach ($payment as $p) {
                                ?>
                                <tr>
                                    <td><?php echo $p['paymentName']; ?></td>
                                    <td><?php echo $p['amountToPay']; ?></td>
                                    <td><?php echo $p['paymentDueDate']; ?></td>
                                    <?php
                                    $dateTime = strtotime($p['paymentDueDate']);
                                    $paymentDueDate = date("Y-m-d", $dateTime);

                                    //$day1 = strtotime($paymentDueDate.'-2 days');
                                    //$dayBefore = date("Y-m-d", strtotime($paymentDueDate . "-2 days"));

                                    $day1 = strtotime('-1 days', strtotime($paymentDueDate));
                                    $dayBefore = date('Y-m-d', $day1);



                                    if ($p['alreadyPaid'] == 1) {
                                        echo '<td bgcolor="#00FF00">'; //verde
                                        echo 'Si';
                                        echo '</td>';
                                    } else if ($p['alreadyPaid'] == 0 and $today > $paymentDueDate) {
                                        echo '<td bgcolor="#FF0000">'; //rojo
                                        echo 'No';
                                        echo '</td>';
                                    } else if ($p['alreadyPaid'] == 0 and $today == $dayBefore or $today == $paymentDueDate) {
                                        echo '<td bgcolor="#F9FF33">'; //amarillo
                                        echo 'No';
                                        echo '</td>';
                                    } else if ($p['alreadyPaid'] == 0 && $today < $dayBefore) {
                                        echo '<td>'; //sin color
                                        echo 'No';
                                        echo '</td>';
                                    }
                                    ?>
                                    <td>
                                        <?php
                                        $idEmployee = $p['idEmployee'];
                                        $employee = $this->employee_model->getEmployeeByID($idEmployee);
                                        echo $employee['name'] . ' ' . $employee['fLastName'];
                                        ?> 

                                    </td>
                                    <td>
                                        <?php
                                        if (isset($p['paymentDate'])) {
                                            echo $p['paymentDate'];
                                        } else {
                                            echo 'Pendiente';
                                        }
                                        ?></td>
                                    <td>
                                        <?php
                                        if (isset($p['paymentDate'])) {
                                            $today = $p['paymentDate'];
                                        } else {
                                            $today = date("Y-m-d");
                                        }
                                        if ($today > $p['paymentDueDate']) {
                                            $date1 = date_create($today);
                                            $date2 = date_create($p['paymentDueDate']);
                                            $diff = date_diff($date1, $date2);
                                            $sundaysCount = $this->agreement_model->countSundays($date2,$date1);
                                            $penaltyDays=$diff->format("%a")-$sundaysCount;
                                            if ($penaltyDays == 1) {
                                                echo $penaltyDays." día";
                                                $diffSum = $diffSum + $penaltyDays;
                                            } else {
                                                echo $penaltyDays." dias";
                                                $diffSum = $diffSum + $penaltyDays;
                                            }
                                        } else {
                                            $diff = 0;
                                            echo '0 dias';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo '$' . $penaltyDays * 30;
                                        ?>
                                    </td>
                                    <td><?php
                                        echo '$' . number_format($p['collectionCost']);
                                        
                                        ?></td>
                                    <td>
                                        <?php
                                        if ($p['alreadyPaid'] == 0) {
                                            echo '<div class="btn-group">';
                                            echo '<button type="button" class="btn btn-primary">Opciones</button>';
                                            echo '<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">';
                                            echo '<span class="caret"></span>';
                                            echo '</button>';
                                            echo '<div class="dropdown-menu">';
                                            echo '<a class="dropdown-item" href="' . site_url('Payment_controller/pay/' . $p['idPayment']) . '">Pagar Adeudo</a>';
                                            if ($p['collectionCost'] != 200) {
                                                echo '<a class="dropdown-item" href="' . site_url('Payment_controller/collectionCost/' . $p['idPayment']) . '">Incluir gastos de cobranza</a>';
                                            }
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <thead class="thead-dark">
                        <th>Desgloce:</th>
                        <th>Adeudo</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Multas</th>
                        <th>Gastos de cobranza</th>
                        <th></th>
                        </thead>
                        <tbody><tr>
                                <td>Adeudos: </td>
                                <td><?php echo '$' . number_format($agreement['totalAmountToPay']); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php echo number_format($diffSum) . ' días'; ?></td>
                                <td><?php
                                    $diffTotal = $diffSum * 30;
                                    echo '$' . number_format($diffTotal);
                                    ?></td>
                                <td><?php echo '$' . number_format($collectionCostsSum); ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Abonos: </td>
                                <td><?php echo '$' . number_format($paidAmount); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php
                                    echo '$' . number_format($totalPenaltyFeePayment);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo '$' . number_format($totalCollectionCostPayment);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo '<div class="btn-group">';
                                    echo '<button type="button" class="btn btn-primary">Opciones</button>';
                                    echo '<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">';
                                    echo '<span class="caret"></span>';
                                    echo '</button>';
                                    echo '<div class="dropdown-menu">';
                                    if($totalPenaltyFeePayment<$diffTotal){
                                    echo '<a class="dropdown-item" data-toggle="modal" data-target="#penaltyFeeModal" href="#">Abonar a multas</a>';
                                    }
                                    if($totalCollectionCostPayment<$collectionCostsSum){
                                    echo '<a class="dropdown-item" data-toggle="modal" data-target="#collectionCostModal" href="#">Abonar a gastos de cobranza</a>';
                                    }
                                    echo '</div>';
                                    echo '</div>';
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Total pendiente: </td>
                                <td><?php echo '<font color="red"><h5>$'.number_format($totalDebt).'</h5></font>'; ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>    
                </div> 
            </div>
            <br>
            <br>
        </div>
    </div>
</div>


<!-- PenaltyFee Modal -->
<div class="modal" id="penaltyFeeModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Abonar a multas</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">      
          
          <?php echo form_open('PenaltyFeePayment_controller/pay/' . $agreement['idAgreement']); ?>
          <div class="form-group">
              <label for="penaltyFeePayment">Cantidad a abonar:</label>
              <input type="text" class="form-control" name="penaltyFeePayment" id="penaltyFeePayment">
          </div>
          <button class="btn btn-primary" type="submit">Abonar</button>

          <?php echo form_close(); ?>          
      </div>


    </div>
  </div>
</div>

<!-- CollectionCost Modal -->
<div class="modal" id="collectionCostModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Abonar a gastos de cobranza</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <?php echo form_open('CollectionCostPayment_controller/pay/' . $agreement['idAgreement']); ?>
          <div class="form-group">
              <label for="penaltyFeePayment">Cantidad a abonar:</label>
              <input type="text" class="form-control" name="collectionCostPayment" id="collectionCostPayment">
          </div>
          <button class="btn btn-primary" type="submit">Abonar</button>

          <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>