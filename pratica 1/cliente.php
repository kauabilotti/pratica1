<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $criticidade = $_POST['criticidade'] ?? 'baixa';

    try {
        $conn->beginTransaction();

        $sqlCliente = "INSERT INTO Clientes (Nome, Email, Telefone) VALUES (:nome, :email, :telefone)";
        $stmtCliente = $conn->prepare($sqlCliente);
        $stmtCliente->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':telefone' => $telefone
        ]);

        $idCliente = $conn->lastInsertId();

        $sqlChamado = "INSERT INTO Chamados (ID_cliente, Descricao, Criticidade) VALUES (:idCliente, :descricao, :criticidade)";
        $stmtChamado = $conn->prepare($sqlChamado);
        $stmtChamado->execute([
            ':idCliente' => $idCliente,
            ':descricao' => $descricao,
            ':criticidade' => $criticidade
        ]);

        $conn->commit();
        echo "Cliente e chamado cadastrados com sucesso!";
    } catch (Exception $e) {
        $conn->rollBack();
        echo "Erro ao cadastrar cliente e chamado: " . $e->getMessage();
    }
}
?>
