<?php
include_once('../../model/php/sistema.php');

	$connect = Sistema::getConexao();

	$nome = Sistema::getPost('nome');
	$cpjcnpj = Sistema::getPost('cpjcnpj');
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
	$sql = "INSERT INTO `pessoa`
			  (`NOME`, `CPFCNPJ`, `TELEFONE`, `EMAIL`, `CEP`, `LOGRADOURO`, `NUMERO`, `COMPLEMENTO`, `BAIRRO`, `MUNICIPIO`, `UF`, `OBSERVACOES`, `LOGDATACADASTRO`) 
			  VALUES
			  ('".$nome."', '".$cpjcnpj."', '".$telefone."', '".$email."', '".$cep."', '".$logradouro."', '".$numero."', '".$complemento."', '".$bairro."', '".$municipio."', '".$uf."', '".$observacoes."', '".$datetime."' )
			  ";
	$connect->exec($sql);
	$connect->commit();
	
	$retorno = array('Cadastro efetuado com sucesso');
	echo json_encode($retorno);
}
catch(PDOException $e){
    $e->getMessage(); 
	$retorno = array('Não foi possível cadastrar os dados, tente novamente!');
	echo json_encode($retorno);
}

$connect = null;
?>