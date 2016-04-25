<?php

/**
 * HELP funciones usadas en la paginación
 */
class Paginacion{
    
    
    public function __construct() {
        
    }

        /**
     * Muestra un paginador para una lista de elementos * 
     * @param Int $pag_actual
     * @param Int $nPags
     * @param String $url
     */
        public function MuestraPaginador($pag_actual, $nPags, $url) {
        // Mostramos paginador 
        echo '<div class="paginador">';
        echo $this->EnlaceAPagina($url, 1, 'Inicio');
        echo $this->EnlaceAPagina($url, $pag_actual - 1, 'Anterior', $pag_actual > 1);
        //Números Páginas
        for ($pag = 1; $pag <= $nPags; $pag++) {
            echo $this->EnlaceAPagina($url, $pag, $pag, $pag_actual != $pag);
        }
        echo $this->EnlaceAPagina($url, $pag_actual + 1, 'Siguiente', $pag_actual < $nPags);
        echo $this->EnlaceAPagina($url, $nPags, 'Fin');


        echo "</div>";
    }

    /**
     * Devuelve un enlace a la página $url si el enlace está activo,
     * en otro caso solo devuelve el texto 
     * 
     * @param String $url		URL de la página que muestra la lista
     * @param Int $pag			Nº de página al cual enlazamos
     * @param String $texto		Texto del enlace
     * @param Bool $activo		Se muestra enlace (true) o no (false)	
     * @return String Enlace generado
     */
    public function EnlaceAPagina($url, $pag, $texto, $activo = true) {
        switch ($texto) {
            case 'Inicio': {
                    if ($activo)
                        return ' <a class="btn btn-inicio-fin" href="' . $url . 'pag=' . $pag . '" title="Página Inicial"><span class="glyphicon glyphicon-backward"></span></a>  ';
                    else
                        return ' <a class="btn btn-default"  title="Página Inicial"><span class="glyphicon glyphicon-backward"></span></a>  ';
                }
                break;

            case 'Fin': {
                    if ($activo)
                        return ' <a class="btn btn-inicio-fin" href="' . $url . 'pag=' . $pag . '" title="Página Final"><span class="glyphicon glyphicon-forward"></span></a>  ';
                    else
                        return ' <a class="btn btn-inicio-fin" title="Página Final"><span class="glyphicon glyphicon-forward"></span></a>  ';
                }
                break;

            case 'Anterior': {
                    if ($activo)
                        return ' <a class="btn btn-anterior-siguiente" href="' . $url . 'pag=' . $pag . '" title="Anterior Página"><span class="glyphicon glyphicon-chevron-left"></span></a>  ';
                    else
                        return ' <a class="btn btn-anterior-siguiente" title="Anterior Página"><span class="glyphicon glyphicon-chevron-left"></span></a>  ';
                }
                break;

            case 'Siguiente': {
                    if ($activo)
                        return ' <a class="btn btn-anterior-siguiente" href="' . $url . 'pag=' . $pag . '" title="Siguiente Página"><span class="glyphicon glyphicon-chevron-right"></span></a>  ';
                    else
                        return ' <a class="btn btn-anterior-siguiente" title="Siguiente Página"><span class="glyphicon glyphicon-chevron-right"></span></a>  ';
                }
                break;

            case is_numeric($texto): { //Números de las paginas
                    if ($activo)
                        return '  <a class="btn btn-num-paginas" href="' . $url . 'pag=' . $pag . '">' . $texto . '</a>  ';
                    else
                        return '  <a class="btn btn-num-paginas" href="' . $url . 'pag=' . $pag . '" style="font: bold 15px sans-serif;">' . $texto . '</a>  ';
                }
                break;

            default:
                return '<h1>ERROR</h1>';
                break;
        }
    }
}
