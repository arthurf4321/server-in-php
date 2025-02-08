<?php 
    $host = "localhost";
    $usuarios = "root";
    $senha = "";
    $nome_banco = "cadastro_db";


// Conexão com banco de dados
$conn = new mysqli($host, $usuarios, $senha, $nome_banco);


// Verificando a conexão
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }
?>