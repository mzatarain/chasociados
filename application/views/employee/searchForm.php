<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-8">
            <div id="AddEmployee">
                <h3>Buscar empleado</h3>
                <?php
                echo '<form action="' . site_url('Employee_controller/EmployeeSearch/') . '" method="post">';
                ?>
                <div class="form-group">
                    <label for="idEmployee">Id de empleado:</label>
                    <input type="text" class="form-control" name="idEmployee" id="idEmployee">
                </div>
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
                    <label for="email">Correo electrónico:</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                
                <button class="btn btn-primary">Buscar</button>
                </form>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>  