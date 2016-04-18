<?php
/**
 * CONTROLADOR del instalador
 */
class Setup{
    
    private $db_conf;


    public function CreaFichero(){
        echo 'Entra CREA FICHERO.............<br>';
        //Creamos fichero de configuración
        $fichero = fopen('config.php', 'w');

        if(! $fichero)
        {
           echo '<h1>No se puede abrir el fichero.</h1>';
        }

        $cadena ="<?php \n";        
        $cadena.= '$GLOBALS[\'db_conf\'] '."= array(
                'servidor'=>'".$_POST['servidor']."',
                'usuario'=>'".$_POST['usuario']."',
                'password'=>'".$_POST['password']."',
                'base_datos'=>'".$_POST['base_datos']."');";


        fwrite($fichero, $cadena, strlen($cadena));

        fclose($fichero);
        echo 'Entra FICHERO CREADO.............<br>';
        include_once 'config.php';
        if (file_exists('config.php')){
            echo 'Exiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiste';
        }
        
        $this->db_conf=$GLOBALS['db_conf'];
        
        $mysqli = new mysqli($this->db_conf['servidor'], 
                             $this->db_conf['usuario'],
                             $this->db_conf['password'],
                             $this->db_conf['base_datos']);
        print_r('SERVIDOR: '.$this->db_conf['servidor']);

        $mysqli->set_charset("utf8");
        

        if ($mysqli->connect_errno) {
            echo "Falló la conexión a MySQL" ;
        }
        else{
            echo 'Entra en el else de LA MULTICONSULTA..............<BR>';
            $sql = file_get_contents('../install/db.sql');        

            if ($mysqli->multi_query($sql)) {

                do {

                    if ($resultado = $mysqli->store_result()) {
                        var_dump($resultado->fetch_all(MYSQLI_ASSOC));
                        $resultado->free();
                    }
                } while ($mysqli->more_results() && $mysqli->next_result()); 
                
            } else {
                echo "Falló la multiconsulta: (" . $mysqli->errno . ") " . $mysqli->error;

            }
            $mysqli->close();
        }        
    }
}