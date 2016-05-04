<?php 
//include_once __DIR__.'/db.php'; 
require_once(HELPERS_PATH.'form.php');
require_once(MODEL_PATH.'db.php');


class Tareas_Model
{
    private $db;
    private $tarea;
    //private  $total_paginas;
    /**
     * Constructor
     */
    public function __construct()
    {       	
            $this->db=Db::getInstance();//conexion  base de datos	
    }
    
    /**
 * Función que devuelve un array con los datos de tareas
 * @param Int $nReg Número de registro
 * @param Int $nElementosxPagina Número de elementos a mostrar por página
 * @return Array Tareas y sus datos
 */
function GetTareasList($nReg, $nElementosxPagina) {
    /* Creamos la instancia del objeto. Ya estamos conectados */
   

    $sql = 'SELECT  * FROM `tareas`  LIMIT ' . $nReg . ', ' . $nElementosxPagina;

    /* Ejecutamos la query */
    $query = $this->db->query($sql);
    // Creamos el array donde se guardarán las provincias
    $tareas = Array();

    /* Realizamos un bucle para ir obteniendo los resultados */
    while ($line = $this->db->readReg($query)) {
        $tareas[] = $line;
    }
    return $tareas;
}

     /**
    * Lista de las tareas paginadas.
    * @param $id id de la tarea si se desea sacar solo una.
    * @param $q query en caso de existir paginación.
    * @return array con la lista de tareas.
    */
    public function GetTareas($id = null, $q = null)
    {
      $array=[];
      $itemsforpage = PAGEELEMENTS;

      if (!isset($id))
      {
        $sql = "SELECT * FROM tareas";
        $query = $this->db->query($sql);
        $numofitems = $query->num_rows;
        $regsnum = regsnum($numofitems);

        if ($q != null) {
            $sql = $q;
        } else {
          $sql = "SELECT * FROM tareas ORDER BY id DESC LIMIT $regsnum,$itemsforpage";
        }

        $query = $this->db->query($sql);
        while ($row = $this->db->readReg($query))
        {
          $array[] = $row;
        }
        return $array;
      } else {
      $sql = "SELECT * FROM tareas WHERE id = $id";
      $query = $this->db->query($sql);
      while ($row = $this->db->readReg($query))
      {
        $array[$id] = $row;
      }
      return $array;
      }
    }
    /**
    * Función que devuelve el número de tareas guardadas en la Base de Datos
    * @return Int Número de tareas guardadas
    */
    public function GetNumRegistrosTareas() {
       
       /* Creamos una query sencilla */
       $sql = 'SELECT  count(*) as numRegistros FROM `tareas`';

       /* Ejecutamos la query */
        $query = $this->db->query($sql);

       /* Realizamos un bucle para ir obteniendo los resultados */
//       $line = $bd->LeeRegistro();
        $line =  $this->db->ReadReg();

       return $line['numRegistros'];
    }

      /**
    * Función que saca el número de páginas.
    * @return número de páginas.
    */
    public function NumPag()
    {
      $sql = "SELECT * FROM tareas";
      $query = $this->db->query($sql);
      $numofitems = $query->num_rows;
      $pags = pagenum($numofitems);
      return $pags;
    }

    /**
     * funcion listaProvincia(muestra la lista de las provincias)
     * @return multitype:
     */
    public function listaProvinciasParaSelect()//muestra la lista con todos los datos de nuestras tareas
    {
            $instruccion = "SELECT * FROM tbl_provincias";
            $result=$this->db->query($instruccion);

            $provincias=array();

            while ($fila=$this->db->obtener_fila($result,0))//strm=result
            {
                    $provincias[$fila['cod']]=$fila['nombre'];
            }

            return $provincias;
    }

    /**
    *funcion agregar(agrega un nuevo tarea a nuestra lista de tareas) 
    * @param unknown_type $datos
    */
     public function agregar($datos) // array datos
    {
            $campos='';
            $valores='';
            foreach ($datos as $c=>$v)
            {
                    if($campos!='')
                    {
                            $campos.=',';
                            $valores.=',';
                    }

                    $campos.='`'.$c.'`';
                    $valores.='"'.$v.'"';
            }
            $instruccion='INSERT INTO tareas ('.$campos.') VALUES ('.$valores.')';
            $result=$this->db->query($instruccion);
    }

    public function modificar($id,$datos)//modifica los datos que le pasemos segun la id
    {
            $campos='';
            $valores='';
            foreach ($datos as $c=>$v)
            {
                    if($campos!='')
                    {
                            $campos.=',';
                            $valores.=',';
                    }

                    $campos.=''.$c.'="'.$v.'"';
                    //$valores.='"'.$v.'"';
            }
            $instruccion='UPDATE `tareas` SET '.$campos.' WHERE id='.$id.';';
            $result=$this->db->query($instruccion);
    }

    public function eliminar($id,$datos)//elimina el tarea que le pasemos segun su id
    {
            $instruccion='DELETE  FROM `tareas` WHERE id='.$id;
            $result=$this->db->query($instruccion);

    }
    /**
     * funcion que devuelve los datos de un registro
     */
    public function carga_tarea($id)
    {
            $instruccion = "SELECT * FROM tareas WHERE id=".$id.";";
            $result=$this->db->query($instruccion);

            while ($fila=$this->db->obtener_fila($result,0))//strm=result
            {
                    $this->tarea[]=$fila;//x=fila
            } 

            return $this->tarea[0];//te coge el primer registro
    }
    //----------- FUNCIÓN MODIFICADA TENGO QUE QUITARLA--------------
    public function buscar($nombre,$dato)//Nos muestra los datos de la tarea que le pasemos segun el dato y valor

    {
            $instruccion="SELECT * FROM tareas WHERE $dato LIKE '%$nombre%' ";
            $result=$this->db->query($instruccion);
            $lista_tareas=array();
            while ($fila=$this->db->obtener_fila($result,0))//strm=result
            {
                    $lista_tareas[]=$fila;
            }

            return $lista_tareas;

    }
//    /**
//     * Función devuelve el nombre de la provincia.
//     * @param unknown $cod
//     */
//    public function GetNombreProvincias($cod){
//            $instruccion="SELECT nombre
//            FROM tbl_provincias
//                    where cod=$cod";
//            $result=$this->db->query($instruccion); 
//            while ($fila=$this->db->obtener_fila($result,0))//strm=result
//            {
//                    echo $fila['nombre'];
//            }
//    }

    /**
    * Modifica una tarea.
    * @param $id id de la tarea a modificar.
    * @param $array datos a modificar.
    */
    public function UpdateTask($id, $array)
    {
      $this->db->Update('tareas', $array, $id);
    }

    /**
    * Añade una tarea.
    * @param $field array con los campos a añadir.
    */
    public function AddTareas($field)
    {
      $this->db->Insert('tareas', $field);
    }

      /**
    * Saca la lista de las tareas paginadas.
    * @param $id id de la tarea si se desea sacar solo una.
    * @param $q query en caso de existir paginación.
    * @return array con la lista de tareas.
    */
    public function TaskList($id = null, $q = null)
    {

      $array=[];
      $itemsforpage = PAGEELEMENTS;

      if (!isset($id))
      {
        $sql = "SELECT * FROM tareas";
        $query = $this->db->query($sql);
        $numofitems = $query->num_rows;
        $regsnum = regsnum($numofitems);

        if ($q != null) {
            $sql = $q;
        } else {
          $sql = "SELECT * FROM tareas ORDER BY id DESC LIMIT $regsnum,$itemsforpage";
        }

        $query = $this->db->query($sql);
        while ($row = $this->db->readReg($query))
        {
          $array[] = $row;
        }
        return $array;
      } else {
      $sql = "SELECT * FROM tareas WHERE id = $id";
      $query = $this->db->query($sql);
      while ($row = $this->db->readReg($query))
      {
        $array[$id] = $row;
      }
      return $array;
      }
    }
//    //Nueva funcion
//    public function login(){
//
//        session_start();
//        // comprobar los argumentos recibidos
//        if ($_POST["username"]=="prueba" && $_POST["password"]=="1234") {
//            // usuario validado correctamente.
//            // Meter en sesión y enviar a la página de inicio
//            $_SESSION["usuario"] = $_POST["username"];
//            header ("Location: inicio.php");
//        } else {
//            echo 'Error. Usuario o contraseña incorrectos'; 
//            echo '<a href="c=Tareas&a=Index">Intentarlo de nuevo</a>';
//        }
//    }
    
    /**
    * Función que devuelve un array con los datos de las provincias
    * @return Array Provincias, código y nombre 
    */
   public function GetProvincias()
   {
         $sql = 'SELECT cod as cod, nombre as nom
                              FROM `tbl_provincias`';

       /*Ejecutamos la query*/
       $query =$this->db->query($sql);
       
       // Creamos el array donde se guardarán las provincias
       $Provincias = Array();

       /*Realizamos un bucle para ir obteniendo los resultados*/
       while ($reg = $query->fetch_array(MYSQLI_ASSOC))
       {
               $Provincias[$reg['cod']] = $reg['nom'];	 
       }
       return $Provincias;
   }

   /**
    * Función que devuelve el nombre de una provincia a través de su código
    * @param Int $cod Código de la provincia
    * @return String Nombre de la provincia
    */
   public function GetNombreProvincias($cod){

       //echo 'CODIGO PROVINCIA:'.$cod;
       /*Creamos una query sencilla*/
       $sql = 'SELECT nombre
               FROM `tbl_provincias`
                       where cod='.$cod;

       /*Ejecutamos la query*/
       $query =$this->db->query($sql);

        /* Obtenemos los resultados */
       $line=$query->fetch_array(MYSQLI_ASSOC);

       return $line['nombre'];
   }
   //-------------------------------------------------------------------------
   /**
    * Función que devuelve un array con los datos que coincidan con la búsqueda
    * @param String $condicion Requisitos que tiene que cumplir la búsqueda
    * @param Int $nReg Número de registro
    * @param Int $nElementosxPagina Número de elementos a mostrar por página
    * @return Array Tareas
    */
   public function GetBusqueda($condicion, $nReg, $nElementosxPagina) {
      $tareas='';
       /* Creamos una query sencilla */
       $sql = "SELECT * FROM `tareas` WHERE  $condicion LIMIT $nReg, $nElementosxPagina;";
       echo $sql;
        /*Ejecutamos la query*/
       $query =$this->db->query($sql);       
 

       /* Realizamos un bucle para ir obteniendo los resultados */
       while ($reg =$query->fetch_array(MYSQLI_ASSOC)) {
           $tareas[] = $reg;
       }
       return $tareas;
   }

   /**
    * Función que devuelve el número total de registros de la búsqueda
    * @param String $condicion Requisitos que tiene que cumplir la busqueda
    * @return Int Número total de regitros
    */
   public function GetNumRegistrosBusqueda($condicion) {
   
       /* Creamos una query sencilla */
       $sql = "SELECT count(*) as num FROM `tareas` WHERE  $condicion;";

       /*Ejecutamos la query*/
       $query =$this->db->query($sql);

       /* Realizamos un bucle para ir obteniendo los resultados */
       while ($reg = $query->fetch_array(MYSQLI_ASSOC)) {
           $numRegistros = $reg;
       }
       return $numRegistros['num'];
   }


           

            
        


}