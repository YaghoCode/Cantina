<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = intval($_POST['cpfid']);
    $nome = mysqli_real_escape_string($con, $_POST['nome']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $adm = mysqli_real_escape_string($con, $_POST['funcao']); // 'funcao' deve ser enviado como 0 ou 1

    // Verifique se todos os campos obrigatórios foram preenchidos
    // Crie a query de atualização
    $query = "UPDATE administradores SET nome = '$nome', email = '$email', adm = '$adm'";

    
    $query .= " WHERE cpf = $cpf";

    // Execute a query
    if (mysqli_query($con, $query)) {
        // Redirecione após sucesso
        header('Location: estoque.php');
        exit;
    } else {
        echo "Erro ao atualizar o item: " . mysqli_error($con);
    }
}
