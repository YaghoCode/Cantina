
<?php
// debug helpers
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json; charset=utf-8');

$input = file_get_contents('php://input');
if (!$input) {
    http_response_code(400);
    echo json_encode(['error' => 'Nenhum payload recebido', 'hint' => 'Envie JSON com {"valor":..., "idPedido":"..."}']);
    exit;
}

$nodeUrl = 'http://localhost:4000/api/pix';

$ch = curl_init($nodeUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, $input);
$response = curl_exec($ch);
$curlErr = curl_error($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($curlErr) {
    http_response_code(500);
    echo json_encode(['error' => 'cURL error', 'detail' => $curlErr, 'nodeUrl' => $nodeUrl]);
    exit;
}

// repassa resposta do node (espera JSON)
http_response_code($httpCode ?: 200);
echo $response;
?>