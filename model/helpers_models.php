<?php
#cria namespaces do modelo
function createModelNamespaces(){
	$namespace = array();
	$namespace[sizeof($namespace)] = 'namespace App\Models;';	
	return $namespace;
}

#cria uses do modelo
function createModelUses(){
	$uses = array();
	$uses[sizeof($uses)] = 'use Illuminate\Database\Eloquent\Factories\HasFactory;';
	$uses[sizeof($uses)] = 'use Illuminate\Database\Eloquent\Model;';
		
	return $uses;
}

function getClass($modelObj){
	$Inflector = new Inflector();
	$plural = $Inflector->tabela($modelObj->name);
	$atributos = [];
	$methods = getClassMethods($modelObj);

	#montando a lista de atributos
	foreach ($modelObj->fillables as $atributo => $tipo) {
		array_push($atributos, "'".$atributo."'");
	}

	$class = '
class Produto extends Model{
    '.getClassUses().'

    protected $table = "'.$plural.'";
    protected $fillable = ['.alinha_array($atributos).'];
    '.$methods.'
}';

	return $class;
}

function getClassUses(){
	$retorno = '';
	$uses = array();
	$uses[sizeof($uses)] = 'use HasFactory;';

	#montando a lista de uses
	foreach ($uses as $key => $use) {
		$retorno .= '
    '.$use;
	}

	return $retorno;
}

function getClassMethods($modelObj){
	$Inflector = new Inflector();
	$retorno = '';
	$methods = array();

	foreach ($modelObj->relationship as $model => $cardinality) {
		$plural = $Inflector->tabela($model);

		$methods[sizeof($methods)] = 'public function '.$plural.'(){
            return $this->'.relationship($cardinality).'('.$model.'::class, \'id_'.$plural.'\', \'id\');
        }
        ';
	}
	
    #montando a lista de uses
	foreach ($methods as $key => $method) {
		$retorno .= '
    '.$method;
	}

	return $retorno;
}

function relationship($cardinality){
	switch ($cardinality) {
	    case 1:
	        return 'hasMany';
	    break;
	    case 'n':
	        return 'belongsTo';
	    break;
	}

	return false;
}
