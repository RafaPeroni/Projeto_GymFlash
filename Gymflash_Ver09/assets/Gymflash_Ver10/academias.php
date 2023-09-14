<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include_once 'assets/php/databaseconnect.php';
$count = 0;
$busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia ");
$busca_acad->execute();
if (isset($_GET['BTN-Search'])) {
    $name_search = (string) $_GET['txt-Search'];
    $name = $name_search;
    if (strlen($name_search) <= 0) {
        $NOME_VAZIO = "DIGITE ALGO PARA PESQUISAR";
    } else {
        $veri_acad = $conn->prepare("SELECT * FROM CadastroAcademia where Nome_da_academia like  ?");
        $veri_acad->bindValue(1, $name_search . '%');
        $veri_acad->execute();
        $count = $veri_acad->rowCount();
        
            include_once("SeletorCredencia.php");
        
        $name_search = null;

    }
}





if(isset($_GET['BTN-Search']) && isset($_POST['detalhe'])){
    $cred= $_POST['teste1'];
   
    header("Location: ResultadosAcademia.php?cred=$cred");
    exit;
}
//botão para voltar para PAGINA INICIAL
if (isset($_POST['voltar'])) {
   

    header("Location: /Gymflash_Ver04/index.php");
    exit;
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
        <?php include_once 'assets/css/reset.css' ?>
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        <?php include_once 'assets/css/style.css' ?>
    </style>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=League+Gothic&family=Pathway+Gothic+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="style.css" >
</head>

<body class="p-0">
    <?php include_once 'header.php' ?>
    <div class="">
        <div class="row w-100 m-0">
            <img src="assets/img/banners/banner_academias.png" alt="">
        </div>
        <div class="container">
            <h1 class="text-black text-center my-4 fw-bold">Dê uma olhada nas melhores perto de você</h1>
        </div>
        <div class="row container-fluid m-0">
            <form class="row" action="" method="GET">
                <div class="col-3">
                    <div class="input-group w-100">
                        <input type="submit" name="BTN-Search"
                            class="btn nav-link text-dark link-hover border px-2 fs-6 text-uppercase logcad"
                            id="buscar">
                        <input type="text" class="form-control rad" placeholder="" name="txt-Search"
                            aria-label="Example text with button addon" aria-describedby="buscar">
                        <?php if (isset($_GET['BTN-Search'])) { ?>
                            <p class="fs-6 my-2 text-black">
                                Número de Academias Encontradas:
                                <?php echo $count;
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <?php if (isset($veri_acad)) {
                                    while ($dados = $veri_acad->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <div class="card p-2 col-3 mx-2 mb-3 text-center"><!--Card das academias-->
                                        <h1 class="fs-4 text-dark">
                                            <?php echo $dados['Nome_da_academia'] ?> <!--Nome da Academia-->
                                        </h1>
                                        <div class="fs-6">
                                            <?php echo $dados['Nome_do_representate'] ?> <!--Nome do Responsável-->
                                        </div>
                                        <div class="display-none">
                                            <?php   $cred = $dados['Credencial_academia'];?><!--ID da Academia-->
                                            
                                        
                                        </div>
                                     </form>
                                        <div class="col d-flex justify-content-center">
                                        <form action="" method="post">
                                            <input class="btn nav-link text-dark link-hover border-black 
                                             text-uppercase logcard px-5 py-3 mt-3" 
                                             type="submit"   value=" detalhes " name="detalhe">
                                             <input class="display-none" name='teste1' value="<?php  echo $dados['Credencial_academia'];?>">
                                             </form>
                                   
                                            
                                        </div>
                                        
                                    </div>
                                    
                                <?php
                               
                                
                            }

                        }
                        } ?>
                    </div>
                </div>
                </form>
            
                           
           
                                             
        </div>
    </div>
    <?php include_once 'footer.php' ?>
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
    <?php include_once 'modais.php' ?>
</body>

<!--
    <div class="col d-flex justify-content-center">
                                             <input class="btn nav-link text-dark link-hover border-black 
                                             text-uppercase logcard px-5 py-3 mt-3" 
                                             type="submit"   value="<?php //echo $dados['Credencial_academia'];?>" name="detalhes">
                                             <form action="" method="post"><input class="btn nav-link text-dark link-hover border-black 
                                             text-uppercase logcard px-5 py-3 mt-3"  type="submit" name="detalhe" value="<?php echo $cred;?>"  ></form>
                                            
                                        </div>
-->
</html>