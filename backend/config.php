<?php
// ================================================================= //
// ARQUIVO DE CONFIGURAÇÃO E CONEXÃO CENTRAL                         //
// Este script verifica e cria o banco/tabelas e estabelece a conexão //
// ================================================================= //

// --- 1. CONFIGURAÇÕES --- //
$host = 'localhost';
$dbname = 'hangman';
$user = 'root';
$pass = '';

try {
    // --- 2. CONECTA AO SERVIDOR MYSQL (SEM SELECIONAR UM BANCO AINDA) --- //
    $pdo_server = new PDO("mysql:host=$host;charset=utf8", $user, $pass);
    $pdo_server->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // --- 3. CRIA O BANCO DE DADOS SE ELE NÃO EXISTIR --- //
    $pdo_server->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;");

    // --- 4. AGORA CONECTA AO BANCO DE DADOS 'hangman' --- //
    // A partir daqui, a variável $pdo estará disponível para todos os scripts que incluírem este arquivo.
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // --- 5. CRIA AS TABELAS SE ELAS NÃO EXISTIREM --- //
    $sql_categories = "CREATE TABLE IF NOT EXISTS `categories` (`id` INT PRIMARY KEY AUTO_INCREMENT, `name` VARCHAR(50) NOT NULL UNIQUE);";
    $sql_words = "CREATE TABLE IF NOT EXISTS `words` (`id` INT PRIMARY KEY AUTO_INCREMENT, `name` VARCHAR(50) NOT NULL, `id_categories` INT, FOREIGN KEY (`id_categories`) REFERENCES `categories`(`id`));";
    $sql_ranking = "CREATE TABLE IF NOT EXISTS `ranking` (`id` INT PRIMARY KEY AUTO_INCREMENT, `player_name` VARCHAR(50) NOT NULL, `score` INT NOT NULL, `game_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP);";
    
    $pdo->exec($sql_categories);
    $pdo->exec($sql_words);
    $pdo->exec($sql_ranking);

    // --- 6. INSERE OS DADOS INICIAIS (APENAS SE A TABELA ESTIVER VAZIA) --- //
    $stmt = $pdo->query("SELECT COUNT(*) FROM `categories`");
    if ($stmt->fetchColumn() == 0) {
        $sql_insert_categories = "INSERT INTO `categories` (`id`, `name`) VALUES (1, 'FRUTAS'), (2, 'CIDADES'), (3, 'PAISES'), (4, 'ANIMAIS'), (5, 'PROFISSOES');";
        $sql_insert_words = "INSERT INTO `words` (`name`, `id_categories`) VALUES ('BANANA', 1), ('MORANGO', 1), ('ABACAXI', 1), ('MELANCIA', 1), ('LARANJA', 1),('AMORA', 1), ('CEREJA', 1), ('GOIABA', 1), ('MANGA', 1), ('LIMAO', 1),('SALVADOR', 2), ('RECIFE', 2), ('MANAUS', 2), ('CURITIBA', 2), ('FORTALEZA', 2),('GOIANIA', 2), ('BELEM', 2), ('NATAL', 2), ('FLORIANOPOLIS', 2), ('VITORIA', 2),('BRASIL', 3), ('PORTUGAL', 3), ('ARGENTINA', 3), ('CANADA', 3), ('JAPAO', 3),('ITALIA', 3), ('ESPANHA', 3), ('FRANCA', 3), ('ALEMANHA', 3), ('CHILE', 3),('CACHORRO', 4), ('GIRAFA', 4), ('ELEFANTE', 4), ('MACACO', 4), ('BORBOLETA', 4),('LEAO', 4), ('TIGRE', 4), ('LOBO', 4), ('CAVALO', 4), ('COBRA', 4),('MEDICO', 5), ('PROFESSOR', 5), ('ENGENHEIRO', 5), ('BOMBEIRO', 5), ('ADVOGADO', 5),('POLICIAL', 5), ('JORNALISTA', 5), ('COZINHEIRO', 5), ('MOTORISTA', 5), ('PADEIRO', 5);";
        
        $pdo->exec($sql_insert_categories);
        $pdo->exec($sql_insert_words);
    }

} catch (PDOException $e) {
    // Se algo der terrivelmente errado, o jogo não pode continuar.
    die("❌ Erro crítico de banco de dados: " . $e->getMessage());
}
?>