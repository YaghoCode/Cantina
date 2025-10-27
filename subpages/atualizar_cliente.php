<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = $_POST['cpfid'];
    $nome = mysqli_real_escape_string($con, $_POST['nome']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $turma = mysqli_real_escape_string($con, $_POST['turma']);


    $query = "UPDATE cliente SET nome = '$nome', email = '$email', turma = '$turma'";

    $query .= " WHERE cpf = $cpf";

    if (mysqli_query($con, $query)) {
        header('Location: estoque.php');
        exit;
    } else {
        echo "Erro ao atualizar o item: " . mysqli_error($con);
    }
}
?>