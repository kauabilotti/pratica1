<?php
include 'db.php';

$sql = "SELECT 
    Chamados.ID_chamado, 
    Chamados.Descricao, 
    Chamados.Criticidade, 
    Chamados.Statu_, 
    Clientes.Nome AS Cliente, 
    Chamados.Data_abertura 
FROM Chamados
LEFT JOIN Clientes ON Chamados.ID_cliente = Clientes.ID_cliente";

$stmt = $conn->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
?>
