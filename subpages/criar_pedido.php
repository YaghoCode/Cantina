<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');
session_start();
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método inválido']);
    exit;
}

if (!isset($_SESSION['cpf'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

$cpf = $_SESSION['cpf'];

// Recebe dados via POST (JSON strings)
$nome_itens = isset($_POST['nome_itens']) ? $_POST['nome_itens'] : null;
$quantidade_itens = isset($_POST['quantidade_itens']) ? $_POST['quantidade_itens'] : null;
$preco_itens = isset($_POST['preco_itens']) ? $_POST['preco_itens'] : null;
$preco_total = isset($_POST['preco_total']) ? $_POST['preco_total'] : null;

if (empty($nome_itens) || empty($quantidade_itens) || empty($preco_itens) || $preco_total === null) {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
    exit;
}

// Valida se são JSON válidos
$nomes_arr = json_decode($nome_itens, true);
$qtds_arr = json_decode($quantidade_itens, true);
$precos_arr = json_decode($preco_itens, true);

if (!is_array($nomes_arr) || !is_array($qtds_arr) || !is_array($precos_arr)) {
    echo json_encode(['success' => false, 'message' => 'Formato de dados inválido']);
    exit;
}

// Formata os dados
$nome_itens_json = implode(', ', $nomes_arr); // Concatena nomes sem colchetes
$quantidade_itens_json = implode(', ', array_map(function($qtd) {
    return $qtd . 'x'; // Adiciona "x" ao lado da quantidade
}, $qtds_arr));
$preco_itens_json = implode(', ', array_map(function($preco) {
    return 'R$' . number_format($preco, 2, ',', '.'); // Formata preço com R$ e duas casas decimais
}, $precos_arr));

$preco_total_float = floatval($preco_total);

$query = "INSERT INTO pedido (cpf, nome_itens, quantidade_itens, preco_itens, preco_total, status) VALUES (?, ?, ?, ?, ?, 'Sendo Preparado')";
$stmt = $con->prepare($query);
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Erro no prepare: ' . $con->error]);
    exit;
}

$stmt->bind_param('ssssd', $cpf, $nome_itens_json, $quantidade_itens_json, $preco_itens_json, $preco_total_float);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Pedido criado']);
    header('Location: /cantinarepositorio/subpages/pagamento_cliente_page.php'); exit;
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao inserir: ' . $stmt->error]);
    exit;
}

$stmt->close();
?>