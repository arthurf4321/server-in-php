<?php
include('db.php');

$host = "localhost";
$usuarios = "root";
$senha = "";
$nome_banco = "cadastro_db";

// Conexão ao banco de dados
$conn = new mysqli($host, $usuarios, $senha, $nome_banco);

// Verificando se a conexão deu certo
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if (isset($_POST['submit'])) {
    
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Validar e limpar os dados
    $nome = htmlspecialchars($nome);
    $email = htmlspecialchars($email);
    $senha = htmlspecialchars($senha);

    // Verifica se o email já existe no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Este email já está registrado.";
    } else {
        // Criptografia da senha
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Inserindo os dados ao banco de dados
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $email, $senha_hash);

        if ($stmt->execute()) {
            echo "Cadastro feito com sucesso!!!";
        } else {
            echo "Erro ao cadastrar: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <input type="submit" name="submit" value="submit">
</body>
</html>

<?php 
    if (isset($_POST['submit'])) {
        header("Location:dashboard.php");
        exit();
    }