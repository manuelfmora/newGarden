<?php
/**
* Autor Manuel Francisco Mora Martín.
* Creación 11 nov. 2015.
* Versión XX
*/
 ?>
<div class="container centrado">
    <p>¿Seguro que quieres borrar la tarea <?= $id ?>?</p>
    <a href="?c=Tareas&a=Delete&del=yes&id=<?= $id ?>"><button class="btn btn-default">Sí</button></a>
    <a href="?c=Tareas&a=Listar"><button class="btn btn-default">No</button></a>
</div>
