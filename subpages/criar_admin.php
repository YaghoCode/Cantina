<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($con, $_POST['nome_criar_admin']);
    $cpf = mysqli_real_escape_string($con, $_POST['cpf']);
    $email = mysqli_real_escape_string($con, $_POST['email_criar_admin']);
    $senha = $_POST['senha_criar_admin'];

    // Hash da senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO administradores (nome, cpf, email, senha, adm) VALUES ('$nome', '$cpf', '$email', '$senha_hash', 0)";
    if (mysqli_query($con, $sql)) {
        header("Location: estoque.php");
        exit;
    } else {
        echo "Erro ao criar administrador.";
    }
}
?>