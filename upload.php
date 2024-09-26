<?php
// Verifica se a solicitação foi feita via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Define o diretório de destino para onde o arquivo será enviado
    $target_dir = "uploads/";
    
    // Cria o caminho completo do arquivo de destino, unindo o diretório de destino e o nome do arquivo enviado
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    
    // Variável de controle para validar se o upload pode prosseguir
    $uploadOk = 1;
    
    // Obtém a extensão do arquivo em letras minúsculas
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verifica se o arquivo é realmente uma imagem
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        // Se o arquivo é uma imagem, tenta salvá-lo no servidor
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            
            // Se o upload for bem-sucedido, exibe uma mensagem de sucesso
            echo "O arquivo " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " foi carregado com sucesso.";

            // Obtém o nome do usuário enviado pelo formulário
            $nome = $_POST['nome'];
            
            // Obtém o nome do arquivo de imagem
            $imageName = basename($_FILES["fileToUpload"]["name"]);
            
            // Cria uma string contendo o nome do usuário e o nome da imagem, separados por '|'
            $data = $nome . '|' . $imageName . "\n"; // Usa '|' para separar nome e imagem
            
            // Adiciona essa string ao arquivo 'data.txt'
            file_put_contents('data.txt', $data, FILE_APPEND); // Adiciona o nome e a imagem no data.txt
            
            // Redireciona o usuário de volta para a página 'images.php' após o upload
            header("Location: images.php");
            exit(); // Finaliza o script após o redirecionamento
        } else {
            // Se o upload falhar, exibe uma mensagem de erro
            echo "Desculpe, ocorreu um erro ao carregar sua imagem.";
        }
    } else {
        // Se o arquivo enviado não for uma imagem, exibe uma mensagem de erro
        echo "O arquivo enviado não é uma imagem.";
        
        // Define a variável de controle como 0 (falso) para indicar que o upload não deve prosseguir
        $uploadOk = 0;
    }
}
?>
