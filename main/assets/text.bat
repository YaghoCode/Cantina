<div class="modal-overlay-editar-admin">
        <!--Modal editar info admin-->
        <?php
        $query = "SELECT * from cliente";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $usuario) {
        ?>
                    <div class="modal-editar-admin" id="modaladm-<?= $usuario['cpf'] ?>">
                        <button class="btn-close-modal-editar-admin">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="form-editar-adm">
                            <div class="form-editar-adm-title">
                                <div class="form-editar-adm-title-text">
                                    <h1>
                                        Informações da Conta
                                    </h1>
                                    <p>
                                        Edite as informações da sua conta de administrador.
                                    </p>
                                </div>
                            </div>
                            <div class="form-editar-adm-content">
                                <form action="" class="form-editar-administrador">
                                    <div class="form-adm-row">
                                        <div class="form-adm-group">
                                            <label for="nome">Nome:</label>
                                            <input type="text" id="nome_admin" value="<?php $usuario['nome']?>" required> <!--TEXT NAME ADMIN CONTA PHP EM VALUE-->
                                        </div>
                                        <div class="form-adm-group">
                                            <label for="CPF">CPF:</label>
                                            <input type="CPF" id="CPF_admin" value="55132867832" disabled><i class="fa-solid fa-ban" style="color: #ff0000;"></i> <!--CPF text admin conta php em value-->
                                        </div>
                                    </div>
                                    <div class="form-adm-row">
                                        <div class="form-adm-group">
                                            <label for="telefone">Telefone:</label>
                                            <input type="text" id="telefone_admin" value="(11) 99999-9999" required> <!--TEXT telefone ADMIN CONTA PHP EM VALUE-->
                                        </div>
                                        <div class="form-adm-group">
                                            <label for="Email">Email:</label>
                                            <input type="Email" id="Email_admin" value="admin@gmail.com" required> <!--Email text admin conta php em value-->
                                        </div>
                                    </div>
                                    <div class="form-adm-row">
                                        <label for="funcao">Função</label>
                                        <select id="funcao" name="funcao" required>
                                            <option value="Administrador Principal" selected>Administrador Principal</option>
                                            <option value="Administrador Secundário">Administrador Secundário</option>
                                        </select><!--TEXT funcao ADMIN CONTA PHP EM VALUE-->
                                    </div>
                                    <div class="form-adm-row-btn">
                                        <div>
                                            <button class="form-editar-adm-btn-cancelar">
                                                Cancelar
                                            </button>
                                        </div>
                                        <div>
                                            <button type="submit" class="form-editar-adm-btn-mandar">
                                                <i class="fa-solid fa-floppy-disk"></i> Salvar Alterações
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>

        <script>
            //abrir modal editar admin
            document.addEventListener('DOMContentLoaded', () => {
            
            const overlayEditarAdmin = document.querySelector('.modal-overlay-editar-admin');
            const btnEditarAdmin = document.querySelectorAll('.btn-editar-admin');
            const btnCloseEditarAdmin = document.querySelectorAll('.btn-close-modal-editar-admin');
            const btnCancelarEditarAdmin = document.querySelectorAll('.form-editar-adm-btn-cancelar');

            document.querySelectorAll('.btn-editar-admin').forEach((button) => {
                button.addEventListener('click', () => {
                    const admId = button.getAttribute('data-id')
                    const modal = document.getElementById(`modaladm-${admId}`);
                    if(modal){
                    modal.classList.add('active');
                    overlayEditarAdmin.classList.add('active');
                    }
                })
            });

            btnCloseEditarAdmin.forEach((btn6) => {
                btn6.addEventListener('click', () => {
                    modalEditarAdmin.classList.remove('active');
                    overlayEditarAdmin.classList.remove('active');
                })
            });

            btnCancelarEditarAdmin.forEach((btn7) => {
                btn7.addEventListener('click', () => {
                    modalEditarAdmin.classList.remove('active');
                    overlayEditarAdmin.classList.remove('active');
                })
            });
        });
        </script>

         <h1>
            <a href="/cantinarepositorio/main/index.php" style="color: inherit; text-decoration:none;">Voltar Home</a>
        </h1>


        //dentro do tbody
        <?php

                                    $query = "SELECT * FROM cliente WHERE admin = 1";
                                    $query_run = mysqli_query($con, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $usuario) {

                                    ?>
                                            <tr>
                                                <td>
                                                    <h6><?php echo $usuario['nome'] ?></h6>
                                                </td>
                                                <td>
                                                    <h6><?php echo $usuario['email'] ?></h6>
                                                </td>
                                                <td>
                                                    <h6><?php echo $usuario['cpf'] ?></h6>
                                                </td>
                                                <td>
                                                    <h6><?php if ($usuario['adminplus'] == 1) {
                                                            echo 'Administrador Principal';
                                                        } else {
                                                            echo 'Adminstrador';
                                                        } ?></h6>
                                                </td>
                                                <td>
                                                    <button class="btn-editar-senha-admin" data-id="<?= $usuario['cpf'] ?>">
                                                        <i class="fa-solid fa-key"></i>
                                                    </button>
                                                    <button class="btn-editar-admin" data-id="<?= $usuario['cpf'] ?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button class="btn-deletar-admin" data-id="<?= $usuario['cpf'] ?>">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } ?>

                                    //buttons table 

                                    <button class="btn-editar-senha-admin" data-id="<?= $usuario['cpf'] ?>">
                                                        <i class="fa-solid fa-key"></i>
                                                    </button>
                                                    <button class="btn-editar-admin" data-id="<?= $usuario['cpf'] ?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button class="btn-deletar-admin" data-id="<?= $usuario['cpf'] ?>">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>


                                                    // editar item

                                                    
        <?php
        $query = "SELECT * from estoque";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $item) {
                $preco = 'R$ ' . number_format($item['preco'], 2, ',', '.');
                $item['valor_total'] = 'R$ ' . number_format($item['preco'] * $item['Quantidade'], 2, ',', '.');
        ?>
                <!-- MODAL EDITAR ITEM -->
                <div class="overlay-editar-produto" id="overlayEditar-<?= $item['id'] ?>">
                    <div class="modal-editar-produto" id="modalEditar-<?= $item['id'] ?>">
                        <button type="button" class="btn-fechar-editar" data-id="<?= $item['id'] ?>" title="Fechar modal">&times;</button>
                        <h2 class="editar-produto-titulo">Editar Produto:</h2>
                        <form id="formEditarProduto-<?= $item['id'] ?>" method="POST" action="atualizar_item.php" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>" />

                            <div class="editar-produto-imagem-box">
                                <img src="./imgbd/<?php echo $item['img'] ?>" alt="Imagem do produto" />
                            </div>

                            <div class="editar-produto-trocar-img">
                                <div>
                                    <h3>Trocar Imagem</h3>
                                    <p>Ative para fazer upload de uma nova imagem</p>
                                </div>
                                <label class="switch">
                                    <input type="radio" class="toggleTrocarImagem" id="toggleTrocarImagem-<?= $item['id'] ?>" name="trocar_imagem" value="1" />
                                    <span class="slider"></span>
                                </label>
                            </div>

                            <div class="editar-produto-inputs-duplo">
                                <div class="input-grupo">
                                    <label>Produto *</label>
                                    <input type="text" name="produto" value="<?= htmlspecialchars($item['Nome']) ?>" required />
                                </div>
                                <div class="input-grupo">
                                    <label>Categoria *</label>
                                    <select name="categoria" required>
                                        <option value="Salgados" <?= $item['Categoria'] == "Salgados" ? 'selected' : '' ?>>Salgados</option>
                                        <option value="Folhados" <?= $item['Categoria'] == "Folhados" ? 'selected' : '' ?>>Folhados</option>
                                        <option value="Doces" <?= $item['Categoria'] == "Doces" ? 'selected' : '' ?>>Doces</option>
                                        <option value="Bebidas" <?= $item['Categoria'] == "Bebidas" ? 'selected' : '' ?>>Bebidas</option>
                                        <option value="Outros" <?= $item['Categoria'] == "Outros" ? 'selected' : '' ?>>Outros</option>
                                    </select>
                                </div>
                            </div>

                            <div class="input-grupo full">
                                <label>Descrição *</label>
                                <textarea name="descricao" required><?= htmlspecialchars($item['Descricao']) ?></textarea>
                            </div>

                            <div class="editar-produto-inputs-duplo">
                                <div class="input-grupo">
                                    <label>Estoque *</label>
                                    <input type="number" name="quantidade" min="0" value="<?= $item['Quantidade'] ?>" required />
                                </div>
                                <div class="input-grupo">
                                    <label>Preço *</label>
                                    <input type="number" step="0.01" name="preco" min="0.1" value="<?= $item['preco'] ?>" required />
                                </div>
                            </div>

                            <button type="button" class="btn-cancelar-editar" data-id="<?= $item['id'] ?>">Cancelar</button>
                            <button type="submit" class="btn-salvar-editar">Salvar Alterações</button>
                        </form>
                    </div>
                </div>
        <?php
            }
        }
        ?>

        <script>
            // editar item

            document.addEventListener('DOMContentLoaded', () => {
                // Abrir modal de edição
                document.querySelectorAll('.btn-editar-item').forEach(button => {
                    button.addEventListener('click', () => {
                        const itemId = button.getAttribute('data-id');
                        const overlay = document.getElementById(`overlayEditar-${itemId}`);
                        const modal = document.getElementById(`modalEditar-${itemId}`);
                        if (overlay && modal) {
                            overlay.classList.add('active');
                            modal.classList.add('active');
                        }
                    });
                });

                // Fechar modal ao clicar no botão fechar
                document.querySelectorAll('.btn-fechar-editar').forEach(button => {
                    button.addEventListener('click', () => {
                        const itemId = button.getAttribute('data-id');
                        const overlay = document.getElementById(`overlayEditar-${itemId}`);
                        const modal = document.getElementById(`modalEditar-${itemId}`);
                        if (overlay) overlay.classList.remove('active');
                        if (modal) modal.classList.remove('active');
                    });
                });

                // Fechar modal ao clicar no overlay
                document.querySelectorAll('.overlay-editar-produto').forEach(overlay => {
                    overlay.addEventListener('click', (e) => {
                        if (e.target === overlay) {
                            const itemId = overlay.id.replace('overlayEditar-', '');
                            const modal = document.getElementById(`modalEditar-${itemId}`);
                            overlay.classList.remove('active');
                            if (modal) modal.classList.remove('active');
                        }
                    });
                });
            });

            //Fechar modal ao clicar no botao cancelar
            document.querySelectorAll('.btn-cancelar-editar').forEach(button => {
                button.addEventListener('click', () => {
                    const itemId = button.getAttribute('data-id');
                    const overlay = document.getElementById(`overlayEditar-${itemId}`);
                    const modal = document.getElementById(`modalEditar-${itemId}`);
                    if (overlay) overlay.classList.remove('active');
                    if (modal) modal.classList.remove('active');
                });
            });

            // Seletores
            const overlayEditarProduto = document.querySelectorAll('.overlay-editar-produto');
            const modalEditarProduto = document.querySelectorAll('.modal-editar-produto');
            const btnAbrirEditarProduto = document.querySelectorAll('.btn-editar-item');
            const btnCancelarEditarProduto = document.querySelectorAll('.btn-cancelar-editar');
            const btnFecharEditar = document.querySelectorAll('.btn-fechar-editar');
            const toggleTrocarImagem = document.querySelector('.toggleTrocarImagem');
            const editarProdutoUpload = document.getElementById('editarProdutoUpload');
            const inputNovaImagem = document.getElementById('inputNovaImagem');
            const editarProdutoPreviewImg = document.getElementById('editarProdutoPreviewImg');
            const formEditarProduto = document.getElementById('formEditarProduto');



            btnCancelarEditarProduto.addEventListener('click', fecharModalEditar);
            btnFecharEditar.addEventListener('click', fecharModalEditar);
            overlayEditarProduto.addEventListener('click', fecharModalEditar);

            // Toggle "Trocar Imagem"
            toggleTrocarImagem.addEventListener('change', () => {
                editarProdutoUpload.style.display = toggleTrocarImagem.checked ? 'block' : 'none';
            });

            // Preview da nova imagem
            inputNovaImagem.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = () => {
                        editarProdutoPreviewImg.src = reader.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
//login 

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
            echo "<script> alert('Seus dados foram inseridos com sucesso!')</script>";
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
            echo "<script> alert('CPF ou Senha invalidos!')</script>";
        }
        
    }
    else {
      echo "<script> alert('CPF ou Senha invalidos!')</script>";
    }
      }
    }
}   
}catch(mysqli_sql_exception){
    echo "<script> alert('Erro em inserir seus dados! CPF já cadastrado.')</script>";

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
  <title>FURA FILA - Login</title>

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
                
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                
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

    <script src="./assets/js/login.js"></script>
</body>
</html>

// home pagina adm

<button class="btn-voltar-main">
        <a href="/cantinarepositorio/main/index.php" style="color: inherit; text-decoration:none;"> <i class="fa-solid fa-caret-left"></i> Home</a>
        </button>