<?php
session_start();
include 'inc/db.php';
include 'inc/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    $user = $res->fetch_assoc();

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard.php");
        exit();
    } else {
        $erro = "E-mail ou senha inválidos!";
    }
}
?>


<h2 class="text-center mb-4">Login</h2>

<?php if (isset($erro)): ?>
  <div class="alert alert-danger text-center"><?= $erro ?></div>
<?php endif; ?>

<div class="row justify-content-center">
  <div class="col-md-4">
    <form method="post" class="card card-body shadow-sm">
      <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" name="senha" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Entrar</button>
    </form>

    <p class="text-center mt-3">
      <a href="register.php">Criar conta</a>
    </p>
  </div>
</div>

<?php include 'inc/footer.php'; ?>
