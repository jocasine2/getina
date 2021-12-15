<?php
include('controller_helpers.php');

function controller($modelObj){
    /*Cabeça*/
        $namespace = createControllerlNamespaces();
        #obtem uses anteriores
        $uses = createControllerUses($modelObj);

    /*Corpo*/
        #obtem a classe
        $class = getControllerClass($modelObj);
        
    /*Juntando tudo*/
    $controller = ltrim(arrayToList($namespace));
    $controller .= '
    '.$class;

    return $controller;
}