<?php
require 'conexao.php'; 

if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; 

    try {
        $sql = "SELECT * FROM celulares WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $cell = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cell) {
            $sql = "DELETE FROM celulares WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);

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
