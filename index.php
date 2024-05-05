<?php
    require_once 'src/config/config.php';
    //capturar la uRL actual
    $currenPageUrl = $_SERVER['REQUEST_URI'];
    //verificar si existe la ruta admin
    $isAdmin = strpos($currenPageUrl, '/' . ADMIN) !== false;
    //comprobar si exite GeT para crear URLS amigables
    $ruta = empty($_GET['url']) ? 'principal/index' : $_GET['url'];
    //crear un arrya a partir de la ruta
    $array = explode('/', $ruta,);
    //validar si nos encontramos en la ruta admin
    if ($isAdmin && (count($array) == 1 
    || (count($array) ==2 && empty($array[1]))) 
    && $array[0] == ADMIN) {
        //CREAR CONTROLADOR
        $controller = 'admin';
        $metodo = 'login';
    } else {
        $indiceUrl = ($isAdmin) ? 1 : 0 ;
        $controller = ucfirst($array[$indiceUrl]);
        $metodo = 'index';
    }
    echo 'Nombre controller: ' . $controller . '<br>';
    echo 'Nombre metodo: ' . $metodo;
?>