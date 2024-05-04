<?php
require_once 'src/config/config.php';
$currenPageUrl = $_SERVER['REQUEST_URI'];
echo $currenPageUrl;
$ruta = empty($_GET['url']) ? 'principal/index' : $_GET['url'];
?>