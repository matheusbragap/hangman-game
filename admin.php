<?php
/* ================================================== */
/*               CONFIGURAÇÃO BANCO                   */
/* ================================================== */

$host = 'localhost';
$dbname = 'hangman';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id, name FROM categories ORDER BY name");
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $erro = "Erro ao buscar categorias: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Jogo da Forca</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #f0f0f0;
        }

        .container {
            max-width: 500px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        button:hover {
            background-color: #0056b3;
        }

        .link-jogo {
            display: block;
            margin-top: 20px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Área Administrativa</h1>

        <form action="backend/add_word.php" method="POST">
            <h2>Adicionar Nova Palavra</h2>

            <?php if (isset($erro)): ?>
                <p style="color: red;"><?php echo $erro; ?></p>
            <?php endif; ?>

            <div class="form-group">
                <label for="palavra">Nova Palavra (sem acentos, maiúsculas):</label>
                <input type="text" id="palavra" name="palavra" required minlength="4" pattern="[A-ZÇ]{4,}"
                    title="Apenas letras maiúsculas, sem acentos, mínimo 4 letras.">
            </div>

            <div class="form-group">
                <label for="categoria">Categoria:</label>
                <select id="categoria" name="id_categoria" required>
                    <option value="">Selecione uma categoria</option>
                    <?php if (!isset($erro) && !empty($categorias)): ?>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?php echo htmlspecialchars($cat['id']); ?>">
                                <?php echo htmlspecialchars($cat['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <button type="submit">Adicionar Palavra</button>
        </form>

        <a href="index.php" class="link-jogo">Voltar para o Menu</a>
    </div>
</body>

</html>