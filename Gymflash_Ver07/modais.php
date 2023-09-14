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
                        <form class="d-flex flex-column py-3" method="POST">
                            <div class="d-flex my-1">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingNome" placeholder="Nome" name="name_usuario"  required>
                                    <label for="floatingNome">Usuário</label>
                                </div>
                                <div class="form-floating ml-2">
                                    <input type="text" class="form-control" id="tel" placeholder="Tel" name="tel_usuario" required>
                                    <label for="floatingTel">Telefone</label>
                                </div>
                            </div>
                            
                            <div class="form-floating">
                                <input type="email" class="form-control" id="floatingEmail" placeholder="Email" name="email_usuario" required>
                                <label for="floatingEmail">Email</label>
                            </div>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="cpf" placeholder="" name="cpf_usuario" required>
                                <label for="floatingCPF">CPF</label>
                            </div>
                            <div class="d-flex my-1">                           
                                 <div class="form-floating my-1">
                                    <input type="password" class="form-control" id="floatingPassword" placeholder="Senha" name="senha_usuario" required>
                                    <label for="floatingPassword">Senha</label>
                                </div>
                                 <div class="form-floating my-1 mb-2">
                                    <input type="password" class="form-control" id="floatingCPassword" placeholder="csenha" name="csenha_usuario" required>
                                    <label for="floatingCPassword">Confirme a senha</label>
                                </div>
                            </div>
                            <input class="w-50 btn nav-link text-dark link-hover border mx-1 text-uppercase logcad py-3 align-self-center" name="cadusu" type="submit" value="Cadastrar">
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
                    <form class="d-flex flex-column py-3" method="POST">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingNome" placeholder="Nome"
                                name="tex-name">
                            <label for="floatingNome">Usuário</label>
                        </div>
                        <div class="form-floating my-1 mb-2">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Senha"
                                name="tex-password">
                            <label for="floatingPassword">Senha</label>
                        </div>
                        <input
                            class="w-50 btn nav-link text-dark link-hover border mx-1 text-uppercase logcad py-3 align-self-center"
                            name="login" type="submit" value="Entrar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>