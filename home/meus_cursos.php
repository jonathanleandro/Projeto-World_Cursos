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
$query_usuario = "SELECT id FROM usuarios WHERE id=:id LIMIT 1";
$result_usuario = $conn->prepare($query_usuario);
$result_usuario->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
$result_usuario->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Cursos</title>

    <link rel="stylesheet" href="../css/style.css">

    <!-- Boostrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>

    <!-- JavaScript Boostrap -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
        crossorigin="anonymous"></script>

    <!-- Icons do Bootstrap -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />

    <!-- Font Awesome -->

    <script src="https://kit.fontawesome.com/f7f942cbb7.js" crossorigin="anonymous"></script>

    <!-- JQuery -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

</head>

<body>
    <!-- NavBar -->
    <header>
        <nav class="navbar bg-color fixed-top" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="home.php">World Cursos</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Meu Painel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="
                                    conta.php">Conta</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="meus_cursos.php">Meus Cursos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../sair.php">Sair</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- Pagina dos Cursos Adquiridos-->
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="main-title">Meus Cursos</h3>
                </div>
            </div>
            <?php
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
            //LEFT JOIN puxa todas as informações, concatena e exibe as informações do BD
            $query_carrinhos = "SELECT usuarios.*,carrinho.*, cursos.*  FROM usuarios LEFT JOIN carrinho ON carrinho.idusuario = usuarios.id LEFT JOIN cursos ON carrinho.idcurso = cursos.id WHERE idusuario =:usuario";
            $result_carrinhos = $conn->prepare($query_carrinhos);
            $result_carrinhos->bindParam(':usuario', $id);
            $result_carrinhos->execute();
            ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">

                <!-- Exibe todos os cursos adicionados pelo usuário-->
                <?php
                if (($result_carrinhos) and ($result_carrinhos->rowCount() != 0)) {
                    while ($row_carrinho = $result_carrinhos->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_carrinho);
                        ?>
                        <!-- Mostra as informações dos cursos em cards -->
                        <div class="col">
                            <div class="card h-100">
                                <img src='<?php echo "img/$id/$image"; ?>' class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo $name; ?>
                                    </h5>
                                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in
                                        to additional content. This content is a little bit longer.</p>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="btn btn-primary">Acessar</a>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                } else {
                    echo "<p style='color: #f00';>Nenhum curso adquirido</p>";
                }
                ?>
            </div>
        </div>
    </main>
    <!-- Rodapé -->
    <footer>
        <div id="copy-area">
            <div class="copy-container">
                <p>Desenvolvido por Jonathan Leandro &copy; 2023 - Todos os Direitos Reservados</p>
            </div>
        </div>
    </footer>
</body>
</html>