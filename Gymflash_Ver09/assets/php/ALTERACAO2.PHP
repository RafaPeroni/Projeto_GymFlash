<?php
include_once 'databaseconnect.php';
if(!isset($_SESSION)) {
    session_start();
}
if(!isset($_SESSION['Credencial_usuario'])  ) {
    die("Você não possue login para acessar essa página.<p><a href=\"./index.php\">RETORNAR</a></p>");
}
if(isset($_POST['excluir'])){
   $excluir= $conn->prepare("DELETE  FROM Cadastrousuario WHERE Credencial_usuario = :credencial");
   $excluir->bindParam(':credencial', $_SESSION['Credencial_usuario']);
   $excluir->execute();
   session_destroy();
   if($excluir){
   die("Sua conta foi exluida com sucesso<p><a href=\"./index.php\">RETORNAR</a></p>");
   }
}
//ALTER NOME DO USUARIO===========================================================================================
 if(isset($_POST['name-usu'])){
    $alter_nome = (string)$_POST['nameusuario'];
    if(strlen($alter_nome) <= 0 )
    {
    echo " O CAMPO QUE DESEJA ATUALIZAR NÃO PODE SER VAZIO";
    }
    else{
     $alter_nomeA= $conn->prepare("UPDATE Cadastrousuario SET  Nome_usuario = '$alter_nome' WHERE Credencial_usuario = :credencial");
     $alter_nomeA->bindParam(':credencial', $_SESSION['Credencial_usuario']);
     $alter_nomeA->execute();
     
     if($alter_nomeA){
        echo '<script>alert("Nome do usuário Alterado com SUCESSO!!")</script>';
        }
    }
 }

//ALTER CPF DO USUARIO===========================================================================================
 if(isset($_POST['cpf-usu'])){
    $alter_cpf = (string)$_POST['cpf-u'];
    if(strlen($alter_cpf) <= 0 )
    {
    echo " O CAMPO QUE DESEJA ATUALIZAR NÃO PODE SER VAZIO";
    }
    else{
      $veri_cpf= $conn->prepare("SELECT * FROM Cadastrousuario WHERE CPF_usuario like ?");
      $veri_cpf->bindValue(1 ,$alter_cpf);
      $veri_cpf->execute();
      //verificação de email na conta de usuarios
      $result_cpf1 = $veri_cpf->fetch(PDO::FETCH_ASSOC);

        if (empty($result_cpf1)) {
        
     $alter_CPFu= $conn->prepare("UPDATE Cadastrousuario SET  CPF_usuario = '$alter_cpf' WHERE Credencial_usuario = :credencial");
     $alter_CPFu->bindParam(':credencial', $_SESSION['Credencial_usuario']);
     $alter_CPFu->execute();
     
     if($alter_CPFu){
        echo '<script>alert("CPF Alterado com SUCESSO!!")</script>';
        }
    }
    }
}
//ALTER TELEFONE DO USUARIO===========================================================================================
 if(isset($_POST['telefone'])){
    $alter_telefone = (string)$_POST['telefone-usu'];
    if(strlen($alter_telefone) <= 0 )
    {
    echo " O CAMPO QUE DESEJA ATUALIZAR NÃO PODE SER VAZIO";
    }
    else{
     $alter_tell= $conn->prepare("UPDATE Cadastrousuario SET  Telefone_usuario = '$alter_telefone' WHERE Credencial_usuario = :credencial");
     $alter_tell->bindParam(':credencial', $_SESSION['Credencial_usuario']);
     $alter_tell->execute();
     
     if($alter_tell){
        echo '<script>alert("TELEFONE Alterado com SUCESSO!!")</script>';
        }
    }
 }
// ALTER Email DO USUARIO===========================================================================================
 if(isset($_POST['email'])){
    $email = (string)$_POST['email-usu'];
    if(strlen($email) <= 0 )
    {
    echo " O CAMPO QUE DESEJA ATUALIZAR NÃO PODE SER VAZIO";
    }
    else{
      $alter_email= $conn->prepare("SELECT * FROM CadastroAcademia WHERE Email_academia like ?");
      $alter_email->bindValue(1 , $email);
      $alter_email->execute();
      //verificação de email na conta de usuarios
      $alter_email2= $conn->prepare("SELECT * FROM Cadastrousuario WHERE Email_usuario like ?");
      $alter_email2->bindValue(1 , $email);
      $alter_email2->execute();
      $result_email1 = $alter_email->fetch(PDO::FETCH_ASSOC);
      $result_email2= $alter_email2->fetch(PDO::FETCH_ASSOC);
        if (empty($result_email1) && empty($result_email2)) { 

      $veri_cpf= $conn->prepare("SELECT * FROM Cadastrousuario WHERE Email_usuario like ?");
      $veri_cpf->bindValue(1 ,$email);
      $veri_cpf->execute();
      //verificação de email na conta de usuarios
      $result_cpf1 = $veri_cpf->fetch(PDO::FETCH_ASSOC);

        if (empty($result_cpf1)) {
        
     $alter_CPFu= $conn->prepare("UPDATE Cadastrousuario SET  Email_usuario = '$email' WHERE Credencial_usuario = :credencial");
     $alter_CPFu->bindParam(':credencial', $_SESSION['Credencial_usuario']);
     $alter_CPFu->execute();
     
     if($alter_CPFu){
        echo '<script>alert("Email Alterado com SUCESSO!!")</script>';
        }
    }
    }else{
      echo '<script>alert("Email indispinível, troque por outro ou entre em contato com o suporte!!")</script>';
    }
}
}
//ALTER SENHA DO USUARIO===========================================================================================
if(isset($_POST['senha'])){
    $alter_senha = $_POST['senha-usu'];
    if(strlen($alter_senha) <= 0 )
    {
    echo " O CAMPO QUE DESEJA ATUALIZAR NÃO PODE SER VAZIO";
    }
    else{
     $alter_senhaA= $conn->prepare("UPDATE Cadastrousuario SET  Senha_usuario = '$alter_senha' WHERE Credencial_usuario = :credencial");
     $alter_senhaA->bindParam(':credencial', $_SESSION['Credencial_usuario']);
     $alter_senhaA->execute();
     
     if( $alter_senhaA){
        echo '<script>alert("Senha Alterada com SUCESSO!!")</script>';
        }
    }
 }

?>