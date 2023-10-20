<?php

include_once 'assets/php/databaseconnect.php';
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['Credencial_academia'])) {
    die("Você não pode acessar esta página porque não está logado. <p><a href=\"./index.php\">RETORNAR</a></p>");
}

include_once('alteracao.php');



if (isset($_POST['desconectar'])) {
    session_destroy();
    die("Você foi deslogado com sucesso.<a href=\"index.php\">RETORNAR</a>");
}
//CONEÇÃO CADASTRO
$busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia WHERE Credencial_academia = :credencial");
$busca_acad->bindParam(':credencial', $_SESSION['Credencial_academia']);
$busca_acad->execute();
//CONEÇÃO LOCALIZAÇÃO
$busca_loc = $conn->prepare("SELECT * FROM EnderecoAcademia WHERE FK_Credencial_academia = :credencial");
$busca_loc->bindParam(':credencial', $_SESSION['Credencial_academia']);
$busca_loc->execute();
//CONEÇÃO HORÁRIO
$busca_Hora = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial");
$busca_Hora->bindParam(':credencial', $_SESSION['Credencial_academia']);
$busca_Hora->execute();
//CONEÇÃO MODALIDADE
$busca_mod = $conn->prepare("SELECT * FROM ModalidadeAcademia WHERE FK_Credencial_academia = :credencial");
$busca_mod->bindParam(':credencial', $_SESSION['Credencial_academia']);
$busca_mod->execute();
?>

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
                        <input class="border-2 bg-transparent form-control form-control-lg" type="text" name="nameRep"
                            id="nameRep" placeholder="Nome do Representante"
                            value="<?php echo $dados['Nome_do_representate']; ?>" required>
                        <label class="text-dark ml-3" for="nameRep">Nome do
                            Representante:</label>
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3"
                            type="submit" value="Alterar nome do representante" name='representante'>
                    </div>
                    <div class="col form-floating ml-5">
                        <input class="border-2 bg-transparent form-control form-control-lg" type="text" name="nameAcad"
                            id="nameAcad" placeholder="Nome da Academia" value="<?php echo $dados['Nome_da_academia']; ?>"
                            required>
                        <label class="text-dark ml-3" for="nameAcad">Nome da Academia:</label>
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3"
                            type="submit" value="Alterar nome do academia" name='academia'>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="senha_acad"
                            id="senha" minlength="8" maxlength="32" placeholder="Senha"
                            value="<?php echo $dados['Senha_academia']; ?>" required>
                        <label class="text-dark ml-3" for="senha">Senha:</label>
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3"
                            type="submit" value="Alterar senha" name='senha'>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " maxlength="18" type="text"
                            id="cnpj" name="cnpj" oninput="formatarCNPJ()" placeholder="CNPJ"
                            value="<?php echo $dados['CNPJ_academia']; ?>" required>
                        <label class="text-dark ml-3" for="cnpj">CNPJ:</label>
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3"
                            type="submit" value="Alterar cnpj" name='cnpj_submit'>
                    </div>
                    <div class="col form-floating">
                        <select class="bg-cad border-0 form-select " name="selct_mod" id="func">
                            <?php
                            while ($dados4 = $busca_mod->fetch(PDO::FETCH_ASSOC)) {
                                $modalidae_atual = $dados4['id_modaldiade'];

                                if ($modalidae_atual == 1) {
                                    $id_modalidade = 1;
                                    ?>
                                    <option value="1">Muay Thai</option>
                                    <?php
                                }
                                if ($modalidae_atual == 2) {
                                    $id_modalidade = 2;
                                    ?>
                                    <option value="2">BOXE</option>
                                    <?php
                                }
                                if ($modalidae_atual == 3) {
                                    $id_modalidade = 3;
                                    ?>
                                    <option value="3">Dança</option>
                                <?php }
                                if ($modalidae_atual == 4) {
                                    $id_modalidade = 4;
                                    ?>
                                    <option value="4>">Spinning</option>
                                <?php }
                                if ($modalidae_atual == 5) {
                                    $id_modalidade = 5;
                                    ?>
                                    <option value="5">Judô</option>
                                <?php }
                                if ($modalidae_atual == 6) {
                                    $id_modalidade = 6;
                                    ?>
                                    <option value="6">Jump</option>
                                <?php }
                                if ($modalidae_atual == 7) {
                                    $id_modalidade = 7;
                                    ?>
                                    <option value="7">Crossfit</option>
                                <?php }
                                if ($modalidae_atual == 8) {
                                    $id_modalidade = 8;
                                    ?>
                                    <option value="8">Taekwendô</option>

                                <?php }
                            } ?>
                        </select>
                        <label class="text-start text-dark ml-3" for="selct_mod">Modalidades Deletar:</label>
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3"
                            type="submit" name="delet_mod" value="Deletar modalidade">
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " type="email" name="email_acad"
                            id="email" placeholder="Email" value="<?php echo $dados['Email_academia']; ?>" required>
                        <label class="text-start text-dark ml-3" for="email">Email:</label>
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3"
                            type="submit" value="ALTERAR EMAIL" name='email'>
                    </div>
                    <fieldset class="col">
                        <label class="text-start  mb-3 text-dark">Modalidades:</label>
                        <div class="d-flex align-items-center my-auto flex-wrap">
                            <div>
                                <input type="checkbox" name="check-muaythai" id="muait">
                                <label for="muait" class="mr-3 ml-2">Muay Thai</label>
                            </div>
                            <div>
                                <input type="checkbox" name="check-boxe" id="boxe">
                                <label for="boxe" class="mr-3 ml-2">Boxe</label>
                            </div>
                            <div>
                                <input type="checkbox" name="chek-danca" id="danca">
                                <label for="danca" class="mr-3 ml-2">Dança</label>
                            </div>
                            <div>
                                <input type="checkbox" name="check-spinning" id="spinning">
                                <label for="spinning" class="mr-3 ml-2">Spinning</label>
                            </div>
                            <div>
                                <input type="checkbox" name="check-judo" id="judo">
                                <label for="judo" class="mr-3 ml-2">Judô</label>
                            </div>
                            <div>
                                <input type="checkbox" name="check-taekwendo" id="taekwendo">
                                <label for="taekwendo" class="mr-3 ml-2">Taekwendô</label>
                            </div>
                            <div>
                                <input type="checkbox" name="check-jump" id="jump">
                                <label for="jump" class="mr-3 ml-2">Jump</label>
                            </div>
                            <div>
                                <input type="checkbox" name="check-crossfit" id="crossfit">
                                <label for="crossfit">Crossfit</label>
                            </div>
                        </div>
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3"
                            type="submit" name='modadd' value="Adicionar">
                    </fieldset>
                </div>
                <div class="row my-2 w-50 align-self-center">
                    <div class="col">
                        <div class="row form-floating my-2">
                        </div>
                        <div class="row form-floating my-2">
                            <input type="number" class="border-2 bg-transparent form-control form-control-lg "
                                name="numFunc" placeholder="Quantidade de Funcionários" id="numFunc"
                                value="<?php echo $dados['Quant_funcionario']; ?>">
                            <label class="text-dark" for="numFunc">Qnt. funcionários:</label>
                            <input
                                class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3"
                                type="submit" value="Alterar quantidade de funcionários" name='funcionarios'>
                        </div>
                        <div class="row form-floating my-2">
                            <input class="border-2 bg-transparent form-control form-control-lg " maxlength="11" type="text"
                                name="tel" id="tel" oninput="formTel()" placeholder="Telefone"
                                value="<?php echo $dados['Telefone_academia']; ?>" required>
                            <label class="text-dark" for="tel">Telefone:</label>
                            <input
                                class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3"
                                type="submit" value="Alterar telefone" name='telefone'>
                        </div>
                        
                        <div class="row my-4 form-floating">
                            <textarea name="coment" id="coment" placeholder="Deixe um Comentario"
                                class="border-2 bg-transparent form-control"
                                style="height: 100px"><?php echo $dados['Comentario']; ?></textarea>
                            <label class="text-start text-dark" for="coment">Comentários:</label>
                            <input
                                class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3"
                                type="submit" value="Alterar Comentario" name='comentarios'>
                        </div>
                    </div>
                </div>
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
                        <select name="status1" id="func" class="form-select">
                            
                                <?php
                                $Bus_mod1 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 1");
                                $Bus_mod1->bindParam(':credencial', $_SESSION['Credencial_academia']);
                                $Bus_mod1->execute();
                                $mmod1 = $Bus_mod1->fetch(PDO::FETCH_ASSOC);
                                ?>
                            <option value="<?php echo $mmod1['estatus']; ?>"><?php echo $mmod1['estatus']; ?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-DOMINGO-A" id="horario"
                            value="<?php echo $mmod1['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-DOMINGO-E" id="horario"
                            value="<?php echo $mmod1['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3 w-25"
                            type="submit" name="alter-day1" value="Confirmar dia">
                    </div>
                 </div>
                <!-- Segunda-->
                 <div class="row my-2 text-center align-items-center"> 
                
                    <div class="col">
                        Segunda-Feira
                    </div>
                    <div class="col">
                        <select name="status2" id="func" class="form-select">
                             
                                <?php
                                 $Bus_mod2 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 2");
                                 $Bus_mod2->bindParam(':credencial', $_SESSION['Credencial_academia']);
                                 $Bus_mod2->execute();
                                 $mmod2 = $Bus_mod2->fetch(PDO::FETCH_ASSOC);
                                   ?>
                             
                             <option value="<?php  $mmod2['estatus'];?>"><?php echo $mmod2['estatus'];?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-SEGUNDA-A" id="horario"
                            value="<?php echo $mmod2['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-SEGUNDA-E" id="horario"
                            value="<?php echo $mmod2['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3 w-25"
                            type="submit" name="alter-day2" value="Confirmar dia">
                    </div>
                 </div>
                <!-- Terça-->
                 <div class="row my-2 text-center align-items-center"> 
                    <div class="col">
                        Terça-Feira
                    </div>
                    <div class="col">
                        <select name="status3" id="func" class="form-select">
                            <?php
                                 $Bus_mod3 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 3");
                                 $Bus_mod3->bindParam(':credencial', $_SESSION['Credencial_academia']);
                                 $Bus_mod3->execute();
                                 $mmod3 = $Bus_mod3->fetch(PDO::FETCH_ASSOC);
                                 ?>
                                 <option value="<?php  $mmod3['estatus']; ?>"><?php echo $mmod3['estatus']; ?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-TERCA-A" id="horario"
                            value="<?php echo $mmod3['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-TERCA-E" id="horario"
                            value="<?php echo $mmod3['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3 w-25"
                            type="submit" name="alter-day3" value="Confirmar dia">
                    </div>
                 </div>
                <!-- Quarta--> 
                 <div class="row my-2 text-center align-items-center"> 
                    <div class="col">
                        Quarta-Feira
                    </div>
                    <div class="col">
                        <select name="status4" id="func" class="form-select">
                        <?php
                                 $Bus_mod4 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 4");
                                 $Bus_mod4->bindParam(':credencial', $_SESSION['Credencial_academia']);
                                 $Bus_mod4->execute();
                                 $mmod4 = $Bus_mod4->fetch(PDO::FETCH_ASSOC);
                                 ?>
                                 <option value="<?php  $mmod4['estatus']; ?>"><?php echo $mmod4['estatus']; ?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-QUARTA-A" id="horario"
                            value="<?php echo $mmod4['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-QUARTA-E" id="horario"
                            value="<?php echo $mmod4['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3 w-25"
                            type="submit" name="alter-day4" value="Confirmar dia">
                    </div>
                 </div>
                <!-- Quinta-->
                 <div class="row my-2 text-center align-items-center"> <!-- Quinta-->
                    <div class="col">
                        Quinta-Feira
                    </div>
                    <div class="col">
                        <select name="status5" id="func" class="form-select">
                        <?php
                                 $Bus_mod5 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 5");
                                 $Bus_mod5->bindParam(':credencial', $_SESSION['Credencial_academia']);
                                 $Bus_mod5->execute();
                                 $mmod5 = $Bus_mod5->fetch(PDO::FETCH_ASSOC);
                                 ?>
                                 <option value="<?php  $mmod5['estatus']; ?>"><?php echo $mmod5['estatus']; ?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-QUINTA-A" id="horario"
                            value="<?php echo $mmod5['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-QUINTA-E" id="horario"
                            value="<?php echo $mmod5['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3 w-25"
                            type="submit" name="alter-day5" value="Confirmar dia">
                    </div>
                 </div>
                <!-- Sexta-->
                 <div class="row my-2 text-center align-items-center"> <!-- Sexta-->
                    <div class="col">
                        Sexta-Feira
                    </div>
                    <div class="col">
                        <select name="status6" id="func" class="form-select">
                        <?php
                                 $Bus_mod6 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 6");
                                 $Bus_mod6->bindParam(':credencial', $_SESSION['Credencial_academia']);
                                 $Bus_mod6->execute();
                                 $mmod6 = $Bus_mod6->fetch(PDO::FETCH_ASSOC);
                                 ?>
                                 <option value="<?php  $mmod6['estatus']; ?>"><?php echo $mmod6['estatus']; ?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-SEXTA-A" id="horario"
                            value="<?php echo $mmod6['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-SEXTA-E" id="horario"
                            value="<?php echo $mmod6['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">
                        <input
                            class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3 w-25"
                            type="submit" name="alter-day6" value="Confirmar dia">
                    </div>
                 </div>
                <!-- Sábado-->
                 <div class="row my-2 text-center align-items-center"> 
                    <div class="col">
                        Sábado
                    </div>
                    <div class="col">
                        <select name="status7" id="func" class="form-select">
                        <?php
                                 $Bus_mod7 = $conn->prepare("SELECT * FROM ExpedienteAcademia WHERE FK_Credencial_academia = :credencial AND Dia_semana = 7");
                                 $Bus_mod7->bindParam(':credencial', $_SESSION['Credencial_academia']);
                                 $Bus_mod7->execute();
                                 $mmod7 = $Bus_mod7->fetch(PDO::FETCH_ASSOC);
                                 ?>
                                 <option value="<?php  $mmod7['estatus']; ?>"><?php echo $mmod7['estatus']; ?></option>
                            <option value="Fechado">Fechado</option>
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-SABADO-A" id="horario"
                            value="<?php echo $mmod7['Hora_abertura_academia']; ?>">
                    </div>
                    <div class="col">
                        <input type="time" class="p-3 fs-5 form-control" name="horario-SABADO-E" id="horario"
                            value="<?php echo $mmod7['Hora_fechamento_academia']; ?>">
                    </div>
                    <div class="row justify-content-center">
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3 w-25"
                            type="submit" name="alter-day7" value="Confirmar dia">
                    </div>
                 </div>
      <!--LOCALIZAÇÃO DA ACADEMIA-->
      <div class="row my-2">
                <h1 class="text-dark text-center fw-bold my-4">Digite a localização da(s) academia(s)</h1>
                <div class="d-flex flex-column align-items-center">
                    <div class="row my-2 w-50 form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " maxlength="9" type="text"
                            name="ceploc" id="ceploc" oninput="formatarCEPloc()" placeholder="CEP" >
                        <label >CEP:  <?php echo $dados2['CEP_academia'];?></label>
                        
                    </div>
                    <div class="row my-2 w-50 form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="state"
                            id="state" placeholder="Estado"  readonly>
                            <label >ESTADO:  <?php echo $dados2['Estado_academia'];?></label>
                    </div>
                    <div class="row my-2 w-50 form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="city"
                            id="city" placeholder="Cidade"  readonly>
                            <label >CIDADE:  <?php echo $dados2['Cidade_academia'];?></label>
                    </div>
                    <div class="row my-2 w-50 form-floating">
                        <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="rua"
                            id="rua" placeholder="Rua"  readonly>
                            <label >RUA:  <?php echo $dados2['Rua_academia'];?></label>
                    </div>
                    <div class="row my-2 w-50">
                        <div class="col-auto w-75 p-0 form-floating">
                            <input class="border-2 bg-transparent form-control form-control-lg " type="text"
                                name="bairro" id="bairro" placeholder="Bairro"  readonly>
                                <label >BAIRRO:  <?php echo $dados2['Bairro_academia'];?></label>
                        </div>
                        <div class="col-auto w-25 pr-0 form-floating">
                            <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="num"
                                id="num" placeholder="Número" >
                                <label >NMR:  <?php echo $dados2['Num_academia'];?></label>
                        </div>
                    </div>
                    <div class="col-auto w-25 pr-0 form-floating">
                            <input class="border-2 bg-transparent form-control form-control-lg " type="text" name="complemento"
                                id="num" placeholder="Número" >
                                <label >Complemento:  <?php echo $dados2['Complemento_academia'];?></label>
                        </div>
                       
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3" type="submit" value="Alterar Endereço" name='endereco2'>
                   
                    </div>
                </div>
                <form action="" method="post" class="row">
                    <div class="col d-flex justify-content-center">
                        <input class="btn nav-link text-dark link-hover border-black text-uppercase logcard px-5 py-3 mt-3" type="submit" value="desconectar" name="desconectar">
                   

                    
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