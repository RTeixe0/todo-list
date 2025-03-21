<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM tasks WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();
?>

<h2>Minhas Tarefas</h2>

<form method="post" action="add_task.php">
  <input type="text" name="tarefa" placeholder="Nova tarefa" required>
  <button type="submit">Adicionar</button>
</form>

<ul>
<?php while ($tarefa = $res->fetch_assoc()): ?>
  <li>
    <?= htmlspecialchars($tarefa['tarefa']) ?> - <?= $tarefa['status'] ?>
    <a href="edit_task.php?id=<?= $tarefa['id'] ?>">Editar</a>
    <a href="delete_task.php?id=<?= $tarefa['id'] ?>">Excluir</a>
  </li>
<?php endwhile; ?>
</ul>

<a href="logout.php">Sair</a>
