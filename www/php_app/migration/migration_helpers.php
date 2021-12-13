<?php
#cria namespaces do modelo
// function createMigrationNamespaces(){
// 	$namespace = array();
// 	$namespace[sizeof($namespace)] = 'namespace App\Migrations;';	
// 	return $namespace;
// }

#cria uses do modelo
function createMigrationUses(){
	$uses = array();

	$uses[sizeof($uses)] = 'use Illuminate\Database\Migrations\Migration;';
	$uses[sizeof($uses)] = 'use Illuminate\Database\Schema\Blueprint;';
	$uses[sizeof($uses)] = 'use Illuminate\Support\Facades\Schema;';
		
	return $uses;
}

function attributes($modelObj){
	$attrs = [];
	foreach ($modelObj->fillables as $attribute => $type) {
		if(!strstr($type, 'id_')){
			$attrs[sizeof($attrs)] = eloquentAttribute($attribute, $type);
		}
	}

	return $attrs;
}

function eloquentAttribute($attribute, $type){
	$retorno = '';

	if(strstr($type, '|')){
		$type = explode('|', $type);	
	}else{
		$type = [$type];
	}

	for ($i=0; $i < sizeof($type) ; $i++) { 
		switch (strtolower($type[$i])) {
				case 'reference':
					$retorno .= '->bigInteger(\''.$attribute.'\')';
				break;
				case 'bigincrements':
					$retorno .= '->bigIncrements(\''.$attribute.'\')';
				break;
				case 'biginteger':
					$retorno .= '->bigInteger(\''.$attribute.'\')';
				break;
				case 'binary':
					$retorno .= '->binary(\''.$attribute.'\')';
				break;
				case 'boolean':
					$retorno .= '->boolean(\''.$attribute.'\')';
				break;
				case 'char':
					$retorno .= '->char(\''.$attribute.'\')';
				break;
				case 'date':
					$retorno .= '->date(\''.$attribute.'\')';
				break;
				case 'datetime':
					$retorno .= '->dateTime(\''.$attribute.'\')';
				break;
				case 'decimal':
					$retorno .= '->decimal(\''.$attribute.'\')';
				break;
				case 'double':
					$retorno .= '->double(\''.$attribute.'\')';
				break;
				case 'enum':
					$retorno .= '->enum(\''.$attribute.'\')';
				break;
				case 'float':
					$retorno .= '->float(\''.$attribute.'\')';
				break;
				case 'increments':
					$retorno .= '->increments(\''.$attribute.'\')';
				break;
				case 'integer':
					$retorno .= '->integer(\''.$attribute.'\')';
				break;
				case 'longtext':
					$retorno .= '->longText(\''.$attribute.'\')';
				break;
				case 'mediuminteger':
					$retorno .= '->mediumInteger(\''.$attribute.'\')';
				break;
				case 'mediumtext':
					$retorno .= '->mediumText(\''.$attribute.'\')';
				break;
				case 'morphs':
					$retorno .= '->morphs(\''.$attribute.'\')';
				break;
				case 'nullabletimestamps':
					$retorno .= '->nullableTimestamps(\''.$attribute.'\')';
				break;
				case 'smallinteger':
					$retorno .= '->smallInteger(\''.$attribute.'\')';
				break;
				case 'tinyinteger':
					$retorno .= '->tinyInteger(\''.$attribute.'\')';
				break;
				case 'softdeletes':
					$retorno .= '->softDeletes(\''.$attribute.'\')';
				break;
				case 'string':
					$retorno .= '->string(\''.$attribute.'\')';
				break;
				case 'string':
					$retorno .= '->string(\''.$attribute.'\')';
				break;
				case 'text':
					$retorno .= '->text(\''.$attribute.'\')';
				break;
				case 'time':
					$retorno .= '->time(\''.$attribute.'\')';
				break;
				case 'timestamp':
					$retorno .= '->timestamp(\''.$attribute.'\')';
				break;
				case 'timestamps':
					$retorno .= '->timestamps(\''.$attribute.'\')';
				break;
				case 'remembertoken':
					$retorno .= '->remembertoken(\''.$attribute.'\')';
				break;
				case 'nullable':
					$retorno .= '->nullable()';
				break;
				case 'default':
					$retorno .= '->default()';
				break;
				case 'unsigned':
					$retorno .= '->unsigned()';
				break;
			}
	}


	return '		$table'.$retorno.';';
}
