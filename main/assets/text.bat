


////////////////////////////////////// sistema de adicionar item ao cardapio

 <main>
        <div class="main-container">
            <div class="main-title">
                <div class="pedidos-title">
                    <button id="btn-pedidos">
                        Pedidos
                    </button>
                </div>
                <div class="estoque-title">
                    <button id="btn-estoque">
                        Ajustes do Estoque
                    </button>
                </div>
            </div>
            <div class="main-content-pedidos" id="content-pedidos">

            </div>
            <div class="main-content-estoque" id="content-estoque">
                <div class="content-estoque-buttons">
                    <div class="estoque-btn-novo-produto">
                        <button id="btn-adicionar-produto">
                            Adicionar Produto +
                        </button>
                    </div>
                </div>
                <div class="table-estoque">

                </div>
            </div>
        </div>


        <!--FUNCAO CLICK DO BOTAO "NOVO"-->

        <!--Alert Modal login-->
        <div class="modal-novo-produto" id="modal-novo-p">
            <div class="modal-content">
                <div class="modal-content-left">
                    <div class="modal-title">
                        <h1>
                            Crie um novo produto:
                        </h1>
                    </div>
                    <!--Form de cadastrar produto-->
                    <div class="modal-form-produto">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-novo-produto" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="titulo">Título do Produto:</label>
                                <input type="text" id="titulo" name="nome-produto" class="form-control" placeholder="Digite o título do produto" required>
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição do Produto:</label>
                                <input type="text" id="descricao" name="descricao-produto" class="form-control" placeholder="Digite a descrição do produto" required>
                            </div>

                            <div class="form-group">
                                <label for="preco">Preço:</label>
                                <input type="number" id="preco" name="preco-produto" class="form-control" placeholder="Digite o preço do produto" step="0.01" min="0" required>
                            </div>

                            <div class="form-group">
                                <label for="quantidade">Quantidade:</label>
                                <input type="number" id="quantidade" name="quantidade-produto" class="form-control" placeholder="Digite a quantidade disponível" min="0" required>
                            </div>

                            <div class="form-group">
                                <label for="categoria">Categoria:</label>
                                <select id="categoria" name="categoria-produto" class="form-control" required>
                                    <option value="Salgados">Salgado</option>
                                    <option value="Folhados">Folhados</option>
                                    <option value="Doces">Doces</option>
                                    <option value="Bebidas">Bebidas</option>
                                    <option value="Outros">Outros</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="cadastrar-produto" class="btn btn-primary">Criar Produto</button>
                            </div>
                    </div>
                </div>
                <div class="modal-content-right">
                    <div class="btn-close-modal">
                        <button id="btn-close-modal-p">
                            <i class="fa-solid fa-xmark" id="btn-close-modal-p"></i>
                        </button>
                    </div>
                    <div class="upload-imagem">
                        <label for="label-imagem">Escolha uma imagem para o produto:</label>
                        <input type="file" id="imagem-produto" name="imagem-produto" accept="image/*"
                            style="display: none;">
                        <div class="preview-imagem">
                            <button id="btn-remove-preview" class="btn-remove-preview"
                                style="display: none;">&times;</button>
                            <img id="preview" src="#" alt="Pré-visualização da imagem" style="display: none;">
                        </div>
                        <label for="imagem-produto" class="btn-upload">
                            <i class="fa-solid fa-upload"></i> Escolher Imagem
                        </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </main>


    <script type="module" src="./assets/js/estoque.js"></script>
</body>

</html

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (isset($_POST['cadastrar-produto'])) {
            // Sanitização dos dados
            $nome = filter_input(INPUT_POST, 'nome-produto', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao = filter_input(INPUT_POST, 'descricao-produto', FILTER_SANITIZE_SPECIAL_CHARS);
            $preco = filter_input(INPUT_POST, 'preco-produto', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $quantidade = filter_input(INPUT_POST, 'quantidade-produto', FILTER_SANITIZE_NUMBER_INT);
            $categoria = filter_input(INPUT_POST, 'categoria-produto', FILTER_SANITIZE_SPECIAL_CHARS);
            $nomearquivo = $_FILES['imagem-produto']['name'];
            $ext = pathinfo($nomearquivo, PATHINFO_EXTENSION);
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
            $tempName = $_FILES['imagem-produto']['tmp_name'];
            $TargetPath = "/xampp/htdocs/cantinarepositorio/subpages/imgbd/" . $nomearquivo;
            echo $nomearquivo;
            // Inserção no banco de dados
            // Quando a gente fez isso embaixo???
            if (in_array($ext, $allowedTypes)) {
                if (move_uploaded_file($tempName, $TargetPath)) {
                    $sql = "INSERT INTO estoque (Nome, Descricao, Preco, Quantidade, Categoria, img) VALUES ('$nome', '$descricao', '$preco', '$quantidade', '$categoria', '$nomearquivo')";
                    if (mysqli_query($con, $sql)) {
                        // Redireciona após sucesso
                        header("Location: /cantinarepositorio/subpages/estoque.php");
                        exit;
                    } else {
                        throw new Exception();
                    }
                } else {
                    throw new Exception();
                }
            } else {
                throw new Exception();
            }
        }
    }


    $query = "SELECT * from estoque";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {

        foreach ($query_run as $item) {
            echo $item['id'];
        }
    }
    ?>

    //// js 

    // tabelas pedidos e estoque

const btnPedidos = document.getElementById('btn-pedidos')
const btnEstoque = document.getElementById('btn-estoque')
const conteudoPedidos = document.getElementById('content-pedidos')
const conteudoEstoque = document.getElementById('content-estoque')

btnPedidos.style.backgroundColor = '#e3261b';
btnPedidos.style.color = '#ffff';


btnPedidos.addEventListener('click', () => {
    if (conteudoPedidos.style.display !== 'flex'){
        //mudar o conteudo
        conteudoPedidos.style.display = 'flex';
        conteudoEstoque.style.display = 'none';

        //mudar a cor e backgroud dos buttons yesirr
        btnPedidos.style.backgroundColor = '#e3261b';
        btnPedidos.style.color = '#ffff'; 
        btnEstoque.style.backgroundColor = '#ffff';
        btnEstoque.style.color = '#000000'; 
    }
});

btnEstoque.addEventListener('click', () => {
    if (conteudoEstoque.style.display !== 'flex'){
              //mudar o conteudo
        conteudoEstoque.style.display = 'flex';
        conteudoPedidos.style.display = 'none';

                //mudar a cor e backgroud dos buttons yesirr
        btnPedidos.style.backgroundColor = '#ffff';
        btnPedidos.style.color = '#000000'; 
        btnEstoque.style.backgroundColor = '#e3261b';
        btnEstoque.style.color = '#ffff'; 
    }
});


// modal NOVO


const btnNovoProduto = document.getElementById('btn-adicionar-produto')
const modalAlert = document.getElementById('modal-novo-p');     
const btnCloseModal = document.getElementById('btn-close-modal-p')

btnNovoProduto.addEventListener('click', () => {
  if(modalAlert.style.display !== 'block'){
      modalAlert.style.display = 'block';
  }
});

btnCloseModal.addEventListener('click', () => {
        modalAlert.style.display = 'none'
});

const inputImagem = document.getElementById('imagem-produto');
const previewImagem = document.getElementById('preview');
const btnRemovePreview = document.getElementById('btn-remove-preview');

inputImagem.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImagem.src = e.target.result;
            previewImagem.style.display = 'block';
            btnRemovePreview.style.display = 'flex'; // Mostra o botão "X"
        };
        reader.readAsDataURL(file);
    }
});

// Função para remover a imagem e reiniciar o preview
btnRemovePreview.addEventListener('click', () => {
    previewImagem.src = '#';
    previewImagem.style.display = 'none';
    btnRemovePreview.style.display = 'none';
    inputImagem.value = ''; // Reseta o campo de upload
});

//// css

/*Main*/

.main-container{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: 120vh;
    width: 100%;
    padding-top: 10%;
}

.main-title{
    display: flex;
    justify-content: flex-start;
    align-items: center;
    height: 8%;
    width: 95%;
    gap: 0.3rem;
}

.pedidos-title, .estoque-title{
    display: flex;
    align-items: center;
    justify-content: center;
    height: 50%;
    width: 9%;
}

.pedidos-title button, .estoque-title button{
    height: 100%;
    width: 100%;
    border: 1px solid rgba(0, 0, 0, 0.328);
    background-color: transparent;
    cursor: pointer;
    font-size: 1rem;
    border-radius: 0.2rem;
    font-family:var(--font-titulo);
    font-weight: 500;
}

.main-content-pedidos{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 95%;
    height: 90%;
    background-color: var(--cor-grey);
    border-radius: 0.5rem;
    border: 1px solid #0000003b;
}

.main-content-estoque{
    display: none;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    width: 95%;
    height: 90%;
    background-color: var(--cor-grey);
    border-radius: 0.5rem;
    border: 1px solid #0000003b;
}

.content-estoque-buttons{
    display: flex;
    align-items: center;
    justify-content: flex-start;
    width: 100%;
    height: 7%;
}

.estoque-btn-novo-produto{
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    width: 13%;
}

.estoque-btn-novo-produto button{
    height: 50%;
    width: 60%;
    border: 1px solid rgba(0, 0, 0, 0.328);
    background-color: transparent;
    cursor: pointer;
    font-size: 0.8rem;
    border-radius: 0.2rem;
    font-family:var(--font-titulo);
    font-weight: 500;
}

.table-estoque{
    display: flex;
    align-items: center;
    justify-content: center;
    height: 95%;
    width: 100%;
}




/*FUNCAO MODAL CLICK "NOVO"*/

/*Modal alert*/

.modal-novo-produto{
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: white;
      border: 1px solid #0000005d;
      z-index: 9999;
      height: 70vh;
      width: 100vh;
      border-radius: 15px;
}

.modal-content{
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    height: 100%;
    width: 100%;
}

.modal-content-right, .modal-content-left{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    height: 98%;
    width: 49%;
}

/*estilos dos elementos da left*/

.modal-title{
    height: 15%;
    width: 98%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.modal-title h1{
    font-size: var(--font-titulo);
    font-size: 2rem;
    color: #000000c2;
    font-weight: 700;
}

.modal-form-produto{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 85%;
    width: 100%;
    padding: 1.5rem;
}

.form-novo-produto {
    padding: 1.8rem;
    width: 100%;
    max-width: 500px;
    font-family: var(--font-titulo);
}


.form-group {
    margin-bottom: 0.8rem;
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 0.4rem;
    color: #333;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 0.6rem;
    border: 1px solid #ccc;
    border-radius: 0.4rem;
    font-size: 1rem;
    box-sizing: border-box;
}

.form-group button {
    width: 100%;
    padding: 0.6rem;
    background-color: var(--cor-primaria);
    color: #fff;
    border: none;
    border-radius: 0.4rem;
    font-size: 1rem;
    cursor: pointer;
    margin-top: 0.5rem;
    transition: background-color 0.3s ease;
}

.form-group button:hover {
    background-color: rgb(180, 25, 25);
}

/* Responsividade */
@media (max-width: 768px) {
    .form-novo-produto {
        padding: 15px;
    }

    .form-group input,
    .form-group select {
        font-size: 14px;
    }

    .form-group button {
        font-size: 14px;
    }
}


/*estilos dos elementos da right */

.btn-close-modal{
    display: flex;
    justify-content: flex-end;
    height: 10%;
    width: 95%;
}

.btn-close-modal button{
    color: var(--cor-primaria);
    font-size: 2rem;
    border: none;
    background-color: transparent;
    height: 100%;
    width: 8%;
    cursor: pointer;
}

.upload-imagem {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    margin-top: 1rem;
    height: 90%;
}

.upload-imagem label{
    font-family: var(--font-titulo);
    font-weight: 700;
    font-size: 1rem;
}

.btn-upload {
    display: inline-block;
    padding: 0.8rem 1.5rem;
    background-color: var(--cor-primaria);
    color: #fff;
    border-radius: 0.4rem;
    font-size: 1rem;
    cursor: pointer;
    text-align: center;
    transition: background-color 0.3s ease;
}

.btn-upload:hover {
    background-color: rgb(180, 25, 25);
}

.preview-imagem {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    max-width: 300px;
    height: 200px;
    border: 1px dashed #ccc;
    border-radius: 0.4rem;
    overflow: hidden;
    background-color: #f9f9f9;
}

.preview-imagem img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.btn-remove-preview {
    position: absolute;
    top: 40%;
    right: 10.4%;
    background-color: #ff4d4d;
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 1.6rem;
    height: 1.4rem;
    font-size: 1rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s ease;
}

.btn-remove-preview:hover {
    background-color: #e60000;
}