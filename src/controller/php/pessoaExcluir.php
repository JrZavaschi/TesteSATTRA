<?php
include_once('../../model/php/sistema.php');

	$connect = Sistema::getConexao();

	$handlePessoa = Sistema::getGet('h');
	
try {
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM `pessoa` WHERE HANDLE = $handlePessoa";
	$connect->exec($sql);
	$connect->commit();
	
	header('Location:../../view/html/pessoa.html');
}
catch(PDOException $e){
    $e->getMessage(); 
	header('Location:../../view/html/pessoa.html');
}

$connect = null;
?>