<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /cantinarepositorio/subpages/pagamento_cliente_page.php');
    exit;
}

if (!isset($_SESSION['cpf'])) {
    header('Location: /cantinarepositorio/subpages/login.php');
    exit;
}

$cpf = $_SESSION['cpf'];

// Atualiza o status do pedido mais recente para "Concluído"
$query = "UPDATE pedido SET status = 'Concluído' WHERE cpf = ? ORDER BY id DESC LIMIT 1";
$stmt = $con->prepare($query);

if (!$stmt) {
    $_SESSION['pagamento_msg'] = 'Erro no banco: ' . $con->error;
    header('Location: /cantinarepositorio/subpages/pagamento_cliente_page.php');
    exit;
}

$stmt->bind_param('s', $cpf);

if ($stmt->execute()) {
    $_SESSION['pagamento_msg'] = 'Pagamento confirmado com sucesso!';
    $_SESSION['pagamento_sucesso'] = true;
    header('Location: /cantinarepositorio/subpages/pagamento_cliente_page.php');
    exit;
} else {
    $_SESSION['pagamento_msg'] = 'Erro ao confirmar pagamento: ' . $stmt->error;
    header('Location: /cantinarepositorio/subpages/pagamento_cliente_page.php');
    exit;
}

$stmt->close();
?>