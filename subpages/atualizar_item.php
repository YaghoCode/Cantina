<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $produto = mysqli_real_escape_string($con, $_POST['produto']);
    $categoria = mysqli_real_escape_string($con, $_POST['categoria']);
    $descricao = mysqli_real_escape_string($con, $_POST['descricao']);
    $preco = mysqli_real_escape_string($con, $_POST['preco']);
    $quantidade = intval($_POST['quantidade']);
    $trocarImagem = isset($_POST['trocar_imagem']) ? true : false;

    // Inclua 'Descricao' na query
    $query = "UPDATE estoque SET Nome = '$produto', Categoria = '$categoria', Descricao = '$descricao', preco = '$preco', quantidade = $quantidade";

    if ($trocarImagem && isset($_FILES['nova_imagem']) && $_FILES['nova_imagem']['error'] === UPLOAD_ERR_OK) {
        $imagemNome = $_FILES['nova_imagem']['name'];
        $imagemTmp = $_FILES['nova_imagem']['tmp_name'];
        $imagemDestino = './imgbd/' . $imagemNome;
        if (move_uploaded_file($imagemTmp, $imagemDestino)) {
            $query .= ", img = '$imagemNome'";
        }
    }

    $query .= " WHERE id = $id";

    if (mysqli_query($con, $query)) {
        header('Location: estoque.php');
        exit;
    } else {
        echo "Erro ao atualizar o item: " . mysqli_error($con);
    }
}
?>