<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = $_POST['cpfid'];
    $senha_atual = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // Validação básica
    if ($nova_senha !== $confirmar_senha) {
        echo "As senhas não coincidem.";
        exit;
    }

    // Busca a senha atual no banco
    $query = "SELECT senha FROM cliente WHERE cpf = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 's', $cpf);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $senha_hash);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Verifica se a senha atual está correta
    if (!password_verify($senha_atual, $senha_hash)) {
        echo "Senha atual incorreta.";
        exit;
    }

    // Atualiza a senha
    $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
    $update = "UPDATE cliente SET senha = ? WHERE cpf = ?";
    $stmt = mysqli_prepare($con, $update);
    mysqli_stmt_bind_param($stmt, 'ss', $nova_senha_hash, $cpf);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: editar_cliente_page.php");
        exit;
    } else {
        echo "Erro ao atualizar a senha.";
    }
}
?>