<?php

/**
 * HELP funciones usadas para todo lo relacionado con los usuarios
 */

/**
 * Función que muestra los datos de todos los usuarios en forma de tabla en la vista
 * @param Array $usuarios Usuarios a mostrar
 */
function EscribeUsuarios($usuarios) {
    foreach ($usuarios as $key => $usuario) {
        echo '<tr>'; //Inicio de fila

        foreach ($usuario as $key => $value) {

            if ($key == 'id')
                $id = $value;
            else {
                if ($value == 'A')
                    echo '<td>Administrador</td>';
                else if ($value == 'O')
                    echo '<td>Operario</td>';
                else
                    echo "<td>$value</td>"; //Guardaría el nombre de usuario
            }
        }

        echo '<td>'; //Inicio de columna de opciones
        //Creación de la ruta completa con la ID
        $ruta = Front_Controller::MakeURL("Login","userEdit");
        $ruta=$ruta."&id=$id"; 
        
        echo '<p><a href="'.$ruta.'" class="btn btn-warning" title="Modificar Usuario"><span class="glyphicon glyphicon-pencil"></span></a>';   
        
        $ruta = Front_Controller::MakeURL("Login","userDeleted");
        $ruta=$ruta."&id=$id";
        
        echo '&nbsp;&nbsp;';
        echo '<a href="'. $ruta .'" class="btn btn-danger" title="Eliminar Usuario"><span class="glyphicon glyphicon-trash"></span></a></p>';
        echo '</td>'; //Fin de columna de opciones
        echo '</tr>'; //Fin de fila
    }
}

/**
 * Función que te devuelve el campo de usuario según su ID
 * @param String $id ID del usuario
 * @param String $name Nombre del campo
 * @return String Dato del campo
 */
function EscribeCampoUsuario($id, $name) {
    
    $model=new LoginModel();
    $usuario =$model->GetUnUsuario($id);    
    return $usuario[$name];
}
