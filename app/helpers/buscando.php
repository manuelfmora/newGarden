<?php
/**
 * HELP funciones usadas en buscar
 */


class Buscando{

    /**
     * Función que genera una condición, a ejecutar en una consulta de tareas, según los campos escogidos
     * @return String Condición generada
     */
    public function CreaCondicionConsulta() {

        $condiciones = array();

        if (!EMPTY($_POST['fechac']))
            $condiciones['fc'] = 'fechac ' . $this->GetOperador($_POST['fechaC_operador']) . ' "' . $this->CambiaFormatoFecha($_POST['fechac']) . '" ';

        if (!EMPTY($_POST['fechar']))
            $condiciones['fr'] = 'fechar ' . $this->GetOperador($_POST['fechaR_operador']) . ' "' . $this->CambiaFormatoFecha($_POST['fechar']) . '" ';

        if (!EMPTY($_POST['telefono']))
            $condiciones['telefono'] = 'telefono LIKE"' . $_POST['telefono'] . '%"';

        if (!EMPTY($_POST['estado']) && $_POST['estado'] != 'defecto')
            $condiciones['estado'] = 'estado LIKE "' . $_POST['estado'] . '"';

        return implode(' AND ', $condiciones);
    }

    /**
     * Función que devuelve un operador de condición correspondiente a un texto
     * @param String $textoOperador Texto del operador
     * @return string Operador
     */
    public function GetOperador($textoOperador) {

       
        switch ($textoOperador) {
            case 'mayor': {
                    return '>';
                    break;
                }

            case 'mayorigual': {
                    return '>=';
                    break;
                }

            case 'menor': {
                    return '<';
                    break;
                }

            case 'menorigual': {
                    return '<=';
                    break;
                }

            case 'igual': {
                    return '=';
                    break;
                }

            default : {
                    return 'error';
                    break;
                }
        }
    }
    
    /**
    * Función que cambia el formato de un fecha, de dd-mm-aaa a yyyy-mm-dd
    * @param String $fecha Fecha a convertir
    * @return DateTime Fecha Cambiada
    */
   public function CambiaFormatoFecha($fecha) {

       $date = new Datetime($fecha); //Convierte a datetime

       return date_format($date, 'Y-m-d');
   }

}


