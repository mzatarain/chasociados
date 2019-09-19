<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-8">
            <h2>General</h2>
            <h3>Menú de opciones</h3>
            <div class="btn-group">

                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Empleados</button>
                    <div class="dropdown-menu">
                        <?php
                        echo '<a class="dropdown-item" href="'. site_url('Employee_controller/EmployeeList').'">Listar empleados</a>';
                        echo '<a class="dropdown-item" href="'. site_url('Employee_controller/EmployeeCreate').'">Agregar empleado</a>';
                        echo '<a class="dropdown-item" href="'. site_url('Employee_controller/EmployeeSearchForm').'">Buscar empleado</a>';
                        ?>
                    </div>                
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Carteras</button>
                    <div class="dropdown-menu">
                        <?php
                        echo '<a class="dropdown-item" href="'. site_url('Portfolio_controller/PortfolioList').'">Listar carteras</a>';
                        echo '<a class="dropdown-item" href="'. site_url('Portfolio_controller/PortfolioCreate').'">Agregar cartera</a>';
                        echo '<a class="dropdown-item" href="'. site_url('Portfolio_controller/PortfolioSearchForm').'">Buscar carteras</a>';
                        ?>
                    </div>
                </div>
                
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Clientes</button>
                    <div class="dropdown-menu">
                        <?php
                        echo '<a class="dropdown-item" href="'. site_url('Client_controller/ClientList').'">Listar clientes</a>';
                        echo '<a class="dropdown-item" href="'. site_url('Client_controller/ClientCreate').'">Agregar cliente</a>';
                        echo '<a class="dropdown-item" href="'. site_url('Client_controller/ClientSearchForm').'">Buscar cliente</a>';
                        ?>
                    </div>
                </div>
                
                <button type="button" class="btn btn-primary" onClick="window.location='<?php echo site_url("Main_controller/map");?>'">Mapa</button>

            </div>
            <br>
            <br>
            <hr class="d-sm-none">
        </div>


    </div>
</div>