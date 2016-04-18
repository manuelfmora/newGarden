<?php
/**
 * CONTROLADOR de login de usuario
 */
include_once (MODEL_PATH.'LoginModel.php');
include_once (CTRL_PATH.'Tareas.php');
include_once (HELPERS_PATH.'user.php');



class Login {
    
    protected $controller=NULL;
    protected $model=NULL;
    

    public function __construct(){
        
      $this->model=new LoginModel();
      $this->controller=new Tareas();
   
        
    }
    
    public function CreaLogin(){
          
        if ($this->model->LoginOK($_POST['usuario'], $_POST['clave'])) {//Sesión correcta
            
            //Si el login es correcto creamos la SESSION.
            $_SESSION['usuario'] = $_POST['usuario'];
            $_SESSION['loginok'] = "TRUE";
            $_SESSION['horainicio'] = date('h:i:s');
            $_SESSION['tipousuario'] =  $this->model->GetTipo($_POST['usuario']);
            $_SESSION['idusuario'] = $this->model->GetID($_POST['usuario']);
            
            header('Location: index.php');
            
        } else {
            
            return $loginok = FALSE; //Variable usada para mostrar error en la vista
           
        }            
     
    }
    
    /**
    * Muestra la pantalla para logearse
    */
    public function login(){

       if (!EMPTY($_POST['usuario']) && !EMPTY($_POST['clave'])){

           $loginok=$this->CreaLogin();

           if($loginok==FALSE ){
               echo 'ENTRA EN SESSION_LOGIN FALSE...................<BR>';
              $this->controller->Verfuera('Login',
                   CargaVista('login', array( 'loginok'=>$loginok )));

           }  
       }
       $this->controller->Verfuera('Login',
                   CargaVista('login', array()));
    }
    
    /**
    * Función que cierra la sesión
    */
    public function closeSession(){
        
       session_unset();
       session_destroy();

       header('Location: index.php');
    }
    
    /**
    * Funcion edita un usuario
    */
    public function userEdit(){ 
        
       
        if(! isset($_SESSION['loginok']) || ! isset($_GET['id'])){//Si no está iniciada la sesión o no se le pasa id muestra error

          include_once CTRL_PATH.'error404.php';
        }
        else if ($_SESSION['tipousuario'] != 'A'){//Solo puede eliminar usuarios los administradores
         include_once CTRL_PATH.'error404.php';
        }
        else{
            $correcto = true;
            $errores = array();  

            if(!$this->model->ExisteUsuarioByID($_GET['id'])){
           
                 include_once CTRL_PATH.'error404.php';
            }
            else{
                if(! isset($_POST['modificarusuario'])){

                     $this->controller->Verfuera('Edita Usuario',
                                        CargaVista('userEdit', array( ))); 
                    
                }            
                else{                   
  
                    if($_POST['clave'] != EscribeCampoUsuario($_GET['id'], 'clave')){ //CLAVE INTRODUCIDA CORRECTA
                        $correcto = FALSE;
                        $errores['claveincorrecta'] = TRUE;
                    }
                    else if($_POST['clavenueva'] != $_POST['clavenuevarep']){ //CLAVES NUEVAS IGUALES
                        $errores['clavesdistintas'] = TRUE;
                        $correcto = FALSE;
                    }
                    else if($this->model->ExisteNuevoNombreUsuario($_POST['usuario'], $_GET['id'])){//Comprobar que el nuevo nombre no sea uno de los usuarios ya guardados
                        $errores['existenuevonombre'] = TRUE;
                        $correcto = FALSE;
                    }

                    if(!$correcto){
                       
                        $this->controller->Verfuera('Edita Usuario',
                                        CargaVista('userEdit', array('errores'=>$errores ))); 
                    }
                    else {                       
                        $_SESSION['usuario'] = $_POST['usuario'];
                        if(empty($_POST['clavenueva']) && empty($_POST['clavenuevarep']))//Si estan vacias las dos claves, solo se modificar el nombre de usuario
                           $this->model->ModificaUsuarioEnBD(array('usuario'=>$_POST['usuario']), $_GET['id']);              

                        else
                             $this->model->ModificaUsuarioEnBD(array('usuario' => $_POST['usuario'], 'clave' => $_POST['clavenueva']), $_GET['id']);


                         $this->userList();

                    }

                }
            }
        }

        
    }
    
    /**
    * CONTROLADOR de modificar usuario de tipo operario
    */
    public function userEdit_O(){
        
       if(! isset($_SESSION['loginok']) || ! isset($_GET['id'])){//Si no está iniciada la sesión o no se le pasa id muestra error

           include_once CTRL_PATH.'error404.php';
       }
       else if ($_SESSION['tipousuario'] != 'O' || $_SESSION['idusuario']!= $_GET['id']){//solo puede modificar si es operario 
                                                                                           // y si el id que llega es el suyo
           include_once CTRL_PATH.'error404.php';
       }
       else{

           $correcto = true;
           $errores = array();

//           include_once MODEL_PATH.'login.php';
//           include_once HELP_PATH.'help_usuarios.php';

           if(!$this->model->ExisteUsuarioByID($_GET['id'])){
                   include_once CTRL_PATH.'error404.php';
           }
           else{
               if(! isset($_POST['modificarusuario']))
                   $this->controller->Verfuera('Edita Operario',
                                        CargaVista('userEdit_O', array( )));
               else{

                   if($_POST['clave'] != EscribeCampoUsuario($_GET['id'], 'clave')){ //CLAVE INTRODUCIDA CORRECTA
                       $correcto = FALSE;
                       $errores['claveincorrecta'] = TRUE;
                   }
                   else if($_POST['clavenueva'] != $_POST['clavenuevarep']){ //CLAVES NUEVAS IGUALES
                       $errores['clavesdistintas'] = TRUE;
                       $correcto = FALSE;
                   }
                   else if($this->model->ExisteNuevoNombreUsuario($_POST['usuario'], $_GET['id'])){//Comprobar que el nuevo nombre no sea uno de los usuarios ya guardados
                       $errores['existenuevonombre'] = TRUE;
                       $correcto = FALSE;
                   }

                   if(!$correcto)
                        $this->controller->Verfuera('Edita Operario',
                                        CargaVista('userEdit_O', array('errores'=>$errores )));
                   else {
                       $_SESSION['usuario'] = $_POST['usuario'];

                       if(empty($_POST['clavenueva']) && empty($_POST['clavenuevarep']))//Si estan vacias las dos claves, solo se modificar el nombre de usuario
                           $this->model->ModificaUsuarioEnBD(array('usuario'=>$_POST['usuario']), $_GET['id']);
                       else
                           $this->model->ModificaUsuarioEnBD(array('usuario' => $_POST['usuario'], 'clave' => $_POST['clavenueva']), $_GET['id']);

                        header('Location: index.php');
                   }

               }
           }
       }



    }
    
   /**
    * Funcion inserta un usuario
    */
    public function userInsert(){
         
//        include_once HELP_PATH.'helps.php';
        //Si no está iniciada la sesión muestra error
        if (!isset($_SESSION['loginok'])) {
            
          include_once CTRL_PATH . 'error404.php';
         //Solo añadir usuarios los administradores
        } else if ($_SESSION['tipousuario'] != 'A') {
          
            include_once CTRL_PATH . 'error404.php';
            
        } else {
            
            $correcto = true;
            $errores = array();

            if (!isset($_POST['isertuser'])){
                
                $this->controller->Verfuera('Añade Usuario',
                    CargaVista('userInsert', array( ))); 
            }
            else {
                               
                if (!EMPTY($_POST['usuario']) && !EMPTY($_POST['clave']) && !EMPTY($_POST['claverepetida'])){
                    
                    if ($this->model->ExisteUsuario($_POST['usuario'])) {
                        
                        $errores['existeusuario'] = TRUE;
                        $correcto = FALSE;
                        
                    } else if ($_POST['clave'] != $_POST['claverepetida']) {//Si el usuario no existe, comprueba que las claves sean iguales
                       
                        $errores['clavesdistintas'] = TRUE;
                        $correcto = FALSE;
                    }

                    if (!$correcto) {
                        
                        $this->controller->Verfuera('Añade Usuario',
                              CargaVista('userInsert', array('errores'=>$errores )));
                        
                    } else {
                        $this->model->InsertaUsuario($_POST['tipo'], $_POST['usuario'], $_POST['clave']);
                        
                        //Muestra la lista de usuarios.
                        $this->userList();
                    }
                }
                else{
                    echo 'ENTRA EN EL ELSE DE LOS ERRORES';
                        $this->controller->Verfuera('Añade Usuario',
                                 CargaVista('userInsert', array( )));
                }
            }
        }       
    }
    /**
    * CONTROLADOR de listar usuarios
    */
    public function userList(){
        
       
        if(! isset($_SESSION['loginok'])){//Si no está iniciada la sesión muestra error

            include_once CTRL_PATH.'error404.php';
        }
        else if ($_SESSION['tipousuario'] != 'A'){//Solo puede ver la lista de usuarios los administradores
            include_once CTRL_PATH.'error404.php';
        }
        else{

            include_once HELPERS_PATH.'user.php';
            
            $user =  $this->model->GetUsuarios();
            
            $this->controller->Verfuera('Lista Usuarios',
                    CargaVista('userList', array( 'user'=>$user )));           

        }

    }
     /**
    * CONTROLADOR de eliminar usuario
    */
    public function userDeleted(){
        
       
        if (!isset($_SESSION['loginok']) || !isset($_GET['id'])) {//Si no está iniciada la sesión o no se le pasa id muestra error
           include_once CTRL_PATH . 'error404.php';
        } else if ($_SESSION['tipousuario'] != 'A') {//Solo puede eliminar usuarios los administradores
           include_once CTRL_PATH . 'error404.php';
        } else {
//           include_once MODEL_PATH . 'login.php';
//           include_once HELP_PATH . 'help_usuarios.php';

           if (!$this->model->ExisteUsuarioByID($_GET['id'])) {
               include_once CTRL_PATH . 'error404.php';
           } else {

               if (!$_POST) {
                   $this->controller->Verfuera('Borra Usuario',
                    CargaVista('userDeleted', array())); //Mostramos vista con los datos de la tarea
               } else {

                   if (isset($_POST['sieliminar'])) {
                       
                      $this->model->EliminarUsuarioEnBD($_GET['id']);
                       
                       $this->userList();                       
                      
                   } else if (isset($_POST['noeliminar'])) {
                       
                        $this->userList();                        
                   }
               }
           }
        }
        
    }

    
}