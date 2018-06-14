$( document ).ready(function() {
		
	var buscaCep = null;
	//Iniciando a VUE do elemento pessoaForm
	var pessoaForm = new Vue({
		el: '#pessoaForm',
		data: {
			endereco: '',
			pessoa: ''
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
			},
			buscaPessoa: function(eventPessoa) {
				//alimentando a variavel com o handle da pessoa inclusa na url em get
	 			var handlePessoa = getUrlParameter('h');
				//Busca das pessoas no controller php retornando um json para compor a VUE
				$.getJSON('../../controller/php/pessoaVisualizar.php?h='+handlePessoa, function (dataPessoa) {
					pessoaForm.pessoa = dataPessoa;
				
					//compondo a url da api para busca do endereço
					var buscaCep = 'http://viacep.com.br/ws/'+dataPessoa[0].CEP+'/json';
					//Busca do endereço pela API viacep retornando os dados em jSON
					$.getJSON(buscaCep, function (endereco) {
						//alimentando o data da vue pessoasForm
						pessoaForm.endereco = endereco;
					});
				});
			
			}
			
		},
		beforeMount(){
			this.buscaPessoa()
		}
	});
	
	
	
	//declarando a div que recebe o retorno do form
	const retornoForm = document.getElementById('retornoForm');
	
	//declarando a função de processamento do form
	function processformPessoaEditar(e) {
	
	//alimentando a variavel com o handle da pessoa inclusa na url em get
	var handlePessoa = getUrlParameter('h');
	
	var url = '../../controller/php/pessoaEditar.php?h='+handlePessoa;
		
		$.ajax({
           type: "POST",
           url: url,
           data: $("#formPessoaEditar").serialize(), 
           success: function(data){
			  //convertendo os dados para JSON 
			  var json = $.parseJSON(data);
			   console.log(json);
			  //compondo o html da div de retorno
              $('#retornoForm').html('<div class="alert alert-info" alert-dismissible fade show" role="alert">'+json+' <button type="button" class="close" data-dismiss="alert" aria-label="Close">    <span aria-hidden="true">&times;</span>  </button></div>');
           }
         });

    	e.preventDefault();
	}
	
	// declarando o form
	const formPessoaEditar = document.getElementById('formPessoaEditar');

	// ouvindo o evento de envio do formPessoaEditar on submit para executar a function
	formPessoaEditar.addEventListener('submit', processformPessoaEditar);
	
});