$( document ).ready(function() {
	
	var buscaCep = null;
	//Iniciando a VUE do elemento pessoaForm
	var pessoaForm = new Vue({
		el: '#pessoaForm',
		data: {
			endereco: ''
		},
		// define métodos dentro do objeto `methods` da VUE
		methods: {
			buscaCEP: function (event) {	
				//capturando o valor digitado no campo de cep com js nativo
				var cepDigitado = document.getElementById('cep').value;
				if(cepDigitado <= 0){
					cepDigitado = '00000000';
				}
				//compondo a url da api para busca do endereço
				var buscaCep = 'http://viacep.com.br/ws/'+cepDigitado+'/json';
				//Busca do endereço pela API viacep retornando os dados em jSON
				$.getJSON(buscaCep, function (endereco) {
					//alimentando o data da vue pessoasForm
					pessoaForm.endereco = endereco;
				});
			}
		}
	});
	
	//declarando a div que recebe o retorno do form
	const retornoForm = document.getElementById('retornoForm');
	
	//declarando a função de processamento do form
	function processformPessoa(e) {
	 
		$.ajax({
           type: "POST",
           url: '../../controller/php/pessoaInserir.php',
           data: $("#formPessoa").serialize(), 
           success: function(data){
			  //convertendo os dados para JSON 
			  var json = $.parseJSON(data);
			  //compondo o html da div de retorno
              $('#retornoForm').html('<div class="alert alert-info" alert-dismissible fade show" role="alert">'+json+' <button type="button" class="close" data-dismiss="alert" aria-label="Close">    <span aria-hidden="true">&times;</span>  </button></div>');
           }
         });

    	e.preventDefault();
	}
	
	// declarando o form
	const formPessoa = document.getElementById('formPessoa');

	// ouvindo o evento de envio do formPessoa on submit para executar a function
	formPessoa.addEventListener('submit', processformPessoa);
	
});