<!-- 
LAYOUT DE LA APLICACIÓN 
ESTA PÁGINA DISPONE DONDE IRÁN LOS DIFERENTES BLOQUES QUE CONFORMAN LA APLICACIÓN

Se centra solamente en la presentación.
Deberemos indicarle:
    - titulo
    - menu
    - cuerpo

Podría tener tantos parámetros como quisiesemos
Igualmente nuestra aplicación podría tener tantos layouts como deseasemos
-->
<html>
    <head>

    <meta charset="utf-8">

    <link rel="icon" type="image/png" href="../assets/bootstrap/img/profile.png" />
    <title><?=$titulo?></title>   

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/cerulean/ -->
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">    

    <!-- Custom CSS -->
    <link href="../assets/bootstrap/css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../assets/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">	

    <link rel="stylesheet" type="text/css" href="../assets/css/estilos.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/estilos_paginador.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/estilos_opcionesusuarios.css">
       
        
              
    </head>    
<body>
    <header>       
        
    </header>   

    <div><?=$menu?></div>
    <div class="container"><?=$cuerpo?></div>
    <!-- Pie de la aplicación, mostrado en todas las páginas -->
    <!-- Pie -->
    <footer class="text-center">
        <div class="navbar navbar-default">
            <div class="container">
                <div class="">
                    <div class="footer-col col-md-12">                        
                        <h3>Creado por Manuel Francisco Mora Martín</h3>
                    </div>
                </div>
            </div>

    </footer>

    <!-- jQuery -->    
    <script src="../assets/bootstrap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<!--    <footer>
        <hr>
        <a href="#" target="_blank"><p class="text-center">Creado por Manuel Francisco Mora Martín</p></a>
    </footer>-->
</body>
</html>