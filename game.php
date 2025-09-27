<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo da Forca</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">
        <h1>Jogo da Forca</h1>

        <div id="jogo">
            <div id="forca-container">
                <svg height="250" width="200" class="forca">
                    <line x1="10" y1="230" x2="130" y2="230" stroke="black" stroke-width="4" />
                    <line x1="70" y1="230" x2="70" y2="20" stroke="black" stroke-width="4" />
                    <line x1="70" y1="20" x2="150" y2="20" stroke="black" stroke-width="4" />
                    <line x1="150" y1="20" x2="150" y2="50" stroke="black" stroke-width="4" />

                    <circle cx="150" cy="70" r="20" stroke="black" stroke-width="4" fill="transparent"
                        class="parte-forca" />
                    <line x1="150" y1="90" x2="150" y2="150" stroke="black" stroke-width="4" class="parte-forca" />
                    <line x1="150" y1="110" x2="120" y2="130" stroke="black" stroke-width="4" class="parte-forca" />
                    <line x1="150" y1="110" x2="180" y2="130" stroke="black" stroke-width="4" class="parte-forca" />
                    <line x1="150" y1="150" x2="120" y2="180" stroke="black" stroke-width="4" class="parte-forca" />
                    <line x1="150" y1="150" x2="180" y2="180" stroke="black" stroke-width="4" class="parte-forca" />
                </svg>
            </div>

            <div id="palavra-container">
            </div>
        </div>

        <div id="dica-container">
            <p>Categoria: <span id="categoria-texto">Carregando...</span></p>
        </div>

        <div id="teclado-container">
        </div>

        <div id="mensagem-container">
            <p id="mensagem-texto"></p>
            <button id="btn-reiniciar" style="display:none;">Jogar Novamente</button>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>

</html>