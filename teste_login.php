<?php
//Iniciar Sessão
session_start();

//Limpar o buffer de saida
ob_start();

//Incluir a conexao com BD
include_once 'conexao.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Query recuperar as informações do usuário
if (!empty($dados['SendLogin'])) {
    //var_dump($dados);
    $query_usuario = "SELECT id, usuario, senha_usuario FROM usuarios WHERE usuario =:usuario LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
    $result_usuario->execute();

    if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        //var_dump($row_usuario);

        //Query verifica o usuário e a senha
        if (password_verify($dados['senha_usuario'], $row_usuario['senha_usuario'])) {
            $_SESSION['id'] = $row_usuario['id'];
            header("Location: home/home.php");
        } else {
            header("Location: index...php");
        }
    } else {
        header("Location: index...php");
    }

}

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>