<?php
// Conexão com o banco de dados
include('database.php');

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $id = $_POST['id'];
    $produto = mysqli_real_escape_string($con, $_POST['produto']);
    $categoria = mysqli_real_escape_string($con, $_POST['categoria']);
    $trocarImagem = isset($_POST['trocar_imagem']) ? true : false;

    // Atualiza os dados no banco de dados
    $query = "UPDATE estoque SET Nome = '$produto', Categoria = '$categoria'";

    // Verifica se uma nova imagem foi enviada
    if ($trocarImagem && isset($_FILES['nova_imagem']) && $_FILES['nova_imagem']['error'] === UPLOAD_ERR_OK) {
        $imagemNome = $_FILES['nova_imagem']['name'];
        $imagemTmp = $_FILES['nova_imagem']['tmp_name'];
        $imagemDestino = './imgbd/' . $imagemNome;

        // Move a nova imagem para o diretório
        if (move_uploaded_file($imagemTmp, $imagemDestino)) {
            $query .= ", img = '$imagemNome'";
        }
    }

    $query .= " WHERE id = $id";

    // Executa a query
    if (mysqli_query($con, $query)) {
        echo "Item atualizado com sucesso!";
        header('Location: estoque.php'); // Redireciona de volta para a página de estoque
        exit;
    } else {
        echo "Erro ao atualizar o item: " . mysqli_error($con);
    }
}
?>