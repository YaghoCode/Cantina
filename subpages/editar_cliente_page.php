<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

if (!isset($_SESSION['cpf'])) {
    header("Location: /cantinarepositorio/subpages/login.php");
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
                            <form action="" class="editar-cliente">
                                <div class="form-editar-clientes-row">
                                    <div class="form-group-editar-clientes">
                                        <label for="nome">Nome:</label>
                                        <input name="nome" type="text" id="nome_editar_cliente" value="Maria da Silva"
                                            required> <!--DENTRO DO VALUE, NOME DO CLIENTE--->
                                    </div>
                                    <div class="form-group-editar-clientes">
                                        <label for="cpf">CPF:</label>
                                        <input name="cpf" type="text" id="cpf_editar_cliente" value="55132867823"
                                            disabled> <!--DENTRO DO VALUE, CPF DO CLIENTE--->
                                    </div>
                                </div>
                                <div class="form-editar-clientes-row">
                                    <div class="form-group-editar-clientes">
                                        <label for="email">Email:</label>
                                        <input name="email" type="text" id="email_editar_cliente" value="maria@gmail.com"
                                            required> <!--DENTRO DO VALUE, email DO CLIENTE--->
                                    </div>
                                    <div class="form-group-editar-clientes">
                                        <label for="turma">Turma:</label>
                                        <select name="turma" id="turma_editar_cliente" class="form-control" required>
                                            <option value="A">1 DS - Manhã</option>
                                            <option value="B">2 DS - Manhã</option>
                                            <option value="C">3 DS - Manhã</option>
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
                            <form action="" class="form-editar-senha-cliente" id="form-editar-senha-cliente">
                                <div class="form-editar-senha-cliente-row">
                                    <div class="form-group-editar-senha-cliente">
                                        <label for="senha_cliente_atual">Senha Atual:</label>
                                        <div class="input-wrapper">
                                            <input type="password" id="senha_cliente_atual" required inputmode="none">
                                            <span class="toggle-senha" data-target="senha_cliente_atual"><i class="fa-regular fa-eye-slash"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-editar-senha-cliente-row">
                                    <div class="form-group-editar-senha-cliente">
                                        <label for="senha_cliente_nova">Nova senha:</label>
                                        <div class="input-wrapper">
                                            <input type="password" id="senha_cliente_nova" required minlength="6" inputmode="none">
                                            <span class="toggle-senha" data-target="senha_cliente_nova"><i class="fa-regular fa-eye-slash"></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group-editar-senha-cliente">
                                        <label for="senha_cliente_nova_confirmacao">Confirmar Nova Senha:</label>
                                        <div class="input-wrapper">
                                            <input type="password" id="senha_cliente_nova_confirmacao" required inputmode="none" minlength="6">
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