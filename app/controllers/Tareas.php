<?php
include (LIB_PATH.'GestorErrores.php');
include (HELPERS_PATH.'form.php');
include (CTRL_PATH.'setup.php');
//include (CTRL_PATH.'login.php');
include (MODEL_PATH.'TareasModel.php');
//include (MODEL_PATH.'LoginModel.php');

/**
 * Description of Tareas
 *
 * @author Manuel Francisco Mora Martín.
 */
class Tareas {
    
    protected $model=NULL;
    protected $errores=NULL;
    protected $controller=NULL;
    protected $loginmodel=NULL;

    public function __construct() {        
        $this->model=new Tareas_Model();
//        $this->loginmodel=new LoginModel();
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
            echo 'Entra No existe CONFIG.PHP<br>';
            if(!$_POST){
                echo 'Entra en NO HAY INSTALADOR<br>';
                $this->Ver('Intalador', CargaVista('setup'));
            }
            else {
                
                echo 'Entra CREAACIÓN DEL INSTALADOR.............<br>';
                $this->controller=new Setup();
                $this->controller->CreaFichero();
                if (file_exists('config.php')){
                    echo 'Entra HAY INSTALADOR Y MOSTRAMO PAGINA DE INICIO.............<br>'; 
                    
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
        $array = $this->model->GetTareas();
        $pags = $this->model->NumPag();
        $this->Ver('Listado de tareas',
                CargaVista('VistaListar', array(
                    'list'=>$array, 'pags'=>$pags)));
    }
    
     /**
    * Función que permite editar una tarea. Carga la vista "edit". Tiene en cuenta errores y si se modifica.
    */
    public function Edit()
    {
      $provincias = $this->model->listaProvinciasParaSelect();
      if (!isset($_GET['u']))
      {
        $array = $this->model->GetTareas($_GET['id']);
        $this->Ver('Modificar tarea', CargaVista('edit', array(
            'provincias'=>$provincias,
            'edit'=>$array, 
            'id'=>$_GET['id'])));
      }
      else
      {      
        $form = $this->getForm();
        $this->model->UpdateTask($_GET['id'], $form);
        $this->Inicio();
      }
     }
    /**
    * Función que permite añadir una nueva tarea. Carga la vista "addtask". Tiene en cuenta si hay errores antes de realizar dicha carga.
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
    
     /**
    * Función que muestra los datos de una tarea. Carga la vista "show".
    */   
    public function Show()
    {
      $provincias = $this->model->listaProvinciasParaSelect();
      $array = $this->model->GetTareas($_GET['id']);
      $this->Ver('Muestra tarea',  CargaVista('show', array(
          'provincias'=>$provincias,
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
      if (isset($_POST['fechar']))$field['fechar'] = $_POST['fechar'];
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

      if(!isset($array['fechac']) || $array['fechac'] == "")
      {
        $errores[] = "El campo 'Fecha de realización' debe estar relleno.";
        $error = true;
      } else {
        if (!preg_match($fecha, $array['fechac']))
        {
          $errores['formato'] = "Formato de fecha incorrecto. AAAA-MM-DD";
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
        if (!preg_match($telefono, $array['telefono']))
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
        if (!preg_match($email, $array['correo']))
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

      if($error)
      {
        return $errores;
      } else {
        return NULL;
      }
    }
    
    public function Buscar() {

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
    
    


    
}
