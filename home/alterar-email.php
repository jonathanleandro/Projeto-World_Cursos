<?php

//Iniciar Sessão
session_start();

//Limpar o buffer de saida
ob_start();

//Incluir a conexao com BD
include_once '../conexao.php';

//Receber o id do registro
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//Query recuperar as compras do usuario
$query_usuario = "SELECT id, usuario, senha_usuario FROM usuarios WHERE id=:id LIMIT 1";
$result_usuario = $conn->prepare($query_usuario);
$result_usuario->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
$result_usuario->execute();

//Query recuperar as informações do usuário
if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
    //var_dump($row_usuario);
    extract($row_usuario);
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Necessário realizar o login para acessar a página!</div>";
    header("Location: ../index.php");
    exit();
}

//Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Verificar se o usuário clicou no botão
if (!empty($dados['EditUsuario'])) {
    $empty_input = false;
    $dados = array_map('trim', $dados);
    if (in_array("", $dados)) {
        $empty_input = true;
        echo "<p style='color: #f00;'>Erro: Necessário preencher todos campos!</p>";
    } elseif (!filter_var($dados['usuario'], FILTER_VALIDATE_EMAIL)) {
        $empty_input = true;
        echo "<p style='color: #f00;'>Erro: Necessário preencher com e-mail válido!</p>";
    }

    //Verifica se o usuário a ser alterado já existe
    $consulta = $conn->prepare("SELECT * FROM usuarios WHERE usuario = '$dados[usuario]'");
    $consulta->execute();
    $linhas = $consulta->rowCount();
    if ($linhas >= 1) {
        header("Location: conta..php");
    } else {

        //Altera o usuario    
        if (!$empty_input) {
            $query_up_usuario = "UPDATE usuarios SET usuario=:usuario WHERE id=:id";
            $edit_usuario = $conn->prepare($query_up_usuario);
            $edit_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
            $edit_usuario->bindParam(':id', $id, PDO::PARAM_INT);
            if ($edit_usuario->execute()) {
                $_SESSION['msg'] = "<p style='color: green;'>Usuário alterado com sucesso!</p>";
                header("Location: conta.php");
            } else {
                echo "<p style='color: #f00;'>Erro: Usuário não alterado</p>";
            }
        }
    }
}
//Altera a senha
if (!empty($dados['ResetarSenha'])) {
    $senha_usuario = password_hash($dados['senha_usuario'], PASSWORD_DEFAULT);

    $query_up_usuario = "UPDATE usuarios SET senha_usuario =:senha_usuario WHERE id =:id LIMIT 1";
    $result_up_usuario = $conn->prepare($query_up_usuario);
    $result_up_usuario->bindParam(':senha_usuario', $senha_usuario, PDO::PARAM_STR);
    $result_up_usuario->bindParam(':id', $id, PDO::PARAM_INT);

    if ($result_up_usuario->execute()) {
        $_SESSION['msg'] = "<p style='color: green'>Senha atualizada com sucesso!</p>";
        header("Location: conta.php");
    } else {
        echo "<p style='color: #ff0000'>Erro: Tente novamente!</p>";
    }
}

?>