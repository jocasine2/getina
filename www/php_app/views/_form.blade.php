<?php

function getImputs($modelObj){
    $html = '';

    foreach ($modelObj->fillables as $attribute => $type) {
        switch ($type) {
            case 'string':
                $html .= input_text($modelObj, $attribute);
            break;
            case 'reference':
                $html .= input_text_hidden($modelObj, $attribute);
            break;
            default:
                $html .= input_text($modelObj, $attribute);
            break;
        }
    }

    return $html;
}

function input_text($modelObj, $attribute){

    $html = '<div class="mb-3">
                <label class="form-label">'.$attribute.'</label>
                <input type="text" name="'.$attribute.'" class="form-control" placeholder="'.$attribute.'">
            </div>';

    return $html;
}   

function input_text_hidden($modelObj, $attribute){
    
    $html = '<input type="hidden" name="'.$attribute.'" class="form-control" placeholder="'.$attribute.'">';

    return $html;
}   

$inputs = getImputs($modelObj); 


$html = '<!-- collapse -->
        <div class="card">
            <div class="card-header">
                <a href="#demo" id="formButton" class="btn btn-secondary" data-bs-toggle="collapse" ><i class="fas fa-plus-square"></i> Formuário</a>
            </div>
            <div id="demo" class="collapse">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <!-- form -->
                    <form id="myForm">
                        '.$inputs.'
                        <input type="submit" class="btn btn-success" value="Salvar">
                    </form>
                    <!-- form -->
                </div>
            </div>
        </div>
        <!-- form collapse -->
        <br>
        <script>
        $(\'#myForm\').submit(function(event) {
            $(this).serialize();
            var obj = getInputs(\'myForm\');

            if(save(\'tabela\', obj)){
                console.log(save(\'tabela\', obj));
                add(obj);
                formClear(\'myForm\');
            }else{
                error(\'Não foi possível inserir o registro...\');
            }

            event.preventDefault();
        });

        function save(tabela, obj){
            
            $.ajax({
                url: "views/teste.php",
                cache: false,
                dataType : \'html\',
                type : \'POST\',
                data : {
                    \'object\': obj
                }
                ,async: false
                ,success : function(text){
                    response = text;
                }
            });

            return parseInt(response);
        }

        //form collapse button
        $(\'#demo\').on(\'hidden.bs.collapse\', function () {
        $(\'#formButton\').empty().append( \'<i class="fas fa-plus-square"></i> Formulário\' );
        })

        $(\'#demo\').on(\'show.bs.collapse\', function () {
        $(\'#formButton\').empty().append( \'<i class="fas fa-minus-square"></i> Formulário\' );
        })
        </script>';

echo $html;