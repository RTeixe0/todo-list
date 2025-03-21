<?php
session_start();
include 'db.php';

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
    } else {
        echo "Login inválido!";
    }
}
?>

<!-- Formulário de login -->
<form method="post">
  <input type="email" name="email" placeholder="E-mail" required>
  <input type="password" name="senha" placeholder="Senha" required>
  <button type="submit">Entrar</button>
</form>
<a href="register.php">Criar conta</a>
