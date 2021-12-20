<?php 
include('_form.blade.php'); 

function searchBar($selectLength=['10','25','50', '100','-1'], $label='Itens por página'){
	$html = '	<!-- jcsNetSearch Bar DataTables -->
	<div class="row">
		<div class="col-md-3">
			<div class="input-group mb-3">
				<label class="input-group-text" for="inputGroupSelect01">'.$label.'</label>
				<select class="form-select" id="selectLength">';

				foreach ($selectLength as $key => $option) {
					if ($option == '-1') {
						$html .='<option value="-1">Todos</option>';
					}else {
						$html .='<option value="'.$option.'">'.$option.'</option>';
					}
				}

				$html .='</select>
			</div>
		</div>
	
		<div class="col">
			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon2">Buscar</span>
				<input type="text" id="inputSearch" class="form-control" placeholder="Buscar">
			</div>
		</div>
	</div>
	<!-- jcsNetSearch Bar DataTables -->';

	return $html;
}

function table($modelObj, $columns=[], $actions=[]){
	$html =	'<!-- tablela -->
	<table id="example" class="display responsive" style="width:100%">
		<thead>
			<tr>';

			if(empty($columns)){
				foreach ($modelObj->fillables as $column => $type) {
					if(!strstr($column, 'id_')){
						$html .='<th>'.$column.'</th>';
					}
				}
			}
			
			$html .='
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
		</tbody>    
	</table>
	<!-- tabela -->';

	return $html;
}

function script_datatables($modelObj, $columns=[], $actions=['edit'=>'Editar', 'delete'=>'Excluir'], $export= ['copy', 'excel', 'pdf']){
	
	$html = '<script>
	$(document).ready(function() {
		var table = $(\'#example\').DataTable({
			ajax: \'views/'.$modelObj->plural.'.json\'
			,"aoColumns": [';

			if(empty($columns)){
				foreach ($modelObj->fillables as $column => $type) {
					if(!strstr($column, 'id_')){
						$html .='{"sWidth": "13%", "mData": 0},';
					}
				}
			}	

		$html .= '{"sWidth": "5%", "mData": null, "bSortable": false, "mRender": function(data, type, full) {
					return ';

					$html .= '\'';

					if(existe_array('edit', $actions, 'key')){
						$html .= '<a class="btn btn-primary" href="javascript:editar_lista_'.$modelObj->plural.'(\\\'\'+full[0]+\'\\\')" title="'.$actions['edit'].'"><i class="fas fa-edit"></i> '.$actions['edit'].'</a>';
					}

					if(existe_array('delete', $actions, 'key')){
						$html .= ' <a class="btn btn-danger" href="javascript:excluir_lista_'.$modelObj->plural.'(\\\'\'+full[0]+\'\\\')" title="'.$actions['edit'].'"><i class="fas fa-trash-alt"></i> '.$actions['edit'].'</a>';
					}

					$html .= '\'';

		$html .= '		}
			  }],';
			  
		$html .= '"oLanguage": {
						"sInfoThousands": ".",
						"sProcessing":   "Processando...",
						"sLengthMenu":   "Mostrar _MENU_ registros",
						"sZeroRecords":  "Não foram encontrados resultados",
						"sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
						"sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
						"sInfoFiltered": "",
						"sInfoPostFix":  "",
						"sSearch":       "Buscar:",
						"sUrl":          "",
						"oPaginate": {
							"sFirst":    "Primeiro",
							"sPrevious": "Anterior",
							"sNext":     "Seguinte",
							"sLast":     "Último"
						}
					},
			dom: \'Bfrtip\',
			buttons: [';
			
			$qtd_virgola = sizeof($export)-1;

			if(existe_array('copy', $export)){
				$html .= '$.extend( true, {}, buttonCommon, {
					extend: \'copyHtml5\'
				})';

				if($qtd_virgola>0){
					$html .= ',';
				}
			}

			if(existe_array('excel', $export)){
				$html .= '$.extend( true, {}, buttonCommon, {
					extend: \'excelHtml5\'
				})';

				if($qtd_virgola>0){
					$html .= ',';
				}
			}

			if(existe_array('pdf', $export)){
				$html .='$.extend( true, {}, buttonCommon, {
					extend: \'pdfHtml5\'
				})'; 

				if($qtd_virgola>0){
					$html .= ',';
				}
			}

			$html .= ']
		});
	
		var buttonCommon = {
			exportOptions: {
				format: {
					body: function ( data, row, column, node ) {
						// Strip $ from salary column to make it numeric
						return column === 5 ?
							data.replace(/[$,]/g, \'\') :
							data;
					}
				}
			}
		};
	
		$( ".paginate_button" ).addClass( "btn btn-light" );
		$(\'#example_length, #example_filter\').addClass(\'hidden\');
		
		// binding
		$(\'#inputSearch\').on( \'keyup\', function () {
			table.search( this.value ).draw();
		});
		// binding
		$(\'#selectLength\').on( \'change\', function () {
			table.page.len(this.value).draw();
		});
	} );
	</script>';

	return $html;
}

echo searchBar();
echo table($modelObj);
echo script_datatables($modelObj, $columns=[]);
?>

	

