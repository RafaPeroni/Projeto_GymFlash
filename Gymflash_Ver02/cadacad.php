<?php
header('Content-Type: text/html; charset=utf-8');
include_once 'assets/php/databaseconnect.php';
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
            echo "<script> alert('Cadastro concluido'); window.location.href='index.php';</script>";
        } else {
            function_alert("As senhas não coincidem!");
        }
    }
} else {
}
?>

<style>
    .bg-cad {
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
                <input type="search" class="form-control form-control-dark bg-white border-none"
                    placeholder="Pesquisa..." aria-label="Search" id="Pesquisa">
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
                <li class="nav-item">
                    <button type="button" class="btn nav-link text-dark link-hover border mx-1 text-uppercase logcad"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Login/Cadastro
                    </button>
                </li>
            </ul>
        </header>
    </div>
    <div class="container">
        <h1 class="text-black text-center fw-bold my-4">Cadastro de Academia</h1>
        <form method="post" class="d-flex flex-column" autocomplete="off">
            <div class="row my-2">
                <div class="col">
                    <label class="text-start fs-4" for="nameRep">Nome do Representante:</label>
                    <input class="bg-cad border-0 form-control p-3 fs-5" type="text" name="nameRep" id="nameRep"
                        required>
                </div>
                <div class="col ml-5">
                    <label class="text-start fs-4" for="nameAcad">Nome da Academia:</label>
                    <input class="bg-cad border-0 form-control p-3 fs-5" type="text" name="nameAcad" id="nameAcad"
                        required>
                </div>
            </div>
            <div class="row my-2">
                <div class="col">
                    <label class="text-start fs-4" for="senha">Senha:</label>
                    <input class="bg-cad border-0 form-control p-3 fs-5" type="password" name="senha" id="senha"
                        minlength="8" maxlength="32" required>
                </div>
                <div class="col ml-5">
                    <label class="text-start fs-4" for="csenha">Confirme a Senha:</label>
                    <input class="bg-cad border-0 form-control p-3 fs-5" type="password" name="csenha" id="csenha"
                        minlength="8" maxlength="32" required>
                </div>
            </div>
            <div class="row my-2">
                <div class="col">
                    <label class="text-start fs-4" for="cnpj">CNPJ:</label>
                    <input class="bg-cad border-0 form-control p-3 fs-5" maxlength="18" type="text" id="cnpj"
                        name="cnpj" oninput="formatarCNPJ()" required>
                </div>
                <fieldset class="col ml-5">
                    <legend class="mb-3">Modalidades:</legend>
                    <div class="d-flex align-items-center my-auto flex-wrap">
                        <div>
                            <input type="checkbox" name="modal-service" id="muait">
                            <label for="muait" class="mr-3 ml-2">Muay Thai</label>
                        </div>
                        <div>
                            <input type="checkbox" name="modal-service" id="boxe">
                            <label for="boxe" class="mr-3 ml-2">Boxe</label>
                        </div>
                        <div>
                            <input type="checkbox" name="modal-service" id="danca">
                            <label for="danca" class="mr-3 ml-2">Dança</label>
                        </div>
                        <div>
                            <input type="checkbox" name="modal-service" id="spinning">
                            <label for="spinning" class="mr-3 ml-2">Spinning</label>
                        </div>
                        <div>
                            <input type="checkbox" name="modal-service" id="judo">
                            <label for="judo" class="mr-3 ml-2">Judô</label>
                        </div>
                        <div>
                            <input type="checkbox" name="modal-service" id="taekwendo">
                            <label for="taekwendo" class="mr-3 ml-2">Taekwendô</label>
                        </div>
                        <div>
                            <input type="checkbox" name="modal-service" id="jump">
                            <label for="jump" class="mr-3 ml-2">Jump</label>
                        </div>
                        <div>
                            <input type="checkbox" name="modal-service" id="crossfit">
                            <label for="crossfit">Crossfit</label>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="row my-2">
                <div class="col">
                    <label class="text-start fs-4" for="email">Email:</label>
                    <input class="bg-cad border-0 form-control p-3 fs-5" type="email" name="email" id="email" required>
                </div>
                <div class="col ml-5">
                    <label class="text-start fs-4" for="cep">CEP:</label>
                    <input class="bg-cad border-0 form-control p-3 fs-5" maxlength="9" type="text" name="cep" id="cep"
                        oninput="formatarCEP()" required>
                </div>
            </div>
            <div class="row my-2 w-50 align-self-center">
                <div class="col">
                    <div class="row justify-content-center my-2">
                        <div class="row d-flex justify-content-center my-3">
                            <label class="text-start fs-4" for="func">Dias de funcionamento na semana:</label>
                            <select class="bg-cad border-0 form-select p-3 fs-5 w-75" name="func" id="func">
                                <option value="dias1">Dias Úteis - Sábados</option>
                                <option value="dias2">Dias Úteis + Sab/Dom</option>
                                <option value="dias3">Todos os dias</option>
                            </select>
                        </div>
                        <div class="row d-flex justify-content-center my-3">
                            <label class="text-start fs-4" for="numFunc">Qnt. funcionários:</label>
                            <input type="number" class="bg-cad border-0 p-3 fs-5 w-75" name="numFunc" id="numFunc">
                        </div>
                    </div>
                    <div class="row my-2">
                        <label class="text-start fs-4" for="horario">Horário de funcionamento:</label>
                        <input class="bg-cad border-0 form-control p-3 fs-5" type="text" name="horario" id="horario"
                            required>
                    </div>
                    <div class="row my-2">
                        <label class="text-start fs-4" for="tel">Telefone:</label>
                        <input class="bg-cad border-0 form-control p-3 fs-5" maxlength="11" type="text" name="tel"
                            id="tel" oninput="formTel()" required>
                    </div>
                    <div class="row my-2">
                        <label class="text-start m fs-4">Selecione uma Imagem:</label> <br>
                        <input type="file" name="img" multiple accept="image/*" id="" placeholder="Escolha">
                    </div>
                </div>
            </div>
            <div class="row my-4 justify-content-center">
                <label class="text-start fs-4" for="coment">Comentários:</label>
                <textarea name="coment" id="coment" cols="30" rows="10"
                    class="bg-cad border-0 form-control p-3 fs-5"></textarea>
            </div>
            <div class="row my-2">
                <h1 class="text-black text-center fw-bold my-4">Digite a localização da(s) academia(s)</h1>
                <div class="d-flex flex-column align-items-center">
                    <div class="row my-2 w-50">
                        <label class="text-start fs-4" for="ceploc">CEP:</label>
                        <input class="bg-cad border-0 form-control p-3 fs-5" maxlength="9" type="text" name="ceploc"
                            id="ceploc" oninput="formatarCEPloc()" required>
                    </div>
                    <div class="row my-2 w-50">
                        <label class="text-start fs-4" for="state">Estado:</label>
                        <input class="bg-cad border-0 form-control p-3 fs-5" type="text" name="state" id="state"
                            required readonly>
                    </div>
                    <div class="row my-2 w-50">
                        <label class="text-start fs-4" for="city">Cidade:</label>
                        <input class="bg-cad border-0 form-control p-3 fs-5" type="text" name="city" id="city" required
                            readonly>
                    </div>
                    <div class="row my-2 w-50">
                        <label class="text-start fs-4" for="rua">Rua:</label>
                        <input class="bg-cad border-0 form-control p-3 fs-5" type="text" name="rua" id="rua" required
                            readonly>
                    </div>
                    <div class="row my-2 w-50">
                        <div class="col-auto w-75 p-0">
                            <label class="text-start fs-4" for="ceploc">Bairro:</label>
                            <input class="bg-cad border-0 form-control p-3 fs-5" type="text" name="bairro" id="bairro"
                                required readonly>
                        </div>
                        <div class="col-auto w-25 pr-0">
                            <label class="text-start fs-4" for="num">Número:</label>
                            <input class="bg-cad border-0 form-control p-3 fs-5" type="text" name="num" id="num"
                                required>
                        </div>
                    </div>
                    <input
                        class="btn nav-link text-dark link-hover border-black mx-1 text-uppercase logcard px-5 py-3 my-5"
                        name="inserir" type="submit" value="Enviar">
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
                    <h1 class="mx-2 align-center text-white ff-sp">G<span class="text-danger ls-1 ff-sp">y</span>mFlash
                    </h1>
                </a>
                <div class="d-flex align-items-center mb-2">
                    <a href="#" class="mr-2"><img src="/assets/img/social-icon/instagram.png" alt=""></a>
                    <a href="#" class="mx-2"><img src="/assets/img/social-icon/facebook.png" alt=""></a>
                    <a href="#" class="mx-2"><img src="/assets/img/social-icon/youtube.png" alt=""></a>
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
    <div class="modal fade scale p-0" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close fw-bold" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="card rounded-4 col mx-2 border-0">
                            <h3 class="text-black text-center my-2 fs-4">
                                Cadastro da Academia
                            </h3>
                            <a href="cadacad.php" class="card rounded-4 text-center border-3  border-black h-100">
                                <div class="card-img-top ">
                                    <img class="py-3 px-3" src="assets/img/logcad/acadcad.png" alt="" width="100%">
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
                        <div class="card rounded-4 col mx-2 border-0">
                            <h3 class="text-black text-center my-2 fs-4">
                                Cadastro de Usuário
                            </h3>
                            <a data-bs-toggle="modal" data-bs-target="#loginModal"
                                class="card rounded-4 text-center border-3 border-black h-100 btn">
                                <div class="card-img-top">
                                    <img class="py-4 px-4" src="assets/img/logcad/usercad.png" alt="" width="100%">
                                </div>
                                <p class="card-text my-3 fs-5 text-decoration-underline">
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
                <div class="d-flex py-2 pb-4 border-0 align-items-center justify-content-center">
                    <button type="button"
                        class="btn nav-link text-dark link-hover border-black mx-1 text-uppercase logcard px-5 py-3"
                        data-bs-toggle="modal" data-bs-target="#loginModal">
                        Login
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-2">Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-lg-4 py-lg-5">
                    <div class="form-signin m-auto card border-0 px-3 justify-content-center">
                        <form class="d-flex flex-column">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="floatingInput" placeholder="Nome">
                                <label for="floatingInput">Usuário</label>
                            </div>
                            <div class="form-floating mt-1 mb-3">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Senha">
                                <label for="floatingPassword">Senha</label>
                            </div>
                            <input
                                class="w-50 btn nav-link text-dark link-hover border mx-1 text-uppercase logcad py-3 align-self-center"
                                name="login" type="submit" value="Login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="usercadMod" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-2">Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-lg-4 py-lg-5">
                    <div class="form-signin m-auto card border-0 px-3 justify-content-center">
                        <form class="d-flex flex-column">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="floatingInput" placeholder="Nome">
                                <label for="floatingInput">Usuário</label>
                            </div>
                            <div class="form-floating mt-1 mb-3">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Senha">
                                <label for="floatingPassword">Senha</label>
                            </div>
                            <input
                                class="w-50 btn nav-link text-dark link-hover border mx-1 text-uppercase logcad py-3 align-self-center"
                                name="login" type="submit" value="Login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
    <script>
        <?php include_once("assets/js/cep.js") ?>
    </script>
</body>

</html>