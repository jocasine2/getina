function getInputs(formName){
	var inputs = {}
	var vazio = true;

	// validade
	$.each($('#'+formName).serializeArray(), function(i, field) {
		inputs[field.name] = field.value;
		
		if(field.value != ''){
			vazio = false;
		}
	});

	if(!vazio){
		return inputs;
	}else{
		warning('objeto vazio');
		return false;
	}
}

function formClear(formName){
	$('#'+formName).closest('form').find("input[type=text], textarea").val("");
}

function rm(rowid){
	$('#'+rowid).next('.child').remove();
	$('#'+rowid).remove();	
	success('Item removido com sucesso!')
}

function add(obj){
	var table = $('#example').DataTable();

	var rowNode = table.row.add([ 
								obj.Name
								, obj.Position
								, obj.Office
								, obj.Extn
								, obj.startDate
								, obj.Salary
					    		]).draw().node().id = 'row_99';
	 
	$( rowNode ).css( 'color', 'red' ).animate( { color: 'red' } );
	success('Item adicionado com sucesso!')
}

function success(msg, titulo ='Sucesso:'){
	iziToast.success({
    	title: titulo,
    	message: msg,
	});
}

function warning(msg, titulo ='Alerta:'){
	iziToast.warning({
    	title: titulo,
    	message: msg,
	});
}

function error(msg, titulo ='Erro:'){
	iziToast.error({
    	title: titulo,
    	message: msg,
	});
}

function info(msg, titulo ='Informação:'){
	iziToast.info({
    	title: titulo,
    	message: msg,
	});
}