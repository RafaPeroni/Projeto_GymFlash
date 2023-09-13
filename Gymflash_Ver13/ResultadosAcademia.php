<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include_once 'assets/php/databaseconnect.php';

if(!isset($_SESSION['Credencial_academia']) && !isset($_SESSION['Credencial_usuario']) ) {
    die("Você não possue login para acessar essa página. FAÇA SEU LOGIN OU CRIE UMA CONTA<p><a href=\"./index.php\">RETORNAR</a></p>");
    exit;
}
if($_SESSION['Credencial_academia']){
    $persona =$_SESSION['Credencial_academia'];
}else if ($_SESSION['Credencial_usuario']){
    $persona =$_SESSION['Credencial_usuario'];
}

$credt = $_GET['cred'];
$cred = $_GET['cred'];
echo $cred;

$busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
$busca_acad->bindParam(':credencial', $cred );
$busca_acad->execute();
//CONEÇÃO LOCALIZAÇÃO
$busca_loc = $conn->prepare("SELECT * FROM EnderecoAcademia WHERE FK_Credencial_academia = :credencial");
$busca_loc->bindParam(':credencial', $cred);
$busca_loc->execute();
//CONEÇÃO HORÁRIO
$busca_Hora = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial");
$busca_Hora->bindParam(':credencial', $cred);
$busca_Hora->execute();
//CONEÇÃO MODALIDADE
$busca_mod = $conn->prepare("SELECT * FROM ModalidadeAcademia WHERE FK_Credencial_academia = :credencial");
$busca_mod->bindParam(':credencial', $cred);
$busca_mod->execute();

if(isset($_POST['cadastraEstrela'])){
    if(!empty($_POST['rating'])){

    $quantidade = (int)$_POST['rating'];
    $stmt = $conn->prepare("INSERT INTO Avaliacao
                VALUES( default,'$quantidade','$cred', '$persona' );");
                    $stmt->execute();
}


}




   




?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
        <?php include_once 'assets/css/style.css' ?>
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" >
    <style>
        <?php include_once 'assets/css/style.css' ?>
    </style>
    <link
        href="https://fonts.googleapis.com/css2?family=League+Gothic&family=Pathway+Gothic+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>
<body>
    
<form action="" method="post">
<div class="estrelas">
                                            <input type="radio" id="vazio" name="rating" value="" checked>
                                            
                                            <label for="star1"><i class="fa"></i></label>
                                            <input type="radio" id="star1" name="rating" value="1" >

                                            <label for="star2"><i class="fa"></i></label>
                                            <input type="radio" id="star2" name="rating" value="2" >

                                            <label for="star3"><i class="fa"></i></label>
                                            <input type="radio" id="star3" name="rating" value="3">

                                            <label for="star4"><i class="fa"></i></label>
                                            <input type="radio" id="star4" name="rating" value="4">

                                           <label for="star5"><i class="fa"></i></label>
                                           <input type="radio" id="star5" name="rating" value="5">
                                            <!-- Add more stars here if needed -->
                                            <input class="btn nav-link text-dark link-hover border-black 
                                             text-uppercase logcard px-5 py-3 mt-3" 
                                             type="submit"    name="cadastraEstrela">
                                        </div>
    
</form>

    <?php
    while ($dados = $busca_acad->fetch(PDO::FETCH_ASSOC) and $dados2 = $busca_loc->fetch(PDO::FETCH_ASSOC)) {

        echo $dados['Credencial_academia'];

        ?>
        <div class="container">
            <h1 class="text-dark text-center fw-bold my-4">Informações de Conta</h1>
            <form method="post" class="d-flex flex-column" autocomplete="off">
                <div class="row my-2">
                    <div class="col form-floating">
                        
                        <label class="text-dark ml-3" for="nameRep">Nome do
                            Representante:<?php echo $dados['Nome_do_representate']; ?></label>
                        
                    </div>
                    <div class="col form-floating ml-3" >
                        
                        <label class="text-dark ml-3" for="nameAcad">Nome da Academia: <?php echo $dados['Nome_da_academia']; ?></label>
                        
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col form-floating">
                        
                        <label class="text-dark ml-3" for="senha">Senha: <?php echo $dados['Senha_academia']; ?></label>
                       
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col form-floating">
                        
                        <label class="text-dark ml-3" for="cnpj">CNPJ: <?php echo $dados['CNPJ_academia']; ?></label>
                      
                    </div>
                    <div class="col form-floating">
                    <label class="text-start text-dark ml-3" for="selct_mod">Modalidades  :</label>
                            <?php
                            while ($dados4 = $busca_mod->fetch(PDO::FETCH_ASSOC)) {
                                $modalidae_atual = $dados4['id_modaldiade'];

                                if ($modalidae_atual == 1) {
                                    $id_modalidade = 1;
                                    ECHO "Muay Thai";
                                }
                                if ($modalidae_atual == 2) {
                                    $id_modalidade = 2;
                                    ECHO "BOXE";}
                                if ($modalidae_atual == 3) {
                                    $id_modalidade = 3;
                                    ECHO "Dança"; }
                                if ($modalidae_atual == 4) {
                                    $id_modalidade = 4;
                                    ECHO "Spinning"; }
                                if ($modalidae_atual == 5) {
                                    $id_modalidade = 5;
                                    ECHO "Judô"; }
                                if ($modalidae_atual == 6) {
                                    $id_modalidade = 6;
                                    ECHO "Jump"; }
                                if ($modalidae_atual == 7) {
                                    $id_modalidade = 7;
                                   
                                    ECHO "Crossfit"; }
                                if ($modalidae_atual == 8) {
                                    $id_modalidade = 8;
                                    ECHO "Taekwendô"; }
                            } ?>
                        
                        
                        
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col form-floating">
                       
                        <label class="text-start text-dark ml-3" for="email">Email: <?php echo $dados['Email_academia']; ?></label>
                        
                    </div>
                   
                    
                </div>
                <div class="row my-2 w-50 align-self-center">
                    <div class="col">
                        <div class="row form-floating my-2">
                        </div>
                        <div class="row form-floating my-2">
                             
                            <label class="text-dark" for="numFunc">Qnt. funcionários: <?php echo $dados['Quant_funcionario']; ?></label>
                            
                        </div>
                        <div class="row form-floating my-2">
                             
                            <label class="text-dark" for="tel">Telefone: <?php echo $dados['Telefone_academia']; ?></label>
                            
                        </div>
                        <div class="row my-2">
                             
                        </div>
                        <div class="row my-4 form-floating">
                             
                            <label class="text-start text-dark" for="coment">Comentários: <?php echo $dados['Comentario']; ?></label>
                            
                        </div>
                    </div>
                </div>
                <div class="row my-2">

                    <?php
                    $dados3 = $busca_Hora->fetch(PDO::FETCH_ASSOC)
                        ?>
                    <h1 class="text-dark text-center fw-bold my-4">Horários</h1>
                    <div class="row my-2 text-center">
                        <div class="col">
                            Dias da Semana
                        </div>
                        <div class="col">
                            Status
                        </div>
                        <div class="col">
                            Horário de Abertura
                        </div>
                        <div class="col">
                            Horário de Encerramento
                        </div>
                    </div>
                </div>
                <!-- Domingo-->                
                 <div class="row my-2 text-center align-items-center">  
                    <div class="col">
                        Domingo
                    </div>
                    <div class="col">
                        <select name="status1" id="func" class="form-select">
                            
                                <?php
                                $Bus_mod1 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 1");
                                $Bus_mod1->bindParam(':credencial', $_SESSION['Credencial_academia']);
                                $Bus_mod1->execute();
                                $mmod1 = $Bus_mod1->fetch(PDO::FETCH_ASSOC);
                                ?>
                            <option value="<?php echo $mmod1['estatus']; ?>"><?php echo $mmod1['estatus']; ?></option>
                            
                        </select>
                    </div>
                    <div class="col">
                    <label class="text-start text-dark" for="coment"> <?php echo $mmod1['Hora_abertura_academia']; ?></label>
                        
                    </div>
                    <div class="col">
                        <input type="TEXT" class="p-3 fs-5 form-control" name="horario-DOMINGO-E" id="horario"
                            value="<?php echo $mmod1['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3 w-25"
                            type="submit" name="alter-day1" value="Confirmar dia">
                    </div>
                 </div>
                <!-- Segunda-->
                 <div class="row my-2 text-center align-items-center"> 
                
                    <div class="col">
                        Segunda-Feira
                    </div>
                    <div class="col">
                        <select name="status2" id="func" class="form-select">
                             
                                <?php
                                 $Bus_mod2 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 2");
                                 $Bus_mod2->bindParam(':credencial', $_SESSION['Credencial_academia']);
                                 $Bus_mod2->execute();
                                 $mmod2 = $Bus_mod2->fetch(PDO::FETCH_ASSOC);
                                   ?>
                             
                             <option value="<?php  $mmod2['estatus'];?>"><?php echo $mmod2['estatus'];?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-SEGUNDA-A" id="horario"
                            value="<?php echo $mmod2['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-SEGUNDA-E" id="horario"
                            value="<?php echo $mmod2['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3 w-25"
                            type="submit" name="alter-day2" value="Confirmar dia">
                    </div>
                 </div>
                <!-- Terça-->
                 <div class="row my-2 text-center align-items-center"> 
                    <div class="col">
                        Terça-Feira
                    </div>
                    <div class="col">
                        <select name="status3" id="func" class="form-select">
                            <?php
                                 $Bus_mod3 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 3");
                                 $Bus_mod3->bindParam(':credencial', $_SESSION['Credencial_academia']);
                                 $Bus_mod3->execute();
                                 $mmod3 = $Bus_mod3->fetch(PDO::FETCH_ASSOC);
                                 ?>
                                 <option value="<?php  $mmod3['estatus']; ?>"><?php echo $mmod3['estatus']; ?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-TERCA-A" id="horario"
                            value="<?php echo $mmod3['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-TERCA-E" id="horario"
                            value="<?php echo $mmod3['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3 w-25"
                            type="submit" name="alter-day3" value="Confirmar dia">
                    </div>
                 </div>
                <!-- Quarta--> 
                 <div class="row my-2 text-center align-items-center"> 
                    <div class="col">
                        Quarta-Feira
                    </div>
                    <div class="col">
                        <select name="status4" id="func" class="form-select">
                        <?php
                                 $Bus_mod4 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 4");
                                 $Bus_mod4->bindParam(':credencial', $_SESSION['Credencial_academia']);
                                 $Bus_mod4->execute();
                                 $mmod4 = $Bus_mod4->fetch(PDO::FETCH_ASSOC);
                                 ?>
                                 <option value="<?php  $mmod4['estatus']; ?>"><?php echo $mmod4['estatus']; ?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-QUARTA-A" id="horario"
                            value="<?php echo $mmod4['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-QUARTA-E" id="horario"
                            value="<?php echo $mmod4['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3 w-25"
                            type="submit" name="alter-day4" value="Confirmar dia">
                    </div>
                 </div>
                <!-- Quinta-->
                 <div class="row my-2 text-center align-items-center"> <!-- Quinta-->
                    <div class="col">
                        Quinta-Feira
                    </div>
                    <div class="col">
                        <select name="status5" id="func" class="form-select">
                        <?php
                                 $Bus_mod5 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 5");
                                 $Bus_mod5->bindParam(':credencial', $_SESSION['Credencial_academia']);
                                 $Bus_mod5->execute();
                                 $mmod5 = $Bus_mod5->fetch(PDO::FETCH_ASSOC);
                                 ?>
                                 <option value="<?php  $mmod5['estatus']; ?>"><?php echo $mmod5['estatus']; ?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-QUINTA-A" id="horario"
                            value="<?php echo $mmod5['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-QUINTA-E" id="horario"
                            value="<?php echo $mmod5['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3 w-25"
                            type="submit" name="alter-day5" value="Confirmar dia">
                    </div>
                 </div>
                <!-- Sexta-->
                 <div class="row my-2 text-center align-items-center"> <!-- Sexta-->
                    <div class="col">
                        Sexta-Feira
                    </div>
                    <div class="col">
                        <select name="status6" id="func" class="form-select">
                        <?php
                                 $Bus_mod6 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 6");
                                 $Bus_mod6->bindParam(':credencial', $_SESSION['Credencial_academia']);
                                 $Bus_mod6->execute();
                                 $mmod6 = $Bus_mod6->fetch(PDO::FETCH_ASSOC);
                                 ?>
                                 <option value="<?php  $mmod6['estatus']; ?>"><?php echo $mmod6['estatus']; ?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-SEXTA-A" id="horario"
                            value="<?php echo $mmod6['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-SEXTA-E" id="horario"
                            value="<?php echo $mmod6['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">
                        <input
                            class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3 w-25"
                            type="submit" name="alter-day6" value="Confirmar dia">
                    </div>
                 </div>
                <!-- Sábado-->
                 <div class="row my-2 text-center align-items-center"> 
                    <div class="col">
                        Sábado
                    </div>
                    <div class="col">
                        <select name="status7" id="func" class="form-select">
                        <?php
                                 $Bus_mod7 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 7");
                                 $Bus_mod7->bindParam(':credencial', $_SESSION['Credencial_academia']);
                                 $Bus_mod7->execute();
                                 $mmod7 = $Bus_mod7->fetch(PDO::FETCH_ASSOC);
                                 ?>
                                 <option value="<?php  $mmod7['estatus']; ?>"><?php echo $mmod7['estatus']; ?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-SABADO-A" id="horario"
                            value="<?php echo $mmod7['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-SABADO-E" id="horario"
                            value="<?php echo $mmod7['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3 w-25"
                            type="submit" name="alter-day7" value="Confirmar dia">
                    </div>
                 </div>
      <!--LOCALIZAÇÃO DA ACADEMIA-->
      <div class="row my-2">
                <h1 class="text-dark text-center fw-bold my-4">Digite a localização da(s) academia(s)</h1>
                <div class="d-flex flex-column align-items-center">
                    <div class="row my-2 w-50 form-floating">
                        
                        <label >CEP:  <?php echo $dados2['CEP_academia'];?></label>
                        
                    </div>
                    <div class="row my-2 w-50 form-floating">
                        
                            <label >ESTADO:  <?php echo $dados2['Estado_academia'];?></label>
                    </div>
                    <div class="row my-2 w-50 form-floating">
                        
                            <label >CIDADE:  <?php echo $dados2['Cidade_academia'];?></label>
                    </div>
                    <div class="row my-2 w-50 form-floating">
                       
                            <label >RUA:  <?php echo $dados2['Rua_academia'];?></label>
                    </div>
                    <div class="row my-2 w-50">
                        <div class="col-auto w-75 p-0 form-floating">
                           
                                <label >BAIRRO:  <?php echo $dados2['Bairro_academia'];?></label>
                        </div>
                        <div class="col-auto w-25 pr-0 form-floating">
                            
                                <label >NMR:  <?php echo $dados2['Num_academia'];?></label>
                        </div>
                    </div>
                    <div class="col-auto w-25 pr-0 form-floating">
                            <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="complemento"
                                id="num" placeholder="Número" >
                                <label >Complemento:  <?php echo $dados2['Complemento_academia'];?></label>
                        </div>
                    </div>
                </div>
                <form action="" method="post" class="row">
                    <div class="col d-flex justify-content-center">
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3" type="submit" value="desconectar" name="desconectar">
                    </div>
                    <div class="col d-flex justify-content-center">
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3" type="submit" value="Excluir Academia" name="excluir">
                    </div>
                </form>
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
    <?php } ?>
</body>

</html>