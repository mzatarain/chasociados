<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-8">
            <div class="btn-group">
                <?php
                echo '<a class="btn btn-secondary" href="' . site_url('Employee_controller/EmployeeCreate') . '">Agregar empleado</a>';
                echo '<a class="btn btn-secondary" href="' . site_url('Employee_controller/EmployeeSearchForm') . '">Buscar empleado</a>';
                ?>
            </div>
            <br>
            <br>
            <div class="card">

                <div class="card-header"><center><h1><?php echo $employee['name'], ' ', $employee['fLastName'], ' ', $employee['sLastName']; ?></h1></center></div>
                <div class="card-body">
                    <center>
                        <h5>
                            <?php
                            echo 'Id de empleado: <u>'. $employee['idEmployee']. '</u>';
                            echo '<br>';
                            echo '<br>';
                            echo 'Correo electrónico: <u>'. $employee['email']. '</u>';
                            echo '<br>';
                            echo '<br>';
                            echo 'Teléfono laboral: <u>' . $employee['workPhone'] . '</u>';
                            echo '<br>';
                            echo '<br>';
                            echo 'Teléfono personal: <u>' . $employee['personalPhone']. '</u>';
                            echo '<br>';
                            echo '<br>';
                            ?>
                        </h5>
                    </center>
                </div> 
                <div class="card-footer"><center><h4><?php echo $employee['jobPosition']; ?></h4></center></div>
            </div>
        </div>
    </div>
</div>