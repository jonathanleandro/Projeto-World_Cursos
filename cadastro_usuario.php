<?php
//Incluir a conexao com BD
include_once 'conexao.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//var_dump($dados);

//Verifica que o usuário apertou o botão
if (isset($_POST['enviar'])) {
    $cliente = filter_input(INPUT_POST, 'usuario');

    //Verifica se o campo não está vazio
    if (empty($cliente)) {
        echo '<script>alert("ERRO: Preencha o campo acima")</script>';
    } else {
        //Verifica se o usuário já não está cadastrado
        $consulta = $conn->prepare("SELECT * FROM usuarios WHERE usuario = '$dados[usuario]'");
        $consulta->execute();
        $linhas = $consulta->rowCount();
        if ($linhas >= 1) {
            echo 'Usuário já cadastrado<br>';
            header("Location: cadastro..php");
            exit;

        } else {
            //Criptografa a senha
            $dados['senha_usuario'] = password_hash($dados['senha_usuario'], PASSWORD_DEFAULT);

            //Query adiciona o usuário e senha ao BD
            $query_usuario = "INSERT INTO usuarios (usuario, senha_usuario) VALUES (:usuario, 
            :senha_usuario)";
            $cad_usuario = $conn->prepare($query_usuario);
            $cad_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
            $cad_usuario->bindParam(':senha_usuario', $dados['senha_usuario'], PDO::PARAM_STR);

            $cad_usuario->execute();

            //Redireciona o usuário
            if ($cad_usuario->rowCount()) {
                header("Location: index..php");
                exit;
            } else {
                header("Location: cadastro..php");
                exit;
            }
        }

    }
}
?>