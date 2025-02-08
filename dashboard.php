<?php 
session_start();

// Vericando se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Usuário</title>
</head>
<body>
    <h2>BEm-Vindo, <?php echo $_SESSION['nome'];?>!</h2>
    <p>Email: <?php echo $_SESSION['email']; ?></p>
    <a href="logout.php">Sair</a>
</body>
</html>