<?php
/* ================================================== */
/*               CONFIGURAÇÃO BANCO                   */
/* ================================================== */

require_once 'config.php';

/* ================================================== */
/*                   BUSCAR PALAVRA                   */
/* ================================================== */
try {
    $sql = "SELECT w.name AS palavra, c.name AS categoria 
            FROM words w 
            JOIN categories c ON w.id_categories = c.id 
            ORDER BY RAND() 
            LIMIT 1";

    $stmt = $pdo->query($sql);
    $resultado = $stmt->fetch();

    /* ================================================== */
    /*                 RETORNO JSON                       */
    /* ================================================== */
    
    header('Content-Type: application/json');
    echo json_encode($resultado);

} catch (PDOException $e) {
    header('Content-Type: application/json');
    http_response_code(500); 
    echo json_encode(['erro' => 'Erro no servidor: ' . $e->getMessage()]);
}
?>