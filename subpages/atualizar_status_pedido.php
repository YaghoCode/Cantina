<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');
session_start();

// Apenas POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /cantinarepositorio/subpages/estoque.php');
    exit;
}

// Verifica parâmetros
$pedido_id = isset($_POST['pedido_id']) ? intval($_POST['pedido_id']) : 0;
$status = isset($_POST['status']) ? trim($_POST['status']) : '';

$allowed = ['Sendo Preparado', 'Concluído', 'Cancelado'];
if ($pedido_id <= 0 || !in_array($status, $allowed, true)) {
    $_SESSION['pedido_msg'] = 'Dados inválidos para atualização.';
    header('Location: /cantinarepositorio/subpages/estoque.php');
    exit;
}

// (Opcional) verificar se usuário é admin
if (!isset($_SESSION['cpf'])) {
    $_SESSION['pedido_msg'] = 'Acesso negado.';
    header('Location: /cantinarepositorio/subpages/login.php');
    exit;
}

$stmt = $con->prepare("UPDATE pedido SET status = ? WHERE id = ?");
if (!$stmt) {
    $_SESSION['pedido_msg'] = 'Erro no banco: ' . $con->error;
    header('Location: /cantinarepositorio/subpages/estoque.php');
    exit;
}

$stmt->bind_param('si', $status, $pedido_id);
if ($stmt->execute()) {
    $_SESSION['pedido_msg'] = 'Status atualizado.';
} else {
    $_SESSION['pedido_msg'] = 'Falha ao atualizar: ' . $stmt->error;
}
$stmt->close();

header('Location: /cantinarepositorio/subpages/estoque.php');
exit;
?>