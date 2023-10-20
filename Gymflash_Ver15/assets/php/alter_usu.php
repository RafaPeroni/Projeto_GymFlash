<?php
include_once 'databaseconnect.php';
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['Credencial_usuario'])) {
    die("Você não possue login para acessar essa página.<p><a href=\"./index.php\">RETORNAR</a></p>");
    exit;
}

include_once('ALTERACAO2.php');


if (isset($_POST['desconectar'])) {
    session_destroy();
    die("Você foi deslogado com sucesso.<a href=\"./index.php\">RETORNAR</a>");
}
//CONEÇÃO USUARIO
$busca_usu = $conn->prepare("SELECT * FROM Cadastrousuario WHERE Credencial_usuario = :credencial");
$busca_usu->bindParam(':credencial', $_SESSION['Credencial_usuario']);
$busca_usu->execute();


if (isset($_GET['login'])) {
    header('location: cadacad.php');
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<body class="p-0">
    <?php
    while ($dados = $busca_usu->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="container">
            <h1 class="text-dark text-center fw-bold my-4">Informações de Conta</h1>
            <form method="post" class="d-flex flex-column" autocomplete="off">
                <div class="row my-2">
                    <!--NOME DO USUARIO-->
                    <div class="col form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg" type="text" name="nameusuario"
                            id="name" placeholder="Nome do Representante" value="<?php echo $dados['Nome_usuario']; ?>">
                        <label class="ml-3" for="nameusuario">Nome:</label>
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3" type="submit" value="Alterar Nome" name='name-usu'>
                    </div>
                    <!--CPF DO USUARIO-->
                    <div class="col form-floating ml-5">
                        <input class="border-2 bg-transparent form-control form-control-lg" type="text" name="cpf-u" id="cpf"
                            placeholder="Nome da Academia" value="<?php echo $dados['CPF_usuario']; ?>" oninput="formatarCPF()">
                        <label class="ml-3" for="cpf-u">CPF:</label>
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3" type="submit" value="Alterar" name='cpf-usu'>
                    </div>
                </div>
                    <div class="row my-2">
                        <!--TELEFONE DO REPRESENTANTE-->
                        <div class="col form-floating">
                            <input class="border-2 bg-transparent form-control form-control-lg" type="text"
                                name="telefone-usu" id="tel" placeholder="Nome do Representante" oninput="formTel()" value="<?php echo $dados['Telefone_usuario']; ?>">
                            <label class="ml-3" for="telefone-usu">Telefone:</label>
                            <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3" type="submit" value="Alterar" name='telefone'>
                        </div>
                        <!--EMAIL DA ACADEMIA-->
                        <div class="col form-floating ml-5">
                            <input class="border-2 bg-transparent form-control form-control-lg" type="EMAIL"
                                name="email-usu" id="email" placeholder="" Value="<?php echo $dados['Email_usuario']; ?>">
                            <label class="ml-3" for="email-usu">Email:</label>
                            <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3" type="submit" value="Alterar" name='email'>
                        </div>
                    </div>
                    <!--senha DA ACADEMIA-->
                    <div class="row my-2">
                        <div class="col form-floating">
                            <input class="border-2 bg-transparent form-control form-control-lg" type="text" name="senha-usu"
                                id="senha-usu" placeholder="" value="<?php echo $dados['Senha_usuario']; ?>">
                            <label class="ml-3" for="senha-usu">Senha:</label>
                            <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3" type="submit" value="Alterar" name='senha'>
                        </div>
                        <div class="col ml-5">

                        </div>
                    </div>
            </form>
            <form action="" method="post" class="row">
                <div class="col d-flex justify-content-center">
                    <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3" type="submit" value="desconectar" name="desconectar">
                </div>
                <div class="col d-flex justify-content-center">
                    <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3" type="button" value="Excluir Conta" data-bs-toggle="modal" data-bs-target="#menu" name="excluir">
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
                        <h2 class="text-black text-center my-2 fs-4">
                            Deseja mesmo excluir sua copnta?
                        </h2>
                        <h5>Após confirmar a exclusão de conta, não é possível recuperar sua conta, certifique-se de estar consciente ao "CONFIRMAR EXCLUSÃO"</h5>
                       
                    </div>
                    
            <div class="d-flex py-2 pb-4 bg-transparent align-items-center justify-content-center">
                <input type="submit" class="btn nav-link text-dark link-hover border-black mx-1 text-uppercase logcard px-5 py-3"
                value="CONFIRMAR EXCLUSÃO" name='excluir'>
                
            </div>
        </div>
    </div>
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