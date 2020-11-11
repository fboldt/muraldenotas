<?php
require_once 'databaseConnection.php';

class mysqlConnection implements DatabaseConnection {
    private $mysqlConnection;

    function __construct() {
        $hostName = 'endereço do servidor (ex.: localhost)';
        $database = 'nome da base de dados (ex.: dbmuraldenotas';
        $userName = 'nome de usuário autorizado no BD';
        $password = 'senha do usuário';
        $this->mysqlConnection = new mysqli($hostName, $userName, $password, $database);
    }

    function executeQuery($query) {
        return $result;
    }
    function sanitizeString($var) {
    }

    function queryResultToPhpArray($queryResult) {
        return $phparray;
    }

}

?>