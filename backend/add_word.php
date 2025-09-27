<?php
/* ================================================== */
/*              PROCESSAMENTO FORMULÁRIO              */
/* ================================================== */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $palavra = isset($_POST['palavra']) ? trim(strtoupper($_POST['palavra'])) : '';
    $id_categoria = isset($_POST['id_categoria']) ? $_POST['id_categoria'] : '';

    if (empty($palavra) || empty($id_categoria)) {
        die("Erro: Palavra ou categoria não informada. Volte e preencha todos os campos.");
    }

    if (strlen($palavra) < 4) {
        die("Erro: A palavra deve ter no mínimo 4 letras.");
    }

    /* ================================================== */
    /*               CONEXÃO BANCO                        */
    /* ================================================== */
    
    require_once 'config.php';

    try {
        $sql = "INSERT INTO words (name, id_categories) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([$palavra, $id_categoria]);

        echo "Palavra adicionada com sucesso! <br>";
        echo "<a href='../admin.php'>Adicionar outra</a> | <a href='../index.php'>Jogar</a>";

    } catch (PDOException $e) {
        die("Erro ao adicionar palavra: " . $e->getMessage());
    }

} else {
    header('Location: ../admin.php');
    exit();
}
?>