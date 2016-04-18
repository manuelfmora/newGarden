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
	/**
	 * Función devuelve el nombre de la provincia.
	 * @param unknown $cod
	 */
        function GetNombreProvincias($cod){
                $instruccion="SELECT nombre
                FROM tbl_provincias
                        where cod=$cod";
                $result=$this->db->query($instruccion); 
                while ($fila=$this->db->obtener_fila($result,0))//strm=result
                {
                        echo $fila['nombre'];
                }
        }
        
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
            $query = $this->db->Query($sql);
            $numofitems = $query->num_rows;
            $regsnum = regsnum($numofitems);

            if ($q != null) {
                $sql = $q;
            } else {
              $sql = "SELECT * FROM tareas ORDER BY id DESC LIMIT $regsnum,$itemsforpage";
            }

            $query = $this->db->Query($sql);
            while ($row = $this->db->readReg($query))
            {
              $array[] = $row;
            }
            return $array;
          } else {
          $sql = "SELECT * FROM tareas WHERE id = $id";
          $query = $this->db->Query($sql);
          while ($row = $this->db->readReg($query))
          {
            $array[$id] = $row;
          }
          return $array;
          }
        }
        //Nueva funcion
        public function login(){
            
            session_start();
            // comprobar los argumentos recibidos
            if ($_POST["username"]=="prueba" && $_POST["password"]=="1234") {
                // usuario validado correctamente.
                // Meter en sesión y enviar a la página de inicio
                $_SESSION["usuario"] = $_POST["username"];
                header ("Location: inicio.php");
            } else {
                echo 'Error. Usuario o contraseña incorrectos'; 
                echo '<a href="c=Tareas&a=Index">Intentarlo de nuevo</a>';
            }
        }
            
           

            
        


}