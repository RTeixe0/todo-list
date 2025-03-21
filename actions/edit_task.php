<?php
session_start();
include '../inc/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM tasks WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $tarefa = $res->fetch_assoc();

    if (!$tarefa) {
        echo "Tarefa não encontrada!";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $tarefa = $_POST['tarefa'];
    $status = $_POST['status'];

    $sql = "UPDATE tasks SET tarefa = ?, status = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $tarefa, $status, $id, $user_id);

    if ($stmt->execute()) {
        header("Location: ../dashboard.php");
        exit();
    } else {
        echo "Erro ao editar tarefa: " . $stmt->error;
    }
}
?>

<h2>Editar Tarefa</h2>
<form method="post">
    <input type="hidden" name="id" value="<?= $tarefa['id'] ?>">
    <input type="text" name="tarefa" value="<?= htmlspecialchars($tarefa['tarefa']) ?>" required><br><br>

    <select name="status">
        <option value="pendente" <?= $tarefa['status'] == 'pendente' ? 'selected' : '' ?>>Pendente</option>
        <option value="concluída" <?= $tarefa['status'] == 'concluída' ? 'selected' : '' ?>>Concluída</option>
    </select><br><br>

    <button type="submit">Salvar</button>
</form>

<a href="../dashboard.php">Cancelar</a>
