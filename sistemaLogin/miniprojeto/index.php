<?php 
include("./database.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <a href="./login.php">LOGIN</a><br><br>
    <a href="./cadastro.php">CADASTRO</a><br><br>
    <a href="./logout.php">LOGOUT</a><br><br>
    
</head>
<body>
</body>
</html>

<?php 
if (isset($_SESSION['cpf'])) {
    $cpf = $_SESSION['cpf'];
    $query = "SELECT nome, cpf FROM cliente WHERE cpf = '$cpf'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        echo "CPF: " . $user_data['cpf'] . "<br>";
        echo "Nome: " . $user_data['nome'] . "<br>";
    } else {
        echo "Usuário não encontrado.";
    }
} else {
    echo "Nenhum usuário logado. <br><br>";
    echo "Ao logar, você verá os dados do usuário aqui.";
}

mysqli_close($con);
?>