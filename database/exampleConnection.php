<?php
function DBMSConnection() {    
    $hostName = 'endereço do servidor (ex.: localhost)';
    $database = 'nome da base de dados (ex.: dbmuraldenotas';
    $userName = 'nome de usuário autorizado no BD';
    $password = 'senha do usuário';
    $mysqlConnection = new mysqli($hostName, $userName, $password, $database);
    return $mysqlConnection;
}
?>