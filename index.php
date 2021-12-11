<?php
include('helpers.php');
include('inflector.php');
include('migration/migration.php');
include('route/routes.php');
include('model/model.php');
include('controller/controller.php');

#criando modelo
$nome='Post';
$atributos = [
	'titulo'=> 'string'
	, 'texto'=>'string'
	,'id_usuarios' => 'reference'
	,'id_like' => 'reference'
];

$relacionamentos = [
	'Usuario'=> '1' #todo <post> pertence a um <usuário> (belongs to)
	, 'Like'=>'n' #todo <post> tem vários <likes> (has many)
];

$modelObj = new Model($nome, $atributos, $relacionamentos);

// s('---------------------------------------------------------------------');
#migrations
// s(migration($modelObj));
// s('---------------------------------------------------------------------');
#model
// s(model($modelObj));
// s('---------------------------------------------------------------------');
#routes
// s(routes($modelObj));
// s('---------------------------------------------------------------------');
#controller
// s(controller($modelObj));
// s('---------------------------------------------------------------------')

#views
include('views/index.blade.php');
