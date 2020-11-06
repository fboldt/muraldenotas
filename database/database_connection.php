<?php

function DBMSConnection() {    
    $hostName = 'us-cdbr-east-02.cleardb.com';
    $database = 'heroku_aab6fa12ea7243b';
    $userName = 'b4d3f2c3728fa5';
    $password = '2d885664';
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
        return $this->DBMSConnection->query($query);
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
