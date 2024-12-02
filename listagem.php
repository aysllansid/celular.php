<?php
require 'conexao.php'; 
try {
    $result = $pdo->query("SELECT * FROM celulares");
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="pc">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Celulares</title>
</head>
<body>
    <h1>Celulares</h1>
    <a href="adicionar.php">Adicionar Novo Celular</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Preço</th>
            <th>Preço com Mão de Obra</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']); ?></td>
            <td><?= htmlspecialchars($row['modelo']); ?></td>
            <td><?= htmlspecialchars($row['marca']); ?></td>
            <td><?= number_format($row['preco'], 2, ',', '.'); ?></td>
            <td><?= number_format($row['preco_com_mao_de_obra'], 2, ',', '.'); ?></td>
            <td>
                <a href="editar.php?id=<?= $row['id']; ?>">Editar</a>
                <a href="deletar.php?id=<?= $row['id']; ?>" onclick="return confirm('Tem certeza que deseja deletar este celular?')">Deletar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
