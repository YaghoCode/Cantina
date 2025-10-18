<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');
session_start();




  if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      if(isset($_POST['action'])){
        if($_POST['action'] === 'cadastrar'){
          // código de cadastro
          $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
          $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_NUMBER_INT);
          $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
          $senha = $_POST['senha'];
          $turma = $_POST['turma'];

          $hash = password_hash($senha, PASSWORD_DEFAULT);

          $sql = "INSERT INTO cliente(nome, cpf, email, turma, senha) VALUES ('$nome', '$cpf', '$email', '$turma', '$hash')";
          if (!mysqli_query($con, $sql)) {
            echo "<script> alert('Erro em inserir seus dados! CPF já cadastrado.')</script>";
          } else {
            echo "<script> alert('Seus dados foram inseridos com sucesso!')</script>";
          }
      
          }
          elseif($_POST["action"] === "entrar"){
           // código de login
          $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_NUMBER_INT);
          $senha = $_POST['senha'];

            // Tenta login como cliente
            $query_cliente = "SELECT * FROM cliente WHERE cpf = '$cpf'";
            $result_cliente = mysqli_query($con, $query_cliente);

          if (mysqli_num_rows($result_cliente) > 0) {
            $user_data = mysqli_fetch_assoc($result_cliente);
            if (password_verify($senha, $user_data['senha'])) {
            $_SESSION['cpf'] = $user_data['cpf'];
            header("Location: /cantinarepositorio/main/index.php");
             exit;
    }
}

// Tenta login como administrador
$query_admin = "SELECT * FROM administradores WHERE cpf = '$cpf'";
$result_admin = mysqli_query($con, $query_admin);

if (mysqli_num_rows($result_admin) > 0) {
    $user_data = mysqli_fetch_assoc($result_admin);
    if (password_verify($senha, $user_data['senha'])) {
      
        $_SESSION['cpf'] = $user_data['cpf'];
        $_SESSION['admin'] = true;
        header("Location: /cantinarepositorio/main/index.php");
        exit;
    }
}

// Se chegou aqui, login falhou
echo "<script> alert('CPF ou Senha inválidos!')</script>";
        }
    }
   
}


if(isset($_SESSION['cpf'])){
  $cpf = $_SESSION['cpf'];
  $query = "SELECT nome, cpf FROM cliente WHERE cpf = '$cpf'";
  $result = mysqli_query($con, $query);

  if($result && mysqli_num_rows($result) > 0){
    header("Location: /cantinarepositorio/main/index.php");
    exit;
  }
  $query_admin = "SELECT nome, cpf FROM administradores WHERE cpf = '$cpf'";
  $result_admin = mysqli_query($con, $query_admin);
  if($result_admin && mysqli_num_rows($result_admin) > 0){
    header("Location: /cantinarepositorio/main/index.php");
    exit;
  }
}

mysqli_close($con);
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FURA FILA - Login</title>

  <!-- Bootstrap e FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <!-- Seu CSS -->
  <link rel="stylesheet" href="./assets/css/pagesCliente/login.css" />
</head>

<body class="body">
  <!-- Navbar -->
  <!-- header, navbar -->
  <header>
    <nav class="navbar">
      <div class="nav-links">
          <button style="display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    background-color: transparent;
                                    color: var(--cor-primaria);
                                    font-family: var(--font-titulo);
                                    font-weight: 600;
                                    border: none;
                                    height: 6vh;
                                    width: 8%;
                                    font-size:1.5rem;
                                    gap: 1.2vh;">
            <a style="color: inherit;
    text-decoration: none;" href="/cantinarepositorio/main/index.php">  <i class="fa-solid fa-caret-left"></i> Voltar</a>
          </button>
      </div>
    </nav>
  </header>

  <!-- Login / Cadastro -->
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="login.php" method="post" >
                <h1 class="h1-sign">Cadastra-se!</h1>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>

                <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" maxlength="11" pattern="\d{11}" required>
                
                <select name="turma" required>
                  <option value="">Selecione</option>
                  <option value="1ds">1°DS</option>
                  <option value="2ds">2°DS</option>
                  <option value="3ds">3°DS</option>
                </select>
                
                <input type="email" id="email" name="email" placeholder="exemplo@email.com" required>
                
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" minlength="6" required>
                
                <button name="action" value="cadastrar" type="submit">Entrar</button>
            </form>
        </div>
        <div class="form-container sign-in" id="form-login">
            <form action="login.php" method="post">
              <div style="text-align:center;"><h1 class="h1-sign">Bem-vindo ao site da <br> #Cantina-PJ</h1></div>
                <span>Faça o login
                  e aproveite a experiência</span>
                <input type="text" name="cpf" id="cpf" maxlength="11" placeholder="000.000.000-00" pattern="\d{11}" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <button name="action" value="entrar" type="submit">
                  <a style="color: inherit; text-decoration: none;" >Entrar</a>
                </button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Já tem uma conta?</h1>
                    <p>Entre em sua conta pessoal para usufruir de nosso site</p>
                    <button class="hidden" id="login">Logar</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Olá Pejotense!</h1>
                    <p>Cadastre-se para usar todos as nossas ofertas e novidades.</p>
                    <button class="hidden" id="register">Cadastre-se</button>
                </div>
            </div>
        </div>
    </div>

    <script src="./assets/js/pageCliente/login.js"></script>
</body>
</html>

