<?php
include('helpers_models.php');

function model($modelObj){
    /*Cabeça*/
        $namespace = createModelNamespaces();
        #obtem uses anteriores
        $uses = createModelUses($modelObj->name);

    /*Corpo*/
        #obtem a classe
        $class = getClass($modelObj);
        
    /*Juntando tudo*/

    $model = (ltrim(arrayToList($namespace)));
    $model .= '
    '.($class);

    return $model;
}
