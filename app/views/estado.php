<?php
/**
* Autor Manuel Francisco Mora Martín.
* Creación 04 mayo 2016
* Versión 2.0
*/
 ?>
<?php require_once (HELPERS_PATH.'form.php');?>
<div class="container">	
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4 column">
            </div>
              <div class="col-md-6 well" style="border: 1px solid #dadada; background-color: white;">
                  <div class="container center-block">
            <form method="post" action="?c=Tareas&a=Estado&id=<?= $_GET['id']?>&u=yes">           
                    <h5>Estado de la Tarea</h5>    
                  <div class="form-group">
                     <div class="input-group">

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

                   <h5>Comentario Anterior</h5>    
                  <div class="form-group">
                     <div class="input-group">
                       <input type="text" class="form-control" placeholder="Comentarios Anterior" name="anotacionesa" autofocus value="<?php Valorpostedit($edit,$id,'anotacionesa')?>">
                     </div>
                   </div>
                   <h5>Comentario Posterior</h5>    
                  <div class="form-group">
                     <div class="input-group">
                       <input type="text" class="form-control" placeholder="Comentarios Posterior" name="anotacionesp" autofocus value="<?php Valorpostedit($edit,$id,'anotacionesp')?>">
                     </div>
                   </div>   

                     <input class="btn btn-info" type="submit" value="Confirmar" name="add">     
                 </form>  
                </div>
             </div>           
        </div>
    </div>
</div>