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
          <a href="?c=Tareas&a=Edit&id=<?= $task['id']?>"><button class="btn btn-primary right botonwidth">Modificar</button></a>
          <a href="?c=Tareas&a=Delete&id=<?= $task['id']?>"><button class="btn btn-danger right botonwidth">Eliminar</button></a>         
          <?php endforeach; ?>
           
        </td>
      </tr>
     
  </table>
</div>
<?php if (isset($pags)):?>
<div class="text-center">

<?php if ($pags != 1): ?>

	<?php
	$path = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]."&pag=";

	if (actualPag() != 1): ?>
		<a href="<?=$path?>1">&laquo;</a>
		<a href="<?=$path.(actualPag()-1)?>">&lsaquo;</a>
	<?php endif; ?>


	<?php if ($pags != 1) :?>
		<?php for ($i = 1; $i <= $pags; $i++): ?>

			<?php if (actualPag() == $i):?>
				<a href="<?=$path.$i?>" style='border-bottom:1px solid black;'><?=$i?></a>
			<?php else: ?>
				<a href="<?=$path.$i?>"><?=$i?></a>
			<?php endif;?>

		<?php endfor;
	endif;?>

	<?php
	if (actualPag() != $pags): ?>
		<a href="<?=$path.(actualPag()+1)?>">&rsaquo;</a>
		<a href="<?=$path.$list["pages"]?>">&raquo;</a>
	<?php
		endif;
	?>


<?php endif; endif;?>

</div>