<?php
include_once 'databaseconnect.php';
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

//CRUD - Insert
try {
    $stmt = $conn->prepare('INSERT INTO CadastroAcademia (Credencial_academia, Nome_da_academia, Nome_do_representate, CNPJ_academia, Email_academia, Senha_academia, Telefone_academia, Quant_funcionario, Comentario) VALUES(:Credencial_academia, :Nome_da_academia, :Nome_do_representate, :CNPJ_academia, :Email_academia, :Senha_academia, :Telefone_academia, :Quant_funcionario, :Comentario)');
    $stmt->execute(
        array(
            ':Credencial_academia' => NULL,
            ':Nome_da_academia' => '1',
            ':Nome_do_representate' => '1',
            ':CNPJ_academia' => '1',
            ':Email_academia' => '1',
            ':Senha_academia' => '1',
            ':Telefone_academia' =>'1',
            ':Quant_funcionario' => '1',
            ':Comentario' => '1'
        )
    );
    function_alert("Cadastrado com sucesso");
} catch (PDOException $e) {
    function_alert("Lamentamos houve algum erro inesperado! - Tente novamente em outro Horário");
}
//CRUD - Update
try {
    $stmt = $conn->prepare('UPDATE minhaTabela SET nome = :nome WHERE id = :id');
    $stmt->execute(
        array(
            ':id' => $id,
            ':nome' => $nome
        )
    );

    function_alert("Dados Atualizados com sucesso!");
} catch (PDOException $e) {
    function_alert("Lamentamos houve algum erro inesperado! - Tente novamente em outro Horário");
}
//CRUD - Delete

try {
    $stmt = $conn->prepare('DELETE FROM minhaTabela WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    function_alert("Conta Deletada com sucesso");
} catch (PDOException $e) {
    function_alert("Lamentamos houve algum erro inesperado! - Tente novamente em outro Horário");
}
?>