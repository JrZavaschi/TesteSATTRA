<?php
include_once('../../model/php/sistema.php');

	$connect = Sistema::getConexao();
	
	$handlePessoa = Sistema::getGet('h');
	$nome = Sistema::getPost('nome');
	$cpfcnpj = Sistema::getPost('cpfcnpj');
	$email = Sistema::getPost('email');
	$telefone = Sistema::getPost('telefone');
	$cep = Sistema::getPost('cep');
	$logradouro = Sistema::getPost('logradouro');
	$numero = Sistema::getPost('numero');
	$complemento = Sistema::getPost('complemento');
	$bairro = Sistema::getPost('bairro');
	$municipio = Sistema::getPost('municipio');
	$uf = Sistema::getPost('uf');
	$observacoes = Sistema::getPost('observacoes');
	
try {
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE `pessoa`
			SET NOME = '".$nome."',
			CPFCNPJ = '".$cpfcnpj."',
			TELEFONE = '".$telefone."',
			EMAIL = '".$email."',
			CEP = '".$cep."',
			LOGRADOURO = '".$logradouro."', 
			NUMERO = '".$numero."',
			COMPLEMENTO = '".$complemento."',
			BAIRRO = '".$bairro."',
			MUNICIPIO = '".$municipio."',
			UF = '".$uf."',
			OBSERVACOES = '".$observacoes."',
			LOGDATAALTERACAO = '".$datetime."' 
			WHERE HANDLE = $handlePessoa
		   ";
	$connect->exec($sql);
	$connect->commit();
	
	$retorno = array('Cadastro atualizado com sucesso');
	echo json_encode($retorno);
}
catch(PDOException $e){
    $e->getMessage(); 
	$retorno = array('Não foi possível atualizar os dados, tente novamente!');
	echo json_encode($sql);
}

$connect = null;
?>