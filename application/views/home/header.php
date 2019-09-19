<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CH & Asociados S.A. de C.V.</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="SHORTCUT ICON" href="<?php echo base_url("images/favicon.png"); ?>" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/footer-distributed-with-address-and-phones.css"); ?>">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url("assets/js/scripts.js"); ?>"></script>
        
    </head>

    <body>

        <div class="jumbotron text-center" style="margin-bottom:0">
            <h1>CH & Asociados S.A. de C.V.</h1>
            <p>Despacho de cobranza</p>  
        </div>


        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <?php
            if ($this->session->userdata('logged')) {
                echo '<a class="navbar-brand" href="#">Menú</a>';
                echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">';
                echo '<span class="navbar-toggler-icon"></span>';
                echo '</button>';
                echo '<div class="collapse navbar-collapse" id="collapsibleNavbar">';
                echo '<ul class="navbar-nav">';
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="'.site_url('Main_controller/cobranza').'">Cobranza</a>';
                echo '</li>';
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="'.site_url('Main_controller/juridico').'">Jurídico</a>';
                echo '</li>';
                echo '</ul>';
                echo '</div>';

                echo '<ul class="nav navbar-nav navbar-right">';

                if ($this->session->userdata('logged')) {
                    echo '<li><a class="nav-link">Bienvenido ' . $this->session->userdata('name') . '! </a></li>';

                    echo '<li><a class="nav-link" href = "' . site_url('Employee_controller/end_session/') . '">Cerrar sesión.</a></li>';
                }
                echo '</ul>';
            } else {
                echo '<a class="navbar-brand" href="#">Login</a>';
            }
            ?>
        </nav>