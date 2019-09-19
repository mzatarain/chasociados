<div class="container" style="margin-top:30px">
  
 <div class="row">
    <div class="col-sm-6">
  <h2>Ingrese sus datos de usuario</h2>
  <?php
  echo '<form action="'.site_url('Employee_controller/login_post/').'" method="post">';
  echo  '<div class="form-group">';
  echo '<label for="email">Correo electrónico:</label>';
  echo '<input type="text" class="form-control" id="email" name="email" placeholder="Ingrese Correo electrónico" autofocus required>';
  echo '</div>';
  echo '<div class="form-group">';
  echo '<label for="pwd">Contraseña:</label>';
  echo '<input type="password" class="form-control" id="password" name="password" placeholder="Ingrese contraseña" required>';
  echo '</div>';
  echo '<button class="btn btn-dark">Submit</button>';
  echo '</form>';
  ?>
</div>
  </div>
</div>
<br>