<?php
/**
* Autor Manuel Francisco Mora Martín.
* Creación 11 nov. 2015.
* Versión XX
*/
 ?>
<div class="container">

<form method="post">
     <div class="container">
    <?php if(isset($errores))
    {
      echo "<div class='alert alert-danger'>";
      foreach ($errores as $value)
      {
        echo "<li>".$value.'</li>';
      }
      echo "</div>";
    } ?>

  <div class="form-group">
    <label class="col-sm-2 control-label">Fecha de creación</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="c_date">
      <select class='form-control' name="operator">
        <option value="=">Igual</option>
        <option value="<">Menor</option>
        <option value=">">Mayor</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Descripción</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="description">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Estado</label>
    <div class="col-sm-10 radiocenter">
      <label class="radio-inline">
        <input type="radio" name="status" value="Pendiente">
      Pendiente
      </label>
      <label class="radio-inline">
        <input type="radio" name="status" value="Realizada">
      Realizada
      </label>
      <label class="radio-inline">
        <input type="radio" name="status" value="Cancelada">
      Cancelada
      </label>
    </div>
  </div>
    <center>
    <input type="submit" class="btn btn-info " type="button" name="sr" value="Buscar">
    </center>
  </form>

</div>
