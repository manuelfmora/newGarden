<?php
/**
* Autor Manuel Francisco Mora Martín.
* Creación 11 nov. 2015.
* Versión XX
*/
 ?>
<?php require_once (HELPERS_PATH.'form.php');?>
<form method="post" action="?c=Tareas&a=Estado&id=<?= $_GET['id']?>&u=yes">
  <div class="container">

    <div class="form-group">
      <label class="col-sm-2 control-label">Estado</label>
      <div class="col-sm-10 radiocenter">
        <label class="radio-inline">
          <input type="radio" name="estado" value="Pendiente">
        Pendiente
        </label>
        <label class="radio-inline">
          <input type="radio" name="estado" value="Realizada">
        Realizada
        </label>
        <label class="radio-inline">
          <input type="radio" name="estado" value="Cancelada">
        Cancelada
        </label>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Comentarios Anteriores</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="anotacionesa" value="<?php Valorpostedit($edit,$id,'anotacionesa')?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Comentarios posteriores</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="anotacionesp" value="<?php Valorpostedit($edit,$id,'anotacionesp')?>">
      </div>
    </div>
    <div class="container centrado">
      <input class="btn btn-default btn-lg" type="submit" value="Confirmar" name="add">
    </div>
  </div>
</form>
