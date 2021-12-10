<?php
include('helpers_routes.php');

function routes($modelObj){
	$Inflector = new Inflector();
	$plural = $Inflector->tabela($modelObj->name);

	/*Cabeça*/
		#obtem uses anteriores
		$uses = getUses();
		#adiciona uses do modelo
		$uses = array_merge($uses, createUses($modelObj->name));

	/*Corpo*/
		#obtem rotas anteriores
		$routes = getRoutes();
		#adiciona rotas do modelo
		$routes = array_merge($routes, createRoutes($modelObj->name, $plural));

	/*Juntando tudo*/
		#cria o arquivo em branco
		$file = array();
		#arquivo recebe uses
		$file = array_merge($file, $uses);
		#arquivo recebe rotas
		$file = array_merge($file, $uses);

	$file_routes = '';
	foreach ($routes as $key => $route) {
		$file_routes .= $route.'
';
	}

	return $file_routes;
}
