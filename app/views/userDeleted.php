<!-- VISTA de eliminar usuario -->

<div class="container">	
    <div class="row well">
        <div class="col-md-12">
            <div class="col-md-3 column">
               <ul class="nav nav-pills nav-stacked well">
                   <li class="active"><a href="?ctrl=listausuarios"><span class="glyphicon glyphicon-chevron-right"></span> Listar</a></li>
                   
                   <li><a href="?ctrl=altausuario" class="active2">&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right"></span> Añadir</a></li>
                                    
                </ul>
            </div>
            <br>
            <div class="col-md-9" style="border: 1px solid #dadada; background-color: white; border-radius: 3px;">
                <div class="col-md-2"></div>
		<div class="col-md-7">	
                    <form action="" method="POST">
                        <h4>¿Desea eliminar el usuario <i>"<?= EscribeCampoUsuario($_GET['id'], 'usuario')?>"?</i></h4>
                            <br>
                            <div class="btn-group">
                                    <input type="submit" name="sieliminar" class="btn btn-comun" value="Sí">							
                                    <input type="submit" name="noeliminar" class="btn btn-comun" value="No">
                                    <br><br><br>
                            </div>
                    </form>
	    	
		</div> <!-- final col-md-4-->
            </div>
            
        </div>
       
    </div>
</div> 