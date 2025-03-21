<?php
session_start();
include '../inc/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM tasks WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $user_id);

    if ($stmt->execute()) {
        header("Location: ../dashboard.php");
    } else {
        echo "Erro ao excluir tarefa: " . $stmt->error;
    }
} else {
    echo "ID de tarefa não fornecido.";
}
