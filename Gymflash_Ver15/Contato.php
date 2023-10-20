<?php
session_start();

header('Content-Type: text/html; charset=utf-8');
include_once 'assets/php/databaseconnect.php';
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
include_once("Cadusu.php");

if (isset($_POST['login'])) {
    //verificação de possiveis campos vazios========================================================================
    if (strlen($_POST['tex-name']) <= 0) {
        function_alert('CAMPO DE USUÁRIO INVÁLIDO');
        $_POST['login'] = die;
        unset($_POST['login']);
    } elseif (strlen($_POST['tex-password']) <= 0) {
        function_alert('CAMPO DE SENHA INVÁLIDO');
    } else {
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
        if (empty($result1) && empty($result2)) {
            function_alert('Credenciais inválidas.... TENTE NOVAMENTE');
        } else {
            if ((!empty($result1))) {
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['Credencial_academia'] = $result1['Credencial_academia'];
                $_SESSION['Nome_da_academia'] = $result1['Nome_da_academia'];
            }
            if ((!empty($result2))) {
                if (!isset($_SESSION)) {
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
    <title>GymFlash - Contato</title>
    <style>
        <?= include_once("assets/css/reset.css") ?>
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        <?= include_once("assets/css/style.css") ?>
    </style>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=League+Gothic&family=Pathway+Gothic+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <form action="" method="post">
    </form>
    <?php include_once 'header.php' ?>
    <h1 class="container" style="color: #B50E0E;">Contato</h1>
    <div class="container">
        <p class="black mx-3" style="border-bottom: 2px solid #AA0F0F; border-width: 20%;">A GymFlash está pronta para lhe ajudar em tudo que quiser desde que esteja no nosso alcance</p>
        <p class="mt-3 black">Nosso email para suporte: suporte.gymflash@gmail.com</p>
        <p class="black">Nosso número de contato: <a href="https://web.whatsapp.com/send?phone=5531972102178">31 97210 - 2178</a></p>
    </div>
    <?php include_once 'footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        <?php include_once("assets/js/main.js") ?>
    </script>
    <?php include_once 'modais.php' ?>
</body>
</html>