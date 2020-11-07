<?php
require_once '../database/database_connection.php';

class Database {
    private $databaseConnection;

    function __construct() {
        $this->databaseConnection = new DatabaseConnection();
    }

    function sanitizeString($string) {
        return $this->databaseConnection->sanitizeString($string);
    }

    function buscaUsuarioDoBanco($login, $senha) {
        $query = "SELECT * FROM usuarios WHERE senha='$senha' AND login='$login'";
        $queryResult = $this->databaseConnection->query($query);
        $phpArrayResult = DatabaseConnection::queryResultToPhpArray($queryResult);
        return $phpArrayResult;  
    }

    function insereUsuarioNoBanco($login, $senha) {
        $query = "INSERT INTO usuarios (login, senha) VALUES ('$login','$senha')";
        $result = $this->databaseConnection->query($query);
        return $result; 
    }
}

?>