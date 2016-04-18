<!-- VISTA de modificar usuario -->

<div class="container">	
    <div class="row well">
        <div class="col-md-12">
            <div class="col-md-3 column">
                <ul class="nav nav-pills nav-stacked well">
                    <li class="active"><a href="<?=Front_Controller::MakeURL('Login', 'userList')?>"><span class="glyphicon glyphicon-chevron-right"></span> Listar</a></li>

                    <li><a href="<?=Front_Controller::MakeURL('Login', 'userInsert')?>" class="active2">&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right"></span> Añadir</a></li>

                </ul>
            </div>            
            <div class="col-md-9" style="border: 1px solid #dadada; background-color: white; border-radius: 3px;">
                <div class="col-md-3"></div>
                <div class="col-md-5">	
                    <form role="form" method="POST" action="?c=Login&a=userEdit&id=<?= $_GET['id'] ?>">

                        <h3>Modificar Usuario</h3>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="text" class="form-control" placeholder="Usuario" name="usuario" autofocus value="<?= EscribeCampoUsuario($_GET['id'], 'usuario') ?>"/>
                            </div>
                        </div>
                        <?php if (isset($errores['existenuevonombre'])): ?>
                            <div class="alert alert-danger">
                                <b>¡Error!</b> El nombre de usuario ya existe
                            </div> 
                        <?php endif; ?>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" class="form-control" placeholder="Contraseña" name="clave"/>
                            </div>
                        </div>
                        <?php if (isset($errores['claveincorrecta'])): ?>
                            <div class="alert alert-danger">
                                <b>¡Error!</b> Contraseña incorrecta
                            </div> 
                        <?php endif; ?>
                        <br>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" class="form-control" placeholder="Contraseña nueva" name="clavenueva"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" class="form-control" placeholder="Confirme contraseña nueva" name="clavenuevarep"/>
                            </div>
                        </div>

                        <?php if (isset($errores['clavesdistintas'])): ?>
                            <div class="alert alert-danger">
                                <b>¡Error!</b> Contraseñas incorrectas
                            </div> 
                        <?php endif; ?>                                    
                        <input type="submit" name="modificarusuario" value="Enviar" class="btn btn-comun">

                    </form>                   

                </div> <!-- final col-md-4-->
            </div>

        </div>

    </div>
</div>      
