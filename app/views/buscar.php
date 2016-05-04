<?php
/**
* Autor Manuel Francisco Mora Martín.
* Creación 03 mayo 2016.
* Versión 2.0
*/
 ?>

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

<div class="container">
    <form action="" class="form-group" method="POST">

        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="list-group-item-heading"><b>Buscar Tarea</b></h3></div>

            <div class="panel-body">

                <div class="row">
                    <!-- 1ª COLUMNA -->
                    <div class="col-md-3">                      

                        <p style="font-size: 14pt; float: left;"><b>Fecha Creación</b></p>

                        <p><?php echo CreaSelect('fechaC_operador', $opcionesfecha, ' style=" width: 90px;" ') ?></p>                            

                        <input type="text" class="form-control" placeholder="dd-mm-yyyy" name="fechac" value="<?= ValorPost('fechac') ?>">


                    </div>

                    <!-- 2ª COLUMNA -->
                    <div class="col-md-3">

                        <p style="font-size: 14pt; float: left;"><b>Fecha Realización</b></p>

                        <p><?php echo CreaSelect('fechaR_operador', $opcionesfecha, ' style=" width: 90px;" ') ?></p>                             

                        <input type="text" class="form-control" placeholder="dd-mm-yyyy" name="fechar" value="<?= ValorPost('fechar') ?>">

                    </div>

                    <!-- 3ª COLUMNA -->
                    <div class="col-md-3">
                        <div style="font-size: 13pt;">

                            <p style="font-size: 14pt;"><b>Estado</b></p>

                            <p><?php echo CreaSelectVacio('estado', array('pendiente' => 'Pendiente', 'realizada' => 'Realizada', 'cancelada' => 'Cancelada')) ?> </p>

                        </div>								
                    </div>

  

                    <!-- 5ª COLUMNA -->
                    <div class="col-md-2">

                        <p style="font-size: 14pt;"><b>Teléfono</b></p>
                        <p><input type="text" class="form-control" placeholder="Teléfono" name="telefono" value="<?= ValorPost('telefono') ?>">	</p>
                        <input type="hidden" name="ok">
                            
                    </div>					
                </div><!-- fin row -->
            
                <!-- BOTON BUSCAR -->
                <p>
                <center>
                    
                    <button type="submit" class="btn btn-comun"><span class="glyphicon glyphicon-search"></span> Búsqueda</button>
                </center>

                </p>
            </div><!-- fin panel-body -->
        </div> <!-- fin panel-default -->		
    </form> 
</div><!-- fin container -->


<?php if(!isset($errores)):?> 
<?php if (isset($_GET['pag'])||isset($_POST['ok'])):?> 

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
   
       <?php  $paginacion=new Paginacion();?> 
      
       <?php $paginacion->MuestraPaginador($nPag, $totalPaginas, $myURL);?> 



</center>
<?php endif; ?>  
<?php endif; ?>  