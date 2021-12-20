<?php
function s($var){
    echo '<pre>';
    if(is_array($var)){
        print_r($var);
    }else if(is_object($var)){
        var_dump($var);
    }else{
        echo $var;
    }
    echo '</pre>';
}

function alinha_array($arr){
    $temp = "";
    foreach ($arr as $key=> $value) {
            if(is_numeric($value) && $value ==''){
                $value = 'NULL';
            }

        $temp .= $value.', ';
    }

    $array_alinhado = substr($temp,0,-2);
 return $array_alinhado;
}

function arrayToList($arr){
    $retorno='';    
    foreach ($arr as $key => $item) {
        $retorno .=$item.'
';
    }

    return rtrim(ltrim($retorno));
}

function existe_array($obj, $array, $search = 'value'){
    if(is_array($array)){
        foreach ($array as $key => $value) {
            if($search == 'value'){
                if($value == $obj){
                    return true;
                }
            }else if($search == 'key'){
                if($key == $obj){
                    return true;
                }
            }
        }
    }else{
        // s('Não é um array');
    }
    return false;
}

class Model{
    public $name;
    public $plural;
    public $singular;
    public $fillables;
    public $relationship;

    public function __construct($name='', $fillables=array(), $relationship=array()) {
        $this->name = $name;
        $this->fillables = $fillables;
        $this->relationship = $relationship;
        
        $Inflector = new Inflector();
        $this->plural = $Inflector->tabela($name);
        $this->singular = $Inflector->singularize($this->plural);
    }
}

