<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-8">
            <div id="ListClient">
                <h3>Lista de pagos</h3>
                
                <table border="1" width="100%" class="table table-bordered table-sm table-hover" id="myTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Número de pago</th>
                                <th>Cantidad a pagar</th>
                                <th>Fecha límite del pago</th>
                                <th>Pago realizado</th>
                                <th>Fecha de pago</th>
                                <th>Atraso</th>
                                <th>Multa</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //$date =date("Y/m/d");
                            //$date = strtotime($date);
                            $today = date("Y-m-d");
                            
                            foreach ($payment as $p) {
                                ?>
                                <tr>
                                    <td><?php echo $p['clientName']; ?></td>
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
                                            if ($diff->format("%a") == 1) {
                                                echo $diff->format("%a día");
                                                $diff = $diff->format("%a");
                                            } else {
                                                echo $diff->format("%a dias");
                                                $diff = $diff->format("%a");
                                            }
                                        } else {
                                            $diff = 0;
                                            echo '0 dias';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo '$' . $diff * 30;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($p['alreadyPaid'] == 0) {
                                            echo '<div class="btn-group">';
                                            echo '<button type="button" class="btn btn-primary">Opciones</button>';
                                            echo '<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">';
                                            echo '<span class="caret"></span>';
                                            echo '</button>';
                                            echo '<div class="dropdown-menu">';
                                            echo '<a class="dropdown-item" href="' . site_url('Payment_controller/pay/' . $p['idPayment']) . '">Pagar</a>';

                                            echo '</div>';
                                            echo '</div>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                    <?php } ?>
                        </tbody>
                    </table>
                
                
                
                
                
                
                
                
                
               <?php 
//               foreach ($payment as $p) { 
//                   echo $p['idPayment'].'<br>';
//                   echo $p['paymentName'].'<br>';
//                   echo $p['amountToPay'].'<br>';
//                   echo $p['paymentDueDate'].'<br>';
//                   echo $p['idAgreement'].'<br>';
//                   echo $p['agreement'].'<br>';
//                   echo $p['idClient'].'<br>';
//                   echo $p['client'].'<br><br>';
//               }
                ?>
            <br>
            <br>
        </div>
    </div>
</div>
</div>
