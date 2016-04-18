<!-- VISTA de listar usuarios -->

<div class="container">	
    <div class="row well">
        <div class="col-md-12">
            <div class="col-md-3 column">
               <ul class="nav nav-pills nav-stacked well">
                   <li class="active btn-opcionesusuario"><a href="<?=Front_Controller::MakeURL('Login', 'userList')?>" class="active2" title="Ver lista de usuarios"><span class="glyphicon glyphicon-chevron-right"></span> Lista</a></li>
                   
                   <li class="btn-opcionesusuario"><a href="<?=Front_Controller::MakeURL('Login', 'userInsert')?>" title="Añadir usuario">&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right"></span> Añadir</a></li>
                                    
                </ul>
            </div>
            <div class="col-md-9" style="">
                <div style="background-color: white; border-radius: 3px; padding: 5px;">
                    <h3>Lista de Usuarios</h3>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Nombre de usuario</th>
                            <th>Tipo</th>
                            <th>Opciones</th>
                        </tr>

                        <?= EscribeUsuarios($user);?>

                    </table>  
	    	
		</div>
            </div>
            
        </div>
       
    </div>
</div>        








            