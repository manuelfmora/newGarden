<?php
include (LIB_PATH.'GestorErrores.php');
include (HELPERS_PATH.'form.php');
include (CTRL_PATH.'setup.php');
include (MODEL_PATH.'TareasModel.php');


/**
 * Description of Tareas
 *
 * @author Manuel Francisco Mora Martín.
 */
class Tareas {
    
    protected $model=NULL;
    protected $errores=NULL;
    protected $controller=NULL;
    protected $controllerlogin=NULL;

    public function __construct() {        
        $this->model=new Tareas_Model();       
        // El gestor solo sería necesario crearlo si editamos o insertamos
        // Inicializamos el gestor de errores que utilizaremos en la vista
        $this->errores=new GestorErrores(
                '<span style="color:red; background:#EEE; padding:.2em 1em; margin:1em">', '</span>');
    }
    
    /**
     * Vamos a la página de inicio igualmente
     */
    public function Index()
    {
        $this->Inicio();
    }
    
    public function Inicio()
    {
        if (!file_exists('config.php')) { //Si no existe el fichero de configuración, accede al instalador
            
            if(!$_POST){
               
                $this->Ver('Intalador', CargaVista('setup'));
            }
            else {
                
               
                $this->controller=new Setup();
                $this->controller->CreaFichero();
                if (file_exists('config.php')){
                    
                    
                    $this->Ver('Página de inicio', CargaVista('inicio'));
                }
                
            }
            
        } else {
                
                $this->Ver('Página de inicio', CargaVista('inicio'));
        }
    } 
    
    /**
     * Muestra la lista de tareas
     */
    public function Listar()
    { 
        if (!isset($_SESSION['loginok'])) {
            //Si no esta logeado cargamos la vista de login.
            include (CTRL_PATH.'login.php');
            $this->controllerlogin=new Login();
            $this->controllerlogin->login();
            
        } else {
            $array = $this->model->GetTareas();
            $pags = $this->model->NumPag();
            $this->Ver('Listado de tareas',
                    CargaVista('VistaListar', array(
                        'list'=>$array, 'pags'=>$pags)));
        }
    }
    
     /**
    * Función que permite editar una tarea. Carga la vista "edit". Tiene en cuenta errores y si se modifica.
    */
    public function Edit()
    {
      $provincias = $this->model->listaProvinciasParaSelect();
      if (isset($_GET['u']))
      {
        $form = $this->getForm();
//        $this->model->UpdateTask($_GET['id'], $form);
//        $this->Listar();        
        $errores = $this->getErrores($form);

        if($errores != NULL)
        {
                        
             $array = $this->model->GetTareas($_GET['id']);
             $this->Ver('Modificar tarea', CargaVista('edit', array(
            'provincias'=>$provincias,
            'errores'=>$errores,
            'edit'=>$array,//Agregamos el formulario sin pasar por la BD. 
            'id'=>$_GET['id'])));
             
    
        }
        else
        {
            echo 'ENTRA EN GUARDAR';
            $form = $this->getFormok();
            $this->model->UpdateTask($_GET['id'], $form);
            $this->Listar();
        }
      }
      else
      {
          echo 'ENTRA EN LA PRIMERA EDICIÓN';
        $array = $this->model->GetTareas($_GET['id']);
        $this->Ver('Modificar tarea', CargaVista('edit', array(
            'provincias'=>$provincias,
            'edit'=>$array, 
            'id'=>$_GET['id'])));
      } 
      
    }
    /**
    * Función que permite añadir una nueva tarea. 
    */
    public function Add()
    {
      $provincias = $this->model->listaProvinciasParaSelect();
      if (isset($_POST['add']))
      {
        $form = $this->getForm();
        $errores = $this->getErrores($form);

        if($errores != NULL)
        {
          $this->Ver('Añadir Tarea', CargaVista('add', array(
              'provincias'=>$provincias,
              'errores'=>$errores)));
        }
        else
        {
          $this->model->AddTareas($form);
          $this->Inicio();
        }
      }
      else
      {
        $this->Ver('Añadir Tarea', CargaVista('add',array(
            'provincias'=>$provincias)));
      }
    }
    
    /**
     * Muestra el resultado del controlador dentro de la plantilla
     * @param type $html
     */
    protected function Ver($titulo, $html)
    {
        MuestraVista('plantilla/layout', array(
            'titulo'=>$titulo,
            'menu'=>CargaVista('plantilla/menu'),
            'cuerpo'=>$html,
        ));
    }
    
    /**
     * Funcion que muestra Ver desde Login.php
     * @param type $titulo
     * @param type $html
     */
    public function Verfuera($titulo,$html){
        $this->Ver($titulo, $html);
    }


    /**
     * Realiza el filtrado de campos y almacena los errores en el gestor de errores
     * @param GestorErrores $this->errores
     */
    function FiltraCamposPost()
    {
        // Filtramos el nombre
        if (VPost('nombre')=='')
        {
            $this->errores->AnotaError('nombre', 'Se debe introducir texto');
        } 
        else if ( strlen(VPost('nombre'))<5)
        {
            $this->errores->AnotaError('nombre', 'El nombre debe tener al menos 5 letras');
        }

        // Filtramos la prioridad
        $prioridad=VPost('prioridad');
        if ($prioridad=='')
        {
            $this->errores->AnotaError('prioridad', 'Se debe introducir texto');
        } 
        else if ( !is_numeric($prioridad) || ($prioridad<1 || $prioridad>5))
        {
            $this->errores->AnotaError('prioridad', 'La prioridad debe ser un número entre 1 y 5');
        }
    }
    
    public function getProvincia($prov){
                    
      return $this->model->GetNombreProvincias($prov);
        
    }
    public function getFechac($fec){
       
        $date = new DateTime($fec);
       return date_format($date, 'd-m-Y') ;         
        
    }
    
     public function getFechar($fec){
      
       $date = new DateTime($fec);
       return date_format($date, 'd-m-Y') ;  
        
     }

    /**
    * Función que muestra los datos de una tarea. Carga la vista "show".
    */   
    public function Show()
    {
        $id=$_GET['id'];
        $array = $this->model->GetTareas($id);
        $this->Ver('Muestra tarea',  CargaVista('show', array(
            'provincias'=>  $this->getProvincia($array[$id]['provincia']),
            'fechac'=>  $this->getFechac($array[$id]['fechac']),
            'fechar'=>  $this->getFechar($array[$id]['fechar']),
            'show'=>$array, 
            'id'=>$_GET['id'])));
      
    }
      /**
    * Función que permite modificar el estado de una tarea, así como sus comentarios. Carga la vista "statusview".
    */
    public function Estado()
    {
      if (!isset($_GET['u']))
      {
          $array = $this->model->GetTareas($_GET['id']);             
          $this->Ver('Cambiar estado de la tarea', CargaVista('estado',array(
              'id'=>$_GET['id'],
              'edit'=>$array)));
      }
      else
      {                
        $form = $this->getForm();      
        $this->model->UpdateTask($_GET['id'], $form);
        $this->Inicio();
      }
    }
  
    /**
    * Función que permite borrar una determinada tarea. Carga la vista "deleteview".
    */
    public function Delete()
    {
      if (!isset($_GET['del']))
      {
        $this->Ver('Borrar Tarea', CargaVista('delete', array(
            'id'=>$_GET['id'])));
      }
      else
      {
        $this->model->DeleteTask($_GET['id']);
        $this->Inicio();
      }
    }
  
    /**
    * Función que saca la información de un formulario.
    * @return devuelve un array con todos los campos del formulario indexados.
    */
    private function getForm()
    {
      if (isset($_POST['descripcion']))$field['descripcion'] = $_POST['descripcion'];
      if (isset($_POST['nombre']))$field['nombre'] = $_POST['nombre'];    
      if (isset($_POST['telefono']))$field['telefono'] = $_POST['telefono'];
      if (isset($_POST['correo']))$field['correo'] = $_POST['correo'];
      if (isset($_POST['direccion']))$field['direccion'] = $_POST['direccion'];
      if (isset($_POST['poblacion'])){$field['poblacion'] = $_POST['poblacion'];}
      if (isset($_POST['codigo_postal'])){$field['codigo_postal'] = $_POST['codigo_postal'];}
      if (isset($_POST['provincia']))$field['provincia'] = $_POST['provincia'];
      if (isset($_POST['estado'])){$field['estado'] = $_POST['estado'];}
      if (isset($_POST['fechac']))$field['fechac'] = $_POST['fechac'];
      if (isset($_POST['operario']))$field['operario'] = $_POST['operario'];
      if (isset($_POST['fechar']))$field['fechar'] =  $_POST['fechar'];
      if (isset($_POST['anotacionesa'])){$field['anotacionesa'] = $_POST['anotacionesa'];}
      if (isset($_POST['anotacionesp'])){$field['anotacionesp'] = $_POST['anotacionesp'];}

      return $field;  

    }
    private function getFormok()
    { 
      
      if (isset($_POST['fechar']))$dateR = new Datetime($_POST['fechar']);
      if (isset($_POST['fechac']))$dateC = new Datetime($_POST['fechac']);
      if (isset($_POST['descripcion']))$field['descripcion'] = $_POST['descripcion'];
      if (isset($_POST['nombre']))$field['nombre'] = $_POST['nombre'];    
      if (isset($_POST['telefono']))$field['telefono'] = $_POST['telefono'];
      if (isset($_POST['correo']))$field['correo'] = $_POST['correo'];
      if (isset($_POST['direccion']))$field['direccion'] = $_POST['direccion'];
      if (isset($_POST['poblacion'])){$field['poblacion'] = $_POST['poblacion'];}
      if (isset($_POST['codigo_postal'])){$field['codigo_postal'] = $_POST['codigo_postal'];}
      if (isset($_POST['provincia']))$field['provincia'] = $_POST['provincia'];
      if (isset($_POST['estado'])){$field['estado'] = $_POST['estado'];}
      if (isset($_POST['fechac']))$field['fechac'] =  date_format($dateC, 'Y-m-d');
      if (isset($_POST['operario']))$field['operario'] = $_POST['operario'];
      if (isset($_POST['fechar']))$field['fechar'] =  date_format($dateR, 'Y-m-d');
      if (isset($_POST['anotacionesa'])){$field['anotacionesa'] = $_POST['anotacionesa'];}
      if (isset($_POST['anotacionesp'])){$field['anotacionesp'] = $_POST['anotacionesp'];}

      return $field;  

    }
    private function getErrores($array)
    {
      $errores = [];
      $error = false;
      $telefono = "/[0-9\s+_]$/";
      $email = "/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/";
      $fecha = "/^\d{4}\-\d{2}\-\d{2}$/";
      
      if(!isset($array['descripcion']) || $array['descripcion'] == "")
      {
        $errores[] = "El campo 'Descripción' debe estar relleno.";
        $error = true;
      }

      if(!isset($array['operario']) || $array['operario'] == "")
      {
        $errores[] = "El campo 'Operario encargado' debe estar relleno.";
        $error = true;
      }
      $a=$this->FechaCorrecta($array['fechar']);

      print_r($a);
      if(!isset($array['fechar']) || $array['fechar'] == "")
      {
        $errores[] = "El campo 'Fecha de realización' debe estar relleno.";
        $error = true;
      } else {
        if (!$this->FechaCorrecta($array['fechar']))
        {
          $errores['formato'] = "Formato de fecha incorrecta o fecha introducida anterior a la actual";
          $error = true;
        }
      }

      if(!isset($array['nombre']) || $array['nombre'] == "")
      {
        $errores[] = "El campo 'Nombre' debe estar relleno.";
        $error = true;
      }
      
      
      
      if(!isset($array['telefono']) || $array['telefono'] == "")
      {
        $errores[] = "El campo 'Teléfono' debe estar relleno.";
        $error = true;
      } else {
        if (!$this->FormatoCorrectoTelefono($array['telefono']))
        {
          $errores[] = "El formato de 'Teléfono' es incorrecto. Debe ser un telefono español.";
          $error = true;
        }
      }

      if(!isset($array['correo']) || $array['correo'] == "")
      {
        $errores[] = "El campo 'Correo electrónico' debe estar relleno.";
        $error = true;
      } else {
        if (!$this->FormatoCorrectoCorreo($array['correo']))
        {
          $errores[] = "El formato de 'Email' es incorrecto.";
          $error = true;
        }
      }

      if(!isset($array['direccion']) || $array['direccion'] == "")
      {
        $errores[] = "El campo 'Dirección' debe estar relleno.";
        $error = true;
      }

      if(!isset($array['poblacion']) || $array['poblacion'] == "")
      {
        $errores[] = "El campo 'Población' debe estar relleno.";
        $error = true;
      }
      if(!isset($array['codigo_postal']) || $array['codigo_postal'] == "")
      {
        $errores[] = "El campo 'Codigo Postal' debe estar relleno.";
        $error = true;
      } else {
        if (!$this->FormatoCorrectoCP($array['codigo_postal'] ))
        {
          $errores[] = "El formato de 'Codigo Postal' es incorrecto.";
          $error = true;
        }
      }

      if($error)
      {
        return $errores;
      } else {
        return NULL;
      }
    }
    
    /**
    * Función que comprueba que el formato de teléfono sea correcto.
    * El teléfono debe empezar por 9, 8, 6 o 7 seguidor de 8 dígitos del 0 al 9
    * @param String $telefono Número de teléfono
    * @return boolean True si el formato es correcto
    */
   public function FormatoCorrectoTelefono($telefono) {

       $telefono = str_replace(' ', '', $telefono); //devuelve cadena sin espacios
       $telefono = str_replace('-', '', $telefono); //devuelve cadena sin guiones

       $expresion = '/^[9|8|6|7][0-9]{8}$/'; //formato español

       if (preg_match($expresion, $telefono)) {
           return TRUE;
       } else {
           return FALSE;
       }
   }

   /**
    * Función que comprueba si una dirección de email/correo es correcta
    * @param String $correo Email/correo a comprueba
    * @return boolean True si es correcto
    */
   public function FormatoCorrectoCorreo($correo) {

       if (filter_var($correo, FILTER_VALIDATE_EMAIL))
           return TRUE;
       else
           return FALSE;
   }

   /**
    * Funció que comprueba que el código postal tenga 5 números
    * @param String $cp Código Postal
    * @return boolean True si es correcto
    */
   public function FormatoCorrectoCP($cp) {
       $patron = '/^[0-9]{5}$/'; //solo 5 números

       if (preg_match($patron, $cp))
           return TRUE;
       else
           return FALSE;
   }

   /**
    * Función que comprueba que si la fecha tiene el formato correcto sea mayor a la actual
    * @param String $fecha Fecha a comprobar
    * @return boolean True si es correcto
    */
   public function FechaCorrecta($fecha) {
       
       if ($this->FormatoFechaCorrecto($fecha)) {//si el formato es correcto, comprobamos que la fecha de realización sea posterior a la de hoy
           if (strtotime($fecha) > strtotime(date('d-m-Y')))//la fecha es correcta
               return TRUE;
           else
               return FALSE;
       } else
           return FALSE;
   }

   /**
    * Función que comprueba que el formato de una fecha sea correecto
    * Formato --> dd-mm-aaaa
    * @param String $fecha Fecha a comprobar
    * @return boolean True si es correcto
    */
   public function FormatoFechaCorrecto($fecha) {
       $DIA = 0;
       $MES = 1;
       $YEAR = 2;

       $array_fecha = explode("-", $fecha);

       if (count($array_fecha) != 3){
          
           return FALSE;
       }
       else {
           error_reporting(E_ERROR);
           $dia = $array_fecha[$DIA];
           $mes = $array_fecha[$MES];
           $year = $array_fecha[$YEAR];

           return checkdate($mes, $dia, $year);
       }
   }

    /**
     * Funcion que permite hacer una busqueda por los diferentes campos.
     */
    public function Buscar() {
        
    
        if (!isset($_SESSION['loginok'])) {
            //Si no esta logeado cargamos la vista de login.
            include (CTRL_PATH.'login.php');
            $this->controllerlogin=new Login();
            $this->controllerlogin->login();
            
        } else {           

                if (isset($_POST["sr"])) {

                      if (empty($_POST["description"]) && empty($_POST["c_date"]) && empty($_POST["status"])) {

                              echo "No has buscado por ningún campo";

                      } else {

                  $query = "SELECT * FROM tareas WHERE ";
                              $num = 0;

                              if (!empty($_POST["c_date"])) {
                                  $c_date= $_POST["c_date"];
                                      //$c_date = formatDate($_POST["c_date"]);
                                      $operator = $_POST["operator"];
                                      if ($num != 0) {
                                              $query .= " and ";
                                      }
                                      $query .= "fechac $operator '$c_date'";
                                      $num++;
                              }

                  if (!empty($_POST["status"])) {
                    $status = $_POST["status"];
                    if ($num != 0) {
                      $query .= " and ";
                    }
                    $query .= "estado = '$status'";
                    $num++;
                  }

                  if (!empty($_POST["description"])) {
                    $description = $_POST["description"];
                    if ($num != 0) {
                      $query .= " and ";
                    }
                    $query .= "descripcion LIKE '%$description%'";
                    $num++;
                  }

                              $array = $this->model->TaskList(null,$query);

                        $this->Ver('Resultados tareas', CargaVista('VistaListar', array(
                            'list'=>$array)));

                      }

            } else {
              $this->Ver('Buscar', CargaVista('buscar'));
            }
        
    }
      
      
    }//Fin buscar
    
}
