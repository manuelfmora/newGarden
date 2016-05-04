<?php
/**
* Autor Manuel Francisco Mora Martín.
* Creación 04 mayo 2016
* Versión 2.0
*/
 ?>
<?php require_once (HELPERS_PATH.'form.php');?>
<form method="post" action="" >
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
  <!-- -------------------------------- -->
    <fieldset>
      <legend>Datos de la tarea</legend>
      <div class="form-group">
        <label class="col-sm-2 control-label">Descripción</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="descripcion" value="<?php ValorPost('descripcion')?>">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Operario encargado</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="operario" value="<?php ValorPost('operario')?>">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Fecha de realización</label>
        <div class="col-sm-10">
          <input type="hidden" name="estado" value="Pendiente"><!--Introducimos en Estado como Pendiente -->
          <input type="text" class="form-control" name="fechar" value="<?php ValorPost('fechar')?>">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Comentarios previos</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="anotacionesa" value="<?php ValorPost('anotacionesa')?>">
        </div>
      </div>

    </fieldset>
  <!-- -------------------------------- -->
    <fieldset>
      <legend>Datos del cliente</legend>
      <div class="form-group">
        <label class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="nombre" value="<?php ValorPost('nombre')?>">
        </div>
      </div>      
      <div class="form-group">
        <label class="col-sm-2 control-label">Teléfono</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="telefono" value="<?php ValorPost('telefono')?>">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Correo electrónico</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="correo" value="<?php ValorPost('correo')?>">
        </div>
      </div>

    </fieldset>
  <!-- -------------------------------- -->
    <fieldset>
      <legend>Datos del jardín</legend>
      <div class="form-group">
        <label class="col-sm-2 control-label">Dirección</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="direccion" value="<?php ValorPost('direccion')?>">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Población</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="poblacion" value="<?php ValorPost('poblacion')?>">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Código postal</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="codigo_postal" value="<?php ValorPost('codigo_postal')?>">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Provincia</label>
        <div class="col-sm-10">
          <?php echo CreaSelect('provincia',$provincias); ?>
        </div>
      </div>
    </fieldset>
  <!-- -------------------------------- -->
    <div>
        <br><br>
        <center>
      <input class="btn btn-primary " type="submit" value="Confirmar" name="add">
      <a href="?c=Tareas&aInicio="><button class="btn btn-danger" type="button">Cancelar</button></a>
      </center>
    </div>
  </div>
</form>
