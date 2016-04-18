<?php 

/* Clase encargada de gestionar las conexiones a la base de datos */
Class Db{

 	private $link;	
        private $result;
	private $array;
        protected $conecDB=NULL;

        static $_instance;

	/*La función construct es privada para evitar que el objeto pueda ser creado mediante new*/
	private function __construct(){                 
            $this->conectar();

	}

	/*Evitamos el clonaje del objeto. Patrón Singleton*/
	private function __clone(){ }

	/*Función encargada de crear, si es necesario, el objeto.*/
	public static function getInstance(){
		if (!(self::$_instance instanceof self)){
			self::$_instance=new self();
		}
		return self::$_instance;
	}
        
        private function conectar(){
            if (file_exists('config.php')){
                
                include_once 'config.php';                             
                $this->conectado($GLOBALS['db_conf']);
            }
        }

        /*Realiza la conexión a la base de datos.*/
	private function conectado($conf){
          
            
                if (!is_array($conf)) {
                    echo "<p>Faltan parámetros de configuración</p>";
                    //var_dump($conf);                    
                    exit();
                }
                
		$this->link=mysqli_connect($conf['servidor'], $conf['usuario'], $conf['password']);
		mysqli_select_db ($this->link,$conf['base_datos']);
		mysqli_set_charset ($this->link,"utf8");            
		
	}

//	/*Método para ejecutar una sentencia sql*/
//	public function ejecutar($instruccion){
//		$this->result=mysqli_query($this->link,$instruccion);//($instruccion,$this->link)
//		return $this->result;
//	}
        
	/*Método para ejecutar una sentencia sql*/
	public function query ($instruccion){            
		$this->result=mysqli_query($this->link,$instruccion);//($instruccion,$this->link)
	
		/*si la consulta esta mal saldrá*/
		if(!$this->result)
		{
			echo "<p>Error<br/>".mysqli_error($this->link)."</p>";
			throw new Exception("</br>Error en la consulta</br>$instruccion</br>");
		}
		return $this->result;
	}
        
	/*Método para obtener una fila de resultados de la sentencia sql*/
	public function obtener_fila($stmt,$fila){
		if ($fila==0){
			$this->array=mysqli_fetch_array($stmt);
		}else{
			mysqli_data_seek($stmt,$fila);
			$this->array=mysqli_fetch_array($stmt);
		}
		return $this->array;
	}

	//Devuelve el último id del insert introducido
	public function lastID(){
		return mysqli_insert_id($this->link);
	}
        
        /**
        * Se encarga de realizar un array asociativo del resultado de una consulta.
        * @param $result resultado de una consulta.
        * @return array asociativo
        */
        public function ReadReg($result)
        {
                return $result->fetch_assoc();
        }
        
        /**
        * Actualiza la base de datos.
        * @param $table tabla que se actualiza.
        * @param $array datos que se actualizan.
        * @param $id id de la/s row a actualizar.
        */
        public function Update($table, $array, $id) {

            $str = '';
            foreach($array as $key => $value) {

                    if($str == '') {
                            $str .= $key." = '".$value."'";
                    } else {
                            $str.=", ".$key." = '".$value."'";
                    }

            }

            $sql = "UPDATE `$table` SET $str WHERE id = '".$id."'";
            $this->query($sql);

        }
    
        /**
        * Inserta en la base de datos.
        * @param $table tabla donde se insertan los datos.
        * @param $array datos que se insertan.
        */
        public function Insert($table, $array)
        {
          $keys = [];
          $values = [];

          foreach ($array as $key => $value)
          {
              $keys[] = $key;
              $values[] = '"'.$value.'"';
          }

          $keysimplode = implode(', ', $keys);
          $valuesimplode = implode(', ', $values);

          $sql = "INSERT INTO $table ($keysimplode) VALUES ($valuesimplode)";
          $this->Query($sql);
        }
        
        /**
        * Borra un registro en la Base de Datos
        * @param String $tabla Nombre de la tabla
        * @param String $id Identificador
        * @return mixed
        */
       public function delete($tabla, $id) {

           $sql = "DELETE FROM `$tabla` WHERE id=$id";

           $rs = $this->link->query($sql);
           if (!$rs) {
               $this->ShowError();
           }
           return $rs;
       }
        


}

