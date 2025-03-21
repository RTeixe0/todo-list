<?php
session_start();
include 'inc/db.php';

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

<h2>Login</h2>
<?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>

<form method="post">
    <input type="email" name="email" placeholder="E-mail" required><br><br>
    <input type="password" name="senha" placeholder="Senha" required><br><br>
    <button type="submit">Entrar</button>
</form>

<p><a href="register.php">Criar conta</a></p>
