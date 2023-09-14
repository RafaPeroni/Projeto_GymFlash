<?php

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GymFlash - Home</title>
    <link type="text/css" rel="stylesheet" href="assets/css/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=League+Gothic&family=Pathway+Gothic+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
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
                            stroke="none" stroke-width="2" stroke-linecap="square" stroke-linejoin="square"></path>
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
                        <button type="button"
                            class="bg-white subtitle fw-semibold text-uppercase border-0 py-3 px-5 my-3 fs-4"
                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Cadastre-se
                        </button>
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
                    class="text-danger ls-1 ff-sp">y</span>mFlash?</span></h3>
        <p class="fs-3 mb-4">É o que você, que precisa de uma academia e não sabe o que fazer. Deve procurar!</p>
        <div class="row d-flex justify-content-center p-1 py-5 border-black text-center card-special">
            <p class=" my-1 fs-4">Acabou de sair de uma academia por ter experiências ruins?</p>
            <p class="subtitle my-1 fs-3">Não se preocupe!</p>
            <p class=" my-1 fs-4">Nenhuma academia é igual a outra, e nós garantimos que você irá achar a sua, de
                acordo
                com suas preferências</p>
        </div>
    </div>
    <div class="container-fluid">
    </div>
    <div class="container-fluid bg-black">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 mt-5 px-3 border-top">
            <div class="col mb-3 d-flex flex-column align-items-start">
                <a href="#" class="d-flex align-items-center mb-3 mb-md-0 link-body-emphasis text-decoration-none">
                    <img src="logo.png" alt="Logo site">
                    <h1 class="mx-2 align-center text-white ff-sp">G<span class="text-danger ls-1 ff-sp">y</span>mFlash
                    </h1>
                </a>
                <div class="d-flex align-items-center mb-2">
                    <a href="" class="mr-2"><img src="/assets/img/social-icon/instagram.png" alt=""></a>
                    <a href="" class="mx-2"><img src="/assets/img/social-icon/facebook.png" alt=""></a>
                    <a href="" class="mx-2"><img src="/assets/img/social-icon/youtube.png" alt=""></a>
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
    <div class="modal fade scale" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                            <button
                                class="w-50 btn nav-link text-dark link-hover border mx-1 text-uppercase logcad py-3 align-self-center"
                                type="submit">Login</button>
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
</body>

</html>