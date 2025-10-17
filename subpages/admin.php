<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');
session_start();

if (isset($_SESSION['cpf'])) {
    $cpf = $_SESSION['cpf'];

    // Tenta buscar como administrador
    $query_admin = "SELECT nome FROM administradores WHERE cpf = '$cpf'";
    $result_admin = mysqli_query($con, $query_admin);

    if ($result_admin && mysqli_num_rows($result_admin) > 0) {
        $user_data = mysqli_fetch_assoc($result_admin);
        // Permite acesso
    } else {
        // Não é admin, redireciona
        header("Location: ./cardapio.php");
        exit;
    }
} else {
    header("Location: ./login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="./assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <title>FURA FILA - Admin</title>
</head>

<body>
        <button class="btn-voltar-home">
        <a href="/cantinarepositorio/main/index.php" style="color: inherit; text-decoration:none;"> <i class="fa-solid fa-house"></i> Home</a>
        </button>
    <div class="main-container">
        <div class="title-main">
            <div class="logo-main">
                <img src="/cantinarepositorio/main/assets/img/logo-main.png" alt="">
            </div>
            <div class="logo-main-text">
                <div class="logo-main-text-h1">
                    <h1>Fura - Fila</h1>
                </div>
                <div class="logo-main-text-h2">
                    <h1>Cantina</h1>
                </div>
            </div>

        </div>
        <div class="description-main">
            <p>Sistema completo de gerenciamento para sua cantina. Controle estoque, clientes e muito mais.</p>
        </div>
        <div class="main-content">
            <div class="cards-options">
                <div class="cards">
                    <div class="icon-cards">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <div class="title-cards">
                        <h1>Controle de Estoque</h1>
                    </div>
                    <div class="description-cards">
                        <p>Gerencie produtos, monitore níveis de estoque e receba alertas quando necessário.</p>
                    </div>
                </div>
                <div class="cards">
                    <div class="icon-cards">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="title-cards">
                        <h1>Gestão de Clientes</h1>
                    </div>
                    <div class="description-cards">
                        <p>Cadastre clientes, acompanhe compras e mantenha relacionamento organizado.</p>
                    </div>
                </div>
                <div class="cards">
                    <div class="icon-cards">
                        <i class="fa-regular fa-chart-bar"></i>
                    </div>
                    <div class="title-cards">
                        <h1>Relatórios</h1>
                    </div>
                    <div class="description-cards">
                        <p>Analise vendas, produtos mais vendidos e performance da sua cantina.</p>
                    </div>
                </div>
            </div>
            <div class="btn-continuar">
                <button>
                    <a href="/cantinarepositorio/subpages/estoque.php">
                        Acessar Painel Administrativo
                    </a>
                </button>
            </div>
        </div>
    </div>

</body>

</html>