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
<!--        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <script src="../assets/js/jquery.js" type="text/javascript"></script>
        <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
        <link href="../assets/css/bootstrap-theme.css" type="text/css" rel="stylesheet">  
        <link href="../assets/css/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="../assets/css/mi.css" type="text/css" rel="stylesheet">-->
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