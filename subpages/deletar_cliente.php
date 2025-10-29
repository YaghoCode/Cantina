teste
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('/xampp/htdocs/cantinarepositorio/main/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = $_POST['cpf'] ?? null;

    if (!empty($cpf)) {
        $query = "DELETE FROM cliente WHERE cpf = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('s', $cpf);

        if ($stmt->execute()) {
            // Redirecionar com mensagem de sucesso
            header('Location: /cantinarepositorio/subpages/estoque.php?mensagem=Cliente excluído com sucesso');
            exit;
        } else {
            // Redirecionar com mensagem de erro
            header('Location: /cantinarepositorio/subpages/estoque.php?mensagem=Erro ao excluir cliente');
            exit;
        }
    } else {
        // Redirecionar com mensagem de erro
        header('Location: /cantinarepositorio/subpages/estoque.php?mensagem=CPF inválido');
        exit;
    }
} else {
    // Redirecionar se o método não for POST
    header('Location: /cantinarepositorio/subpages/estoque.php?mensagem=Método inválido');
    exit;
}
?>
