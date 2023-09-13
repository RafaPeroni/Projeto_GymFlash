<?php

include_once 'assets/php/databaseconnect.php';

if(isset($_POST['cadusu'])){
    $name_usu = $_POST['name_usuario']; 
    $tel_usu = $_POST['tel_usuario']; 
    $email_usu = $_POST['email_usuario']; 
    $cpf_usu = $_POST['cpf_usuario']; 
    $senha_usu = $_POST['senha_usuario']; 
    $csenha_usu = $_POST['csenha_usuario']; 
  //verificação de nulos
    if(strlen($name_usu) == 0 || strlen($tel_usu) <= 0 || strlen($cpf_usu) <= 0|| strlen($senha_usu) <= 0|| strlen($csenha_usu) <= 0)
    {
        function_alert('CADASTRO INTERROMPIDO, ERRO AO REALIZAR CADASTRO, PREENCHA INFORMAÇÕES VÁLIDAS NOS CAMPOS DE CADASTRO');
    }
    else{

  // verificação de cadastros existentes
        $veri_usu = $conn->prepare("SELECT * FROM Cadastrousuario WHERE Email_usuario LIKE :email_usu OR CPF_usuario LIKE :cpf_usu");
        $veri_usu->bindValue(':email_usu', $email_usu);
        $veri_usu->bindValue(':cpf_usu', $cpf_usu);
        $veri_usu->execute();
        $result1 = $veri_usu->fetch(PDO::FETCH_ASSOC);
        if (empty($result1))
        {   
            if($senha_usu == $csenha_usu){

        $stmt = $conn->prepare("INSERT into Cadastrousuario (Credencial_usuario, Nome_usuario, CPF_usuario, Email_usuario, Senha_usuario, Telefone_usuario) " .
            " values (default,?,?, ?, ?, ?)"
        );

        $stmt->bindParam(1, $name_usu);
        $stmt->bindParam(2, $cpf_usu);
        $stmt->bindParam(3, $email_usu);
        $stmt->bindParam(4, $senha_usu);
        $stmt->bindParam(5, $tel_usu);

        $stmt->execute();
        function_alert('Valor inserido com sucesso!');
           
        echo "Valor inserido com sucesso!";
        die("Valor inserido com sucesso!. <p><a href=\"./index.php\">RETORNAR</a></p>");


        $stmt = null;
        $conn = die;
        header("Location: index.php");

           }
           else{
            function_alert(' AS SENHAS CADASTRADAS DEVEM SER IGUAIS PARA PROSSEGUIR COM A VALIDAÇÃO DO CADASTRO!');
           }
        }
        else
        {
            function_alert(' ERRO AO REALIZAR CADASTRO, EMAIL OU CPF JÁ EXISTENTE... CASO PRECISE ENTRE EM CONTATO COM O SUPORTE :)');
        }
    }
}  
?>