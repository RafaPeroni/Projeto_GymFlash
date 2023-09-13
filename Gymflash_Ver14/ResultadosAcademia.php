<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include_once 'assets/php/databaseconnect.php';

if (!isset($_SESSION['Credencial_academia']) && !isset($_SESSION['Credencial_usuario'])) {
    die("Você não possue login para acessar essa página. FAÇA SEU LOGIN OU CRIE UMA CONTA<p><a href=\"./index.php\">RETORNAR</a></p>");
    exit;
}
if (isset($_SESSION['Credencial_academia'])) {
    $persona = $_SESSION['Credencial_academia'];
} else if (isset($_SESSION['Credencial_usuario'])) {
    $persona = $_SESSION['Credencial_usuario'];
}
$credt = $_GET['cred'];
$cred = $_GET['cred'];

$busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
$busca_acad->bindParam(':credencial', $cred);
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
        <?= include_once("assets/css/estrelas.css") ?>
    </style>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=League+Gothic&family=Pathway+Gothic+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body class="p-0">
    <?php include_once 'header.php' ?>
    <div class="container">
        <?php include_once 'assets\php\perfil_acad.php'?>
    </div>
    <?php include_once 'footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        <?php include_once("assets/js/main.js") ?>
    </script>
    <script>
        <?php include_once("assets/js/cep.js") ?>
    </script>
    <?php include_once 'modais.php' ?>
</body>

</html>