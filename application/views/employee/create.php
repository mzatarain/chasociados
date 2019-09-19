<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-8">
            <div id="AddEmployee">
                <h3>Agregar empleado</h3>
                <?php
                echo '<form action="' . site_url('Employee_controller/createEmployee/') . '" method="post">';
                ?>
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="fLastName">Apellido paterno:</label>
                    <input type="text" class="form-control" name="fLastName" id="fLastName">
                </div>
                <div class="form-group">
                    <label for="sLastName">Apellido materno:</label>
                    <input type="text" class="form-control" name="sLastName" id="sLastName">
                </div>
                <div class="form-group">
                    <label for="jobPosition">Puesto:</label>
                    <select class="form-control" name="jobPosition">
                        <option value="Admin">Administrador</option>
                        <option value="Cobrador">Cobrador</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="pwd">Contraseña:</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="workPhone">Teléfono laboral:</label>
                    <input type="text" class="form-control" name="workPhone" id="workPhone">
                </div>
                <div class="form-group">
                    <label for="personalPhone">Teléfono personal:</label>
                    <input type="text" class="form-control" name="personalPhone" id="personalPhone">
                </div>

                <button class="btn btn-primary">Enviar</button>
                </form>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>  