
=======
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Images</title>
    <link rel="icon" href="logo.png.png" type="image/png">
    <link rel="stylesheet" href="styles-img.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='//fonts.googleapis.com/css?family=Montserrat:thin,extra-light,light,100,200,300,400,500,600,700,800' 
rel='stylesheet' type='text/css'>
</head>
<body> 
    <nav class="menu-lateral">
        <div class="btn-expandir">       
             <i class="bi bi-list"></i>
        </div>
        <ul>
            <li class="item-menu">
                <a href="index.php">
                    <span class="icon"><i class="bi bi-house"></i></span>
                    <span class="txt-link">Home</span>
                </a>
            </li>
            <li class="item-menu"> 
            <a href="images.php">
                <span class="icon"><i class="bi bi-images"></i></span>
                <span class="txt-link">Imagens</span>
            </a>
            </li>
            <li class="item-menu"> 
                <a href="https://www.instagram.com/robowaller?igsh=MXY1dnlhMjVqeDRqYg==">
                    <span class="icon"><i class="bi bi-instagram"></i></span>
                    <span class="txt-link">instagram</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="https://eteacojeorg-my.sharepoint.com/personal/fe_rodrigues_edu_etefmc_com_br/Documents/Blocos%20de%20Anota%C3%A7%C3%B5es/Projete%202104?wdo=6&wdorigin=701">
                    <span class="icon"><i class="bi bi-journal"></i></span>
                    <span class="txt-link"> Diário de Bordo</span>
                </a>
            </li>
        </ul>
    </nav> 
   <header>
        <div id="title">
            <h2>WALLE<span class="highlight">R</span>:</h2>
            <h1>O robô coletor de latas</h1>
        </div>
        <div class="container">
<div class="content">
            <section class="form-section">
                    <form action="upload.php" method="POST" enctype="multipart/form-data">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" placeholder="Seu nome" required>
                        <label for="fileToUpload">Selecione uma imagem:</label>
                        <input type="file" name="fileToUpload" id="fileToUpload" required>
                        <input type="submit" value="Enviar Foto">
                    </form>
            </section>
        
            <section class="gallery-section">
                <div class="gallery">
                    <?php
                    // Verifica se o arquivo 'data.txt' existe
                    if (file_exists('data.txt')) {
                        // Lê o arquivo linha por linha
                        $lines = file('data.txt');
                        foreach ($lines as $line) {
                            list($nome, $image) = explode('|', trim($line)); // Separa nome e imagem
                            echo '<div class="gallery-item">';
                            echo '<img src="uploads/' . $image . '" alt="Imagem de ' . htmlspecialchars($nome) . '">';
                            echo '<p>' . htmlspecialchars($nome) . '</p>'; // Exibe o nome
                            echo '<div class="controls">';
                            echo '<button onclick="deletePhoto(\'' . $image . '\')">Excluir</button>';
                            echo '<button onclick="sharePhoto(\'uploads/' . $image . '\')">Compartilhar</button>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                       
                    }
                    ?>
                </div>
            </section>
        </div>
    </div>
    </header> 

<script>
    function deletePhoto(image) {
    fetch(`delete.php?image=${image}`, { method: 'GET' })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Recarrega a página após a exclusão
            } else {
                alert('Erro ao excluir a foto: ' + data.message);
            }
        })
        .catch(err => console.error('Erro:', err));
}


    function sharePhoto(url) {
        if (navigator.share) {
            navigator.share({
                title: 'Foto Compartilhada',
                url: url
            }).then(() => {
                console.log('Compartilhamento realizado com sucesso');
            }).catch(err => {
                console.error('Erro no compartilhamento:', err);
            });
        } else {
            alert('Compartilhamento não suportado no seu navegador.');
        }
    }
</script>
</body>
</html>
>>>>>>> 8db5931 (Commit inicial)
