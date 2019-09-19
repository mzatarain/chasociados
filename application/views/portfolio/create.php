<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-8">
            <div id="AddPortfolio">
                <h3>Agregar cartera</h3>
                
                <?php
                echo '<form action="' . site_url('Portfolio_controller/createPortfolio/') . '" method="post">';
                ?>
                <div class="form-group">
                    <label for="number">Número de cartera:</label>
                    <input type="text" class="form-control" name="number" id="number" >
                </div>
                <div class="form-group">
                    <label for="source">Fuente:</label>
                    <input type="text" class="form-control" name="source" id="source">
                </div>
                <div class="form-group">
                    <label for="dateOfPurchase">Fecha de compra:</label>
                    <input type="date" class="form-control" name="dateOfPurchase" id="dateOfPurchase">
                </div>
                <div class="form-group">
                    <label for="amountOfAccounts">Cantidad de cuentas:</label>
                    <input type="text" class="form-control" name="amountOfAccounts" id="amountOfAccounts">
                </div>
                <button class="btn btn-primary">Enviar</button>
                </form>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>  