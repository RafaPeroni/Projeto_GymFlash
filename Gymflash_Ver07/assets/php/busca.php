<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include_once 'databaseconnect.php';
$count=0;
$busca_acad = $conn->prepare("SELECT * FROM CadastroAcademia ");
$busca_acad->execute();
if(isset($_POST['BTN-Search'])){
    $name_search=  (string)$_POST['txt-Search'];
    $name = $name_search;
    if(strlen($name_search) <= 0)
    {
        $NOME_VAZIO ="DIGITE ALGO PARA PESQUISAR";
    }
    else
    {
        $veri_acad= $conn->prepare("SELECT * FROM CadastroAcademia where Nome_da_academia like  ?");
        $veri_acad->bindValue(1, $name_search . '%');
        $veri_acad->execute();
        $count = $veri_acad->rowCount();
        $name_search =null;

    }
}
if(isset($_POST['detalhe'])){
    $cred= $_POST['detalhe'];
   
    header("Location: resultados.php?cred=$cred");
}
//botão para voltar para PAGINA INICIAL
if(isset($_POST['voltar'])){
    $cred= $_POST['detalhe'];
   
    header("Location: /Gymflash_Ver04/index.php");
    exit;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
<CENTER>
    <label for="">BUSQUE SUA ACADEMIA </label><br>
    <input type="search" name='txt-Search'>
    <input value="BUSCAR" type="submit" name='BTN-Search' ><br><br>
    <label for="">
     
     <?php
         
         if(isset($_POST['BTN-Search']))
         {
            if(strlen($name) <= 0){
                ECHO"$NOME_VAZIO";
            }
         if(strlen($name) > 0 && $count <= 0)
        {            
    ?>      
            NÃO EXISTEM ACADEMIAS CADASTRADAS COM ESTE Nome
        <?php
            }
            if(strlen($name) > 0 && $count > 0) {
            ?>
            Existem "<?php echo $count?>" ACADEMIAS CADASTRADAS COM ESSE NOME
        <?php
            
        
        
        
     ?>
     </label>   

     <br><br><br>
     <label for="">
     <table border="10">
            <?php
        while($dados = $busca_acad ->fetch(PDO::FETCH_ASSOC)){
            if(isset($veri_acad))
                { ?>
            <tr>
                <td>Credencial_academia</td>
                <td>Nome da academia</td>
                <td>Nome do representante</td>
            </tr>
            <tr>
                <td><?php $cred= $dados['Credencial_academia'] ; echo $dados['Credencial_academia'] ;?></td>
                <td><?php echo $dados['Nome_da_academia'] ;?></td>
                <td><?php echo $dados['Nome_do_representate'] ;?></td>
                <td><form action="" method="post"><input type="submit" name="detalhe" value="<?php echo $cred;?>"  ></form></td>
            </tr>   
            <?php 
            }
      }
    }
}   
            ?>
            
        </table>
    </label>



</CENTER>
<input type="submit" value="voltar" name="voltar">
</form>
</body>
</html>