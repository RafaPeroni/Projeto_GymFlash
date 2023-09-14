<?php
include_once 'pdoconfig.php';
function function_alert($message,) {
    echo "<script>alert('$message');</script>";
}

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
} catch (PDOException $pe) {
    function_alert("Não foi possível se conectar ao banco de dados $dbname" . $pe->getMessage() );
}
?>