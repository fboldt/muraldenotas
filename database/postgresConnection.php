<?php

function DBMSConnection() {    
    $hostName = 'ec2-54-159-107-189.compute-1.amazonaws.com';
    $database = 'd9q8kqci7t6slv';
    $userName = 'whzhsiuwmrjiln';
    $password = '5432';
    $mysqlConnection = new mysqli($hostName, $userName, $password, $database);
    return $mysqlConnection;
}

class DatabaseConnection {
    private $DBMSConnection;

    function __construct() {
        $this->DBMSConnection = DBMSConnection();
    }

    function __destruct() {
        $this->DBMSConnection->close();
    }

    function query($query) {
        $result = $this->DBMSConnection->query($query);
        return $result;
    }

    function real_escape_string($var) {
        return $this->DBMSConnection->real_escape_string($var);
    }

    function sanitizeString($var) {
        $var = strip_tags($var);
        $var = htmlentities($var);
        if (get_magic_quotes_gpc()) {
          $var = stripslashes($var);
        }
        return $this->real_escape_string($var);
    }

    static function queryResultToPhpArray($queryResult) {
        $phparray = array();
        while ($row = $queryResult->fetch_array(MYSQLI_ASSOC)) {
          array_push($phparray, $row);
        }
        return $phparray;
    }

}

?>