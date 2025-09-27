<?php
/* ================================================== */
/*               CONFIGURAÇÃO BANCO                   */
/* ================================================== */

require_once 'backend/config.php';

$ranking = [];

try {
    /* ================================================== */
    /*                BUSCAR RANKING                      */
    /* ================================================== */
    
    $sql = "SELECT player_name, SUM(score) AS total_score 
        FROM ranking 
        GROUP BY player_name 
        ORDER BY total_score DESC 
        LIMIT 10";
    $stmt = $pdo->query($sql);

    $ranking = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $erro = "Erro ao buscar o ranking: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking - Jogo da Forca</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .ranking-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .ranking-table th,
        .ranking-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        .ranking-table th {
            background-color: #f2f2f2;
            color: #333;
        }

        .ranking-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .link-voltar {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Ranking - Top 10</h1>

        <?php if (isset($erro)): ?>
            <p style="color: red;"><?php echo $erro; ?></p>
        <?php else: ?>
            <table class="ranking-table">
                <thead>
                    <tr>
                        <th>Posição</th>
                        <th>Nome</th>
                        <th>Pontuação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($ranking) > 0): ?>
                        <?php foreach ($ranking as $index => $entrada): ?>
                            <tr>
                                <td><?php echo $index + 1; ?>º</td>
                                <td><?php echo htmlspecialchars($entrada['player_name']); ?></td>
                                <td><?php echo $entrada['total_score']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Nenhuma pontuação registrada ainda. Jogue e vença uma partida!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <a href="index.php" class="link-voltar">Voltar ao Menu</a>
    </div>
</body>

</html>