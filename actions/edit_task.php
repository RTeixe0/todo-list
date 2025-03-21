<?php
session_start();
include '../inc/db.php';
include '../inc/header.php';

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

<h2 class="mb-4 text-center">Editar Tarefa</h2>

<div class="row justify-content-center">
  <div class="col-md-6">
    <form method="post" class="card card-body shadow-sm">
      <input type="hidden" name="id" value="<?= $tarefa['id'] ?>">

      <div class="mb-3">
        <label class="form-label">Tarefa</label>
        <input type="text" name="tarefa" class="form-control" value="<?= htmlspecialchars($tarefa['tarefa']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
          <option value="pendente" <?= $tarefa['status'] === 'pendente' ? 'selected' : '' ?>>Pendente</option>
          <option value="concluída" <?= $tarefa['status'] === 'concluída' ? 'selected' : '' ?>>Concluída</option>
        </select>
      </div>

      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="../dashboard.php" class="btn btn-secondary">Cancelar</a>
      </div>
    </form>
  </div>
</div>

<?php include '../inc/footer.php'; ?>

