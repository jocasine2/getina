<?php
#cria rota baseada no modelo
function createRoutes($model,$plural){
	$routes = array();
	$routes[sizeof($routes)] = '#'.$model;
	$routes[sizeof($routes)] = 'Route::get(\'/'.$plural.'\', ['.$model.'Controller::class, \'index\'])->name(\''.$plural.'\');';
	$routes[sizeof($routes)] = 'Route::get(\'/'.$plural.'\', ['.$model.'Controller::class, \'list\'])->name(\''.$plural.'.list\');';
	$routes[sizeof($routes)] = 'Route::get(\''.$plural.'/json\', ['.$model.'Controller::class, \'json\'])->name(\''.$plural.'.json\');';
	$routes[sizeof($routes)] = 'Route::get(\'/'.$plural.'/create\', ['.$model.'Controller::class, \'create\'])->name(\''.$plural.'.create\');';
	$routes[sizeof($routes)] = 'Route::get(\'/'.$plural.'/show/{id}\', ['.$model.'Controller::class, \'show\'])->name(\''.$plural.'.show\');';
	$routes[sizeof($routes)] = 'Route::get(\'/'.$plural.'/edit/{id}\', ['.$model.'Controller::class, \'edit\'])->name(\''.$plural.'.edit\');';
	$routes[sizeof($routes)] = 'Route::post(\'/'.$plural.'/store\', ['.$model.'Controller::class, \'store\'])->name(\''.$plural.'.store\');';
	$routes[sizeof($routes)] = 'Route::post(\'/'.$plural.'/delete/{id}\', ['.$model.'Controller::class, \'destroy\'])->name(\''.$plural.'.store\');';

	return $routes;	
}

#cria uses da rota
function createUses($model){
	$uses = array();
	$uses[sizeof($uses)] = 'use App\\Http\\Controllers\\'.$model.'Controller;';
	
	return $uses;
}

#uses inicais
function getUses(){
	$uses = array();
	$uses[sizeof($uses)] = 'use Illuminate\Support\Facades\Route;'; 
	$uses[sizeof($uses)] = 'use App\Http\Controllers\PostController;'; 

	return $uses;
}

function getRoutes(){
	return array();
}