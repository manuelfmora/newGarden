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
    <td><?="Descripción: ".$show[$id]['descripcion']?>
    </td>
  </tr>
  <tr>
    <td><?="Nombre: ".$show[$id]['nombre']?>
    </td>
  </tr>
  <tr>
    <td><?="Teléfono: ".$show[$id]['telefono']?>
    </td>
  </tr>
  <tr>
    <td><?="Email: ".$show[$id]['correo']?>
    </td>
  </tr>
  <tr>
    <td><?="Dirección: ".$show[$id]['direccion']?>
    </td>
  </tr>
  <tr>
    <td><?="Población: ".$show[$id]['poblacion']?>
    </td>
  </tr>
  <tr>
    <td><?="Código postal: ".$show[$id]['codigo_postal']?>
    </td>
  </tr>
  <tr>
    <td><?="Provincia: ".$show[$id]['provincia']?>
    </td>
  </tr>
  <tr>
    <td><?="Estado: ".$show[$id]['estado']?>
    </td>
  </tr>
  <tr>
    <td><?="Fecha de creación: ".$show[$id]['fechac']?>
    </td>
  </tr>
  <tr>
    <td><?="Operario encargado: ".$show[$id]['operario']?>
    </td>
  </tr>
  <tr>
    <td><?="Fecha de realización: ".$show[$id]['fechar']?>
    </td>
  </tr>
  <tr>
    <td><?="Comentarios anteriores: ".$show[$id]['anotacionesa']?>
    </td>
  </tr>
  <tr>
    <td><?="Comentarios posteriores: ".$show[$id]['anotacionesp']?>
    </td>
  </tr>
</table>
    <a href="?c=Tareas&a=Listar"><button class="btn btn-primary right botonwidth">Volver</button></a>
    
</div>