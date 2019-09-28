/* Função para envio de email */

<?php

function trabalheConosco ($dados) {

    // Etapa 1 - Pegar dados do formulário*

    /* Os dados dentro do array se referem aos inputs do formulário trabalhe 
    conosco. */

    $nome_usuario = $dados["nome"];
    $email_usuario = $dados ['email'];
    $mensagem_usuario = $dados ["mensagem"];

    // Criar variáveis de envio

    $destino = "garaujo@marlin.com.br";
    $remetente = "garaujo@marlin.com.br";
    $assunto = "Trabalhe Conosco"; 

    // Montar o corpo da mensagem do email  

    $mensagem = "O usuário" . $nome_usuario . "fez uma solicitação";
    $mensagem .= "para trabalhar no Mercado Diamante <br>";
    $mensagem .= "Email: " .$email_usuario . "<br>";
    $mensagem .= "Mensagem: " .$mensagem_usuario . "<br>";

    return mail($destino,$assunto,$mensagem, $remetente);


}


?>