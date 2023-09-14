<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include_once 'assets/php/databaseconnect.php';


include_once("cadusu.php");
if(isset($_POST['login'])){
//verificação de possiveis campos vazios========================================================================
    if(strlen($_POST['tex-name']) <= 0)
    {
        function_alert('CAMPO DE USUÁRIO INVÁLIDO' );
        $_POST['login'] = die;
        unset($_POST['login']);
    }
    elseif(strlen($_POST['tex-password']) <= 0) 
    {
        function_alert('CAMPO DE SENHA INVÁLIDO' );
    }
    else
    {
//busca para validação de cadastro de academias==============================================================================
        $login_name = (string)$_POST['tex-name'];
        $login_password = (string)$_POST['tex-password'];
        $login_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE CNPJ_academia LIKE :login_name OR Email_academia LIKE :login_name AND Senha_academia LIKE :login_password");
        $login_acad->bindValue(':login_name', $login_name);
        $login_acad->bindValue(':login_password', $login_password);
        $login_acad->execute();
//busca para validação de cadastro de academias==============================================================================
        $login_usu = $conn->prepare("SELECT * FROM Cadastrousuario WHERE CPF_usuario LIKE :login_name OR Email_usuario LIKE :login_name AND Senha_usuario LIKE :login_password");
        $login_usu->bindValue(':login_name', $login_name);
        $login_usu->bindValue(':login_password', $login_password);
        $login_usu->execute();

        $result1 = $login_acad->fetch(PDO::FETCH_ASSOC);
        $result2 = $login_usu->fetch(PDO::FETCH_ASSOC);
        if (empty($result1) && empty($result2))
        {      
        function_alert('Credenciais inválidas.... TENTE NOVAMENTE');
        } 
        else 
        {  
           if ((!empty($result1)))
            { 
                if (!isset($_SESSION))
                {session_start();}      
                $_SESSION['Credencial_academia'] = $result1['Credencial_academia'];
                $_SESSION['Nome_da_academia'] = $result1['Nome_da_academia'];
            }
            if ((!empty($result2)))
            { 
                if (!isset($_SESSION))
                {
                    session_start();
                }      
                $_SESSION['Credencial_usuario'] = $result2['Credencial_usuario'];
                $_SESSION['Email_usuario'] = $result2['Email_usuario'];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GymFlash - Home</title>
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

<body>
    <?php include_once 'header.php' ?>
    <div class="container-fluid my-1">
        <div class="row d-flex justify-content-center">
            <div class="d-flex flex-column align-items-center px-0">
                <div class="row my-3 w-100 py-5"
                    style="background: url(assets/img/banners/banner_principal.png) no-repeat center center; background-size: cover;">
                    <div class="col mb-3 article-banner">
                    </div>
                    <div class="col mb-3 text-center">
                        <h2 class="fs-1 fw-semibold text-white text-uppercase my-3">
                            Ande junto com a gente
                        </h2>
                        <h3 class="fs-2 fw-lighter text-white text-uppercase my-2">
                            Cadastre-se Agora
                        </h3>
                        <h3 class="fw-normal text-white text-uppercase my-1 fs-3">
                            Rápido | Prático | Simples
                        </h3>
                        <a href="perfil.php?dir=assets/php&file=databaseconnect" type="button"
                            class="bg-white text-white border border-3 rounded-3 fw-semibold text-uppercase bg-transparent py-3 px-5 my-3 fs-4 text-decoration-none"
                            aria-current="page">
                            Cadastre-se
                        </a>
                        <p class="fw-medium fs-6 text-white my-3 text-uppercase">www.gymflash.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="d-flex flex-column align-items-center px-0">
                <h1 class="text-center my-2 display-4 fw-normal subtitle fs-1 text-uppercase">Conosco você estará
                    seguro</h1>
                <div class="row my-3 w-100 pt-sp pb-sp py-5"
                    style="background: url(assets/img/banners/banner-conosco.png) no-repeat center center; background-size: cover;">
                    <div class="col mb-3 article-banner">
                        <h2 class="text-start h1 fw-semibold text-black">
                            Descubra o que é melhor para você e para sua vida
                        </h2>
                        <p class="text-start fw-medium h5">Fazemos questão de facilitar todos os processos!</p>
                    </div>
                    <div class="col mb-3">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-4">
        <h3 class="display-5 text-start">O que é o <span class="mx-2 align-center ff-sp">G<span
                    class="text-danger ls-1 ff-sp">y</span>mFlash</span>
        </h3>
        <p class="fs-3 mb-4">É o que você, que precisa de uma academia e não sabe o que fazer. Deve procurar!</p>
        <div class="row d-flex justify-content-center p-1 py-5 border-black text-center card-special">
            <p class=" my-1 fs-4">Acabou de sair de uma academia por ter experiências ruins?</p>
            <p class="subtitle my-1 fs-3">Não se preocupe!</p>
            <p class=" my-1 fs-4">Nenhuma academia é igual a outra, e nós garantimos que você irá achar a sua, de
                acordo
                com suas preferências</p>
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
    <?php include_once 'modais.php' ?>
</body>

</html>