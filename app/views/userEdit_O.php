<!-- VISTA de modificar usuario de tipo Operario -->


<div class="container">	
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4 column">
            </div>
            <div class="col-md-4 well" style="border: 1px solid #dadada; background-color: white;">
                <form role="form" method="POST" action="?ctrl=modificarusuarioOPE&id=<?= $_GET['id'] ?>">

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

            </div>

        </div>

    </div>
</div>      
