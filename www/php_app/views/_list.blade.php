<?= include('_form.blade.php') ?>
	
<!-- tablela -->
	<!-- jcsNetSearch Bar DataTables -->
	<div class="row">
		<div class="col-md-3">
			<div class="input-group mb-3">
				<label class="input-group-text" for="inputGroupSelect01">Itens por página</label>
				<select class="form-select" id="selectLength">
				<option value="10">10</option>
				<option value="25">25</option>
				<option value="50">50</option>
				<option value="100">100</option>
				<option value="-1">Todos</option>
				</select>
			</div>
		</div>
	
		<div class="col">
			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon2">Buscar</span>
				<input type="text" id="inputSearch" class="form-control" placeholder="Buscar" aria-label="Recipient's username" aria-describedby="basic-addon2">
			</div>
		</div>
	</div>
	<!-- jcsNetSearch Bar DataTables -->
    
	<table id="example" class="display responsive" style="width:100%">
		<thead>
			<tr>
				<th>Name</th>
				<th>Position</th>
				<th>Office</th>
				<th>Extn.</th>
				<th>Start date</th>
				<th>Salary</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
		</tbody>    
	</table>
</div>
<!-- tabela -->

<script>
$('#myForm').submit(function(event) {
	$(this).serialize();
  	var registro = getInputs('myForm');
	
	if(registro){
		add(registro);
		formClear('myForm');
	}

	event.preventDefault();
});


$(document).ready(function() {
	var buttonCommon = {
        exportOptions: {
            format: {
                body: function ( data, row, column, node ) {
                    // Strip $ from salary column to make it numeric
                    return column === 5 ?
                        data.replace( /[$,]/g, '' ) :
                        data;
                }
            }
        }
    };

	var table = $('#example').DataTable({
        ajax: 'https://gyrocode.github.io/files/jquery-datatables/arrays.json'
		,"aoColumns": [
        	{"sWidth": "13%", "mData": 0},
        	{"sWidth": "13%", "mData": 1},
        	{"sWidth": "16%", "mData": 2},
        	{"sWidth": "10%", "mData": 3},
			{"sWidth": "15%", "mData": 4},
			{"sWidth": "13%", "mData": 5},
			{"mData": null, "bSortable": false, "mRender": function(data, type, full) {
				return '<a class="btn btn-primary" href="javascript:editar_lista_enderecos(\''+full[0]+'\')" title="Editar"><i class="fas fa-edit"></i> Editar</a>\
					<a class="btn btn-danger" href="javascript:btn_excluir(\''+full[0]+'\')" title="Excluir"><i class="fas fa-trash-alt"></i> Excluir</a>';
			}
          }],
        dom: 'Bfrtip',
        buttons: [
            $.extend( true, {}, buttonCommon, {
                extend: 'copyHtml5'
            } ),
            $.extend( true, {}, buttonCommon, {
                extend: 'excelHtml5'
            } ),
            $.extend( true, {}, buttonCommon, {
                extend: 'pdfHtml5'
            } )
        ]
    });

    $( ".paginate_button" ).addClass( "btn btn-light" );

    $('#example_length, #example_filter').addClass('hidden');
    
    // #inputSearch is a <input type="text"> element
	$('#inputSearch').on( 'keyup', function () {
	    table.search( this.value ).draw();
	} );

	$('#selectLength').on( 'change', function () {
	    table.page.len(this.value).draw();
	});
} );


$('#demo').on('hidden.bs.collapse', function () {
  $('#formButton').empty().append( '<i class="fas fa-plus-square"></i> Formulário' );
})

$('#demo').on('show.bs.collapse', function () {
  $('#formButton').empty().append( '<i class="fas fa-minus-square"></i> Formulário' );
})
</script>