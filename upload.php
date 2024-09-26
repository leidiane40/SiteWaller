<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Diretório temporário do sistema
    $tempDir = sys_get_temp_dir();
    
    // Cria um caminho para o arquivo temporário
    $target_file = $tempDir . '/' . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;

    // Verifica se o arquivo é uma imagem
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        // Tenta salvar a imagem no diretório temporário
        if (!is_writable($tempDir)) {
            echo "Erro: O diretório temporário não é gravável.";
            $uploadOk = 0;
        } elseif (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "O arquivo " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " foi carregado com sucesso.";

            // Salva o nome do usuário e o nome da imagem em um arquivo temporário
            $nome = $_POST['nome'];
            $imageName = basename($_FILES["fileToUpload"]["name"]);
            $data = $nome . '|' . $imageName . "\n"; // Usa '|' para separar nome e imagem

            // Salva em um arquivo temporário
            $dataFile = tempnam($tempDir, 'data_'); // Cria um arquivo temporário
            file_put_contents($dataFile, $data); // Adiciona o nome e a imagem no arquivo temporário

            // Redireciona de volta para a página inicial após o upload
            header("Location: images.php");
            exit();
        } else {
            echo "Desculpe, ocorreu um erro ao carregar sua imagem. Verifique as permissões do diretório.";
        }
    } else {
        echo "O arquivo enviado não é uma imagem.";
        $uploadOk = 0;
    }
}
?>
