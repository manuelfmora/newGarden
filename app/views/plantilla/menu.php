
<!-- <nav class="navbar navbar-default navbar-fixed-top">-->
 <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <a class="navbar-brand" href="index.php"> <span class="glyphicon glyphicon-home"></span> Inicio</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">              


                <ul class="nav navbar-nav navbar-right" style=" float: right;">

                    <?php if (isset($_SESSION['loginok'])) : //Si está iniciada sesión ?>

                        <span style=" float: right; color: #FFFFFF;"> 
                            <span class="glyphicon glyphicon-user"> </span>  
                            <?php
                            if ($_SESSION['tipousuario'] == 'A') //Si es el usuario es de tipo Administrador
                                echo "Administrador: " . $_SESSION['usuario'];
                            else
                                echo "Operario: " . $_SESSION['usuario']; //Si es el usuario es de tipo Operario
                            ?> 

                        </span>
                        <br>
                        <span style=" float: right; color: #FFFFFF;"> 
                            <a href="<?=Front_Controller::MakeURL('Login', 'closeSession')?>" style="color: #FFFFFF;"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión,</a>    
                            <?php echo $_SESSION['horainicio']; ?> 
                        </span>
                        <br>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['tipousuario']) && $_SESSION['tipousuario'] == 'A'):  //Si es el usuario es de tipo Administrador?>
                        <li class="page-scroll">
                            <a href="<?=Front_Controller::MakeURL('Tareas', 'Add')?>" title="Añadir una tarea"><span class="glyphicon glyphicon-plus"></span> Añadir</a>
                        </li>
                    <?php endif; ?>
                    <li class="page-scroll">
                        <a href="<?=Front_Controller::MakeURL('Tareas', 'Listar')?>" title="Lista de tareas"><span class="glyphicon glyphicon-list-alt"></span> Lista</a>
                    </li>
                    <li class="page-scroll">
                        <a href="<?=Front_Controller::MakeURL('Tareas', 'Buscar')?>" title="Buscar tareas"><span class="glyphicon glyphicon-search"></span> Buscar</a>
                    </li>

                    <?php if (!isset($_SESSION['loginok'])) : //Si está iniciada sesión ?>    
                        <li class="page-scroll">
                            <a href="<?=Front_Controller::MakeURL('Login', 'login')?>" title="Login"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                        </li>
                    <?php endif; ?>    

                    <?php if (isset($_SESSION['tipousuario']) && $_SESSION['tipousuario'] == 'A'):  //Si es el usuario es de tipo Administrador?>
                        <li class="page-scroll">
                            <a href="<?=Front_Controller::MakeURL('Login', 'userList')?>" title="Opciones de usuario"><span class="glyphicon glyphicon-cog"></span></a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['tipousuario']) && $_SESSION['tipousuario'] == 'O'):  //Si es el usuario es de tipo Opeario ?>
                        <li class="page-scroll">
                            <a href="?c=Login&a=userEdit_O&id=<?= $_SESSION['idusuario'] ?>" title="Opciones de usuario"><span class="glyphicon glyphicon-cog"></span></a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>