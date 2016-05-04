<?php
/**
* Autor Manuel Francisco Mora Martín.
* Creación 04 mayo 2016
* Versión 2.0
*/
 ?>
<div class="container centrado">
    <p>¿Seguro que quieres borrar la tarea <?= $id ?>?</p>
    <a href="?c=Tareas&a=Delete&del=yes&id=<?= $id ?>"><button class="btn btn-default">Sí</button></a>
    <a href="?c=Tareas&a=Listar"><button class="btn btn-default">No</button></a>
</div>
