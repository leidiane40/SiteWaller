
=======
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verifica se o arquivo é uma imagem
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        // Tenta salvar a imagem no servidor
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "O arquivo " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " foi carregado com sucesso.";

            // Salva o nome do usuário e o nome da imagem em um arquivo de texto
            $nome = $_POST['nome'];
            $imageName = basename($_FILES["fileToUpload"]["name"]);
            $data = $nome . '|' . $imageName . "\n"; // Usa '|' para separar nome e imagem
            file_put_contents('data.txt', $data, FILE_APPEND); // Adiciona o nome e a imagem no data.txt
            // Redireciona de volta para a página inicial após o upload
            header("Location: images.php");
            exit();
        } else {
            echo "Desculpe, ocorreu um erro ao carregar sua imagem.";
        }
    } else {
        echo "O arquivo enviado não é uma imagem.";
        $uploadOk = 0;
    }
}
?>
>>>>>>> 8db5931 (Commit inicial)
