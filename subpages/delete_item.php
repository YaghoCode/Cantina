<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']); // Sanitiza o ID recebido

    $query = "DELETE FROM estoque WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Item deletado com sucesso.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao deletar o item.']);
    }

    $stmt->close();
    $con->close();
    exit;
}
?>