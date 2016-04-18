<?php
/**
* Autor Manuel Francisco Mora Martín.
* Creación 11 nov. 2015.
* Versión XX
*/
 ?>
<div class="container">

<form method="post">

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
  <div class="container centrado">
    <input type="submit" class="btn btn-default btn-lg" type="button" name="sr" value="Buscar">
  </div>
  </form>

</div>
