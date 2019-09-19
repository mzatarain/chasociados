<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-8">
            <div id="EditEmployee">
                <h3>Editar empleado</h3>
                <?php echo form_open('Employee_controller/update/' . $employee['idEmployee']); ?>

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" class="form-control" value="<?php echo ($this->input->post('name') ? $this->input->post('name') : $employee['name']); ?>" />
                </div>
                <div class="form-group">
                    <label for="fLastName">Apellido paterno:</label> 
                    <input type="text" name="fLastName" class="form-control" value="<?php echo ($this->input->post('fLastName') ? $this->input->post('fLastName') : $employee['fLastName']); ?>" />
                </div>
                <div class="form-group">
                    <label for="sLastName">Apellido materno:</label>
                    <input type="text" name="sLastName" class="form-control" value="<?php echo ($this->input->post('sLastName') ? $this->input->post('sLastName') : $employee['sLastName']); ?>" />
                </div>
                <div class="form-group">
                    <label for="jobPosition">Puesto:</label>
                    <select class="form-control" name="jobPosition">
                        <?php
                        if($employee['jobPosition'] == 'Admin'){
                        echo '<option value="Admin" selected="selected">Administrador</option>';
                        echo '<option value="Cobrador">Cobrador</option>';
                        }
                        else{
                            echo '<option value="Admin">Administrador</option>';
                        echo '<option value="Cobrador" selected="selected">Cobrador</option>';
                        }
                        
                        ?>
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="text" name="email" class="form-control" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $employee['email']); ?>" />
                </div>
                <div class="form-group">
                    <label for="workPhone">Teléfono laboral:</label>
                    <input type="text" name="workPhone" class="form-control" value="<?php echo ($this->input->post('workPhone') ? $this->input->post('workPhone') : $employee['workPhone']); ?>" />
                </div>
                <div class="form-group">
                    <label for="personalPhone">Teléfono personal:</label> 
                    <input type="text" name="personalPhone" class="form-control" value="<?php echo ($this->input->post('personalPhone') ? $this->input->post('personalPhone') : $employee['personalPhone']); ?>" />
                </div>

                <button class="btn btn-primary" type="submit">Save</button>

                <?php echo form_close(); ?>
                <br>
                <br>
            </div>
        </div> 
    </div> 
</div>