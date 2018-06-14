<?php
	include_once('../../model/php/sistema.php');
	$connect = Sistema::getConexao();

	$dados = $connect->prepare("SELECT *
								FROM pessoa
								ORDER BY NOME ASC
								");
	$dados->execute();
	

	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC), JSON_NUMERIC_CHECK);

$connect = null;
?>