<?php

#cria namespaces do controller
function createControllerlNamespaces(){
    $namespace = array();
    $namespace[sizeof($namespace)] = 'namespace App\Http\Controllers;';	
    return $namespace;
}

#cria uses do controller
function createControllerUses($modelObj){
	$uses = array();

    $uses[sizeof($uses)] = 'use App\\Models\\'.$modelObj->name.';';
    $uses[sizeof($uses)] = 'use Illuminate\Http\Request;';
    $uses[sizeof($uses)] = 'use Illuminate\Support\Facades\Storage;';
    $uses[sizeof($uses)] = 'use DataTables;';
		
	return $uses;
}

function getControllerClass($modelObj){
	$Inflector = new Inflector();
	$plural = $Inflector->tabela($modelObj->name);
    $singular = $Inflector->singularize($plural);
    $atributos = [];
	#montando a lista de atributos
	foreach ($modelObj->fillables as $atributo => $tipo) {
		array_push($atributos, "'".$atributo."'");
	}

	$class = '
    class '.$modelObj->name.'Controller extends Controller
    {
         /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return view(\''.$plural.'.index\');
        }

        public function list(Request $request){
            return view(\''.$plural.'.index\');
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {   
            $'.$singular.' = new '.$modelObj->name.'();
            return view(\''.$plural.'._form\', compact(\''.$singular.'\'));
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \App\Http\Requests\Store'.$modelObj->name.'Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            
            #se forem validos vão para a variável $input
            $input = $request->all();
    
            #se veio id atualiza se não veio cria novo registro
            if(!isset($request[\'id\']) || empty($request[\'id\'])){
                #validando os inputs do form
                $request->validate([
                    \'nome\' => \'required\'
                    ,\'telefone\' => \'required\'
                    , \'instagram\' => \'unique:'.$plural.'\'
                ]);
    
                $'.$singular.' = '.$modelObj->name.'::create($input);
                $message = \''.$modelObj->name.' cadastrado com sucesso!\';
            }elseif( isset($request[\'id\']) && !empty($request[\'id\'])) {
                $'.$singular.' = '.$modelObj->name.'::find($request[\'id\']);
                $'.$singular.'->update($request->all());
                $message = \''.$modelObj->name.' atualizado!\';
            }else{
                return redirect()->route(\''.$plural.'.index\')->with(\'error\',\'Falha ao atualizar '.$singular.'...\');
            }
    
            return redirect()->route(\''.$plural.'.index\')->with(\'success\', $message);
        }
    
        /**
         * Display the specified resource.
         *
         * @param  \App\Models\\'.$modelObj->name.'
         * @return \Illuminate\Http\Response
         */
        public function show('.$modelObj->name.' $'.$singular.')
        {
            
        }
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Models\\'.$modelObj->name.'
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $'.$singular.' = '.$modelObj->name.'::find($id);
            return view(\''.$plural.'._form\',compact(\''.$singular.'\'));
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\\'.$modelObj->name.'
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $'.$singular.' = '.$modelObj->name.'::find($id);
            if($'.$singular.'->delete()){
                return redirect()->route(\''.$plural.'.index\')
                            ->with(\'success\',\''.$modelObj->name.' apagado com sucesso!\');
            }else{
                return redirect()->route(\''.$plural.'.index\')
                            ->with(\'success\',\''.$modelObj->name.' apagado com sucesso!\');
            }
        }
    
        public function json(Request $request){
            if ($request->ajax()) {
                $data = '.$modelObj->name.'::latest()->get();
                
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn(\'action\', function($row){
                            $btn = \'<a href="javascript:show(\'.$row->id.\')" class="edit btn btn-primary btn-sm">View</a>
                                    <a href="javascript:edit(\'.$row->id.\')" class="edit btn btn-info btn-sm">Edit</a>
                                    <form action="/'.$plural.'/\'.$row->id.\'" method="post">
                                        <input type="hidden" name="_token" id="csrf-token" value="\'.csrf_token().\'" />
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger">Apagar</button>
                                    </form>\'.btn_delete(\''.$plural.'\', $row->id);
    
                            return $btn;
                        })
                        ->rawColumns([\'action\'])
                        ->make(true);
            }
        }
    }';

	return $class;
}
