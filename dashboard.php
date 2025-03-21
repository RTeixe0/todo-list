<?php
session_start();
include 'inc/db.php';
include 'inc/header.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM tasks WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();
?>

<h2 class="mb-4 text-center">Minhas Tarefas</h2>

<div class="card mb-4 shadow-sm bg-gradient-dark">
  <div class="card-body">
    <form method="post" action="actions/add_task.php" class="row g-2">
      <div class="col-9">
        <input type="text" name="tarefa" class="form-control" placeholder="Digite uma nova tarefa..." required>
      </div>
      <div class="col-3 d-grid">
        <button type="submit" class="btn btn-primary">Adicionar</button>
      </div>
    </form>
  </div>
</div>

<ul class="list-group shadow-sm">
  <?php if ($res->num_rows == 0): ?>
    <li class="list-group-item text-center text-muted">Nenhuma tarefa cadastrada.</li>
  <?php endif; ?>

  <?php while ($tarefa = $res->fetch_assoc()): ?>
    <li class="list-group-item d-flex justify-content-between align-items-center bg-gradient-dark">
      <div>
        <span class="<?= $tarefa['status'] == 'concluída' ? 'text-decoration-line-through text-muted' : '' ?>">
          <?= htmlspecialchars($tarefa['tarefa']) ?>
        </span>
        <span class="badge bg-<?= $tarefa['status'] == 'pendente' ? 'warning' : 'success' ?> ms-2">
          <?= ucfirst($tarefa['status']) ?>
        </span>
      </div>
      <div class="btn-group btn-group-sm">
        <a href="actions/edit_task.php?id=<?= $tarefa['id'] ?>" class="btn btn-outline-secondary">Editar</a>
        <a href="actions/delete_task.php?id=<?= $tarefa['id'] ?>" onclick="return confirm('Tem certeza?')" class="btn btn-outline-danger">Excluir</a>
      </div>
    </li>
  <?php endwhile; ?>
</ul>

<div class="mt-4 text-center">
  <a href="logout.php" class="btn btn-outline-dark btn-sm">Sair</a>
</div>

<?php include 'inc/footer.php'; ?>