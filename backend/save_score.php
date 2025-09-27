<?php
/* ================================================== */
/*             CONFIGURAÇÃO RESPOSTA                  */
/* ================================================== */

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

/* ================================================== */
/*              VALIDAÇÃO DADOS                       */
/* ================================================== */

if (!isset($data['nomeJogador']) || !isset($data['erros'])) {
    http_response_code(400);
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados incompletos.']);
    exit();
}

$nomeJogador = $data['nomeJogador'];
$erros = (int)$data['erros'];

/* ================================================== */
/*               CÁLCULO PONTUAÇÃO                    */
/* ================================================== */

$score = max(value: 0, values: 6 - $erros);

/* ================================================== */
/*               CONEXÃO BANCO                        */
/* ================================================== */

$host = 'localhost';
$dbname = 'hangman';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO ranking (player_name, score) VALUES (?, ?)";
    
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([$nomeJogador, $score]);

    echo json_encode(['status' => 'sucesso', 'mensagem' => 'Pontuação salva com sucesso!']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar no banco de dados: ' . $e->getMessage()]);
}
?>