<?php
/**
* Autor Manuel Francisco Mora Martín.
* Creación 11 nov. 2015.
* Versión XX
*/
 ?>
<div class="container">
    <table class="table">
        <tr>
            <td>
                <h3>ID-Tareas</h3>              
            </td>
            <td>
                <h3 >Acciones a Realizar</h3>  
            </td>
            
        </tr>
       
    </table>
  <table class="table">
     
    <?php foreach($list as $task) : ?>
      <tr>
        <td>           
          <a href="?c=Tareas&a=Show&id=<?= $task['id']?>"><?php echo $task['id'].' '.$task['descripcion'];?></a>
        </td>
        <td>
          <a href="?c=Tareas&a=Estado&id=<?= $task['id']?>"><button class="btn btn-primary right botonwidth"><?php echo $task['estado'];?></button></a>
            <?php if (isset($_SESSION['tipousuario']) && $_SESSION['tipousuario'] == 'A'):?>           
                    <a href="?c=Tareas&a=Edit&id=<?= $task['id']?>"><button class="btn btn-primary right botonwidth">Modificar</button></a>
                    <a href="?c=Tareas&a=Delete&id=<?= $task['id']?>"><button class="btn btn-danger right botonwidth">Eliminar</button></a>         
             <?php endif; ?>       
          <?php endforeach; ?>
           
        </td>
      </tr>
     
  </table>
</div>
<center>
 <?php
//Solo lo muestra si existen datos
if (!empty($list)){
     $paginacion=new Paginacion();
    $paginacion->MuestraPaginador($nPag, $totalPaginas, $myURL);

}
?>
</center>
