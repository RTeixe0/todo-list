<?php
include 'inc/db.php';

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

<h2>Cadastro de Usuário</h2>
<form method="post">
    <input type="text" name="nome" placeholder="Nome" required><br><br>
    <input type="email" name="email" placeholder="E-mail" required><br><br>
    <input type="password" name="senha" placeholder="Senha" required><br><br>
    <button type="submit">Cadastrar</button>
</form>

<p><a href="index.php">Já tem conta? Faça login</a></p>
