<?php 
session_start();
include('db.php'); // Arquivo de conexão com o banco de dados


// Verificando se o formulario foi enviado
if (isset($_POST['submit'])) {


    // Recebendo os dados
    $email = $_POST['email'];
    $senha = $_POST['senha'];


    // Validando e Limpando dados
    $email = htmlspecialchars($email);
    $senha = htmlspecialchars($senha);


    // Verificando se o email ja existe no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();


    // Verificando se o usuario foi encontrado
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();


        // Verificando se a senha é valida
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nome'] = $user['nome'];
            $_SESSION['email'] = $user['email'];


            // Redirecionando usuario
            header("Location: dashboard.php");
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }
}
?>