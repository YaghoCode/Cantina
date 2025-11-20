<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");



if (isset($_SESSION['cpf'])) {
    $cpf = $_SESSION['cpf'];

    $query_user = "SELECT nome, cpf, email, turma FROM cliente WHERE cpf = '$cpf'";
    $result_user = mysqli_query($con, $query_user);

    if ($result_user && mysqli_num_rows($result_user) > 0) {
        $user_data = mysqli_fetch_assoc($result_user);
        // Permite acesso
    } else {
        header("Location: ./login.php");
        exit;
    }
} else {
    header("Location: ./login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="./assets/css/pagesCliente/editar-cliente-page.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <title>FURA FILA - Editar Cliente</title>

</head>

<body class="body">
    <header>
        <div class="navbar" id="editar">
            <div class="nav-links">
                <div class="nav-logo">
                    <img src="/cantinarepositorio/main/assets/img/logo3.png" alt="">
                </div>
                <div class="nav-items">
                    <ul>
                        <li>
                            <i class="fa-solid fa-user-pen" style="font-size: 1.9rem; transform:translateY(-8%)"></i>
                            Editar Informações
                        </li>
                    </ul>
                </div>
                <div class="nav-buttons">
                    <div class="btn-home">
                        <button>
                            <a href="/cantinarepositorio/main/index.php">
                                <i class="fa-solid fa-house"></i>Home
                            </a>
                        </button>
                    </div>
                    <div class="btn-user" id="btn-user-nav">
                        <button>
                            <i class="fa-regular fa-user"></i> Perfil
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!--POPUP DO USER-->
    <div class="overlay-pop-up-user" id="overlay-pop-up-user">

    </div>
    <div class="pop-up-user" id="pop-up-user">
        <button class="btn-fechar-pop-up-user" id="btn-close-user-nav">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="content-pop-user">
            <div class="content-top-user">
                <div class="content-top-left-user">
                    <div class="content-top-left-user-img">
                        <img src="./assets/img/CocaCola.png" alt="">
                    </div>
                </div>
                <div class="content-top-right-user">
                    <div class="content-top-right-user-text">
                        <div class="content-top-right-user-text-name">
                            <h3>
                                <?php echo $user_data['nome'] ?>
                            </h3>
                        </div>
                        <div class="content-top-right-user-text-email">
                            <h6>
                                <?php echo $user_data['email'] ?>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-mid-user">
                <div class="content-mid-user-row">
                    <div class="content-mid-user-row-left">
                        <div class="content-mid-user-row-left-icon">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                    </div>
                    <div class="content-mid-user-row-right">
                        <div class="content-mid-user-row-right-text">
                            <h1>
                                Turma
                            </h1>
                            <h3>
                                <?php echo $user_data['turma'] ?>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="content-mid-user-row">
                    <div class="content-mid-user-row-left">
                        <div class="content-mid-user-row-left-icon">
                            <i class="fa-regular fa-credit-card"></i>
                        </div>
                    </div>
                    <div class="content-mid-user-row-right">
                        <div class="content-mid-user-row-right-text">
                            <h1>
                                CPF:
                            </h1>
                            <h3>
                                <?php echo $user_data['cpf'] ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-bottom-user">
                <div class="content-bottom-user-row">
                    <button class="btn-pop-up-editar-adm">
                        <a href="#Editar-adm">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Editar
                        </a>
                    </button>
                    <button class="btn-logout-pop-up">
                        <a href="/cantinarepositorio/subpages/logout.php">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Logout
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        //popup users navbar

        const containerPopUp = document.getElementById('pop-up-user');
        const btnUserNav = document.getElementById('btn-user-nav');
        const btnCloseUsernav = document.getElementById('btn-close-user-nav');
        const overlayPopUpUser = document.getElementById('overlay-pop-up-user');


        btnUserNav.addEventListener('click', () => {
            if (containerPopUp.style.display !== 'block') {
                containerPopUp.style.display = 'block';
                overlayPopUpUser.style.display = 'block';
            } else {
                containerPopUp.style.display = 'none';
                overlayPopUpUser.style.display = 'none';
            }
        });


        btnCloseUsernav.addEventListener('click', () => {
            containerPopUp.style.display = 'none';
            overlayPopUpUser.style.display = 'none';
        });
    </script>

    <main>
        <div class="container-editar-cliente">
            <div class="title-editar-cliente">
                <h1>Configurações da Conta</h1>
                <p>Gerencie suas informações pessoais e configurações de segurança.</p>
            </div>
            <div class="content-editar-cliente">
                <div class="content-top-editar-cliente">
                    <div class="form-editar-cliente">
                        <div class="form-editar-cliente-title">
                            <div class="form-editar-cliente-title-text">
                                <h1>Informações Pessoais</h1>
                                <p>Atualize suas informações de perfil.</p>
                            </div>
                        </div>
                        <div class="form-editar-cliente-content">
                            <form action="atualizar_cliente.php" method="POST" class="editar-cliente">
                                <input type="hidden" name="cpfid" value="<?= $user_data['cpf'] ?>" />
                                <div class="form-editar-clientes-row">
                                    <div class="form-group-editar-clientes">
                                        <label for="nome">Nome:</label>
                                        <input name="nome" type="text" id="nome_editar_cliente" value="<?php echo $user_data['nome'] ?>"
                                            required> <!--DENTRO DO VALUE, NOME DO CLIENTE--->
                                    </div>
                                    <div class="form-group-editar-clientes">
                                        <label for="cpf">CPF:</label>
                                        <input name="cpf" type="text" id="cpf_editar_cliente" value="<?php echo $user_data['cpf'] ?>"
                                            disabled> <!--DENTRO DO VALUE, CPF DO CLIENTE--->
                                    </div>
                                </div>
                                <div class="form-editar-clientes-row">
                                    <div class="form-group-editar-clientes">
                                        <label for="email">Email:</label>
                                        <input name="email" type="text" id="email_editar_cliente" value="<?php echo $user_data['email'] ?>"
                                            required> <!--DENTRO DO VALUE, email DO CLIENTE--->
                                    </div>
                                    <div class="form-group-editar-clientes">
                                        <label for="turma">Turma:</label>
                                        <select name="turma" id="turma_editar_cliente" class="form-control" required>
                                           <option value="1DS" <?= $cliente['turma'] == "1DS" ? 'selected' : '' ?>> 1DS
                                                    </option>
                                                    <option value="2DS" <?= $cliente['turma'] == "2DS" ? 'selected' : '' ?>> 2DS
                                                    </option>
                                                    <option value="3DS" <?= $cliente['turma'] == "3DS" ? 'selected' : '' ?>>3DS
                                                    </option>
                                                    <option value="1ADM" <?= $cliente['turma'] == "1ADM" ? 'selected' : '' ?>> 1ADM
                                                    </option>
                                                    <option value="2ADM" <?= $cliente['turma'] == "2ADM" ? 'selected' : '' ?>> 2ADM
                                                    </option>
                                                    <option value="3ADM" <?= $cliente['turma'] == "3ADM" ? 'selected' : '' ?>>3ADM
                                                    </option>
                                                    <option value="1RH" <?= $cliente['turma'] == "1RH" ? 'selected' : '' ?>> 1RH
                                                    </option>
                                                    <option value="2RH" <?= $cliente['turma'] == "2RH" ? 'selected' : '' ?>> 2RH
                                                    </option>
                                                    <option value="3RH" <?= $cliente['turma'] == "3RH" ? 'selected' : '' ?>>3RH
                                                    </option>
                                                    <option value="1JD" <?= $cliente['turma'] == "1JD" ? 'selected' : '' ?>> 1JD
                                                    </option>
                                                    <option value="2JD" <?= $cliente['turma'] == "2JD" ? 'selected' : '' ?>> 2JD
                                                    </option>
                                                    <option value="3JD" <?= $cliente['turma'] == "3JD" ? 'selected' : '' ?>>3JD
                                                    </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-editar-clientes-row-btn">
                                    <div class="form-group-editar-clientes-btn">
                                        <button class="btn-cancelar-editar-clientes">
                                            Cancelar
                                        </button>
                                    </div>
                                    <div class="form-group-editar-clientes-btn">
                                        <button class="btn-enviar-editar-clientes" type="submit">
                                            <i class="fa-solid fa-floppy-disk" style="padding-right: 0.6rem;"></i>
                                            Salvar Alterações
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="content-bottom-editar-cliente">
                    <div class="form-editar-senha-cliente">
                        <div class="form-editar-senha-cliente-title">
                            <div class="form-editar-senha-cliente-title-text">
                                <h1>Alterar Senha - Cliente</h1>
                                <p>Atualize a senha de sua conta.</p>
                            </div>
                        </div>
                        <div class="form-editar-senha-cliente-content">
                            <!--Form editar senha cliente-->
                            <form action="alterar_senha_cliente.php" method="POST" class="form-editar-senha-cliente" id="form-editar-senha-cliente">
                                <input type="hidden" name="cpfid" value="<?= $user_data['cpf'] ?>" />
                                <div class="form-editar-senha-cliente-row">
                                    <div class="form-group-editar-senha-cliente">
                                        <label for="senha_cliente_atual">Senha Atual:</label>
                                        <div class="input-wrapper">
                                            <input name="senha_atual" type="password" id="senha_cliente_atual" required inputmode="none">
                                            <span class="toggle-senha" data-target="senha_cliente_atual"><i class="fa-regular fa-eye-slash"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-editar-senha-cliente-row">
                                    <div class="form-group-editar-senha-cliente">
                                        <label for="senha_cliente_nova">Nova senha:</label>
                                        <div class="input-wrapper">
                                            <input name="nova_senha" type="password" id="senha_cliente_nova" required minlength="6" inputmode="none">
                                            <span class="toggle-senha" data-target="senha_cliente_nova"><i class="fa-regular fa-eye-slash"></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group-editar-senha-cliente">
                                        <label for="senha_cliente_nova_confirmacao">Confirmar Nova Senha:</label>
                                        <div class="input-wrapper">
                                            <input name="confirmar_senha" type="password" id="senha_cliente_nova_confirmacao" required inputmode="none" minlength="6">
                                            <span class="toggle-senha" data-target="senha_cliente_nova_confirmacao"><i class="fa-regular fa-eye-slash"></i></span>
                                        </div>
                                        <div class="erro-senha" id="erroSenhaCliente">As senhas não coincidem.</div>
                                    </div>
                                </div>

                                <div class="form-editar-senha-cliente-row-btn">
                                    <div class="form-group-editar-senha-cliente-btn">
                                        <button class="btn-cancelar-nova-senha-cliente">Cancelar</button>
                                        <button type="submit" class="btn-mudar-senha-cliente" disabled>Alterar Senha</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const senhaAtual = document.getElementById('senha_cliente_atual');
            const novaSenha = document.getElementById('senha_cliente_nova');
            const confirmarSenha = document.getElementById('senha_cliente_nova_confirmacao');
            const erroSenha = document.getElementById('erroSenhaCliente');
            const btnAlterarSenha = document.querySelector('.btn-mudar-senha-cliente');
            const btnCancelar = document.querySelector('.btn-cancelar-nova-senha-cliente');

            // Mostrar ou ocultar senha
            document.querySelectorAll('.toggle-senha').forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const targetId = toggle.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    if (input.type === 'password') {
                        input.type = 'text';
                        toggle.innerHTML = '<i class="fa-regular fa-eye"></i>';
                    } else {
                        input.type = 'password';
                        toggle.innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
                    }
                });
            });

            // Função para validar senhas e habilitar botão
            function validarSenhas() {
                const senhaAtualPreenchida = senhaAtual.value.trim() !== '';
                const novaSenhaPreenchida = novaSenha.value.trim() !== '';
                const confirmarSenhaPreenchida = confirmarSenha.value.trim() !== '';

                const senhasIguais = novaSenha.value === confirmarSenha.value;

                if (senhaAtualPreenchida && novaSenhaPreenchida && confirmarSenhaPreenchida && senhasIguais) {
                    erroSenha.style.display = 'none';
                    btnAlterarSenha.disabled = false;
                } else {
                    // Mostra o erro apenas se os campos estiverem preenchidos
                    if (novaSenhaPreenchida && confirmarSenhaPreenchida && !senhasIguais) {
                        erroSenha.style.display = 'block';
                    } else {
                        erroSenha.style.display = 'none';
                    }
                    btnAlterarSenha.disabled = true;
                }
            }

            // Eventos de input
            [senhaAtual, novaSenha, confirmarSenha].forEach(input => {
                input.addEventListener('input', validarSenhas);
            });

            // Botão cancelar → recarrega a página
            btnCancelar.addEventListener('click', (e) => {
                e.preventDefault();
                location.reload();
            });
        });
    </script>



    <!--footer-->

    <footer>
        <div class="container-footer">
            <div class="content-footer">
                <div class="content-top-footer">
                    <div class="item-footer">
                        <div class="info-cantina-img">
                            <img src="/cantinarepositorio/main/assets/img/logo-footer.png" alt="">
                        </div>
                        <div class="info-cantina-description">
                            <p>Alimentando conhecimento e criando memórias através de sabores únicos há mais de 10 anos na nossa
                                comunidade escolar.</p>
                        </div>
                        <div class="info-icon">
                            <i class="fa-brands fa-whatsapp"></i>
                            <i class="fa-brands fa-instagram"></i>
                            <i class="fa-brands fa-x-twitter"></i>
                        </div>
                    </div>
                    <div class="item-footer">
                        <div class="title-footer-links">
                            <h1>Links Rápidos</h1>
                        </div>
                        <div class="footer-links">
                            <ul>
                                <li>
                                    <h6>
                                        <a href="/cantinarepositorio/main/index.php">Home</a>
                                    </h6>
                                </li>
                                <li>
                                    <h6>
                                        <a href="#editar">Cliente</a>
                                    </h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item-footer">
                        <div class="title-footer-links">
                            <h1>Contato</h1>
                        </div>
                        <div class="footer-links-local">
                            <ul>
                                <li>
                                    <h6>
                                        <a
                                            href="https://www.bing.com/search?q=maps%20Av%20Cruzeiro%20Do%20Sul%2C%202630%20-%20Carandiru&qs=n&form=QBRE&sp=-1&lq=0&pq=maps%20av%20cruzeiro%20do%20sul%2C%202630%20-%20carandiru&sc=0-41&sk=&cvid=08A936946DAF43F9B1FC74F782A823B6">
                                            <i class="fa-solid fa-location-dot"></i>
                                            Av Cruzeiro Do Sul, 2630 - Carandiru.
                                        </a>
                                    </h6>
                                </li>
                                <li>
                                    <h6>
                                        <a href="https://vestibulinho.etec.sp.gov.br/fale-conosco">
                                            <i class="fa-solid fa-location-dot"></i>
                                            (11) 3471-4071.
                                        </a>
                                    </h6>
                                </li>
                                <li>
                                    <h6><i class="fa-solid fa-envelope"></i> Furafila@gmail.com</h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item-footer">
                        <div class="title-footer-links">
                            <h1>Horários de Funcionamento</h1>
                        </div>
                        <div class="footer-links">
                            <ul>
                                <li>
                                    <h6 style="width: 230%; display:flex; gap: 1vh;"><i class="fa-solid fa-clock"></i> Manha: 10:00 -
                                        10:20.</h6>
                                </li>
                                <li>
                                    <h6 style="width: 230%; display:flex; gap: 1vh;"><i class="fa-solid fa-clock"></i> Tarde: 16:00 -
                                        16:20.</h6>
                                </li>
                                <li>
                                    <h6 style="width: 235%; display:flex; gap: 1vh; padding-bottom:2vh;"><i class="fa-solid fa-clock"></i>
                                        Noite: 20:00 - 20:20.</h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="content-bottom-footer">
                    <div class="title-footer-bottom">
                        <h1>
                            © 2025 FURA-FILA. Todos os direitos reservados.
                        </h1>
                    </div>
                    <div class="title-footer-bottom-2">
                        <h1>
                            <a href="/cantinarepositorio/subpages/termos.php">
                                Política e Privacidade
                            </a>
                        </h1>
                        <h1>
                            <a href="/cantinarepositorio/subpages/termos.php">
                                Termos de uso
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <script src="./assets/js/pageCliente/editar_cliente_page.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- Swiper.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>