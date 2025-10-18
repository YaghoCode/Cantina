<?php
session_start();
header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'] . '/cantinarepositorio/main/database.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['cpf'])) {
    echo json_encode(['success' => false, 'message' => 'CPF não fornecido']);
    exit;
}

$cpf = $_POST['cpf'];

// Verifica existência
$stmt = mysqli_prepare($con, "SELECT cpf FROM administradores WHERE cpf = ?");
mysqli_stmt_bind_param($stmt, 's', $cpf);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
if (mysqli_stmt_num_rows($stmt) === 0) {
    mysqli_stmt_close($stmt);
    echo json_encode(['success' => false, 'message' => 'Administrador não encontrado']);
    exit;
}
mysqli_stmt_close($stmt);

// Deleta
$stmt = mysqli_prepare($con, "DELETE FROM administradores WHERE cpf = ?");
mysqli_stmt_bind_param($stmt, 's', $cpf);
$ok = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

if ($ok) {
    $logout = false;
    if (isset($_SESSION['cpf']) && $_SESSION['cpf'] === $cpf) {
        // se deletou a conta logada, encerra sessão
        session_unset();
        session_destroy();
        $logout = true;
    }
    echo json_encode(['success' => true, 'logout' => $logout]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao deletar administrador']);
}
?>