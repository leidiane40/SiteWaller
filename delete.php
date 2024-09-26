
=======
<?php
if (isset($_GET['image'])) {
    $image = $_GET['image'];
    $filePath = 'uploads/' . $image;

    // Verifica se o arquivo existe e tenta excluí-lo
    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            // Remove a entrada da imagem no arquivo de dados
            $dataFile = 'data.txt';
            $lines = file($dataFile);
            $newLines = [];

            foreach ($lines as $line) {
                if (!str_contains($line, $image)) {
                    $newLines[] = $line;
                }
            }

            file_put_contents($dataFile, implode("", $newLines));

            // Retorna um JSON confirmando o sucesso
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Falha ao excluir o arquivo']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Arquivo não encontrado']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Parâmetro da imagem ausente']);
}
>>>>>>> 8db5931 (Commit inicial)
