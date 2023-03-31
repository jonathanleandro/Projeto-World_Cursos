<?php
//Iniciar Sessão
session_start();

//Limpar o buffer de saida
ob_start();

//Incluir a conexao com BD
include_once 'conexao.php';

//Receber o id do registro
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//Query que encerra a sessão
unset($_SESSION['id'], $_SESSION['nome']);
$_SESSION['msg'] = "<p style='color: green'>Deslogado com sucesso!</p>";

header("Location: index.php");

?>