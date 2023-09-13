<?php
include_once 'databaseconnect.php';
if(!isset($_SESSION)) {
    session_start();
}
if(!isset($_SESSION['Credencial_academia'])  ) {
    die("Você não possue login para acessar essa página.<p><a href=\"./index.php\">RETORNAR</a></p>");
}
if(isset($_POST['excluir'])){
  //cadastro
  $excluir1= $conn->prepare("DELETE  FROM CadastroAcademia WHERE Credencial_academia = :credencial");
  $excluir1->bindParam(':credencial', $_SESSION['Credencial_academia']);
  $excluir1->execute();
  //expediente
  $excluir2= $conn->prepare("DELETE  FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial");
  $excluir2->bindParam(':credencial', $_SESSION['Credencial_academia']);
  $excluir2->execute();
  //endereço
  $excluir3= $conn->prepare("DELETE  FROM enderecoacademia WHERE FK_Credencial_academia = :credencial");
  $excluir3->bindParam(':credencial', $_SESSION['Credencial_academia']);
  $excluir3->execute();
 //modalidade
  $excluir4= $conn->prepare("DELETE  FROM ModalidadeAcademia WHERE FK_Credencial_academia = :credencial");
  $excluir4->bindParam(':credencial', $_SESSION['Credencial_academia']);
  $excluir4->execute();
  session_destroy();
  if($excluir1){
  die("   Sua conta foi exluida com sucesso<p><a href=\"./index.php\">RETORNAR</a></p>");
  }
}
//ALTER NOME DA  ACADEMIA===========================================================================================
 if(isset($_POST['academia'])){
    $alter_nome = (string)$_POST['nameAcad'];
    if(strlen($alter_nome) <= 0 )
    {
    echo " O CAMPO QUE DESEJA ATUALIZAR NÃO PODE SER VAZIO";
    }
    else{
     $alter_nomeA= $conn->prepare("UPDATE CadastroAcademia SET  Nome_da_academia = '$alter_nome' WHERE Credencial_academia = :credencial");
     $alter_nomeA->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $alter_nomeA->execute();
     $busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
     $busca_acad->bindParam(':credencial', $_SESSION['Credencial_academia']);
     if($alter_nomeA){
        echo '<script>alert("Nome da ACADEMIA Alterado com SUCESSO!!")</script>';
        }
    }
}
//ALTER REPRESENTANTE DA ACADEMIA===========================================================================================
 if(isset($_POST['representante'])){
    $representante = (string)$_POST['nameRep'];
    if(strlen($representante) <= 0 )
    {
    echo " O CAMPO QUE DESEJA ATUALIZAR NÃO PODE SER VAZIO";
    }
    else{
     $alter_representante= $conn->prepare("UPDATE CadastroAcademia SET  Nome_do_representate = '$representante' WHERE Credencial_academia = :credencial");
     $alter_representante->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $alter_representante->execute();
     $busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
     $busca_acad->bindParam(':credencial', $_SESSION['Credencial_academia']);
     if($alter_representante){
        echo '<script>alert("Nome do REPRESENTANTE Alterado com SUCESSO!!")</script>';
        }
    }
}
//ALTER senha DA ACADEMIA===========================================================================================
 if(isset($_POST['senha'])){
    $senha = (string)$_POST['senha_acad'];
    if(strlen($senha) <= 0 )
    {
    echo " O CAMPO QUE DESEJA ATUALIZAR NÃO PODE SER VAZIO";
    }
    else{
     $alter_senha= $conn->prepare("UPDATE CadastroAcademia SET  Senha_academia = '$senha' WHERE Credencial_academia = :credencial");
     $alter_senha->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $alter_senha->execute();
     $busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
     $busca_acad->bindParam(':credencial', $_SESSION['Credencial_academia']);
     if($alter_senha){
        echo '<script>alert("SENHA Alterada com SUCESSO!!")</script>';
        }
    }
}
//ALTER CNPJ DA ACADEMIA===========================================================================================
 if(isset($_POST['cnpj_submit'])){
    $cnpj = (string)$_POST['cnpj'];
    if(strlen($cnpj) <= 0 )
    {
    echo " O CAMPO QUE DESEJA ATUALIZAR NÃO PODE SER VAZIO";
    }
    else{
      
      $veri_acad= $conn->prepare("SELECT * FROM CadastroAcademia WHERE CNPJ_academia like '$cnpj'");
      $veri_acad->execute();
      $result1 = $veri_acad->fetch(PDO::FETCH_ASSOC);
        if (empty($result1) ) {
            $alter_cnpj= $conn->prepare("UPDATE CadastroAcademia SET  CNPJ_academia = '$cnpj' WHERE Credencial_academia = :credencial");
            $alter_cnpj->bindParam(':credencial', $_SESSION['Credencial_academia']);
            $alter_cnpj->execute();
            $busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
            $busca_acad->bindParam(':credencial', $_SESSION['Credencial_academia']);
             if($alter_cnpj){
                echo '<script>alert("CNPJ Alterada com SUCESSO!!")</script>';
              }
           }
           else{
            function_alert('ESTE CNPJ ESTA INDISPONÍVEL NO MOMENTO! Gentileza escolher outro ou entar em contato com o SUPORTE');
        }
     }
 }
//ALTER EMAIL DA ACADEMIA===========================================================================================
 if(isset($_POST['email'])){
    $email = (string)$_POST['email_acad'];
    if(strlen($email) <= 0 )
    {
    function_alert("O CAMPO QUE DESEJA ATUALIZAR NÃO PODE SER VAZIO");
    }
    else{
      //verificação de email na conta de academias
      $alter_email= $conn->prepare("SELECT * FROM CadastroAcademia WHERE Email_academia like ?");
      $alter_email->bindValue(1 ,$email);
      $alter_email->execute();
      //verificação de email na conta de usuarios
      $alter_email2= $conn->prepare("SELECT * FROM Cadastrousuario WHERE Email_usuario like ?");
      $alter_email2->bindValue(1 ,$email);
      $alter_email2->execute();
      $result_email1 = $alter_email->fetch(PDO::FETCH_ASSOC);
      $result_email2= $alter_email2->fetch(PDO::FETCH_ASSOC);
        if (empty($result_email1) && empty($result_email2)) {
            $alter_email= $conn->prepare("UPDATE CadastroAcademia SET  Email_academia = '$email' WHERE Credencial_academia = :credencial");
            $alter_email->bindParam(':credencial', $_SESSION['Credencial_academia']);
            $alter_email->execute();
            $busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
            $busca_acad->bindParam(':credencial', $_SESSION['Credencial_academia']);
            if($alter_email){
               echo '<script>alert("EMAIL Alterada com SUCESSO!!")</script>';
               }
    } 
    else{
      function_alert('ESTE EMAIL ESTA INDISPONÍVEL NO MOMENTO! Gentileza escolher outro email ou entar em contato com o SUPORTE');
  }
}
 }
//ALTER FUNCIONÁRIOS DA ACADEMIA===========================================================================================
 if(isset($_POST['funcionarios'])){
    $numFunc = (int)$_POST['numFunc'];
    if(strlen($numFunc) <= 0 )
    {
    echo " O CAMPO QUE DESEJA ATUALIZAR NÃO PODE SER VAZIO";
    }
    else{
     $alter_funcionarios= $conn->prepare("UPDATE CadastroAcademia SET  Quant_funcionario = '$numFunc' WHERE Credencial_academia = :credencial");
     $alter_funcionarios->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $alter_funcionarios->execute();
     $busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
     $busca_acad->bindParam(':credencial', $_SESSION['Credencial_academia']);
     if($alter_funcionarios){
        echo '<script>alert("QUANTIDADE DE FUNCIONÁRIOS  Alterada com SUCESSO!!")</script>';
        }
    } 
}
//ALTER TELEFONE DA ACADEMIA===========================================================================================
 if(isset($_POST['telefone'])){
    $telefone = (string)$_POST['tel'];
    if(strlen($telefone) <= 0 )
    {
    echo " O CAMPO QUE DESEJA ATUALIZAR NÃO PODE SER VAZIO";
    }
    else{
     $alter_telefone= $conn->prepare("UPDATE CadastroAcademia SET  Telefone_academia = '$telefone' WHERE Credencial_academia = :credencial");
     $alter_telefone->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $alter_telefone->execute();
     $busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
     $busca_acad->bindParam(':credencial', $_SESSION['Credencial_academia']);
     if($alter_telefone){
        echo '<script>alert("COMENTARIOS  Alterada com SUCESSO!!")</script>';
        }
    } 
}
//ALTER COMENTARIOS DA ACADEMIA===========================================================================================
 if(isset($_POST['comentarios'])){
    $comentario = (string)$_POST['coment'];
    if(strlen($comentario) <= 0 )
    {
    echo " O CAMPO QUE DESEJA ATUALIZAR NÃO PODE SER VAZIO";
    }
    else{
     $alter_comentario= $conn->prepare("UPDATE CadastroAcademia SET  Comentario = '$comentario' WHERE Credencial_academia = :credencial");
     $alter_comentario->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $alter_comentario->execute();
     $busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
     $busca_acad->bindParam(':credencial', $_SESSION['Credencial_academia']);
     if($alter_comentario){
        echo '<script>alert("QUANTIDADE DE FUNCIONÁRIOS  Alterada com SUCESSO!!")</script>';
        }
    } 
}
//ALTER ENDERECODA ACADEMIA===========================================================================================
 if(isset($_POST['endereco2'])){
    $cep = (string)$_POST['ceploc'];
    $estado = (string)$_POST['state'];
    $cidade = (string)$_POST['city'];
    $rua = (string)$_POST['rua'];
    $bairro = (string)$_POST['bairro'];
    $num = (int)$_POST['num'];
    $comp = (string)$_POST['complemento'];
    if(strlen($cep) <= 0  || strlen($num) <= 0)
    {
    echo " O CAMPO QUE DESEJA ATUALIZAR NÃO PODE SER VAZIO";
    }
    else{
 //CEP
 
      $alter_endereco= $conn->prepare("UPDATE EnderecoAcademia SET  CEP_academia = '$cep' WHERE FK_Credencial_academia = :credencial");
      $alter_endereco->bindParam(':credencial', $_SESSION['Credencial_academia']);
      $alter_endereco->execute();
 //estado
     $alter_endereco= $conn->prepare("UPDATE EnderecoAcademia SET   Estado_academia = '$estado' WHERE FK_Credencial_academia = :credencial");
     $alter_endereco->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $alter_endereco->execute();
 //cidade
     $alter_endereco= $conn->prepare("UPDATE EnderecoAcademia SET  Cidade_academia = '$cidade' WHERE FK_Credencial_academia = :credencial");
     $alter_endereco->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $alter_endereco->execute();
 //bairro
     $alter_endereco= $conn->prepare("UPDATE EnderecoAcademia SET  Bairro_academia = '$bairro' WHERE FK_Credencial_academia = :credencial");
     $alter_endereco->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $alter_endereco->execute();
 //rua
     $alter_endereco= $conn->prepare("UPDATE EnderecoAcademia SET  Rua_academia = '$rua' WHERE FK_Credencial_academia = :credencial");
     $alter_endereco->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $alter_endereco->execute();
 //nmr
     $alter_endereco= $conn->prepare("UPDATE EnderecoAcademia SET  Num_academia = '$num' WHERE FK_Credencial_academia = :credencial");
     $alter_endereco->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $alter_endereco->execute();

    
 //complemento
     $alter_endereco = $conn->prepare("UPDATE EnderecoAcademia SET  Complemento_academia = '$comp' WHERE FK_Credencial_academia = :credencial");
     $alter_endereco->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $alter_endereco->execute();

     if($alter_endereco){
      echo '<script>alert("LOCALIZAÇÃO DA ACADEMIA  Alterada com SUCESSO!!")</script>';
      }
  } 

} 
//ALTER HORÁRIO ACADEMIA
 //DOMINGO   
  if(isset($_POST['alter-day1'])){
    $DAY1_A = $_POST['horario-DOMINGO-A'];
    $DAY1_E = $_POST['horario-DOMINGO-E']; 
    $status1 = (string)$_POST['status1'];
   
        $alter_horario= $conn->prepare("UPDATE ExpedienteAcademia SET  
        Hora_abertura_academia = '$DAY1_A', 
        Hora_fechamento_academia = '$DAY1_E', 
        estatus = '$status1' WHERE Dia_semana = 1 AND FK_Credencial_academia = :credencial");
        $alter_horario->bindParam(':credencial', $_SESSION['Credencial_academia']);
        $alter_horario->execute();

     $busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
     $busca_acad->bindParam(':credencial', $_SESSION['Credencial_academia']);
     if($alter_horario)
     {
      echo '<script>alert("HORÁRIO DA ACADEMIA  Alterada com SUCESSO!!")</script>';
     }
    }
  
 //SEGUNDA
  if(isset($_POST['alter-day2'])){
    $DAY2_A = $_POST['horario-SEGUNDA-A'];
    $DAY2_E = $_POST['horario-SEGUNDA-E']; 
    $status2 = (string)$_POST['status2'];
  
    $alter_horario= $conn->prepare("UPDATE ExpedienteAcademia SET  
        Hora_abertura_academia = '$DAY2_A', 
        Hora_fechamento_academia = '$DAY2_E', 
        estatus = '$status2' WHERE Dia_semana = 2 AND FK_Credencial_academia = :credencial");
        $alter_horario->bindParam(':credencial', $_SESSION['Credencial_academia']);
        $alter_horario->execute();

        $busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
        $busca_acad->bindParam(':credencial', $_SESSION['Credencial_academia']);
        if($alter_horario)
        {
         echo '<script>alert("HORÁRIO DA ACADEMIA  Alterada com SUCESSO!!")</script>';
        }
    }
  
 //TERÇA
  if(isset($_POST['alter-day3'])){
    $DAY3_A = $_POST['horario-TERCA-A'];
    $DAY3_E = $_POST['horario-TERCA-E']; 
    $status3 = (string)$_POST['status3'];
  
     $alter_horario= $conn->prepare("UPDATE ExpedienteAcademia SET  
     Hora_abertura_academia = '$DAY3_A', 
     Hora_fechamento_academia = '$DAY3_E', 
     estatus = '$status3' WHERE Dia_semana = 3 AND FK_Credencial_academia = :credencial");
     $alter_horario->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $alter_horario->execute();

     $busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
     $busca_acad->bindParam(':credencial', $_SESSION['Credencial_academia']);
     if($alter_horario)
     {
      echo '<script>alert("HORÁRIO DA ACADEMIA  Alterada com SUCESSO!!")</script>';
     }
    } 
   
 //QUARTA
  if(isset($_POST['alter-day4'])){
    $DAY4_A = $_POST['horario-QUARTA-A'];
    $DAY4_E = $_POST['horario-QUARTA-E']; 
    $status4 = (string)$_POST['status4'];
  
     $alter_horario= $conn->prepare("UPDATE ExpedienteAcademia SET  
     Hora_abertura_academia = '$DAY4_A', 
     Hora_fechamento_academia = '$DAY4_E', 
     estatus = '$status4' WHERE Dia_semana = 4 AND FK_Credencial_academia = :credencial");
     $alter_horario->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $alter_horario->execute();

     $busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
     $busca_acad->bindParam(':credencial', $_SESSION['Credencial_academia']);
     if($alter_horario)
     {
      echo '<script>alert("HORÁRIO DA ACADEMIA  Alterada com SUCESSO!!")</script>';
     }
    }
  
 //QUINTA
  if(isset($_POST['alter-day5'])){
    $DAY5_A = $_POST['horario-QUINTA-A'];
    $DAY5_E = $_POST['horario-QUINTA-E']; 
    $status5 = (string)$_POST['status5'];
  
  
     $alter_horario= $conn->prepare("UPDATE ExpedienteAcademia SET  
     Hora_abertura_academia = '$DAY5_A', 
     Hora_fechamento_academia = '$DAY5_E', 
     estatus = '$status5' WHERE Dia_semana = 5 AND FK_Credencial_academia = :credencial");
     $alter_horario->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $alter_horario->execute();

     $busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
     $busca_acad->bindParam(':credencial', $_SESSION['Credencial_academia']);
     if($alter_horario)
     {
      echo '<script>alert("HORÁRIO DA ACADEMIA  Alterada com SUCESSO!!")</script>';
     }
   } 
  
 //SEXTA
  if(isset($_POST['alter-day6'])){
    $DAY6_A = $_POST['horario-SEXTA-A'];
    $DAY6_E = $_POST['horario-SEXTA-E']; 
    $status6 = (string)$_POST['status6'];
 
     $alter_horario= $conn->prepare("UPDATE ExpedienteAcademia SET  
     Hora_abertura_academia = '$DAY6_A', 
     Hora_fechamento_academia = '$DAY6_E', 
     estatus = '$status6' WHERE Dia_semana = 6 AND FK_Credencial_academia = :credencial");
     $alter_horario->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $alter_horario->execute();

     $busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
     $busca_acad->bindParam(':credencial', $_SESSION['Credencial_academia']);
     if($alter_horario)
     {
      echo '<script>alert("HORÁRIO DA ACADEMIA  Alterada com SUCESSO!!")</script>';
     }
    } 
  
 //SÁBADO
  if(isset($_POST['alter-day7'])){
    $DAY7_A = $_POST['horario-SABADO-A'];
    $DAY7_E = $_POST['horario-SABADO-E']; 
    $status7 = (string)$_POST['status7'];
 
     $alter_horario= $conn->prepare("UPDATE ExpedienteAcademia SET  
     Hora_abertura_academia = '$DAY7_A', 
     Hora_fechamento_academia = '$DAY7_E', 
     estatus = '$status7' WHERE Dia_semana = 7 AND FK_Credencial_academia = :credencial");
     $alter_horario->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $alter_horario->execute();

     $busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
     $busca_acad->bindParam(':credencial', $_SESSION['Credencial_academia']);
     if($alter_horario)
     {
      echo '<script>alert("HORÁRIO DA ACADEMIA  Alterada com SUCESSO!!")</script>';
     }
    }
  
//ALTER MODALIDADES DA ACADEMIA
  if(isset($_POST['delet_mod'])){
    if(isset($_POST['selct_mod'])){
      $id = (string)$_POST['selct_mod'];
    
     $del_modalidades = $conn->prepare("DELETE from ModalidadeAcademia WHERE FK_Credencial_academia = :credencial AND id_modaldiade = :id ");
     $del_modalidades->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $del_modalidades->bindParam(':id', $id);
     $del_modalidades->execute();
    
     if($del_modalidades){
      echo '<script>alert("Modalidade Deletada com SUCESSO!!")</script>';
      }
    }
    else{function_alert("Você não possui modalidades cadastradas"); }
  } 
//CADASTRO MODALIDADES==========================================================================================
 if (isset($_POST['modadd'])) {
 //MODALIDADE 1
 if((!empty($_POST['check-muaythai'])))
 {
  $veri_mod1= $conn->prepare("SELECT * FROM ModalidadeAcademia WHERE FK_Credencial_academia = :credencial AND Nome_modalidade = 'Muay Thai'");
  $veri_mod1->bindParam(':credencial', $_SESSION['Credencial_academia']);
  $veri_mod1->execute();
  $result1 = $veri_mod1->fetch(PDO::FETCH_ASSOC);
    if (!empty($result1)) 
    {
      ECHO"Muay Thai já existe";
    } 
    else {
      
      $add_modalidade1 = $conn->prepare("INSERT INTO ModalidadeAcademia 
      VALUES( 1,:credencial,'Muay Thai' );");
      $add_modalidade1->bindParam(':credencial', $_SESSION['Credencial_academia']);
      $add_modalidade1->execute();
    } 
  }
    // MODALIDADE 2
  if((!empty($_POST['check-boxe'])))
    {
     $veri_mod2 = $conn->prepare("SELECT * FROM ModalidadeAcademia WHERE FK_Credencial_academia = :credencial AND Nome_modalidade = 'boxe' ");
     $veri_mod2->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $veri_mod2->execute();
     $result2 = $veri_mod2->fetch(PDO::FETCH_ASSOC);
       if (!empty($result2)) 
       {
         ECHO "Boxe ja existe";
       } 
       else {
        $add_modalidade2 = $conn->prepare("INSERT INTO ModalidadeAcademia 
        VALUES( 2,:credencial,'Boxe' );");
        $add_modalidade2->bindParam(':credencial', $_SESSION['Credencial_academia']);
        $add_modalidade2->execute();
       }
  }
    // MODALIDADE 3
    if((!empty($_POST['chek-danca'])))
    {
     $veri_mod3 = $conn->prepare("SELECT * FROM ModalidadeAcademia WHERE FK_Credencial_academia = :credencial AND Nome_modalidade = 'Dança' ");
     $veri_mod3->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $veri_mod3->execute();
     $result3 = $veri_mod3->fetch(PDO::FETCH_ASSOC);
       if (!empty($result3)) 
       {
         ECHO "Dança ja existe 3";
       } 
       else {
        $add_modalidade3 = $conn->prepare("INSERT INTO ModalidadeAcademia 
        VALUES( 3,:credencial,'Dança' );");
        $add_modalidade3->bindParam(':credencial', $_SESSION['Credencial_academia']);
        $add_modalidade3->execute();
       }
     }
    // MODALIDADE 4
    if((!empty($_POST['check-spinning'])))
    {
     $veri_mod4 = $conn->prepare("SELECT * FROM ModalidadeAcademia WHERE FK_Credencial_academia = :credencial AND Nome_modalidade = 'Spinning' ");
     $veri_mod4->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $veri_mod4->execute();
     $result4 = $veri_mod4->fetch(PDO::FETCH_ASSOC);
       if (!empty($result4)) 
       {
         ECHO "Spinning ja existe";
       } 
       
       else {
        $add_modalidade4 = $conn->prepare("INSERT INTO ModalidadeAcademia 
        VALUES( 4,:credencial,'Spinning' );");
        $add_modalidade4->bindParam(':credencial', $_SESSION['Credencial_academia']);
        $add_modalidade4->execute();
       }
     }
    // MODALIDADE 5
    if((!empty($_POST['check-judo'])))
    {
     $veri_mod5 = $conn->prepare("SELECT * FROM ModalidadeAcademia WHERE FK_Credencial_academia = :credencial AND Nome_modalidade = 'Judô' ");
     $veri_mod5->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $veri_mod5->execute();
     $result5 = $veri_mod5->fetch(PDO::FETCH_ASSOC);
       if (!empty($result5)) 
       {
         ECHO "judo já existe";
       } 
       
       else {
        $add_modalidade5 = $conn->prepare("INSERT INTO ModalidadeAcademia 
        VALUES( 5,:credencial,'Judô' );");
        $add_modalidade5->bindParam(':credencial', $_SESSION['Credencial_academia']);
        $add_modalidade5->execute();
       }
     }
     // MODALIDADE 6
    if((!empty($_POST['check-jump'])))
    {
     $veri_mod6 = $conn->prepare("SELECT * FROM ModalidadeAcademia WHERE FK_Credencial_academia = :credencial AND Nome_modalidade = 'Jump' ");
     $veri_mod6->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $veri_mod6->execute();
     $result6 = $veri_mod6->fetch(PDO::FETCH_ASSOC);
       if (!empty($result6)) 
       {
         ECHO "Jumpjá existe";
       } 
       
       else {
        $add_modalidade6 = $conn->prepare("INSERT INTO ModalidadeAcademia 
        VALUES( 6,:credencial,'Jump' );");
        $add_modalidade6->bindParam(':credencial', $_SESSION['Credencial_academia']);
        $add_modalidade6->execute();
       }
     }
    // MODALIDADE 7
    if((!empty($_POST['check-crossfit'])))
    {
     $veri_mod7 = $conn->prepare("SELECT * FROM ModalidadeAcademia WHERE FK_Credencial_academia = :credencial AND Nome_modalidade = 'Crossfit' ");
     $veri_mod7->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $veri_mod7->execute();
     $result7 = $veri_mod7->fetch(PDO::FETCH_ASSOC);
       if (!empty($result7)) 
       {
         ECHO "Jumpjá existe";
       } 
       
       else {
        $add_modalidade7 = $conn->prepare("INSERT INTO ModalidadeAcademia 
        VALUES( 7,:credencial,'Crossfit' );");
        $add_modalidade7->bindParam(':credencial', $_SESSION['Credencial_academia']);
        $add_modalidade7->execute();
       }
     }
    // MODALIDADE 8
    if((!empty($_POST['check-taekwendo'])))
    {
     $veri_mod8 = $conn->prepare("SELECT * FROM ModalidadeAcademia WHERE FK_Credencial_academia = :credencial AND Nome_modalidade = 'Taekwendô' ");
     $veri_mod8->bindParam(':credencial', $_SESSION['Credencial_academia']);
     $veri_mod8->execute();
     $result8 = $veri_mod8->fetch(PDO::FETCH_ASSOC);
       if (!empty($result8)) 
       {
         ECHO "Taekwendô já existe";
       } 
       
       else {
        $add_modalidade8 = $conn->prepare("INSERT INTO ModalidadeAcademia 
        VALUES( 8,:credencial,'Taekwendô' );");
        $add_modalidade8->bindParam(':credencial', $_SESSION['Credencial_academia']);
        $add_modalidade8->execute();
       }
     }
     echo '<script>alert("Os campos que não estavam cadastrados, Foram armazenados com Sucesso")</script>'; 
    }
 



  
 
?>