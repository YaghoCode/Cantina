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
</head>
<body>
    <form action="<?php $_SERVER["PHP_SELF"]?>" method="post">
        <label>CPF:</label><br>
        <input type="text" name="cpf" maxlength="11" pattern="\d{11}" title="Digite apenas números, 11 dígitos" required><br><br>   <!--pattern assegura que o cpf esteja em parametros -->
        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>
        <input type="submit" value="Login"><br><br>
    </form>

    <a href="./cadastro.php">CADASTRO</a><br><br>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_NUMBER_INT);
    $senha = $_POST['senha'];

    $query = "SELECT * FROM cliente WHERE cpf = '$cpf'";
    $result = mysqli_query($con, $query);
    
    if(mysqli_num_rows($result) > 0){
        $user_data = mysqli_fetch_assoc($result);
        
        if(password_verify($senha, $user_data['senha'])) {
            $_SESSION['cpf'] = $user_data['cpf'];
            header("Location: index.php");
            exit;
        }
        else {
            echo "CPF ou senha inválidos!";
        }
    }
    
    }


mysqli_close($con)
?>