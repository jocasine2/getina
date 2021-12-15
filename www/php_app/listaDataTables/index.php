<!-- iziToast-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css" integrity="sha512-DIW4FkYTOxjCqRt7oS9BFO+nVOwDL4bzukDyDtMO7crjUZhwpyrWBFroq+IqRe6VnJkTpRAS6nhDvf0w+wHmxg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Bootstarp 5.0 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- dataTables -->
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet">

<!-- jquery 3.5 -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- font awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

<!-- Estilos customizados para dataTables -->
<link href="datatablesbootstra.css" rel="stylesheet">


<div class="container">
	<!-- collapse -->
		<div class="card">
			<div class="card-header">
				<a href="#demo" id="formButton" class="btn btn-success " data-bs-toggle="collapse" ><i class="fas fa-plus-square"></i> Formuário</a>
			</div>
			<div id="demo" class="collapse">
				<div class="card-body">
					<h5 class="card-title">Formulário</h5>
					<!-- form -->
					<form id="myForm">
						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Name</label>
							<input type="text" name="Name" class="form-control" placeholder="Name">
						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Position</label>
							<input type="text" name="Position" class="form-control" placeholder="Position">
						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Office</label>
							<input type="text" name="Office" class="form-control" placeholder="Office">
						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Extn</label>
							<input type="text" name="Extn" class="form-control" placeholder="Age">
						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Start Date</label>
							<input type="text" name="startDate" class="form-control" placeholder="Start Date">
						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Salary</label>
							<input type="text" name="Salary" class="form-control" placeholder="Salary">
						</div>

						<input type="submit" class="btn btn-success" value="Submit Button">
					</form>
					<!-- form -->
				</div>
			</div>
		</div>
	<!-- form collapse -->
	<br>
	

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

</div>
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



<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="helpers.js"></script>

<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
