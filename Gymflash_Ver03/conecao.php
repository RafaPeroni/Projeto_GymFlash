<?PHP
$hostname = 'localhost';
$bancodedados = 'gymflash';
$usuario = 'root';
$senha = '';


$conexao =  new mysqli ($hostname, $usuario, $senha, $bancodedados) or die("erro de conexao");


if($conexao->connect_errno){
   
        echo "OPS... EXISTE UM PROBLEMA DE CONEXÃO COM O BANCO DE DADOS";
    
}
 

 


?>

