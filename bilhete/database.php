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

    function buscaBilhetesDoBanco() {
        $query = "SELECT * FROM mensagens";
        $result = $this->databaseConnection->query($query);
        $result = DatabaseConnection::queryResultToPhpArray($result);
        return $result;  
    }

    function buscaBilheteDoBanco($bilid) {
        $query = "SELECT * FROM mensagens WHERE id=$bilid";
        $result = $this->databaseConnection->query($query);
        $result = DatabaseConnection::queryResultToPhpArray($result);
        return $result;  
    }

    function insereBilheteNoBanco($usuid, $texto) {
        $texto = $this->sanitizeString($texto);
        $query = "INSERT INTO mensagens (usuid, texto) VALUES ($usuid,'$texto')";
        $result = $this->databaseConnection->query($query);
        return $result; 
    }

    function removeBilheteNoBanco($bilid) {
        $bilid = $this->sanitizeString($bilid);
        $query = "DELETE FROM mensagens WHERE id='$bilid'";
        $result = $this->databaseConnection->query($query);
        return $result;  
    }

}

?>