<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-8">
            <div id="ListEmployee">
                <h3>Lista de empleados</h3>
                <div class="btn-group">
                    <?php
                    echo '<a class="btn btn-secondary" href="'. site_url('Employee_controller/EmployeeCreate').'">Agregar empleado</a>';
                    echo '<a class="btn btn-secondary" href="'. site_url('Employee_controller/EmployeeSearchForm').'">Buscar empleado</a>';
                    ?>
                </div>
                <div>
                    <br>
                    <table border="1" width="100%" class="table table-bordered table-hover" id="myTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id de empleado</th>
                                <th>Nombre</th>
                                <th>Apellido paterno</th>
                                <th>Apellido materno</th>
                                <th>Puesto</th>
                                <th>Correo electrónico</th>
                                <th>Teléfono laboral</th>
                                <th>Teléfono móvil</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <?php foreach ($employee as $e) { ?>
                            <tr>
                                <td><?php echo $e['idEmployee']; ?></td>
                                <td><?php echo $e['name']; ?></td>
                                <td><?php echo $e['fLastName']; ?></td>
                                <td><?php echo $e['sLastName']; ?></td>
                                <td><?php echo $e['jobPosition']; ?></td>
                                <td><?php echo $e['email']; ?></td>
                                <td><?php echo $e['workPhone']; ?></td>
                                <td><?php echo $e['personalPhone']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">Opciones</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                    <a class="dropdown-item" href="<?php echo site_url('Employee_controller/EmployeeDetails/' . $e['idEmployee']); ?>">Detalles</a>
                                    <a class="dropdown-item" href="<?php echo site_url('Employee_controller/EmployeeUpdate/' . $e['idEmployee']); ?>">Editar</a> 
                                    <a class="dropdown-item" href="<?php echo site_url('Employee_controller/disableAccount/' . $e['idEmployee']); ?>">Desactivar cuenta</a>
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