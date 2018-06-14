<?php
include_once('../../model/php/sistema.php');

	$connect = Sistema::getConexao();

	$handlePessoa = Sistema::getGet('h');
	
	$dados = $connect->prepare("SELECT *
								FROM pessoa
								WHERE HANDLE = $handlePessoa
								");
	$dados->execute();

	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC), JSON_NUMERIC_CHECK);

$connect = null;
?>