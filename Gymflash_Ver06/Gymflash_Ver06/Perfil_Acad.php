<?php
include_once 'assets/php/databaseconnect.php';
if(!isset($_SESSION)) {
    session_start();
}
if(!isset($_SESSION['Credencial_academia'])   ) {
    die("Você não pode acessar esta página porque não está logado. <p><a href=\"./index.php\">RETORNAR</a></p>");
}

include_once('assets/php/ALTERACAO.php');


if(isset($_POST['desconectar']))
{
        session_destroy();
        die("Você foi deslogado com sucesso.<a href=\"./index.php\">RETORNAR</a>");
}
//CONEÇÃO CADASTRO
$busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
$busca_acad->bindParam(':credencial', $_SESSION['Credencial_academia']);
$busca_acad->execute();
//CONEÇÃO LOCALIZAÇÃO
$busca_loc = $conn->prepare("SELECT * FROM EnderecoAcademia WHERE FK_Credencial_academia = :credencial");
$busca_loc->bindParam(':credencial', $_SESSION['Credencial_academia']);
$busca_loc->execute();
//CONEÇÃO HORÁRIO
$busca_Hora = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial");
$busca_Hora->bindParam(':credencial', $_SESSION['Credencial_academia']);
$busca_Hora->execute();
//CONEÇÃO MODALIDADE
$busca_mod = $conn->prepare("SELECT * FROM ModalidadeAcademia WHERE FK_Credencial_academia = :credencial");
$busca_mod->bindParam(':credencial', $_SESSION['Credencial_academia']);
$busca_mod->execute();

if(isset($_GET['login'])){
    header('location: cadacad.php');
}

?>
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
<?php
while ($dados = $busca_acad ->fetch(PDO::FETCH_ASSOC) AND $dados2 =  $busca_loc ->fetch(PDO::FETCH_ASSOC)) {
    
    echo $dados['Credencial_academia'];

?>
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
<!--NOME DO REPRESENTANTE-->     
                <div class="col form-floating">
                    <input class="border-2 bg-transparent form-control form-control-lg" type="text" name="nameRep"
                        id="nameRep" placeholder="Nome do Representante" >
               
                    <label >NOME ATUAL:  <?php echo $dados['Nome_do_representate'];?></label>
                    <input type="submit" value="Alterar nome do representante" name='representante'>
                </div>
<!--NOME DA ACADEMIA--> 
                <div class="col form-floating ml-5">
                    <input class="border-2 bg-transparent form-control form-control-lg" type="text" name="nameAcad"
                        id="nameAcad" placeholder="Nome da Academia" >
                        <label >NOME ATUAL:  <?php echo $dados['Nome_da_academia'];?></label>
                    <input type="submit" value="Alterar nome do academia" name='academia'>
                </div>
            </div>
<!--SENHA DA ACADEMIA-->
            <div class="row my-2">
                <div class="col form-floating">
                    <input class="border-2 bg-transparent form-control form-control-lg " type="password" name="senha_acad"
                        id="senha" minlength="8" maxlength="32" placeholder="Senha" >
                        <label >SENHA ATUAL:  <?php echo $dados['Senha_academia'];?></label>
                    <input type="submit" value="Alterar senha" name='senha'>
                </div>
<!--CNPJ DA ACADEMIA-->
                <div class="col form-floating ml-5">
                </div>
            </div>
            <div class="row my-2">
                <div class="col form-floating">
                    <input class="border-2 bg-transparent form-control form-control-lg " maxlength="18" type="text"
                        id="cnpj" name="cnpj" oninput="formatarCNPJ()" placeholder="CNPJ" >
                        <label >CNPJ ATUAL:  <?php echo $dados['CNPJ_academia'];?></label>
                    <input type="submit" value="Alterar cnpj" name='cnpj_submit'>
                </div>
<!--MODALIDADES DA ACADEMIA-->
                <div class="row my-2">
                <div class="col form-floating"></div>
                <fieldset class="col ml-5">
                    <legend class="mb-3">Modalidades Deletar:</legend>
                    <select class="bg-cad border-0 form-select p-3 fs-5 w-75" name="selct_mod" id="func">
                <?php
                     while( $dados4 =  $busca_mod ->fetch(PDO::FETCH_ASSOC))
                        {                         
                         $modalidae_atual = $dados4['id_modaldiade'];
                         
                         if($modalidae_atual == 1){
                            $id_modalidade = 1;
                        ?>
                        <option value="1">Muay Thai</option>
                        <?php 
                        }
                        if($modalidae_atual == 2){
                            $id_modalidade = 2;
                            ?>
                            <option value="2">BOXE</option><?php                         
                        }
                        if($modalidae_atual == 3){
                            $id_modalidade = 3;
                            ?>
                            <option value="3">Dança</option><?php }
                        if($modalidae_atual == 4){
                        $id_modalidade = 4;
                        ?>
                        <option value="4>">Spinning</option><?php }
                        if($modalidae_atual == 5){
                            $id_modalidade = 5;
                            ?>
                            <option value="5">Judô</option><?php }
                        if($modalidae_atual == 6){
                            $id_modalidade = 6;
                            ?>
                            <option value="6">Jump</option><?php }
                        if($modalidae_atual == 7){
                            $id_modalidade = 7;
                            ?>
                            <option value="7">Crossfit</option><?php}
                        if($modalidae_atual == 8){
                            $id_modalidade = 8;
                            ?>
                            <option value="8">Taekwendô</option>
                    
                    <?php } }  ?>
                </select>
                    </div>
                    <input type="submit" name="delet_mod" value="Deletar modalidade">
                </fieldset>
            </div>
<!--ADICIONAR DA ACADEMIA-->
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
                    <input type="submit" name="add_mod" value="Adicionar">
                </fieldset>
            </div>
           

         
<!--EMAIL DA ACADEMIA-->
            <div class="row my-2">
                <div class="col form-floating">
                    <input class="border-2 bg-transparent form-control form-control-lg " type="email" name="email_acad"
                        id="email" placeholder="Email" >
                        <label >EMAIL ATUAL:  <?php echo $dados['Email_academia'];?></label>
                    <input type="submit" value="ALTERAR EMAIL" name='email'>
                </div>
            </div>
<!--FUNCIONÁRIOS DA ACADEMIA-->
            <div class="row my-2 w-50 align-self-center">
                <div class="col">
                    <div class="row form-floating my-2">
                        <input type="number" class="border-2 bg-transparent form-control form-control-lg "
                            name="numFunc" placeholder="Quantidade de Funcionários" id="numFunc">
                            <label >FUNCIONÁRIOS ATUAIS:  <?php echo $dados['Quant_funcionario'];?></label>
                    <input type="submit" value="Alterar quantidade de funcionários" name='funcionarios'>
                    </div>
<!--TELEFONE DA ACADEMIA-->
                    <div class="row form-floating my-2">
                        <input class="border-2 bg-transparent form-control form-control-lg " maxlength="15" type="text"
                            name="tel" id="tel" oninput="formTel()" placeholder="Telefone" >
                            <label >TELEFONE ATUAL:  <?php echo $dados['Telefone_academia'];?></label>
                    <input type="submit" value="Alterar telefone" name='telefone'>
                    </div>
                    <div class="row form-floating my-2">
                    <table border="20">
<!-- HORÁRIOS-->
 <table>
    <tr>
            <td><table border="5">
         <tr>
               <td>Dias da Semana</td>
               <td>STATUS</td>
               <td>Horário de abertura</td>
               <td>Horário de encerramento</td>
         </tr>
         <?php
        while( $dados3 =  $busca_Hora ->fetch(PDO::FETCH_ASSOC))
            {   
                $diaS =$dados3['Dia_semana'];
                 ?>

                 <tr>
                    <td><?php 
                        if($diaS == 1){?>
                        DOMINGO
                        <?php }
                        if($diaS == 2){?>
                        SEGUNDA
                        <?php }
                        if($diaS == 3){?>
                        TERÇA
                        <?php }
                        if($diaS == 4){?>
                        QUARTA
                        <?php }
                        if($diaS == 5){?>
                        QUINTA<?php }
                        if($diaS == 6){?>
                        SEXTA
                        <?php }
                        if($diaS == 7){?>
                        SÁBADO
                        <?php }?>
                    </td>
                    <td><?php echo $dados3['estatus'] ;?></td>
                    <td><?php echo $dados3['Hora_abertura_academia'] ;?></td>
                    <td><?php echo $dados3['Hora_fechamento_academia'] ;?></td>
                 </tr>
                 
                
                    
                   
                <?php
            }
            ?>
         </table></td>
         <td>
         <td><table border="20">
    <!-- HORÁRIOS-->
       
       <tr>
             <td>Dias da Semana</td>
             <td>STATUSa</td>
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
          <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-DOMINGO-A" id="horario" ></td>
          <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-DOMINGO-E" id="horario" ></td>
          <td><input type="submit" name="alter-day1" value="Confirmar dia"></td>
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
          <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-SEGUNDA-A" id="horario" ></td>
          <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-SEGUNDA-E" id="horario" ></td>
          <td><input type="submit" name="alter-day2" value="Confirmar dia"></td>
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
          <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-TERCA-A" id="horario" ></td>
          <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-TERCA-E" id="horario" ></td>
          <td><input type="submit" name="alter-day3" value="Confirmar dia"></td>
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
          <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-QUARTA-A" id="horario" ></td>
          <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-QUARTA-E" id="horario" ></td>
          <td><input type="submit" name="alter-day4" value="Confirmar dia"></td>
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
          <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-QUINTA-A" id="horario" ></td>
          <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-QUINTA-E" id="horario" ></td>
          <td><input type="submit" name="alter-day5" value="Confirmar dia"></td>
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
          <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-SEXTA-A" id="horario" ></td>
          <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-SEXTA-E" id="horario" ></td>
          <td><input type="submit" name="alter-day6" value="Confirmar dia"></td><br>
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
          <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-SABADO-A" id="horario" ></td>
          <td><input class="bg-cad border-0 form-control p-3 fs-5" type="time" name="horario-SABADO-E" id="horario" ></td>
          <td><input type="submit" name="alter-day7" value="Confirmar dia"></td>
         </tr>
       

          </td>
         </tr>
       </table>
    </tr>
 </table>
<!--SELEÇÃO DE IMAGENS-->
                    </div>
                    <div class="row my-2">
                        <label class="text-start text-dark-emphasis ">Selecione uma Imagem:</label> <br>
                        <input class="form-control form-control-lg" type="file" name="img" accept=".png, .jpg, .jpeg"
                            id="formFile" placeholder="Escolha">
                    </div>
<!--COMENTÁRIOS-->
                    <div class="row my-4 form-floating">
                        <textarea name="coment" id="coment" placeholder="Deixe um Comentario"
                            class="border-2 bg-transparent form-control" style="height: 100px" name></textarea>
                        <label >COMENTÁRIOS:  <?php echo $dados['Comentario'];?></label>
                       <input type="submit" value="Alterar Comentario" name='comentarios'>
                    </div>
                </div>

            </div>
<!--LOCALIZAÇÃO DA ACADEMIA-->
            <div class="row my-2">
                <h1 class="text-dark-emphasis text-center fw-bold my-4">Digite a localização da(s) academia(s)</h1>
                <div class="d-flex flex-column align-items-center">
                    <div class="row my-2 w-50 form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " maxlength="9" type="text"
                            name="ceploc" id="ceploc" oninput="formatarCEPloc()" placeholder="CEP" >
                        <label >CEP:  <?php echo $dados2['CEP_academia'];?></label>
                        <input type="submit" value="Alterar Comentario" name='endereco'>
                    </div>
                    <div class="row my-2 w-50 form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="state"
                            id="state" placeholder="Estado"  readonly>
                            <label >ESTADO:  <?php echo $dados2['Estado_academia'];?></label>
                    </div>
                    <div class="row my-2 w-50 form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="city"
                            id="city" placeholder="Cidade"  readonly>
                            <label >CIDADE:  <?php echo $dados2['Cidade_academia'];?></label>
                    </div>
                    <div class="row my-2 w-50 form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="rua"
                            id="rua" placeholder="Rua"  readonly>
                            <label >RUA:  <?php echo $dados2['Rua_academia'];?></label>
                    </div>
                    <div class="row my-2 w-50">
                        <div class="col-auto w-75 p-0 form-floating">
                            <input class="border-2 bg-transparent form-control form-control-lg " type="text"
                                name="bairro" id="bairro" placeholder="Bairro"  readonly>
                                <label >BAIRRO:  <?php echo $dados2['Bairro_academia'];?></label>
                        </div>
                        <div class="col-auto w-25 pr-0 form-floating">
                            <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="num"
                                id="num" placeholder="Número" >
                                <label >NMR:  <?php echo $dados2['Num_academia'];?></label>
                        </div>
                    </div>
                    <input
                        class="btn nav-link text-dark-emphasis link-hover border-black mx-1 text-uppercase logcard px-5 py-3 my-5"
                        name="inserir" type="submit" onclick="alertCad('Concluido','Cadastro concluido!')"
                        value="Enviar">
                </div>
            </div>
          
        </form>
        <form action="" method="post">
        <input type="submit" value="desconectar" name="desconectar">

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
    <?php }?>
</body>

</html>