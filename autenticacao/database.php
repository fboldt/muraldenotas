<?php
require_once '../database/connection.php';

class Database {
    private $databaseConnection;

    function __construct() {
        $this->databaseConnection = getDatabaseConnection();
    }

    function sanitizeString($string) {
        return $this->databaseConnection->sanitizeString($string);
    }

    function buscaUsuarioDoBanco($login, $senha) {
        $query = "SELECT * FROM usuarios WHERE senha='$senha' AND login='$login'";
        $result = $this->databaseConnection->executeQuery($query);
        $result = $this->databaseConnection->queryResultToPhpArray($result);
        return $result;  
    }

    function insereUsuarioNoBanco($login, $senha) {
        $query = "INSERT INTO usuarios (login, senha) VALUES ('$login','$senha')";
        $result = $this->databaseConnection->executeQuery($query);
        return $result; 
    }
}

?>