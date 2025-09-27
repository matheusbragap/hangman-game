<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo da Forca - Início</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">

        <div class="player-name-container">
            <input type="text" id="nome-jogador" placeholder="Digite seu nome para o ranking" maxlength="15">
        </div>

        <h1>Jogo da Forca</h1>

        <nav class="main-menu">
            <ul>
                <li><a href="game.php" id="btn-jogar">Jogar</a></li>
                <li><a href="ranking.php">Ranking</a></li>
                <li><a href="admin.php">Cadastrar Palavras</a></li>
                <li><a href="#" class="disabled">Configurações</a></li>
                <li><a href="#" class="disabled">Sair</a></li>
            </ul>
        </nav>
    </div>

    <script src="js/menu.js"></script>
</body>
</html>