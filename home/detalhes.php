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
$query_usuario = "SELECT * FROM usuarios WHERE id=:id LIMIT 1";
$result_usuario = $conn->prepare($query_usuario);
$result_usuario->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
$result_usuario->execute();

//Query recuperar as informações do usuário
if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
    //var_dump($row_usuario);
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Necessário realizar o login para acessar a página!</div>";
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Cursos - Detalhes</title>

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
                                <a class="nav-link" href="conta.php">Conta</a>
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
    <!-- Pagina com Detalhes do Cursos -->
    <main>
        <div class="container">
            <div class="row">
                <form action="" enctype="multipart/form-data" method="post">
                    <!-- //Query recuperar as informações do curso-->
                    <?php
                    $query_cursos = "SELECT id, name, description, price, image FROM cursos WHERE id =:id LIMIT 1";
                    $result_cursos = $conn->prepare($query_cursos);
                    $result_cursos->bindParam(':id', $id, PDO::PARAM_INT);
                    $result_cursos->execute();
                    $row_cursos = $result_cursos->fetch(PDO::FETCH_ASSOC);
                    extract($row_cursos);
                    ?>
            </div>
            <!-- Mostra a informação do curso escolhido em um card -->
            <h3 class="display-4 mt-5 mb-5 text-center">
                <?php echo $name; ?>
            </h3>
            <div class="row">
                <div class="col-md-6">
                    <img src='<?php echo "img/$id/$image"; ?>' class="card-img-top">
                </div>
                <div class="col-md-6">
                    <?php echo $description; ?>

                    <p>de: R$
                        <?php echo number_format($price, 2, ",", "."); ?>
                    </p>
                    <p>por: Grátis</p>

                    <p><input class="btn btn-primary" type="submit" name="enviar" value="Comprar"></p>
                    </form>

                    <!-- Envia as infromações do curso para o BD -->
                    <?php
                    if (isset($_POST['enviar'])) {

                        $sql = "SELECT * FROM carrinho WHERE idusuario = :idusuario AND idcurso = :idcurso";
                        $sql = $conn->prepare($sql);
                        $sql->bindValue("idusuario", $_SESSION['id']);
                        $sql->bindValue("idcurso", $id);
                        $sql->execute();

                        if ($sql->rowCount() > 0) {
                            echo "<p style='color: #f00';>Curso já adquirido</p>";
                        } else {

                            $query = "INSERT INTO carrinho(idusuario, idcurso) VALUES(:id, :idcurso)";
                            //$_SESSION['id'] = id do usuário da sessão
                            //$id = id do curso selecionado     
                            $stmt = $conn->prepare($query);
                            $stmt->execute(['id' => $_SESSION['id'], 'idcurso' => $id]);

                            header('Location: meus_cursos.php');

                        }
                    }
                    ?>
                </div>
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