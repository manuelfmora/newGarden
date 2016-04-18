<?php
/**
* Autor Manuel Francisco Mora Martín.
* Creación 11 nov. 2015.
* Versión XX
*/
 ?>
<?php
/**
* Se encarga de cargar la vista recibida y pasarle a dicha vista parámetros.
* @param $layout plantilla.
* @param $viewsvar variables de la vista.
* @return devulve el body de la página
*/
function LoadView($layout, array $viewsvar = NULL)
{
  $fileview = VIEW_PATH.$layout.'.php';

  if (! file_exists($fileview))
  {
    $Error = "<div>No existe</div>";
    return $Error;
  }

  if (is_array($viewsvar))
  {
    extract($viewsvar);
  }

  ob_start();
  include($fileview);
  $body = ob_get_clean();
  return $body;
}
/**
* "Escribe" la función LoadView.
* @param $vista vista a cargar.
* @param viewsvar parametros de la vista.
*/
function ShowView($view, array $viewsvar = NULL)
{
    echo LoadView($view, $viewsvar);
}

?>
