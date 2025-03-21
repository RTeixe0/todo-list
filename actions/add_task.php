<?php
session_start();
include '../inc/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tarefa = $_POST['tarefa'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO tasks (user_id, tarefa) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user_id, $tarefa);

    if ($stmt->execute()) {
        header("Location: ../dashboard.php");
    } else {
        echo "Erro ao adicionar tarefa: " . $stmt->error;
    }
}
