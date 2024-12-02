<?php
require 'conexao.php'; // Conecta ao banco de dados

// Verifica se o parâmetro 'id' foi passado na URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Garantir que o id seja um número inteiro

    try {
        // Verifica se o ID existe no banco de dados
        $sql = "SELECT * FROM celulares WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $cell = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cell) {
            // Se o celular existir, executa a exclusão
            $sql = "DELETE FROM celulares WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);

            // Forçar a reinicialização do auto incremento
            $sql = "ALTER TABLE celulares AUTO_INCREMENT = 1"; // Reinicia o contador do AUTO_INCREMENT
            $pdo->exec($sql);

            // Redireciona para a página de listagem após a exclusão
            header("Location: listagem.php");
            exit();
        } else {
            echo "Celular não encontrado.";
        }
    } catch (PDOException $e) {
        echo 'Erro ao excluir celular: ' . $e->getMessage();
    }
} else {
    echo "ID inválido.";
}
?>
