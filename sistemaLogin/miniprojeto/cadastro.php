<?php
include('./database.php')

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">

        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>CPF:</label><br>
        <input type="text" name="cpf" maxlength="11" pattern="\d{11}" title="Digite apenas números, 11 dígitos" required><br><br>   <!--pattern assegura que o cpf esteja em parametros -->

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>

        <label>Turma:</label><br>
        <select name="turma" required>
            <option value="">Selecione</option>
            <option value="1ds">1°DS</option>
            <option value="2ds">2°DS</option>
            <option value="3ds">3°DS</option>
        </select><br><br>

        <input type="submit" value="Enviar"><br><br>

    </form>

    <a href="./login.php">LOGIN</a><br><br>
    
</body>
</html>

<?php



try{
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];
    $turma = $_POST['turma'];

    $hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO cliente(nome, cpf, email, turma, senha) VALUES ('$nome', '$cpf', '$email', '$turma', '$hash')";
    mysqli_query($con, $sql);
    echo "Dados inseridos com sucesso!";
}   
}catch(mysqli_sql_exception){
    echo "Erro ao inserir dados! CPF já cadastrado";
}



mysqli_close($con);
?>