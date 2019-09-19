<div class="container" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-8">
            <div id="AddEmployee">
                <h3>Buscar cartera</h3>
                <?php
                echo '<form action="' . site_url('Portfolio_controller/PortfolioSearch/') . '" method="post">';
                ?>
                <div class="form-group">
                    <label for="idPortfolio">Número de cartera:</label>
                    <input type="text" class="form-control" name="idPortfolio" id="idPortfolio">
                </div>
                <div class="form-group">
                    <label for="source">Fuente:</label>
                    <input type="text" class="form-control" name="source" id="source">
                </div>
                
                <button class="btn btn-primary">Buscar</button>
                </form>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>  