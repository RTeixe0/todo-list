<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senha);
    
    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Erro: " . $stmt->error;
    }
}
?>

<!-- Formulário de cadastro -->
<form method="post">
  <input type="text" name="nome" placeholder="Nome" required>
  <input type="email" name="email" placeholder="E-mail" required>
  <input type="password" name="senha" placeholder="Senha" required>
  <button type="submit">Cadastrar</button>
</form>
