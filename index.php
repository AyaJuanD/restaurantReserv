<?php
    require_once 'src/config/config.php';
    //verificar si existe la ruta admin
    $isAdmin = strpos($_SERVER['REQUEST_URI'], '/' . ADMIN) !== false;
    //comprobar si exite GeT para crear URLS amigables
    $ruta = empty($_GET['url']) ? 'principal/index' : $_GET['url'];
    //crear un arrya a partir de la ruta
    $array = explode('/', $ruta,);
    //validar si nos encontramos en la ruta admin
    if ($isAdmin && (count($array) == 1 
    || (count($array) ==2 && empty($array[1]))) 
    && $array[0] == ADMIN) {
        //CREAR CONTROLADOR
        $controller = 'Admin';
        $metodo = 'login';
    } else {
        $indiceUrl = ($isAdmin) ? 1 : 0 ;
        $controller = ucfirst($array[$indiceUrl]);
        $metodo = 'index';
    }
    //Validar Metodos
    $metodoIndice = ($isAdmin) ? 2 : 1;
    if (!empty($array[$metodoIndice]) && $array[$metodoIndice] != '') {
        $metodo = $array[$metodoIndice];
    }
    //Validar Metodos
    $parametro = '';
    $parametroIndice = ($isAdmin) ? 3 : 2;
    if (!empty($array[$metodoIndice]) && $array[$metodoIndice] != '') {
        for ($i= $parametroIndice; $i < count($array); $i++) { 
            $parametro .= $array[$i] . ','; 
        }
        $parametro = trim($parametro, ',');
    }
    //Validar Directorio de Controladores
    $dirControllers = ($isAdmin) ? 'controller/admin/' . $controller . '.php' : 'controller/principal/' . $controller . '.php';
    if (file_exists($dirControllers)) {
        require_once $dirControllers; 
        $controller = new $controller();
        if (method_exists($controller, $metodo)) {
            $controller->$metodo($parametro);
        } else {
            echo 'Metodo no existe';
        }
        
    } else {
        echo 'Controlador no existe';
    }
    



?>