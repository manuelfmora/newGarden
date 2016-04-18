<?php

/**
 * MODELO de todo lo relacionado con los usuarios
 */
require_once(MODEL_PATH.'db.php');

class LoginModel 
{
    protected $db=NULL;


    public function __construct() {
        
         /* Creamos la instancia del objeto. Ya estamos conectados */
        $this->db=Db::getInstance();
    }
    
    
    /**
    * Función que comprueba que un usuario y una clave sean correctos
    * @param String $usuario Usuario a comprobar
    * @param String $clave Clave del usuario a comprobar
    * @return boolean True si la clave corresponde al usuario
    */  
    public function LoginOK($usuario, $clave) {

        $sql = "SELECT usuario as user, clave as pass
                    FROM `usuarios`
                        WHERE `usuario` LIKE '$usuario'";

        $query =$this->db->query($sql);
        
        /* Obtenemos los resultados */
       $user=$query->fetch_array(MYSQLI_ASSOC);
    
        if ($user['pass'] == $clave)
            return TRUE;
        else
            return FALSE;
    }

    /**
     * Función que inserta en la Base de Datos un nuevo usuario
     * @param Char $tipo Administrador -> A, Operario -> O
     * @param String $usuario Nombre de usuario
     * @param String $clave Contraseña de usuario
     */
    public function InsertaUsuario($tipo, $usuario, $clave) {
       

        $this->db->Insert('usuarios', array('tipo' => $tipo, 'usuario' => $usuario, 'clave' => $clave));
    }

    /**
     * Función que comprueba si un usuario está guardado en la Base de Datos a través de su nombre
     * @param String $usuario Nombre de usuario
     * @return boolean True si existe
     */
    public function ExisteUsuario($usuario) {
        
        $sql = "SELECT COUNT(*) as cont
                        FROM `usuarios`
                            WHERE `usuario` LIKE '$usuario'";

        /* Ejecutamos la query */        
        $query =$this->db->query($sql);        
        
        /* Obtenemos los resultados */
       $user=$query->fetch_array(MYSQLI_ASSOC);

        if ($user['cont'] > 0)
            return true;
        else
            return false;
    }

    /**
     * Función que comprueba si un usuario está guardado en la Base de Datos a través de su ID
     * @param Int $id Campo identificador del usuario
     * @return boolean True si existe 
     */
    public function ExisteUsuarioByID($id) {

   

        $sql = "SELECT COUNT(*) as cont
                        FROM `usuarios`
                            WHERE `id` LIKE '$id'";

         /* Ejecutamos la query */        
        $query =$this->db->query($sql);        
        
        /* Obtenemos los resultados */
       $cont=$query->fetch_array(MYSQLI_ASSOC);

        if ($cont['cont'] > 0)
            return true;
        else
            return false;
    }

    /**
     * Función que devuelve todos los usuarios guardados en la Base de Datos con los campos de id, nombre y tipo
     * @return Array Usuarios
     */
    public function GetUsuarios() {
      
        $sql = 'SELECT id as id, usuario as nombre, tipo as tipo 
                FROM `usuarios`';
        
        /* Ejecutamos la query */        
        $query =$this->db->query($sql);
        
        
        /* Obtenemos los resultados */
//       $user=$query->fetch_array(MYSQLI_ASSOC);

        
//        $bd->Consulta($sql);

        // Creamos el array donde se guardarán los usuarios
        $usuarios = Array();

        /* Realizamos un bucle para ir obteniendo los resultados */
        while ($line = $query->fetch_array(MYSQLI_ASSOC)) {
            $usuarios[] = $line;
        }
        return $usuarios;
    }

    /**
     * Función que devuelve el tipo de un usuario
     * @param String $usuario Nombre del usuario
     * @return Char A -> Administrador, O -> Operario
     */
    public function GetTipo($usuario) {
        
        $sql = "SELECT tipo
                    FROM `usuarios`
                        WHERE `usuario` LIKE '$usuario'";
        
        /* Ejecutamos la query */
        $query =$this->db->query($sql);
        
        /* Obtenemos los resultados */
       $user=$query->fetch_array(MYSQLI_ASSOC);

        return $user['tipo'];
    }

    /**
     * Función que te devuelve un usuario y su clave a través de su ID
     * @param Int $id Identificador del usuario
     * @return Array Usuario y clave
     */
    public function GetUnUsuario($id) {
        
        $sql = "SELECT usuario, clave
                    FROM `usuarios`
                        WHERE `id`=$id";

        /* Ejecutamos la query */        
        $query =$this->db->query($sql);
        
        
        /* Obtenemos los resultados */
//       $user=$query->fetch_array(MYSQLI_ASSOC);

        
//        $bd->Consulta($sql);

        // Creamos el array donde se guardarán los usuarios
        $usuario = Array();

        /* Realizamos un bucle para ir obteniendo los resultados */
        while ($line = $query->fetch_array(MYSQLI_ASSOC)) {
            $usuario[] = $line;
        }        
        return $usuario[0];
    }

    /**
     * Función que te devuelve el ID de un usuario a través de su nombre
     * @param String $usuario Nombre de usuario
     * @return Int Identificador de usuario
     */
    public function GetID($usuario) {
  
        $sql = "SELECT id
                    FROM `usuarios`
                        WHERE `usuario` LIKE '$usuario'";

        /* Ejecutamos la query */
        $query =$this->db->query($sql);
        
        /* Obtenemos los resultados */
        $user = $query->fetch_array(MYSQLI_ASSOC);     

        return $user['id'];
    }

    /**
     * Función que comprueba que un nombre exista y no corresponda al ID pasado por parámetro
     * @param String $nuevonombre Nombre de usuario
     * @param Int $id Identificador del usuario
     * @return boolean True si existe
     */
    public function ExisteNuevoNombreUsuario($nuevonombre, $id) {

     
        $sql = "SELECT COUNT(*) as cont
                        FROM `usuarios`
                            WHERE `usuario` LIKE '$nuevonombre'
                                AND `id` NOT LIKE '$id'";

        /* Ejecutamos la query */        
        $query =$this->db->query($sql);        
        
        /* Obtenemos los resultados */
       $cont=$query->fetch_array(MYSQLI_ASSOC);

        if ($cont['cont'] > 0)
            return true;
        else
            return false;
    }

    /**
     * Función que actualiza los datos de un usuario en la Base de Datos
     * @param Array $registro Datos a actualizar
     * @param Int $id Identificador del usuario
     */
    public function ModificaUsuarioEnBD($registro, $id) {
  
        /* Ejecutamos la query */        
         $this->db->Update('usuarios',$registro, $id);
        
   
    }

    /**
     * Función que borra un usuario en la Base de Datos a través de su ID
     * @param Int $id Identificador del usuario
     */
    public function EliminarUsuarioEnBD($id) {
      
        /* Ejecutamos la query */
        $this->db->delete('usuarios', $id);
    }
}
