<?php
header('Content-Type: text/html; charset=utf-8');
include_once 'assets/php/databaseconnect.php';


//CRUD - Insert, vai acontecer apenas ao clicar no submit no final da página

//CADASTRO ACADEMIA==========================================================================================
 if (isset($_POST['inserir'])) {
    $email_veri = (string)$_POST['email'];
    $cnpj_veri = (string)$_POST['cnpj'];
    $veri_acad= $conn->prepare(
        "SELECT * FROM CadastroAcademia WHERE CNPJ_academia like '$cnpj_veri'
         OR Email_academia like '$email_veri'  ");
        $veri_acad->execute();
        
        $result1 = $veri_acad->fetch(PDO::FETCH_ASSOC);
        if (empty($result1) ) {
       
             if (empty($_POST['senha'])) {
                
                  } else {
//cadastro
        $senha = $_POST['senha'];
        $csenha = $_POST['csenha'];
        if ($senha == $csenha) {
            $stmt = $conn->prepare('INSERT INTO CadastroAcademia (Credencial_academia, Nome_da_academia, Nome_do_representate, CNPJ_academia, Email_academia, Senha_academia, Telefone_academia, Quant_funcionario, Comentario) VALUES(:Credencial_academia, :Nome_da_academia, :Nome_do_representate, :CNPJ_academia, :Email_academia, :Senha_academia, :Telefone_academia, :Quant_funcionario, :Comentario)');
            $stmt->execute(
                array(
                    ':Credencial_academia' => NULL,
                    ':Nome_da_academia' => $nomeCad = $_POST['nameAcad'],
                    ':Nome_do_representate' => $nomeRep = $_POST['nameRep'],
                    ':CNPJ_academia' => $cnpj = $_POST['cnpj'],
                    ':Email_academia' => $email = $_POST['email'],
                    ':Senha_academia' => $senha,
                    ':Telefone_academia' => $tel = $_POST['tel'],
                    ':Quant_funcionario' => $qtdFunc = $_POST['numFunc'],
                    ':Comentario' => $coment = $_POST['coment']
                )
            );
            $lastID = $conn->lastInsertId();
            $fkCred = $lastID;
//CADASTRO MODALIDADES==========================================================================================
//CADASTRO MODALIDADES==========================================================================================
            if((!empty($_POST['check-muaythai'])))
            {
                $stmt1 = $conn->prepare("INSERT INTO ModalidadeAcademia 
                VALUES( 1,'$fkCred ','Muay Thai' );");
                $stmt1->execute();

            }
            if((!empty($_POST['check-boxe'])))
            {
                $stmt2 = $conn->prepare("INSERT INTO ModalidadeAcademia 
                VALUES( 2,'$fkCred ','Boxe' );");
                $stmt2->execute();
                
            }
            if((!empty($_POST['check-danca'])))
            {
                $stmt3 = $conn->prepare("INSERT INTO ModalidadeAcademia 
                VALUES( 3,'$fkCred ','Dança' );");
                $stmt3->execute();
                
            }
            if((!empty($_POST['check-spinning'])))
            {
                $stmt4 = $conn->prepare("INSERT INTO ModalidadeAcademia 
                VALUES( 4,'$fkCred ','Spinning' );");
                $stmt4->execute(); 
                
            }
            if((!empty($_POST['check-judo'])))
            {
                $stmt5 = $conn->prepare("INSERT INTO ModalidadeAcademia 
                VALUES( 5,'$fkCred ','Judô' );");
                $stmt5->execute();  
                
            }
            if((!empty($_POST['check-jump'])))
            {
                $stmt6 = $conn->prepare("INSERT INTO ModalidadeAcademia 
                VALUES( 6,'$fkCred ','Jump' );");
                $stmt6->execute();  
                
            }
            if((!empty($_POST['check-crossfit'])))
            {
                $stmt7 = $conn->prepare("INSERT INTO ModalidadeAcademia 
                VALUES( 7,'$fkCred ','Crossfit' );");
                $stmt7->execute(); 
            }
            if((!empty($_POST['check-taekwendo'])))
            {
                $stmt8 = $conn->prepare("INSERT INTO ModalidadeAcademia 
                VALUES( 8,'$fkCred ','Taekwendô' );");
                $stmt8->execute();  
            }
//CADASTRO ENDEREÇO==========================================================================================
            
            $stmt = $conn->prepare('INSERT INTO EnderecoAcademia (idEndereco, FK_Credencial_academia, 
            CEP_academia, Num_academia, Rua_academia, Bairro_academia, Cidade_academia, Estado_academia,Complemento_academia) 
            VALUES(:idEndereco, :FK_Credencial_academia, :CEP_academia, :Num_academia, :Rua_academia, 
            :Bairro_academia, :Cidade_academia, :Estado_academia,:Complemento_academia)');
            $stmt->execute(
                array(
                    ':idEndereco' => NULL,
                    ':FK_Credencial_academia' => $fkCred = $lastID,
                    ':CEP_academia' => $cep = $_POST['ceploc'],
                    ':Num_academia' => $num = $_POST['num'],
                    ':Rua_academia' => $rua = $_POST['rua'],
                    ':Bairro_academia' => $bairro = $_POST['bairro'],
                    ':Cidade_academia' => $city = $_POST['city'],
                    ':Estado_academia' => $uf = $_POST['state'],
                    ':Complemento_academia' => $coment = $_POST['coment']
                )
            );
// ADASTRO  HORÁRIO ==========================================================================================
            for($i=1; $i<=7; $i++)
            {
               $day_A = null;
               $day_E = null;
               $status = null;
               if ($i == 1) {
                  $day_A = $_POST['horario-DOMINGO-A'];
                  $day_E = $_POST['horario-DOMINGO-E'];
                  $status = $_POST['status1'];
               }
               elseif($i == 2){
                $day_A = $_POST['horario-SEGUNDA-A'];
                $day_E = $_POST['horario-SEGUNDA-E'];
                $status = $_POST['status2'];
               }
               elseif($i == 3){
                $day_A = $_POST['horario-TERCA-A'];
                $day_E = $_POST['horario-TERCA-E'];
                $status = $_POST['status3'];
               }
               elseif($i == 4){
                $day_A = $_POST['horario-QUARTA-A'];
                $day_E = $_POST['horario-QUARTA-E'];
                $status = $_POST['status4'];
               }
               elseif($i == 5){
                $day_A = $_POST['horario-QUINTA-A'];
                $day_E = $_POST['horario-QUINTA-E'];
                $status = $_POST['status5'];
               }
               elseif($i == 6){
                $day_A = $_POST['horario-SEXTA-A'];
                $day_E = $_POST['horario-SEXTA-E'];
                $status = $_POST['status6'];
               }
               elseif($i == 7){
                $day_A = $_POST['horario-SABADO-A'];
                $day_E = $_POST['horario-SABADO-E'];
                $status = $_POST['status7'];
               }
               $fkCred = $lastID;
               $stmt = $conn->prepare("INSERT INTO ExpedienteAcademia 
               VALUES( '$fkCred','$i','$status','$day_A','$day_E' );");
               $stmt->execute();
  

            } 
            
        } else {
            function_alert("As senhas não coincidem!");
        }

    }
    if($stmt){
        function_alert("Cadastro concluido");
    }
    else{
        function_alert("Cadastro não finalizado"); 
    }
}
else{
    function_alert('E-mail ou CNPJ JÁ CADASTRADOS, POR GENTILEZA, CADASTRE NOVAMENTE OU ENTRE EM CONTATO COM O SUPORTE');
}
}



?>

<style>
    .border-2 {
        background-color: #D9D9D9 !important;
    }
</style>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GymFlash - Cadastro Academia</title>
    <style>
        <?= include_once("assets/css/reset.css") ?>
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        <?= include_once("assets/css/style.css") ?>
    </style>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=League+Gothic&family=Pathway+Gothic+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body class="p-0">
    <div class="container-fluid">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom align-items-center">
            <a href="index.php"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img src="logo.png" alt="Logo site">
                <h1 class="mx-2 align-center ff-sp">G<span class="text-danger ls-1 ff-sp">y</span>mFlash</h1>
            </a>
            <form class="col-12 w-50 mb-3 mb-lg-0 me-lg-3 d-flex align-items-center src-bar" role="search"
                autocomplete="off">
                <label for="Pesquisa" class="src-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M14.9521 14.5633L22.0432 22.4344M17.122 9.06101C17.122 13.513 13.513 17.122 9.06101 17.122C4.60904 17.122 1 13.513 1 9.06101C1 4.60904 4.60904 1 9.06101 1C13.513 1 17.122 4.60904 17.122 9.06101Z"
                            stroke="none" stroke-width="2" stroke-linecap="square" stroke-linejoin="square" />
                    </svg>
                </label>
                <input type="search" class="form-control form-control-dark bg-transparent border-none"
                    placeholder="Pesquisa..." aria-label="Search" id="Pesquisa">
            </form>
            <ul class="nav nav-pills nav-justified align-items-center">
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark-emphasis link-hover mx-1 text-uppercase">Academias</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark-emphasis link-hover mx-1 text-uppercase">Contato</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark-emphasis link-hover mx-1 text-uppercase">Sobre</a>
                </li>
                <li class="nav-item">
                    <button type="button"
                        class="btn nav-link text-dark-emphasis link-hover border mx-1 text-uppercase logcad"
                        data-bs-toggle="modal" data-bs-target="#menu">
                        Login/Cadastro
                    </button>
                </li>
            </ul>
        </header>
    </div>
    <div class="container">
        <h1 class="text-dark-emphasis text-center fw-bold my-4">Cadastro de Academia</h1>
        <form method="post" class="d-flex flex-column" autocomplete="off">
            <div class="row my-2">
                <div class="col form-floating">
                    <input class="border-2 bg-transparent form-control form-control-lg" type="text" name="nameRep"
                        id="nameRep" placeholder="Nome do Representante" required>
                    <label class="text-dark-emphasis ml-3" for="nameRep">Nome do Representante:</label>
                </div>
                <div class="col form-floating ml-5">
                    <input class="border-2 bg-transparent form-control form-control-lg" type="text" name="nameAcad"
                        id="nameAcad" placeholder="Nome da Academia" required>
                    <label class="text-dark-emphasis ml-3" for="nameAcad">Nome da Academia:</label>
                </div>
            </div>
            <div class="row my-2">
                <div class="col form-floating">
                    <input class="border-2 bg-transparent form-control form-control-lg " type="password" name="senha"
                        id="senha" minlength="8" maxlength="32" placeholder="Senha" required>
                    <label class="text-dark-emphasis ml-3" for="senha">Senha:</label>
                </div>
                <div class="col form-floating ml-5">
                    <input class="border-2 bg-transparent form-control form-control-lg " type="password" name="csenha"
                        id="csenha" minlength="8" maxlength="32" placeholder="Confirme a Senha" required>
                    <label class="text-dark-emphasis ml-3" for="csenha">Confirme a Senha:</label>
                </div>
            </div>
            <div class="row my-2">
                <div class="col form-floating">
                    <input class="border-2 bg-transparent form-control form-control-lg " maxlength="18" type="text"
                        id="cnpj" name="cnpj" oninput="formatarCNPJ()" placeholder="CNPJ" required>
                    <label class="text-dark-emphasis ml-3" for="cnpj">CNPJ:</label>
                </div>
                <fieldset class="col ml-5">
                    <legend class="mb-3">Modalidades:</legend>
                    <div class="d-flex align-items-center my-auto flex-wrap">
                        <div>
                            <input type="checkbox" name="check-muaythai" id="muait">
                            <label for="muait" class="mr-3 ml-2">Muay Thai</label>
                        </div>
                        <div>
                            <input type="checkbox" name="check-boxe" id="boxe">
                            <label for="boxe" class="mr-3 ml-2">Boxe</label>
                        </div>
                        <div>
                            <input type="checkbox" name="chek-danca" id="danca">
                            <label for="danca" class="mr-3 ml-2">Dança</label>
                        </div>
                        <div>
                            <input type="checkbox" name="check-spinning" id="spinning">
                            <label for="spinning" class="mr-3 ml-2">Spinning</label>
                        </div>
                        <div>
                            <input type="checkbox" name="check-judo" id="judo">
                            <label for="judo" class="mr-3 ml-2">Judô</label>
                        </div>
                        <div>
                            <input type="checkbox" name="check-taekwendo" id="taekwendo">
                            <label for="taekwendo" class="mr-3 ml-2">Taekwendô</label>
                        </div>
                        <div>
                            <input type="checkbox" name="check-jump" id="jump">
                            <label for="jump" class="mr-3 ml-2">Jump</label>
                        </div>
                        <div>
                            <input type="checkbox" name="check-crossfit" id="crossfit">
                            <label for="crossfit">Crossfit</label>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="row my-2">
                <div class="col form-floating">
                    <input class="border-2 bg-transparent form-control form-control-lg " type="email" name="email"
                        id="email" placeholder="Email" required>
                    <label class="text-start text-dark-emphasis ml-3" for="email">Email:</label>
                </div>
                
            </div>
            <div class="row my-2 w-50 align-self-center">
                <div class="col">
                   
                    <div class="row form-floating my-2">
                        <input type="number" class="border-2 bg-transparent form-control form-control-lg "
                            name="numFunc" placeholder="Quantidade de Funcionários" id="numFunc">
                        <label class="text-dark-emphasis" for="numFunc">Qnt. funcionários:</label>
                    </div>
                    
                    <div class="row form-floating my-2">
                        <input class="border-2 bg-transparent form-control form-control-lg " maxlength="11" type="text"
                            name="tel" id="tel" oninput="formTel()" placeholder="Telefone" required>
                        <label class="text-dark-emphasis" for="tel">Telefone:</label>
                    </div>
                    <div class="row form-floating my-2">
                    <table border="20"><!-- HORÁRIOS-->
         <tr>
               <td>Dias da Semana</td>
               <td>STATUS</td>
               <td>Horário de abertura</td>
               <td>Horário de encerramento</td>
         </tr>
         <!--DOMINGO HORÁRIO-->
         <tr>
            <td>DOMINGO</td>
            <td> 
               <select class="bg-cad border-0 form-select p-3 fs-5 w-75" name="status1" id="func">
                  <OPtion></OPtion>
                  <option value="aberto" >ABERTO</option>
                  <option value="fechado">FECHADO</option>
               </select>
            </td>
            <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-DOMINGO-A" id="horario" required></td>
            <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-DOMINGO-E" id="horario" required></td>
         </tr>
         <!--SEGUNDA FEIRA HORÁRIO-->
         <tr>
            <td>SEGUNDA</td>
            <td> 
               <select class="bg-cad border-0 form-select p-3 fs-5 w-75" name="status2" id="func">
                  <OPtion></OPtion>
                  <option value="aberto">ABERTO</option>
                  <option value="fechado">FECHADO</option>
               </select>
            </td>
            <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-SEGUNDA-A" id="horario" required></td>
            <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-SEGUNDA-E" id="horario" required></td>
         </tr>
         <!--TERÇA FEIRA HORÁRIO-->
         <tr>
            <td>TERÇA</td>
            <td> 
               <select class="bg-cad border-0 form-select p-3 fs-5 w-75" name="status3" id="func">
                  <OPtion></OPtion>
                  <option value="aberto">ABERTO</option>
                  <option value="fechado">FECHADO</option>
               </select>
            </td>
            <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-TERCA-A" id="horario" required></td>
            <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-TERCA-E" id="horario" required></td>
         </tr>
         <!--QUARTA FEIRA HORÁRIO-->
         <tr>
            <td>QUARTA</td>
            <td> 
               <select class="bg-cad border-0 form-select p-3 fs-5 w-75" name="status4" id="func">
                  <OPtion></OPtion>
                  <option value="aberto">ABERTO</option>
                  <option value="fechado">FECHADO</option>
               </select>
            </td>
            <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-QUARTA-A" id="horario" required></td>
            <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-QUARTA-E" id="horario" required></td>
         </tr>
         <!--QUINTA FEIRA HORÁRIO-->
         <tr>
            <td>QUINTA</td>
            <td> 
               <select class="bg-cad border-0 form-select p-3 fs-5 w-75" name="status5" id="func">
                  <OPtion></OPtion>
                  <option value="aberto">ABERTO</option>
                  <option value="fechado">FECHADO</option>
               </select>
            </td>
            <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-QUINTA-A" id="horario" required></td>
            <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-QUINTA-E" id="horario" required></td>
         </tr>
         <!--SEXTA FEIRA HORÁRIO-->
         <tr>
            <td>SEXTA</td>
            <td> 
               <select class="bg-cad border-0 form-select p-3 fs-5 w-75" name="status6" id="func">
                  <OPtion></OPtion>
                  <option value="aberto">ABERTO</option>
                  <option value="fechado">FECHADO</option>
               </select>
            </td>
            <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-SEXTA-A" id="horario" required></td>
            <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-SEXTA-E" id="horario" required></td>
         </tr>
         <!--SÁBADO FEIRA HORÁRIO-->
         <tr>
            <td>SÁBADO</td>
            <td> 
               <select class="bg-cad border-0 form-select p-3 fs-5 w-75" name="status7" id="func">
                  <OPtion></OPtion>
                  <option value="aberto">ABERTO</option>
                  <option value="fechado">FECHADO</option>
               </select>
            </td>
            <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-SABADO-A" id="horario" required></td>
            <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-SABADO-E" id="horario" required></td>
         </tr>
         
      </table>
                    </div>
                    <div class="row my-2">
                        <label class="text-start text-dark-emphasis ">Selecione uma Imagem:</label> <br>
                        <input class="form-control form-control-lg" type="file" name="img" accept=".png, .jpg, .jpeg"
                            id="formFile" placeholder="Escolha">
                    </div>
                    <div class="row my-4 form-floating">
                        <textarea name="coment" id="coment" placeholder="Deixe um Comentario"
                            class="border-2 bg-transparent form-control" style="height: 100px"></textarea>
                        <label class="text-start text-dark-emphasis" for="coment">Comentários:</label>
                    </div>
                </div>
            </div>
            <div class="row my-2">
                <h1 class="text-dark-emphasis text-center fw-bold my-4">Digite a localização da(s) academia(s)</h1>
                <div class="d-flex flex-column align-items-center">
                    <div class="row my-2 w-50 form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " maxlength="9" type="text"
                            name="ceploc" id="ceploc" oninput="formatarCEPloc()" placeholder="CEP" required>
                        <label class="text-start text-dark-emphasis " for="ceploc">CEP:</label>
                    </div>
                    <div class="row my-2 w-50 form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="state"
                            id="state" placeholder="Estado" required readonly>
                        <label class="text-start text-dark-emphasis " for="state">Estado:</label>
                    </div>
                    <div class="row my-2 w-50 form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="city"
                            id="city" placeholder="Cidade" required readonly>
                        <label class="text-start text-dark-emphasis " for="city">Cidade:</label>
                    </div>
                    <div class="row my-2 w-50 form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="rua"
                            id="rua" placeholder="Rua" required readonly>
                        <label class="text-start text-dark-emphasis " for="rua">Rua:</label>
                    </div>
                    <div class="row my-2 w-50">
                        <div class="col-auto w-75 p-0 form-floating">
                            <input class="border-2 bg-transparent form-control form-control-lg " type="text"
                                name="bairro" id="bairro" placeholder="Bairro" required readonly>
                            <label class="text-start text-dark-emphasis " for="ceploc">Bairro:</label>
                        </div>
                        <div class="col-auto w-25 pr-0 form-floating">
                            <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="num"
                                id="num" placeholder="Número" required>
                            <label class="text-start text-dark-emphasis ml-3" for="num">Número:</label>
                        </div>
                    </div>
                    <input
                        class="btn nav-link text-dark-emphasis link-hover border-black mx-1 text-uppercase logcard px-5 py-3 my-5"
                        name="inserir" type="submit" onclick="alertCad('Concluido','Cadastro concluido!')"
                        value="Enviar">
                </div>
            </div>
        </form>
    </div>
    <div class="container-fluid bg-black">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 mt-5 px-3 border-top">
            <div class="col mb-3 d-flex flex-column align-items-start">
                <a href="index.php"
                    class="d-flex align-items-center mb-3 mb-md-0 link-body-emphasis text-decoration-none">
                    <img src="logo.png" alt="Logo site">
                    <h1 class="mx-2 align-center ff-sp">G<span class="text-danger ls-1 ff-sp">y</span>mFlash
                    </h1>
                </a>
                <div class="d-flex align-items-center my-2">
                    <a href="#" class="mr-2"><img src="assets/img/social-icon/instagram.png" alt=""></a>
                    <a href="#" class="mx-2"><img src="assets/img/social-icon/facebook.png" alt=""></a>
                    <a href="#" class="mx-2"><img src="assets/img/social-icon/youtube.png" alt=""></a>
                </div>
                <div class="mb-2">
                    <a href="" class="text-uppercase text-decoration-none text-white fw-bold">Privacidade</a>
                    <a href="" class="text-uppercase text-decoration-none text-white fw-bold">Termos</a>
                </div>
                <p class="text-custom text-center">© 2023 GymFlash US, LLC</p>
            </div>

            <div class="col mb-3">
            </div>

            <div class="col mb-3">
            </div>

            <div class="col mb-3">
                <h5 class="text-white">Nosso Serviço</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#"
                            class="nav-link link-hover fw-light p-0 text-white">Academias</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link link-hover fw-light p-0 text-white">Objetivo</a>
                    </li>
                </ul>
            </div>

            <div class="col mb-3">
                <h5 class="text-white">Quem Somos</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link link-hover fw-light p-0 text-white">Contato</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link link-hover fw-light p-0 text-white">Ajuda</a>
                    </li>
                </ul>
            </div>
        </footer>
    </div>
    <div class="modal fade scale" id="menu" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close fw-bold" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="rounded-4 col mx-2 bg-transparent">
                            <h3 class="text-black text-center my-2 fs-4">
                                Cadastro da Academia
                            </h3>
                            <a href="cadacad.php"
                                class="card text-decoration-none rounded-4 text-center border-3  border-black">
                                <div class="card-img-top ">
                                    <img class="py-3 px-3" src="assets/img/logcad/acadcad.svg" alt="" width="100%">
                                </div>
                                <p class="card-text my-3 fs-5">
                                    Clique aqui para realizar o cadastro
                                </p>
                            </a>
                            <p class="text-center text-black pt-3 fs-6">
                                Recomendado para
                                pessoas jurídicas
                            </p>
                        </div>
                        <div class="rounded-4 col mx-2 bg-transparent">
                            <h3 class="text-black text-center my-2 fs-4">
                                Cadastro de Usuário
                            </h3>
                            <a data-bs-toggle="modal" data-bs-target="#cadUser"
                                class="card rounded-4 text-center border-3 border-black btn p-0">
                                <div class="card-img-top">
                                    <img class="py-3 px-3" src="assets/img/logcad/usercad.svg" alt="" width="100%">
                                </div>
                                <p class="card-text my-3 fs-5">
                                    Clique aqui para realizar o cadastro
                                </p>
                            </a>
                            <p class="text-center text-black pt-3 fs-6">
                                Recomendado para
                                pessoas físicas
                            </p>
                        </div>
                    </div>
                </div>
                <div class="d-flex py-2 pb-4 bg-transparent align-items-center justify-content-center">
                    <button type="button"
                        class="btn nav-link text-dark link-hover border-black mx-1 text-uppercase logcard px-5 py-3"
                        data-bs-toggle="modal" data-bs-target="#login">
                        Login
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cadUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-4 border-bottom-1">
                    <h1 class="fw-bold mb-0 fs-2">Cadastro</h1>
                    <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#menu"
                        aria-label="Return"></button>
                </div>
                <div class="modal-body px-lg-3 py-lg-4">
                    <div class="form-signin m-auto bg-transparent px-3 justify-content-center">
                        <form class="d-flex flex-column py-3">
                            <div class="d-flex my-1">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingNome" placeholder="Nome">
                                    <label for="floatingNome">Usuário</label>
                                </div>
                                <div class="form-floating ml-2">
                                    <input type="text" class="form-control" id="floatingTel" placeholder="Tel">
                                    <label for="floatingTel">Telefone</label>
                                </div>
                            </div>
                            <div class="form-floating">
                                <input type="email" class="form-control" id="floatingEmail" placeholder="Email">
                                <label for="floatingEmail">Email</label>
                            </div>
                            <div class="form-floating my-1">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Senha">
                                <label for="floatingPassword">Senha</label>
                            </div>
                            <div class="form-floating my-1 mb-2">
                                <input type="password" class="form-control" id="floatingCPassword" placeholder="CSenha">
                                <label for="floatingCPassword">Confirme a senha</label>
                            </div>
                            <input
                                class="w-50 btn nav-link text-dark link-hover border mx-1 text-uppercase logcad py-3 align-self-center"
                                name="login" type="submit" value="Cadastrar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-4 border-bottom-1">
                    <h1 class="fw-bold mb-0 fs-2">Login</h1>
                    <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#menu"
                        aria-label="Return"></button>
                </div>
                <div class="modal-body px-lg-3 py-lg-4">
                    <div class="form-signin m-auto bg-transparent px-3 justify-content-center">
                        <form class="d-flex flex-column py-3">
                            <div class="d-flex my-1">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingNome" placeholder="Nome">
                                    <label for="floatingNome">Usuário</label>
                                </div>
                            </div>
                            <div class="form-floating my-1 mb-2">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Senha">
                                <label for="floatingPassword">Senha</label>
                            </div>
                            <input
                                class="w-50 btn nav-link text-dark link-hover border mx-1 text-uppercase logcad py-3 align-self-center"
                                name="login" type="submit" value="Cadastrar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script>
        <?php include_once("assets/js/main.js") ?>
    </script>
    <script>
        <?php include_once("assets/js/cep.js") ?>
    </script>
</body>

</html>