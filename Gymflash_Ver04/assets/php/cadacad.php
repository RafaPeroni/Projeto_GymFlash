<?php
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
            $stmt = $conn->prepare('INSERT INTO EnderecoAcademia (idEndereco, FK_Credencial_academia, 
            CEP_academia, Num_academia, Rua_academia, Bairro_academia, Cidade_academia, Estado_academia,:Complemento_academia) 
            VALUES(:idEndereco, :FK_Credencial_academia, :CEP_academia, :Num_academia, :Rua_academia, 
            :Bairro_academia, :Cidade_academia, :Estado_academia,:Complemento_academia)');
            $stmt->execute(
                array(
                    ':idEndereco' => NULL,
                    ':FK_Credencial_academia' => $fkCred = $lastID,
                    ':CEP_academia' => $cep = $_POST['ceploc'],
                    ':Num_academia' => $num = $_POST['num'],
                    ':Rua_academia' => $rua = $_POST['rua'],
                    ':Bairro_academia' => $bairro = $_POST['bairro'],
                    ':Cidade_academia' => $city = $_POST['city'],
                    ':Estado_academia' => $uf = $_POST['state'],
                    ':Complemento_academia'=> "estabelecimento"
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
    <div class="container">
        <h1 class="text-dark-emphasis text-center fw-bold my-4">Cadastro de Academia</h1>
        <form method="post" class="d-flex flex-column" autocomplete="off">
            <div class="row my-2">
                <div class="col form-floating">
                    <input class="border-2 bg-transparent form-control form-control-lg" type="text" name="nameRep"
                        id="nameRep" placeholder="Nome do Representante" required>
                    <label class="text-dark-emphasis ml-3" for="nameRep">Nome do Representante:</label>
                </div>
                <div class="col form-floating ml-5">
                    <input class="border-2 bg-transparent form-control form-control-lg" type="text" name="nameAcad"
                        id="nameAcad" placeholder="Nome da Academia" required>
                    <label class="text-dark-emphasis ml-3" for="nameAcad">Nome da Academia:</label>
                </div>
            </div>
            <div class="row my-2">
                <div class="col form-floating">
                    <input class="border-2 bg-transparent form-control form-control-lg " type="password" name="senha"
                        id="senha" minlength="8" maxlength="32" placeholder="Senha" required>
                    <label class="text-dark-emphasis ml-3" for="senha">Senha:</label>
                </div>
                <div class="col form-floating ml-5">
                    <input class="border-2 bg-transparent form-control form-control-lg " type="password" name="csenha"
                        id="csenha" minlength="8" maxlength="32" placeholder="Confirme a Senha" required>
                    <label class="text-dark-emphasis ml-3" for="csenha">Confirme a Senha:</label>
                </div>
            </div>
            <div class="row my-2">
                <div class="col form-floating">
                    <input class="border-2 bg-transparent form-control form-control-lg " maxlength="18" type="text"
                        id="cnpj" name="cnpj" oninput="formatarCNPJ()" placeholder="CNPJ" required>
                    <label class="text-dark-emphasis ml-3" for="cnpj">CNPJ:</label>
                </div>
                <fieldset class="col ml-5">
                    <label class="text-start  mb-3 text-dark-emphasis">Modalidades:</label>
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
                <div class="col form-floating">
                    <input class="border-2 bg-transparent form-control form-control-lg " type="email" name="email"
                        id="email" placeholder="Email" required>
                    <label class="text-start text-dark-emphasis ml-3" for="email">Email:</label>
                </div>
                <div class="col form-floating ml-5">
                    <input class="border-2 bg-transparent form-control form-control-lg " maxlength="9" type="text"
                        name="cep" id="cep" oninput="formatarCEP()" placeholder="CEP" required>
                    <label class="text-start text-dark-emphasis ml-3" for="cep">CEP:</label>
                </div>
            </div>
            <div class="row my-2 w-50 align-self-center">
                <div class="col">
                    <div class="row form-floating my-2">
                        <select class="border-2 bg-transparent form-select form-select-lg fs-6" name="func" id="func">
                            <option class="text-dark">
                                <p>Dias Úteis - Sábados</p>
                            </option>
                            <option class="text-dark" value="dias2">
                                <p>Dias Úteis + Sab/Dom</p>
                            </option>
                            <option class="text-dark" value="dias3">
                                <p>Todos os dias</p>
                            </option>
                        </select>
                        <label class="text-dark-emphasis" for="func">Dias de funcionamento na semana:</label>
                    </div>
                    <div class="row form-floating my-2">
                        <input type="number" class="border-2 bg-transparent form-control form-control-lg "
                            name="numFunc" placeholder="Quantidade de Funcionários" id="numFunc">
                        <label class="text-dark-emphasis" for="numFunc">Qnt. funcionários:</label>
                    </div>
                    <div class="row form-floating my-2">
                        <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="horario"
                            id="horario" placeholder="Horario de Funcionamento" required>
                        <label class="text-dark-emphasis" for="horario">Horário de funcionamento:</label>
                    </div>
                    <div class="row form-floating my-2">
                        <input class="border-2 bg-transparent form-control form-control-lg " maxlength="11" type="text"
                            name="tel" id="tel" oninput="formTel()" placeholder="Telefone" required>
                        <label class="text-dark-emphasis" for="tel">Telefone:</label>
                    </div>
                    <div class="row my-2">
                        <label class="text-start text-dark-emphasis ">Selecione uma Imagem:</label> <br>
                        <input class="form-control form-control-lg" type="file" name="img" accept=".png, .jpg, .jpeg"
                            id="formFile" placeholder="Escolha">
                    </div>
                    <div class="row my-4 form-floating">
                        <textarea name="coment" id="coment" placeholder="Deixe um Comentario"
                            class="border-2 bg-transparent form-control" style="height: 100px"></textarea>
                        <label class="text-start text-dark-emphasis" for="coment">Comentários:</label>
                    </div>
                </div>
            </div>
            <div class="row my-2">
                <h1 class="text-dark-emphasis text-center fw-bold my-4">Digite a localização da(s) academia(s)</h1>
                <div class="d-flex flex-column align-items-center">
                    <div class="row my-2 w-50 form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " maxlength="9" type="text"
                            name="ceploc" id="ceploc" oninput="formatarCEPloc()" placeholder="CEP" required>
                        <label class="text-start text-dark-emphasis " for="ceploc">CEP:</label>
                    </div>
                    <div class="row my-2 w-50 form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="state"
                            id="state" placeholder="Estado" required readonly>
                        <label class="text-start text-dark-emphasis " for="state">Estado:</label>
                    </div>
                    <div class="row my-2 w-50 form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="city"
                            id="city" placeholder="Cidade" required readonly>
                        <label class="text-start text-dark-emphasis " for="city">Cidade:</label>
                    </div>
                    <div class="row my-2 w-50 form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="rua"
                            id="rua" placeholder="Rua" required readonly>
                        <label class="text-start text-dark-emphasis " for="rua">Rua:</label>
                    </div>
                    <div class="row my-2 w-50">
                        <div class="col-auto w-75 p-0 form-floating">
                            <input class="border-2 bg-transparent form-control form-control-lg " type="text"
                                name="bairro" id="bairro" placeholder="Bairro" required readonly>
                            <label class="text-start text-dark-emphasis " for="ceploc">Bairro:</label>
                        </div>
                        <div class="col-auto w-25 pr-0 form-floating">
                            <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="num"
                                id="num" placeholder="Número" required>
                            <label class="text-start text-dark-emphasis ml-3" for="num">Número:</label>
                        </div>
                    </div>
                    <input
                        class="btn nav-link text-dark-emphasis link-hover border-black mx-1 text-uppercase logcard px-5 py-3 my-5"
                        name="inserir" type="submit" onclick="alertCad('Concluido','Cadastro concluido!')"
                        value="Enviar">
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
</body>

</html>