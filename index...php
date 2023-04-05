<?php
//Iniciar Sessão
session_start();

//Limpar o buffer de saida
ob_start();

//Incluir a conexao com BD
include_once 'conexao.php';

//Receber o id do registro
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//Pagina que exibe de erro ao logar
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Cursos</title>

    <link rel="stylesheet" href="css/style.css">

    <!-- Boostrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- JavaScript Boostrap -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
        crossorigin="anonymous"></script>

    <!-- Icons do Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/f7f942cbb7.js" crossorigin="anonymous"></script>

</head>
<!-- Exibe informações sobre a plataforma -->
<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row input-box">
                <div class="col-md-6 index-text">
                    <h1>World Cursos</h1>
                    <br>
                    <p>Para aqueles que buscam:</p>
                    <ul id="about-list">
                        <li>
                            <i class="fa-solid fa-check"></i>
                            Adquirir novas habilidades
                        </li>
                        <li>
                            <i class="fa-solid fa-check"></i>
                            Atinjir o seu Real Potencial
                        </li>
                        <li>
                            <i class="fa-solid fa-check"></i>
                            Alcançar a sonhada promoção
                        </li>
                        <li>
                            <i class="fa-solid fa-check"></i>
                            Dar um upgrade em seus projetos
                        </li>
                        <li>
                            <i class="fa-solid fa-check"></i>
                            Dar os proximos passos na Carreira
                        </li>
    
                    </ul>
                    <br>
                    <p>Acesse a qualquer hora ou lugar em qualquer idioma</p>
                    <p>Uma ampla seleção de cursos com os melhores preços do mercado.</p>
                    <p class="hidden">Tudo que você precisa para Aprender, Crescer e se Desenvolver.</p>
    
                    <h5>Crie sua conta e comece agora !</h5>
                </div>

                <div class="col-md-6 index-form">
                    <form action="teste_login.php" method="POST">
                        <fieldset>
                            <legend class="mb-4 text-center">Acessar</legend>
                            <p style='color: red;'>Erro: Usuário ou senha inválidos!</p>
                            <div class="mb-3 form-floating">
                                <input type="email" class="form-control" name="usuario" id="email" required="required">
                                <label for="floatingInput">Email</label>
                            </div>
        
                            <div class="mb-4 form-floating">
                                <input type="password" class="form-control" id="senha" name="senha_usuario" minlength="8"
                                    size="8" required="required">
                                <label for="floatingInput">Senha</label>
                            </div>
        
                            <div class="mb-3 form-floating">
                                <input type="submit" value="Acessar" class="btn btn-primary" name="SendLogin">
                            </div>
                            <!-- Envia o usuário para a página de cadastro -->
                            <p>Ainda não tem uma conta ?</p>
                            <p>
                                <a href="cadastro.php" target="_self" name="enviar" rel="next">Cadastre-se aqui</a>
                            </p>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>