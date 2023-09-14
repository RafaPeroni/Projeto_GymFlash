<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include 'assets/php/databaseconnect.php';
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

//CRUD - Insert, vai acontecer apenas ao clicar no submit no final da página
if (isset($_POST['inserir'])) {
    if (empty($_POST['senha'])) {
    } else {
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
            $stmt = $conn->prepare('INSERT INTO EnderecoAcademia (idEndereco, FK_Credencial_academia, CEP_academia, Num_academia, Rua_academia, Bairro_academia, Cidade_academia, UF_academia) VALUES(:idEndereco, :FK_Credencial_academia, :CEP_academia, :Num_academia, :Rua_academia, :Bairro_academia, :Cidade_academia, :UF_academia)');
            $stmt->execute(
                array(
                    ':idEndereco' => NULL,
                    ':FK_Credencial_academia' => $fkCred = $lastID,
                    ':CEP_academia' => $cep = $_POST['ceploc'],
                    ':Num_academia' => $num = $_POST['num'],
                    ':Rua_academia' => $rua = $_POST['rua'],
                    ':Bairro_academia' => $bairro = $_POST['bairro'],
                    ':Cidade_academia' => $city = $_POST['city'],
                    ':UF_academia' => $uf = $_POST['state']
                )
            );
            function_alert("Cadastro concluido");
        } else {
            function_alert("As senhas não coincidem!");
        }
    }
} else {
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
        <?php require_once 'assets/css/reset.css' ?>
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        <?php require_once 'assets/css/style.css' ?>
    </style>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Gothic&family=Pathway+Gothic+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body class="p-0">
    <div class="container-fluid">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom align-items-center">
            <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img src="logo.png" alt="Logo site">
                <h1 class="mx-2 align-center ff-sp">G<span class="text-danger ls-1 ff-sp">y</span>mFlash</h1>
            </a>
            <form class="col-12 w-50 mb-3 mb-lg-0 me-lg-3 d-flex align-items-center src-bar" role="search" autocomplete="off">
                <label for="Pesquisa" class="src-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M14.9521 14.5633L22.0432 22.4344M17.122 9.06101C17.122 13.513 13.513 17.122 9.06101 17.122C4.60904 17.122 1 13.513 1 9.06101C1 4.60904 4.60904 1 9.06101 1C13.513 1 17.122 4.60904 17.122 9.06101Z" stroke="none" stroke-width="2" stroke-linecap="square" stroke-linejoin="square" />
                    </svg>
                </label>
                <input type="search" class="form-control form-control-dark bg-white border-none" placeholder="Pesquisa..." aria-label="Search" id="Pesquisa">
            </form>
            <ul class="nav nav-pills nav-justified align-items-center">
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark link-hover mx-1 text-uppercase">Academias</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark link-hover mx-1 text-uppercase">Contato</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark link-hover mx-1 text-uppercase">Sobre</a>
                </li>
                <li class="nav-item"><?php if(isset($_SESSION['Credencial_academia']) ) 
                echo "VOCÊ JA ESTA LOGADO ... APROVEITE";
                     {?>
                    logado:
                <?php
                    echo $_SESSION['Nome_da_academia'];
                    }
                    ?>
                </li>
            </ul>
        </header>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="d-flex flex-column flex-shrink-0 p-3 h-100">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item fs-4 my-2">
                        <a href="perfil.php?dir=assets/php&file=databaseconnect" class="nav-link link-body-emphasis d-flex align-items-center linkP" aria-current="page">
                            <svg class="bi pe-none me-2" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 50 50">
                                <path d="M 25 1.0507812 C 24.7825 1.0507812 24.565859 1.1197656 24.380859 1.2597656 L 1.3808594 19.210938 C 0.95085938 19.550938 0.8709375 20.179141 1.2109375 20.619141 C 1.5509375 21.049141 2.1791406 21.129062 2.6191406 20.789062 L 4 19.710938 L 4 46 C 4 46.55 4.45 47 5 47 L 19 47 L 19 29 L 31 29 L 31 47 L 45 47 C 45.55 47 46 46.55 46 46 L 46 19.710938 L 47.380859 20.789062 C 47.570859 20.929063 47.78 21 48 21 C 48.3 21 48.589063 20.869141 48.789062 20.619141 C 49.129063 20.179141 49.049141 19.550938 48.619141 19.210938 L 25.619141 1.2597656 C 25.434141 1.1197656 25.2175 1.0507812 25 1.0507812 z M 35 5 L 35 6.0507812 L 41 10.730469 L 41 5 L 35 5 z">
                                </path>
                            </svg>
                            <p class="m-0 mx-2">Início</p> 
                        </a>
                    </li>
                    <li class="nav-item fs-4 my-2">
                        <a href="perfil.php?dir=assets/php&file=cadacad" class="nav-link link-body-emphasis d-flex align-items-center linkP" aria-current="page">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 30 30">
                                <path d="M24,2H4v26h20c1.105,0,2-0.895,2-2V4C26,2.895,25.105,2,24,2z M9,21c0-3.792,4-2.708,4.5-4.333v-1.083 c-0.225-0.121-0.868-0.951-0.936-1.599c-0.177-0.015-0.455-0.191-0.537-0.886c-0.044-0.373,0.131-0.583,0.237-0.649 c0,0-0.264-0.602-0.264-1.199C12,9.474,12.879,8,15,8c1.145,0,1.5,0.812,1.5,0.812c1.023,0,1.5,1.122,1.5,2.438 c0,0.656-0.264,1.199-0.264,1.199c0.106,0.066,0.281,0.276,0.237,0.649c-0.082,0.695-0.36,0.871-0.537,0.886 c-0.068,0.648-0.711,1.478-0.936,1.599v1.083C17,18.292,21,17.208,21,21H9z">
                                </path>
                            </svg>
                            <p class="m-0 mx-2">Informações Pessoais</p>
                        </a>
                    </li>
                    <li class="nav-item fs-4 my-2">
                        <a href="perfil.php?dir=assets/php&file=databaseconnect" class="nav-link link-body-emphasis d-flex align-items-center linkP" aria-current="page">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 46 51" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.734955 7.21817C16.1919 5.93913 23.0632 0.716064 23.0632 0.716064C23.0632 0.716064 35.8891 7.21898 45.3525 7.21898C45.0143 8.88922 44.6946 10.4876 44.3883 12.0188C39.8238 34.8397 38.2475 42.7209 22.9849 50.7096C7.91227 42.4078 5.42443 34.032 0.734955 7.21817ZM18 20V29H27V20H25.5C25.5 20 26.5 15 22.5 15C18.5 15 19.5 20 19.5 20H18ZM24.5 20C24.5 20 25.5 16 22.5 16C19.5 16 20.5 20 20.5 20H24.5Z" fill="black" />
                                <path d="M23.25 22.25C22.8358 21.8358 22.1642 21.8358 21.75 22.25V22.25C21.3358 22.6642 21.3358 23.3358 21.75 23.75L22 24H22.5H23L23.25 23.75C23.6642 23.3358 23.6642 22.6642 23.25 22.25V22.25Z" fill="black" />
                                <path d="M21.5 26H23.5L23 24H22.5H22L21.5 26Z" fill="black" />
                            </svg>
                            <p class="m-0 mx-2">Dados e Privacidade</p>
                        </a>
                    </li>
                    <li class="nav-item fs-4 my-2">
                        <a href="perfil.php?dir=assets/php&file=databaseconnect" class="nav-link link-body-emphasis d-flex align-items-center linkP" aria-current="page">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 30 30">
                                <path d="M 15 2 C 11.145666 2 8 5.1456661 8 9 L 8 11 L 6 11 C 4.895 11 4 11.895 4 13 L 4 25 C 4 26.105 4.895 27 6 27 L 24 27 C 25.105 27 26 26.105 26 25 L 26 13 C 26 11.895 25.105 11 24 11 L 22 11 L 22 9 C 22 5.2715823 19.036581 2.2685653 15.355469 2.0722656 A 1.0001 1.0001 0 0 0 15 2 z M 15 4 C 17.773666 4 20 6.2263339 20 9 L 20 11 L 10 11 L 10 9 C 10 6.2263339 12.226334 4 15 4 z">
                                </path>
                            </svg>
                            <p class="m-0 mx-2">Segurança</p>
                        </a>
                    </li>
                    <li class="nav-item fs-4 my-2">
                        <a href="perfil.php?dir=assets/php&file=databaseconnect" class="nav-link link-body-emphasis d-flex align-items-center linkP" aria-current="page">
                            <svg class="bi pe-none me-2" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 50 50">
                                <path d="M 25 1.0507812 C 24.7825 1.0507812 24.565859 1.1197656 24.380859 1.2597656 L 1.3808594 19.210938 C 0.95085938 19.550938 0.8709375 20.179141 1.2109375 20.619141 C 1.5509375 21.049141 2.1791406 21.129062 2.6191406 20.789062 L 4 19.710938 L 4 46 C 4 46.55 4.45 47 5 47 L 19 47 L 19 29 L 31 29 L 31 47 L 45 47 C 45.55 47 46 46.55 46 46 L 46 19.710938 L 47.380859 20.789062 C 47.570859 20.929063 47.78 21 48 21 C 48.3 21 48.589063 20.869141 48.789062 20.619141 C 49.129063 20.179141 49.049141 19.550938 48.619141 19.210938 L 25.619141 1.2597656 C 25.434141 1.1197656 25.2175 1.0507812 25 1.0507812 z M 35 5 L 35 6.0507812 L 41 10.730469 L 41 5 L 35 5 z">
                                </path>
                            </svg>
                            <p class="m-0 mx-2">Pagamentos e Assinaturas</p>
                        </a>
                    </li>
                    <li class="nav-item fs-4 my-2">
                        <a href="perfil.php?dir=assets/php&file=databaseconnect" class="nav-link link-body-emphasis d-flex align-items-center linkP" aria-current="page">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 30 30">
                                <path d="M15,3C8.373,3,3,8.373,3,15c0,6.627,5.373,12,12,12s12-5.373,12-12C27,8.373,21.627,3,15,3z M16,21h-2v-7h2V21z M15,11.5 c-0.828,0-1.5-0.672-1.5-1.5s0.672-1.5,1.5-1.5s1.5,0.672,1.5,1.5S15.828,11.5,15,11.5z">
                                </path>
                            </svg>
                            <p class="m-0 mx-2">Sobre</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row col-9 h-100">
            <div class="row h-25">
                <div class="bg-danger bg-gradient bg-opacity-50 h-100">
                </div>
                <div>

                </div>
            </div>
            <div class="container row h-75">
                <section class="container border border-2 shadow-lg m-2 rounded-5 overflow-hidden p-0">
                    <?php require_once(__DIR__ . "/{$_GET['dir']}/{$_GET['file']}.php"); ?>
                </section>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-black">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 mt-5 px-3 border-top">
            <div class="col mb-3 d-flex flex-column align-items-start">
                <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 link-body-emphasis text-decoration-none">
                    <img src="logo.png" alt="Logo site">
                    <h1 class="mx-2 align-center text-white ff-sp">G<span class="text-danger ls-1 ff-sp">y</span>mFlash
                    </h1>
                </a>
                <div class="d-flex align-items-center mb-2">
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
                    <li class="nav-item mb-2"><a href="#" class="nav-link link-hover fw-light p-0 text-white">Academias</a>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        <?php include_once("assets/js/main.js") ?>
    </script>
    <script>
        <?php include_once("assets/js/cep.js") ?>
    </script>
</body>

</html>