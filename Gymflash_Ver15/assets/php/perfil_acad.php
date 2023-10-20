<?php
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

if (isset($_POST['cadastraEstrela'])) {
    $quantidade = (int) $_POST['rating'];
    if (isset($_SESSION['Credencial_academia'])) {
        function_alert("Usuários logados como Academias não podem avaliar outras academias");
    } else {
        if ($quantidade <= 0) {
            function_alert("Você deve selecionar pelo menos uma estrela para avaliação");
        } else {
            $ValidaStar = $conn->prepare("SELECT * FROM Avaliacao where id_persona = $persona and  FK_Credencial_academia = $cred");
            $ValidaStar->execute();
            $contveri = $ValidaStar->rowCount();
            if ($contveri >= 1) {

                $stmt = $conn->prepare("UPDATE Avaliacao SET  qnt_estrelas = $quantidade  where FK_Credencial_academia = $cred and  id_persona = $persona ");
                $stmt->execute();
                if ($stmt) {
                    function_alert("Avaliação Alterada com sucesso");
                }
                $quantidade = null;
            } else {
                $stmt = $conn->prepare("INSERT INTO Avaliacao VALUES( default, ?, ?, ?  );");
                $stmt->bindParam(1, $quantidade);
                $stmt->bindParam(2, $persona);
                $stmt->bindParam(3, $cred);
                $stmt->execute();
                if ($stmt) {
                    function_alert("Avaliação Cadastrada com Sucesso");
                }
                $quantidade = null;
            }
        }
    }
}
?>
</style>
<!DOCTYPE html>
<html lang="pt-br">

<body class="p-0">
    <?php
    while ($dados = $busca_acad->fetch(PDO::FETCH_ASSOC) and $dados2 = $busca_loc->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <div class="container">
            <h1 class="text-dark text-center fw-bold my-4">Informações de Conta</h1>
            <form method="post" class="d-flex flex-column" autocomplete="off">
                <div class="row my-2">
                    <div class="col form-floating">
                        <input readonly class="border-2 bg-transparent form-control form-control-lg" type="text" name="nameRep" id="nameRep" placeholder="Nome do Representante" value="<?php echo $dados['Nome_do_representate']; ?>" required>
                        <label class="text-dark ml-3" for="nameRep">Nome do
                            Representante:</label>

                    </div>
                    <div class="col form-floating ml-5">
                        <input readonly class="border-2 bg-transparent form-control form-control-lg" type="text" name="nameAcad" id="nameAcad" placeholder="Nome da Academia" value="<?php echo $dados['Nome_da_academia']; ?>" required>
                        <label class="text-dark ml-3" for="nameAcad">Nome da Academia:</label>

                    </div>
                </div>

                <div class="row my-2">
                    <div class="col form-floating">
                        <input readonly class="border-2 bg-transparent form-control form-control-lg " maxlength="18" type="text" id="cnpj" name="cnpj" oninput readonly="formatarCNPJ()" placeholder="CNPJ" value="<?php echo $dados['CNPJ_academia']; ?>" required>
                        <label class="text-dark ml-3" for="cnpj">CNPJ:</label>

                    </div>
                </div>
                <div class="row my-2">
                    <div class="col form-floating">
                        <input readonly class="border-2 bg-transparent form-control form-control-lg " type="email" name="email_acad" id="email" placeholder="Email" value="<?php echo $dados['Email_academia']; ?>" required>
                        <label class="text-start text-dark ml-3" for="email">Email:</label>

                    </div>
                    <fieldset class="col">
                        <label class="text-start  mb-3 text-dark">Modalidades:</label>
                        <?php
                        $busca_mod = $conn->prepare("SELECT * FROM ModalidadeAcademia WHERE FK_Credencial_academia = :credencial");
                        $busca_mod->bindParam(':credencial', $cred);
                        $busca_mod->execute();
                        while ($dados4 = $busca_mod->fetch(PDO::FETCH_ASSOC)) {
                            $modalidae_atual = $dados4['id_modaldiade'];
                        ?>
                            <div class="d-flex align-items-center my-auto flex-wrap">

                                <div class="border border-danger m-1">
                                    <?php
                                    if ($modalidae_atual == 1) {
                                        $id_modalidade = 1;
                                    ?>
                                        <label value="1">Muay Thai</label>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="border border-danger m-1">
                                    <?php
                                    if ($modalidae_atual == 2) {
                                        $id_modalidade = 2;
                                    ?>
                                        <label value="2" class="mr-3 ml-2">Boxe</label>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div>
                                    <?php
                                    if ($modalidae_atual == 3) {
                                        $id_modalidade = 3;
                                    ?>
                                        <label value="3" class="border border-danger m-1">Dança</label>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div>
                                    <?php
                                    if ($modalidae_atual == 4) {
                                        $id_modalidade = 4;
                                    ?>
                                        <label value="4" class="border border-danger m-1">Spinning</label>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div>
                                    <?php
                                    if ($modalidae_atual == 5) {
                                        $id_modalidade = 5;
                                    ?>
                                        <label value="5" class="border border-danger m-1">Judô</label>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div>
                                    <?php
                                    if ($modalidae_atual == 6) {
                                        $id_modalidade = 6;
                                    ?>
                                        <label value="6" class="border border-danger m-1">Jump</label>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div>
                                    <?php
                                    if ($modalidae_atual == 7) {
                                        $id_modalidade = 7;
                                    ?>
                                        <label value="7" class="border border-danger m-1">Jump</label>
                                    <?php
                                    }
                                    ?>
                                </div>

                            <?php
                        } ?>


                    </fieldset>
                </div>
                <div class="row my-2 w-50 align-self-center">
                    <div class="col">
                        <div class="row form-floating my-2">
                        </div>
                        <div class="row form-floating my-2">
                            <input readonly type="number" class="border-2 bg-transparent form-control form-control-lg " name="numFunc" placeholder="Quantidade de Funcionários" id="numFunc" value="<?php echo $dados['Quant_funcionario']; ?>">
                            <label class="text-dark" for="numFunc">Qnt. funcionários:</label>

                        </div>
                        <div class="row form-floating my-2">
                            <input readonly class="border-2 bg-transparent form-control form-control-lg " maxlength="11" type="text" name="tel" id="tel" oninput readonly="formTel()" placeholder="Telefone" value="<?php echo $dados['Telefone_academia']; ?>" required>
                            <label class="text-dark" for="tel">Telefone:</label>

                        </div>
                        
                        <div class="row my-4 form-floating">
                            <textarea disabled name="coment" id="coment" placeholder="Deixe um Comentario" class="border-2 bg-transparent form-control" style="height: 100px"><?php echo $dados['Comentario']; ?></textarea>
                            <label class="text-start text-dark" for="coment">Comentários:</label>

                        </div>
                    </div>
                </div>
                <!--HORARIOS DA ACADEMIA-->
                <div class="row my-2">

                    <?php
                    $dados3 = $busca_Hora->fetch(PDO::FETCH_ASSOC)
                    ?>
                    <h1 class="text-dark text-center fw-bold my-4">Horários</h1>
                    <div class="row my-2 text-center">
                        <div class="col">
                            Dias da Semana
                        </div>
                        <div class="col">
                            Status
                        </div>
                        <div class="col">
                            Horário de Abertura
                        </div>
                        <div class="col">
                            Horário de Encerramento
                        </div>
                    </div>
                 </div>
                 <!-- Domingo-->
                 <div class="row my-2 text-center align-items-center">
                    <div class="col">
                        Domingo
                    </div>
                    <div class="col">
                        <select disabled name="status1" id="func" class="form-select">

                            <?php
                            $Bus_mod1 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 1");
                            $Bus_mod1->bindParam(':credencial', $cred);
                            $Bus_mod1->execute();
                            $mmod1 = $Bus_mod1->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <option value="<?php echo $mmod1['estatus']; ?>"><?php echo $mmod1['estatus']; ?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input disabled type="time" class="p-3 fs-5 form-control" name="horario-DOMINGO-A" id="horario" value="<?php echo $mmod1['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input disabled type="time" class="p-3 fs-5 form-control" name="horario-DOMINGO-E" id="horario" value="<?php echo $mmod1['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">

                    </div>
                 </div>
                 <!-- Segunda-->
                 <div class="row my-2 text-center align-items-center">

                    <div class="col">
                        Segunda-Feira
                    </div>
                    <div class="col">
                        <select disabled name="status2" id="func" class="form-select">

                            <?php
                            $Bus_mod2 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 2");
                            $Bus_mod2->bindParam(':credencial', $cred);
                            $Bus_mod2->execute();
                            $mmod2 = $Bus_mod2->fetch(PDO::FETCH_ASSOC);
                            ?>

                            <option value="<?php $mmod2['estatus']; ?>"><?php echo $mmod2['estatus']; ?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input disabled type="time" class="p-3 fs-5 form-control" name="horario-SEGUNDA-A" id="horario" value="<?php echo $mmod2['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input disabled type="time" class="p-3 fs-5 form-control" name="horario-SEGUNDA-E" id="horario" value="<?php echo $mmod2['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">

                    </div>
                 </div>
                 <!-- Terça-->
                 <div class="row my-2 text-center align-items-center">
                    <div class="col">
                        Terça-Feira
                    </div>
                    <div class="col">
                        <select disabled name="status3" id="func" class="form-select">
                            <?php
                            $Bus_mod3 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 3");
                            $Bus_mod3->bindParam(':credencial', $cred);
                            $Bus_mod3->execute();
                            $mmod3 = $Bus_mod3->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <option value="<?php $mmod3['estatus']; ?>"><?php echo $mmod3['estatus']; ?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input disabled type="time" class="p-3 fs-5 form-control" name="horario-TERCA-A" id="horario" value="<?php echo $mmod3['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input disabled type="time" class="p-3 fs-5 form-control" name="horario-TERCA-E" id="horario" value="<?php echo $mmod3['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">

                    </div>
                 </div>
                 <!-- Quarta-->
                 <div class="row my-2 text-center align-items-center">
                    <div class="col">
                        Quarta-Feira
                    </div>
                    <div class="col">
                        <select disabled name="status4" id="func" class="form-select">
                            <?php
                            $Bus_mod4 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 4");
                            $Bus_mod4->bindParam(':credencial', $cred);
                            $Bus_mod4->execute();
                            $mmod4 = $Bus_mod4->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <option value="<?php $mmod4['estatus']; ?>"><?php echo $mmod4['estatus']; ?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input disabled type="time" class="p-3 fs-5 form-control" name="horario-QUARTA-A" id="horario" value="<?php echo $mmod4['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input disabled type="time" class="p-3 fs-5 form-control" name="horario-QUARTA-E" id="horario" value="<?php echo $mmod4['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">

                    </div>
                 </div>
                 <!-- Quinta-->
                 <div class="row my-2 text-center align-items-center">
                    <!-- Quinta-->
                    <div class="col">
                        Quinta-Feira
                    </div>
                    <div class="col">
                        <select disabled name="status5" id="func" class="form-select">
                            <?php
                            $Bus_mod5 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 5");
                            $Bus_mod5->bindParam(':credencial', $cred);
                            $Bus_mod5->execute();
                            $mmod5 = $Bus_mod5->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <option value="<?php $mmod5['estatus']; ?>"><?php echo $mmod5['estatus']; ?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input disabled type="time" class="p-3 fs-5 form-control" name="horario-QUINTA-A" id="horario" value="<?php echo $mmod5['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input disabled type="time" class="p-3 fs-5 form-control" name="horario-QUINTA-E" id="horario" value="<?php echo $mmod5['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">

                    </div>
                 </div>
                 <!-- Sexta-->
                 <div class="row my-2 text-center align-items-center">
                    <!-- Sexta-->
                    <div class="col">
                        Sexta-Feira
                    </div>
                    <div class="col">
                        <select disabled name="status6" id="func" class="form-select">
                            <?php
                            $Bus_mod6 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 6");
                            $Bus_mod6->bindParam(':credencial', $cred);
                            $Bus_mod6->execute();
                            $mmod6 = $Bus_mod6->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <option value="<?php $mmod6['estatus']; ?>"><?php echo $mmod6['estatus']; ?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input disabled type="time" class="p-3 fs-5 form-control" name="horario-SEXTA-A" id="horario" value="<?php echo $mmod6['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input disabled type="time" class="p-3 fs-5 form-control" name="horario-SEXTA-E" id="horario" value="<?php echo $mmod6['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">

                    </div>
                 </div>
                 <!-- Sábado-->
                 <div class="row my-2 text-center align-items-center">
                    <div class="col">
                        Sábado
                    </div>
                    <div class="col">
                        <select disabled name="status7" id="func" class="form-select">
                            <?php
                            $Bus_mod7 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 7");
                            $Bus_mod7->bindParam(':credencial', $cred);
                            $Bus_mod7->execute();
                            $mmod7 = $Bus_mod7->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <option value="<?php $mmod7['estatus']; ?>"><?php echo $mmod7['estatus']; ?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input disabled type="time" class="p-3 fs-5 form-control" name="horario-SABADO-A" id="horario" value="<?php echo $mmod7['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input disabled type="time" class="p-3 fs-5 form-control" name="horario-SABADO-E" id="horario" value="<?php echo $mmod7['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">

                    </div>
                </div>
                <!--LOCALIZAÇÃO DA ACADEMIA-->
                <div class="row my-2">
                    <h1 class="text-dark text-center fw-bold my-4">ENDEREÇO : </h1>
                    <div class="d-flex flex-column align-items-center">
                        <div class="row my-2 w-50 form-floating">
                            <input readonly class="border-2 bg-transparent form-control form-control-lg " maxlength="9" type="text" name="ceploc" id="ceploc" oninput readonly="formatarCEPloc()" placeholder="CEP" value="<?php echo $dados2['CEP_academia']; ?>">
                            <label>CEP:</label>

                        </div>
                        <div class="row my-2 w-50 form-floating">
                            <input readonly class="border-2 bg-transparent form-control form-control-lg " type="text" name="state" id="state" placeholder="Estado" value="<?php echo $dados2['Estado_academia']; ?>" readonly>
                            <label>Estado:</label>
                        </div>
                        <div class="row my-2 w-50 form-floating">
                            <input readonly class="border-2 bg-transparent form-control form-control-lg " type="text" name="city" id="city" placeholder="Cidade" value="<?php echo $dados2['Cidade_academia']; ?>" readonly>
                            <label>Cidade:</label>
                        </div>
                        <div class="row my-2 w-50 form-floating">
                            <input readonly class="border-2 bg-transparent form-control form-control-lg " type="text" name="rua" id="rua" placeholder="Rua" value="<?php echo $dados2['Rua_academia']; ?>" readonly>
                            <label>Rua:</label>
                        </div>
                        <div class="row my-2 w-50">
                            <div class="col-auto w-75 p-0 form-floating">
                                <input readonly class="border-2 bg-transparent form-control form-control-lg " type="text" name="bairro" id="bairro" placeholder="Bairro" value="<?php echo $dados2['Bairro_academia']; ?>" readonly>
                                <label>Bairro:</label>
                            </div>
                            <div class="col-auto w-25 p-0 form-floating" style="padding-left: 10px !important;">
                                <input readonly class="border-2 bg-transparent form-control form-control-lg " type="text" name="num" id="num" placeholder="Número" value="<?php echo $dados2['Num_academia']; ?>">
                                <label class="ml-3">Número:</label>
                            </div>
                        </div>
                        <div class="col-auto w-50 pr-0 form-floating">
                            <input readonly class="border-2 bg-transparent form-control form-control-lg " type="text" name="complemento" id="num" placeholder="Complemento" value="<?php echo $dados2['Complemento_academia']; ?>">
                            <label>Complemento:</label>
                        </div>
                    </div>
                </div>
                <!--Avaliação de 5 estrelas && Exibição da média-->
                <div class="d-flex flex-column align-items-center">
                <h1 class="text-dark text-center fw-bold my-4">AVALIAÇÃO DA ACADEMIA : </h1>
                    <form action="" method="post">
                        <div class="d-flex flex-column align-items-center">
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
                            <div class="estrelas">
                                <input type="radio" id="cm_star-empty" name="rating" value="" checked />
                                <label for="cm_star-1"><i class="fa"></i></label>
                                <input type="radio" id="cm_star-1" name="rating" value="1" />
                                <label for="cm_star-2"><i class="fa"></i></label>
                                <input type="radio" id="cm_star-2" name="rating" value="2" />
                                <label for="cm_star-3"><i class="fa"></i></label>
                                <input type="radio" id="cm_star-3" name="rating" value="3" />
                                <label for="cm_star-4"><i class="fa"></i></label>
                                <input type="radio" id="cm_star-4" name="rating" value="4" />
                                <label for="cm_star-5"><i class="fa"></i></label>
                                <input type="radio" id="cm_star-5" name="rating" value="5" />
                            </div>
                            <!-- Add more stars here if needed -->
                            <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3" type="submit"value="Avaliar agora" name="cadastraEstrela">
                            <div class="text-dark btn link-hover border-black text-uppercase logcard px-5 py-3 mt-3">
                                Média atual de avaliações:
                                <?php
                                $constar = $conn->prepare("SELECT round(AVG(qnt_estrelas),1) FROM  Avaliacao where FK_Credencial_academia = $cred");
                                $constar->execute();


                                $mediaAv = $constar->fetch(PDO::FETCH_ASSOC);
                                echo $mediaAv['round(AVG(qnt_estrelas),1)'];
                                ?>
                            </div>

                            
                        </div>

                    </form>
                </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script>
            <?php include_once("assets/js/main.js") ?>
        </script>
        <script>
            <?php include_once("assets/js/cep.js") ?>
        </script>
    <?php } ?>
</body>

</html>