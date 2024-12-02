<?php
require 'conexao.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; 

    try {
        
        $sql = "SELECT * FROM celulares WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $cell = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cell) {
            echo "Celular não encontrado.";
            exit();
        }
    } catch (PDOException $e) {
        echo 'Erro ao buscar celular: ' . $e->getMessage();
        exit();
    }
} else {
    echo "ID inválido.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $preco = $_POST['preco'];
    $preco_com_mao_de_obra = $_POST['preco_com_mao_de_obra'];

    try {
        $sql = "UPDATE celulares SET modelo = ?, marca = ?, preco = ?, preco_com_mao_de_obra = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$modelo, $marca, $preco, $preco_com_mao_de_obra, $id]);
        
        header("Location: listagem.php");
        exit();
    } catch (PDOException $e) {
        echo 'Erro ao atualizar celular: ' . $e->getMessage();
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar Celular</title>
</head>
<body>
    <h1>Editar Celular</h1>
    <form method="POST">
        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" value="<?= htmlspecialchars($cell['modelo']); ?>" required><br>

        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" value="<?= htmlspecialchars($cell['marca']); ?>" required><br>

        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" value="<?= htmlspecialchars($cell['preco']); ?>" required step="0.01"><br>

        <label for="preco_com_mao_de_obra">Preço com Mão de Obra:</label>
        <input type="number" id="preco_com_mao_de_obra" name="preco_com_mao_de_obra" value="<?= htmlspecialchars($cell['preco_com_mao_de_obra']); ?>" required step="0.01"><br>

        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
