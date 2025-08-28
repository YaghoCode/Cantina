<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');
session_start();




try{
  if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      if(isset($_POST['action'])){
        if($_POST['action'] === 'cadastrar'){
          // código de login
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
      
          elseif($_POST["action"] === "entrar"){
           // código de cadastro
          $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_NUMBER_INT);
          $senha = $_POST['senha'];

            $query = "SELECT * FROM cliente WHERE cpf = '$cpf'";
            $result = mysqli_query($con, $query);
    
            if(mysqli_num_rows($result) > 0){
              $user_data = mysqli_fetch_assoc($result);
        
              if(password_verify($senha, $user_data['senha'])) {
            $_SESSION['cpf'] = $user_data['cpf'];
            header("Location: /cantinarepositorio/main/index.php");
            exit;
        }
        else {
            echo "CPF ou senha inválidos!";
        }
    }
      }
    }
}   
}catch(mysqli_sql_exception){
    echo "Erro ao inserir dados! CPF já cadastrado";
}



if(isset($_SESSION['cpf'])){
  $cpf = $_SESSION['cpf'];
  $query = "SELECT nome, cpf FROM cliente WHERE cpf = '$cpf'";
  $result = mysqli_query($con, $query);

  if($result && mysqli_num_rows($result) > 0){
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
  <title>Cantina PJ - Main</title>

  <!-- Bootstrap e FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <!-- Seu CSS -->
  <link rel="stylesheet" href="./assets/css/login.css" />
</head>

<body class="body">
  <!-- Navbar -->
  <!-- header, navbar -->
  <header>
    <nav class="navbar">
      <div class="nav-links">
        <div class="nav-logo"> <img src="./assets/img/img comidas/Logo-TCC-removebg-preview.png" alt=""> </div>
        <div class="nav-items">
          <ul>
            <li>
              <h1> <a href="#inicio" style="text-decoration: none; color: inherit;">Início</a> </h1>
            </li>
            <li>
              <h1> <a href="#Sobre-Nos" style="text-decoration: none; color: inherit;">Sobre Nós</a> </h1>
            </li>
          </ul>
        </div>
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
                  <option value="1adm">1°ADM</option>
                  <option value="2ds">2°ADM</option>
                  <option value="3ds">3°ADM</option>
                  <option value="1ds">1°JD</option>
                  <option value="2ds">2°RH</option>
                  <option value="3ds">3°RH</option>
                  <option value="3ds">1°DG</option>
                </select>
                
                <input type="email" id="email" name="email" placeholder="exemplo@email.com" required>
                
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                
                <button name="action" value="cadastrar" type="submit">Entrar</button>
            </form>
        </div>
        <div class="form-container sign-in" id="form-login">
            <form action="login.php" method="post">
                <h1 class="h1-sign">Bem-vindo á <br>#Cantina-PJ</h1>
                <span>Faça o login
                  e aproveite a experiência</span>
                <input type="text" name="cpf" id="cpf" maxlength="11" placeholder="000.000.000-00" pattern="\d{11}" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <button name="action" value="entrar" type="submit">
                  <a href="./logout.php">SAIR</a>
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

    <script src="./assets/js/login.js"></script>
</body>
</html>

