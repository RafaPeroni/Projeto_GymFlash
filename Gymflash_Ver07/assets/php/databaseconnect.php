<?php
include_once 'pdoconfig.php';
function function_alert( $message)
{
    echo "<script>alert('$message');</script>";
}

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    function_alert("Não foi possível se conectar ao banco de dados $dbname" . $e->getMessage());
}
?>