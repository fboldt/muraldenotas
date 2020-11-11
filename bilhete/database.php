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

    function buscaBilhetesDoBanco() {
        $query = "SELECT usuarios.id AS usuid, usuarios.login, mensagens.id AS bilid, mensagens.texto, mensagens.tempo FROM mensagens INNER JOIN usuarios ON usuarios.id = mensagens.usuid ORDER BY tempo";
        $result = $this->databaseConnection->executeQuery($query);
        $result = $this->databaseConnection->queryResultToPhpArray($result);
        return $result;  
    }

    function buscaBilheteDoBanco($bilid) {
        $query = "SELECT * FROM mensagens WHERE id=$bilid";
        $result = $this->databaseConnection->executeQuery($query);
        $result = $this->databaseConnection->queryResultToPhpArray($result);
        return $result;  
    }

    function insereBilheteNoBanco($usuid, $texto) {
        $texto = $this->sanitizeString($texto);
        $query = "INSERT INTO mensagens (usuid, texto) VALUES ($usuid,'$texto')";
        $result = $this->databaseConnection->executeQuery($query);
        return $result; 
    }

    function removeBilheteNoBanco($bilid) {
        $bilid = $this->sanitizeString($bilid);
        $query = "DELETE FROM mensagens WHERE id='$bilid'";
        $result = $this->databaseConnection->executeQuery($query);
        return $result;  
    }

}

?>