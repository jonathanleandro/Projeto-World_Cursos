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

<body class="bg">
    <div class="Container">
        <div class="cadastro-text-1">
            <h1>World Cursos</h1>
            <br />
            <p>Ao se cadastrar, você ganha acesso a itens exclusivos:</p>
            <ul id="about-list">
                <li>
                    <i class="fa-solid fa-check"></i>
                    Descontos exclusivos !
                </li>
                <li>
                    <i class="fa-solid fa-check"></i>
                    Aulas Práticas + Certificado !
                </li>
                <li>
                    <i class="fa-solid fa-check"></i>
                    Chat exclusivo para alunos !
                </li>
                <li>
                    <i class="fa-solid fa-check"></i>
                    Acesso de qualquer localidade !
                </li>
                <li>
                    <i class="fa-solid fa-check"></i>
                    Suporte 24 Horas !
                </li>
            </ul>
            <br />
            <h5>Crie sua conta e comece agora !</h5>
        </div>
        <!-- Formulário de Cadastro -->
        <div class="cadastro-form-1">
            <form action="cadastro_usuario.php" method="post">
                <fieldset>
                    <legend class="text-center mb-4">Cadastrar</legend>
                    <div class="mb-3 form-floating">
                        <input type="email" name="usuario" class="form-control" id="email" required="required" />
                        <label for="floatingInput">Digite um Email</label>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="password" class="form-control" id="senha" minlength="8" size="8"
                            name="senha_usuario" required="required" />
                        <label for="floatingInput">Digite uma Senha</label>
                    </div>

                    <div class="mb-3">
                        <input type="submit" value="cadastar" class="btn btn-primary" name="enviar">
                    </div>
                    <!-- Envia o usuário para a página de Login -->
                    <p>Já tem uma conta ?</p>
                    <p>
                        <a href="index.php" target="_self" rel="prev">Acesse aqui</a>
                    </p>
                </fieldset>
            </form>
        </div>
    </div>
</body>
</html>