<?php
include 'inc/db.php';
include 'inc/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "E-mail já cadastrado!";
    } else {
        $sql = "INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $email, $senha);
        
        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            echo "Erro ao cadastrar: " . $stmt->error;
        }
    }
}
?>

<h2 class="text-center mb-4">Criar Conta</h2>

<?php if (isset($erro)): ?>
  <div class="alert alert-warning text-center"><?= $erro ?></div>
<?php endif; ?>

<div class="row justify-content-center">
  <div class="col-md-4">
    <form method="post" class="card card-body shadow-sm">
      <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Senha</label>
        <input type="password" name="senha" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-success w-100">Cadastrar</button>
    </form>

    <p class="text-center mt-3">
      <a href="index.php">Já tem conta? Faça login</a>
    </p>
  </div>
</div>

<?php include 'inc/footer.php'; ?>
