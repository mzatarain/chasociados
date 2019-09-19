<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-8">
            <div id="EditClient">
                <h3>Editar cartera</h3>
                <?php echo form_open('Portfolio_controller/update/' . $portfolio['idPortfolio']); ?>

                <div class="form-group">
                    <label for="idPortfolio">Id de Cartera:</label>
                    <input type="text" class="form-control" name="idPortfolio" id="idPortfolio" value="<?php echo ($this->input->post('idPortfolio') ? $this->input->post('idPortfolio') : $portfolio['idPortfolio']); ?>">
                </div>
                <div class="form-group">
                    <label for="source">Fuente:</label>
                    <input type="text" class="form-control" name="source" id="source" value="<?php echo ($this->input->post('source') ? $this->input->post('source') : $portfolio['source']); ?>">
                </div>
                <div class="form-group">
                    <label for="dateOfPurchase">Fecha de compra:</label>
                    <input type="text" class="form-control" name="dateOfPurchase" id="dateOfPurchase" value="<?php echo ($this->input->post('dateOfPurchase') ? $this->input->post('dateOfPurchase') : $portfolio['dateOfPurchase']); ?>">
                </div>
                <div class="form-group">
                    <label for="amountOfAccounts">Cantidad de cuentas:</label>
                    <input type="text" class="form-control" name="amountOfAccounts" id="amountOfAccounts" value="<?php echo ($this->input->post('amountOfAccounts') ? $this->input->post('amountOfAccounts') : $portfolio['amountOfAccounts']); ?>">
                </div>
                

                <button class="btn btn-primary" type="submit">Guardar</button>

                <?php echo form_close(); ?>
                <br>
                <br>
            </div>
        </div> 
    </div> 
