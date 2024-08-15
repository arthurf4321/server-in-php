<?php
    header("Content-Type:application/json");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['name'];
        $email = $_POST['email'];
        $mensagem = $_POST['message'];

        header("HTTP/1.1 200");
	
        $response['data'] = array("nome"=>$nome, "email"=>$email, "mensagem"=>$mensagem);
        
        $json_response = json_encode($response);
        echo $json_response;
    }
?>