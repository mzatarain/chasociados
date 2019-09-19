<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <link rel="SHORTCUT ICON" href="<?php echo base_url("images/favicon.png"); ?>" />
        <title>CH & Asociados</title>
        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                height: 100%;
            }
            /* Optional: Makes the sample page fill the window. */
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
            .labels {
                color: white;
                padding: 8px;
                background-color: black;
                font-family: "Lucida Grande", "Arial", sans-serif;
                font-size: 10px;
                text-align: center;
                white-space: nowrap;
            }
            .success {background-color: #4CAF50;} /* Green */
            .info {background-color: #2196F3;} /* Blue */
            .warning {background-color: #ff9800;} /* Orange */
            .danger {background-color: #f44336;} /* Red */ 
            .other {background-color: #e7e7e7; color: black;} /* Gray */
        </style>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBx5FBg69gskcXHjRJwwp0wrkjKM19zZRM"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/footer-distributed-with-address-and-phones.css"); ?>"> 
        <script src="<?php echo base_url("assets/js/markerwithlabel.js"); ?>"></script>
        <script>
            var homeLatLng = new google.maps.LatLng(32.624538, -115.452263);
            var mexicali = {lat: 32.624538, lng: -115.452263};
            //https://www.latlong.net/
            
//                var client1={ idPortfolio: "1" ,
//                idClient: "1",
//                name: "Manuel", 
//                fLastName: "Rodríguez", 
//                sLastName: "Zatarain",
//                cellPhone: "6862279910",
//                address: "Av Republica de Colombia #302",
//                neighborhood: "Cuauhtemoc Norte",
//                latitude: "32.664720",
//                longitude: "-115.442340",
//                debt: "32000"
//            };            
//            let clients=[
//                { idPortfolio: "1",
//                idClient: "1",
//                name: "Manuel", 
//                fLastName: "Rodríguez", 
//                sLastName: "Zatarain",
//                cellPhone: "6862279910",
//                address: "Av Republica de Colombia #302",
//                neighborhood: "Cuauhtemoc Norte",
//                latitude: "32.664720",
//                longitude: "-115.442340",
//                debt: "32000"
//            },
//            { idPortfolio: "3",
//                idClient: "2",
//                name: "Andrés", 
//                fLastName: "Hernández", 
//                sLastName: "Morales",
//                cellPhone: "6863698754",
//                address: "Av Republica de Cuba #205",
//                neighborhood: "Cuauhtemoc Norte",
//                latitude: "32.664610",
//                longitude: "-115.442210",
//                debt: "81000"
//            },
//            { idPortfolio: "2",
//                idClient: "3",
//                name: "Edgar", 
//                fLastName: "Zamora", 
//                sLastName: "Peña",
//                cellPhone: "6865132021",
//                address: "Av Mariano Arista #2039",
//                neighborhood: "Prohogar",
//                latitude: "32.660619",
//                longitude: "-115.452926",
//                debt: "61000"
//            }
//            ];
            let clients = [];
            let client = {};
            var markers = [];
            var contents = [];
            var infowindows = [];            
            <?php foreach ($client as $c) { ?>
            client={ idPortfolio: "<?php echo $c['idPortfolio']; ?>" ,
                idClient: "<?php echo $c['idClient']; ?>",
                name: "<?php echo $c['name']; ?>", 
                fLastName: "<?php echo $c['fLastName']; ?>", 
                sLastName: "<?php echo $c['sLastName']; ?>",
                cellPhone: "<?php echo $c['cellPhone']; ?>",
                address: "<?php echo $c['address']; ?>",
                neighborhood: "<?php echo $c['neighborhood']; ?>",
                latitude: "<?php echo $c['latitude']; ?>",
                longitude: "<?php echo $c['longitude']; ?>",
                debt: "<?php echo '$' . number_format($c['debt']); ?>"
            };
            clients.push(client);
            <?php } ?>
            function initialize() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 13,
                    center: mexicali,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                for (i = 0; i < clients.length; i++) {
                    markers[i] = new MarkerWithLabel({
                        position: new google.maps.LatLng(clients[i].latitude, clients[i].longitude),
                        draggable: false,
                        raiseOnDrag: false,
                        map: map,
                        labelContent: clients[i].debt,
                        labelAnchor: new google.maps.Point(22, 0),
                        labelClass: "labels danger", // the CSS class for the label
                        labelStyle: {opacity: 1.0}
                    });
                    markers[i].index = i;
                    contents[i] = '<div class="popup_container">' +
                            clients[i].name + ' ' + clients[i].fLastName + ' ' + clients[i].sLastName
                            +
                            '<br>' + clients[i].address + ', ' + clients[i].neighborhood
                            +
                            '<br>Celular: ' + clients[i].cellPhone
                            +
                            '</div>';
                    infowindows[i] = new google.maps.InfoWindow({
                        content: contents[i],
                        maxWidth: 300
                    });
                    google.maps.event.addListener(markers[i], 'click', function () {
                        infowindows[this.index].open(map, markers[this.index]);
                        map.panTo(markers[this.index].getPosition());
                    });
                }
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
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
                echo '<a class="nav-link" href="' . site_url('Main_controller/cobranza') . '">Cobranza</a>';
                echo '</li>';
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="' . site_url('Main_controller/juridico') . '">Jurídico</a>';
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
        <div id="map"></div>
        <div class="jumbotron text-center" style="margin-bottom:0">
            <footer class="footer-distributed">
                <div class="footer-left">
                    <h3><a href="<?php echo site_url('main_controller/index') ?>"><img  style="width:15%; height: 15%;"  src="<?php echo base_url("images/logo_transparent.png"); ?>"></a></span></h3>
                    <p class="footer-links">
                        <a href="#">Inicio</a>
                    </p>
                    <p class="footer-company-name">HC Asociados &copy; 2019</p>
                </div>
                <div class="footer-center">
                    <div>
                        <i class="fa fa-map-marker"></i>
                        <p><span>S/N Calz. Zaragoza</span> Mexicali, México</p>
                    </div>
                    <div>
                        <i class="fa fa-phone"></i>
                        <p>+52 686 123456</p>
                    </div>
                    <div>
                        <i class="fa fa-envelope"></i>
                        <p><a href="mailto:soporte@zatasc.com">soporte@zatasc.com</a></p>
                    </div>
                </div>
                <div class="footer-right">
                    <p class="footer-company-about">
                        <span>Acerca de CH Asociados.</span>
                        Empresa dedicada a la gestión de cobranzas.
                    </p>
                </div>
            </footer>
        </div>
    </body>
</html>