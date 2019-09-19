<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-8">
            <div id="EditClient">
                <h3>Editar cliente</h3>
                <?php echo form_open('Client_controller/update/' . $client['idClient']); ?>

                <div class="form-group">
                    <label for="idPortfolio">Id de Cartera:</label>
                    <input type="text" class="form-control" name="idPortfolio" id="idPortfolio" value="<?php echo ($this->input->post('idPortfolio') ? $this->input->post('idPortfolio') : $client['idPortfolio']); ?>">
                </div>
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo ($this->input->post('name') ? $this->input->post('name') : $client['name']); ?>">
                </div>
                <div class="form-group">
                    <label for="fLastName">Apellido paterno:</label>
                    <input type="text" class="form-control" name="fLastName" id="fLastName" value="<?php echo ($this->input->post('fLastName') ? $this->input->post('fLastName') : $client['fLastName']); ?>">
                </div>
                <div class="form-group">
                    <label for="sLastName">Apellido materno:</label>
                    <input type="text" class="form-control" name="sLastName" id="sLastName" value="<?php echo ($this->input->post('sLastName') ? $this->input->post('sLastName') : $client['sLastName']); ?>">
                </div>
                <div class="form-group">
                    <label for="address">Dirección:</label>
                    <input type="text" class="form-control" name="address" id="address" value="<?php echo ($this->input->post('address') ? $this->input->post('address') : $client['address']); ?>">
                </div>
                <div class="form-group">
                    <label for="neighborhood">Colonia:</label>
                    <input type="text" class="form-control" name="neighborhood" id="neighborhood" value="<?php echo ($this->input->post('neighborhood') ? $this->input->post('neighborhood') : $client['neighborhood']); ?>">
                </div>
                <div class="form-group">
                    <label for="latitude">Latitud:</label>
                    <input type="text" class="form-control" name="latitude" id="latitude" value="<?php echo ($this->input->post('latitude') ? $this->input->post('latitude') : $client['latitude']); ?>">
                </div>
                <div class="form-group">
                    <label for="longitude">longitud:</label>
                    <input type="text" class="form-control" name="longitude" id="longitude" value="<?php echo ($this->input->post('longitude') ? $this->input->post('longitude') : $client['longitude']); ?>">
                </div>
                
                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $client['email']); ?>">
                </div>
                <div class="form-group">
                    <label for="notes">Notas:</label>
                    <input type="text" class="form-control" name="notes" id="notes" value="<?php echo ($this->input->post('notes') ? $this->input->post('notes') : $client['notes']); ?>">
                </div>
                <div class="form-group">
                    <label for="workplace">Lugar de trabajo:</label>
                    <input type="text" class="form-control" name="workplace" id="workplace" value="<?php echo ($this->input->post('workplace') ? $this->input->post('workplace') : $client['workplace']); ?>">
                </div>
                <div class="form-group">
                    <label for="jobPosition">Puesto:</label>
                    <input type="text" class="form-control" name="jobPosition" id="jobPosition" value="<?php echo ($this->input->post('jobPosition') ? $this->input->post('jobPosition') : $client['jobPosition']); ?>">
                </div>
                <div class="form-group">
                    <label for="workSchedule">Horario de trabajo:</label>
                    <input type="text" class="form-control" name="workSchedule" id="workSchedule" value="<?php echo ($this->input->post('workSchedule') ? $this->input->post('workSchedule') : $client['workSchedule']); ?>">
                </div>
                <div class="form-group">
                    <label for="workAntiquity">Antiguedad laboral:</label>
                    <input type="text" class="form-control" name="workAntiquity" id="workAntiquity" value="<?php echo ($this->input->post('workAntiquity') ? $this->input->post('workAntiquity') : $client['workAntiquity']); ?>">
                </div>
                <div class="form-group">
                    <label for="salary">Salario:</label>
                    <input type="text" class="form-control" name="salary" id="salary" value="<?php echo ($this->input->post('salary') ? $this->input->post('salary') : $client['salary']); ?>">
                </div>
                <div class="form-group">
                    <label for="hasACar">Automóvil propio:</label>
                   
                     <div class="form-check">                        
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="hasACar" value="1" <?php echo ($client['hasACar']==1 ? 'checked="checked"' : '');?> >Sí
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="hasACar" value="0" <?php echo ($client['hasACar']==0 ? 'checked="checked"' : '');?>>No
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="hasAHouse">Casa propia:</label>
                    <div class="form-check">                        
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="hasAHouse" value="1" <?php echo ($client['hasAHouse']==1 ? 'checked="checked"' : ''); ?>>Sí
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="hasAHouse" value="0" <?php echo ($client['hasAHouse']==0 ? 'checked="checked"' : ''); ?>>No
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="homePhone">Teléfono de casa:</label>
                    <input type="text" class="form-control" name="homePhone" id="homePhone" value="<?php echo ($this->input->post('homePhone') ? $this->input->post('homePhone') : $client['homePhone']); ?>">
                </div>
                <div class="form-group">
                    <label for="workphone">Teléfono laboral:</label>
                    <input type="text" class="form-control" name="workphone" id="workphone" value="<?php echo ($this->input->post('workphone') ? $this->input->post('workphone') : $client['workphone']); ?>">
                </div>
                <div class="form-group">
                    <label for="cellPhone">Teléfono personal:</label>
                    <input type="text" class="form-control" name="cellPhone" id="cellPhone" value="<?php echo ($this->input->post('cellPhone') ? $this->input->post('cellPhone') : $client['cellPhone']); ?>">
                </div>

                <button class="btn btn-primary" type="submit">Guardar</button>

                <?php echo form_close(); ?>
                <br>
                <br>
            </div>
        </div> 
    </div> 
</div>