$( document ).ready(function() {
	
	//Iniciando a VUE do elemento pessoasGrid
	var pessoaGrid = new Vue({
		el: '#pessoaGrid',
		data: {
			pessoas: ''
		}
	});
	//Busca das pessoas no controller php retornando um json para compor a VUE
	$.getJSON('../../controller/php/pessoaGrid.php', function (pessoas) {
		pessoaGrid.pessoas = pessoas;
	});
		
});