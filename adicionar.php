<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $modelo = htmlspecialchars($_POST['modelo']);
    $marca = htmlspecialchars($_POST['marca']);
    $preco = filter_var($_POST['preco'], FILTER_VALIDATE_FLOAT);
    $preco_mao_obra = filter_var($_POST['preco_com_mao_de_obra'], FILTER_VALIDATE_FLOAT);

    if ($modelo && $marca && $preco && $preco_mao_obra) {

        $sql = "INSERT INTO celulares (modelo, marca, preco, preco_com_mao_de_obra) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$modelo, $marca, $preco, $preco_mao_obra]);

      
        header("Location: listagem.php");
        exit();
    } else {
        echo "Por favor, preencha todos os campos corretamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Novo Celular</title>
</head>
<body>
    <h1>Adicionar Novo Celular</h1>
    <form method="POST">
        <label>Modelo: <input type="text" name="modelo" required></label><br>
        <label>Marca: <input type="text" name="marca" required></label><br>
        <label>Preço: <input type="number" step="0.01" name="preco" required></label><br>
        <label>Preço com Mão de Obra: <input type="number" step="0.01" name="preco_com_mao_de_obra" required></label><br>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
