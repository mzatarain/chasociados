<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-8">
            <div id="AddClient" >
                <h3>Agregar cliente</h3>
                <?php
                if (isset($portfolio['idPortfolio'])) {
                    echo '<h3>Cartera: ' . $portfolio['number'] . '</h3>';
                }
                echo '<form action="' . site_url('Client_controller/createClient/') . '" method="post">';


                if (isset($portfolio['idPortfolio'])) {
                    echo '<div class="form-group">';
                    echo '<input type="hidden" class="form-control" name="idPortfolio" id="idPortfolio" placeholder="id de la cartera" value="' . $portfolio['idPortfolio'] . '"';
                    echo '</div>';
                } else {
                    $portfolios = $this->portfolio_model->getPortfolios();
                    echo '<div class="form-group">';
                    echo '<label for="idPortfolio">Cartera:</label><br>';
                    echo '<input class="form-control" type="text" placeholder="Filtrar cartera">';
                    echo '<select class="form-control" name="idPortfolio" id="idPortfolio">';
                    foreach ($portfolios as $p) {
                        echo '<option value="'.$p['idPortfolio'].'">'.$p['number'].'</option>';
                    }
                    echo '</select>';
                    
                    
                    
                    echo '</div>';
                }
                ?>
                <div class="form-group">
                    <label for="number">Número de cliente:</label>
                    <input type="text" class="form-control" name="number" id="number" placeholder="Número de cliente">
                </div>

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" class="form-control" name="name" placeholder="Nombre del cliente" id="name">
                </div>
                <div class="form-group">
                    <label for="fLastName">Apellido paterno:</label>
                    <input type="text" class="form-control" name="fLastName" placeholder="Apellido paterno" id="fLastName">
                </div>
                <div class="form-group">
                    <label for="sLastName">Apellido materno:</label>
                    <input type="text" class="form-control" name="sLastName" placeholder="Apellido Materno" id="sLastName">
                </div>
                <div class="form-group">
                    <label for="address">Dirección:</label>
                    <input type="text" class="form-control" name="address" placeholder="Ej: Avenida República de Cuba #203" id="address">
                </div>
                <div class="form-group">
                    <label for="neighborhood">Colonia:</label>
                    <input type="text" class="form-control" name="neighborhood" placeholder="Ej: Cuauhtémoc Norte" id="neighborhood">
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" class="form-control" name="email" placeholder="Ej: nombre@gmail.com" id="email">
                </div>

                <a class="btn btn-primary" target="_blank" href="https://www.latlong.net/">Latitud y longitud</a>
                <div class="form-group">
                    <label for="latitude">Latitud:</label>
                    <input type="text" class="form-control" name="latitude" placeholder="Ej: 32.660853" id="latitude">
                </div>
                <div class="form-group">
                    <label for="longitude">Longitud:</label>
                    <input type="text" class="form-control" name="longitude" placeholder="Ej: -115.441804" id="longitude">
                </div>
                <div class="form-group">
                    <label for="debt">Deuda Actual:</label>
                    <input type="text" class="form-control" name="debt" placeholder="Ej: 50000" id="debt">
                </div>
                <div class="form-group">
                    <label for="notes">Notas:</label>
                    <input type="text" class="form-control" name="notes" placeholder="Ej: Adeudo con 1 año de atraso" id="notes">
                </div>
                <div class="form-group">
                    <label for="workplace">Lugar de trabajo:</label>
                    <input type="text" class="form-control" name="workplace" placeholder="Lugar de trabajo" id="workplace">
                </div>
                <div class="form-group">
                    <label for="jobPosition">Puesto:</label>
                    <input type="text" class="form-control" name="jobPosition" placeholder="Puesto" id="jobPosition">
                </div>
                <div class="form-group">
                    <label for="workSchedule">Horario de trabajo:</label>
                    <select class="form-control" name="workSchedule">
                        <option value="Matutino">Matutino</option>
                        <option value="Vespertino">Vespertino</option>
                        <option value="Nocturno">Nocturno</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="workAntiquity">Antiguedad laboral:</label>
                    <input type="text" class="form-control" name="workAntiquity" placeholder="Ej: 1 año" id="workAntiquity">
                </div>
                <div class="form-group">
                    <label for="salary">Salario:</label>
                    <input type="text" class="form-control" name="salary" placeholder="Ej: 8000" id="salary">
                </div>
                <div class="form-group">
                    <label for="hasACar">Automóvil propio:</label>
                    <div class="form-check">                        
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="hasACar" value="1">Sí
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="hasACar" value="0">No
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="hasAHouse">Casa propia:</label>
                    <div class="form-check">                        
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="hasAHouse" value="1">Sí
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="hasAHouse" value="0">No
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="homePhone">Teléfono de casa:</label>
                    <input type="text" class="form-control" name="homePhone" placeholder="(686)5687941" id="homePhone">
                </div>
                <div class="form-group">
                    <label for="workphone">Teléfono laboral:</label>
                    <input type="text" class="form-control" name="workphone" placeholder="(686)5687941" id="workphone">
                </div>
                <div class="form-group">
                    <label for="cellPhone">Teléfono personal:</label>
                    <input type="text" class="form-control" name="cellPhone" placeholder="(686)5687941" id="cellPhone">
                </div>

                <button class="btn btn-primary">Enviar</button>
                </form>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>