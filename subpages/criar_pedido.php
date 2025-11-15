<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /cantinarepositorio/subpages/finalizar_pedido_cliente.php');
    exit;
}

if (!isset($_SESSION['cpf'])) {
    header('Location: /cantinarepositorio/subpages/login.php');
    exit;
}

$cpf = $_SESSION['cpf'];

$nome_itens_raw = $_POST['nome_itens'] ?? '';
$quantidade_itens_raw = $_POST['quantidade_itens'] ?? '';
$preco_itens_raw = $_POST['preco_itens'] ?? '';
$preco_total_raw = $_POST['preco_total'] ?? '';

if ($nome_itens_raw === '' || $quantidade_itens_raw === '' || $preco_itens_raw === '' || $preco_total_raw === '') {
    $_SESSION['pedido_msg'] = 'Dados do pedido incompletos.';
    header('Location: /cantinarepositorio/subpages/finalizar_pedido_cliente.php');
    exit;
}

// Decodifica JSON (espero que finalizar_pedido_cliente.php envie arrays JSON)
$nomes = json_decode($nome_itens_raw, true);
$quantidades = json_decode($quantidade_itens_raw, true);
$precos = json_decode($preco_itens_raw, true); // aqui preco_item já deve ser subtotal por item (unit * qtd)
$preco_total = floatval($preco_total_raw);

if (!is_array($nomes) || !is_array($quantidades) || !is_array($precos)) {
    $_SESSION['pedido_msg'] = 'Formato de dados inválido.';
    header('Location: /cantinarepositorio/subpages/finalizar_pedido_cliente.php');
    exit;
}

$count = min(count($nomes), count($quantidades), count($precos));
if ($count === 0) {
    $_SESSION['pedido_msg'] = 'Carrinho vazio.';
    header('Location: /cantinarepositorio/subpages/finalizar_pedido_cliente.php');
    exit;
}

// formata strings para a tabela pedido (sem colchetes)
$nome_itens_conc = substr(implode(', ', array_map('trim', $nomes)), 0, 255);
$quantidade_itens_fmt = implode(', ', array_map(function($q){ return intval($q) . 'x'; }, $quantidades));
$preco_itens_fmt = implode(', ', array_map(function($p){ return 'R$' . number_format(floatval($p), 2, ',', '.'); }, $precos));

$con->begin_transaction();

try {
    // 1) Insere metadados em pedido (mantém o histórico agregado)
    $stmt = $con->prepare("INSERT INTO pedido (cpf, nome_itens, quantidade_itens, preco_itens, preco_total, status) VALUES (?, ?, ?, ?, ?, 'Sendo Preparado')");
    if (!$stmt) throw new Exception($con->error);
    $stmt->bind_param('ssssd', $cpf, $nome_itens_conc, $quantidade_itens_fmt, $preco_itens_fmt, $preco_total);
    if (!$stmt->execute()) throw new Exception($stmt->error);
    $pedido_id = $con->insert_id;
    $stmt->close();

    // 2) Insere cada item em pedido_itens (uma row por item) com data/hora
    $stmtItem = $con->prepare("INSERT INTO pedido_itens (pedido_id, nome_item, quantidade, preco_item, data_pedido, hora_pedido) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmtItem) throw new Exception($con->error);

    $data_pedido = date('Y-m-d');
    $hora_pedido = date('H:i:s');

    for ($i = 0; $i < $count; $i++) {
        $nome = trim((string)$nomes[$i]);
        $qtd = max(1, intval($quantidades[$i]));
        $preco_item = floatval($precos[$i]); // subtotal do item (unit * qtd) conforme preenchido na página
        $stmtItem->bind_param('isidss', $pedido_id, $nome, $qtd, $preco_item, $data_pedido, $hora_pedido);
        if (!$stmtItem->execute()) throw new Exception($stmtItem->error);
    }
    $stmtItem->close();

    $con->commit();

    // opcional: limpar carrinho no cliente é feito na página de pagamento
    header('Location: /cantinarepositorio/subpages/pagamento_cliente_page.php');
    exit;
} catch (Exception $e) {
    $con->rollback();
    $_SESSION['pedido_msg'] = 'Erro ao salvar pedido: ' . $e->getMessage();
    header('Location: /cantinarepositorio/subpages/finalizar_pedido_cliente.php');
    exit;
}
?>