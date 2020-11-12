<?php
require_once 'databaseConnection.php';

class MysqlConnection implements DatabaseConnection {
    private $mysqlConnection;

    function __construct($mysqlCredentials) {
        $hostname = $mysqlCredentials->getHostname();
        $database = $mysqlCredentials->getDatabase();
        $username = $mysqlCredentials->getUsername();
        $password = $mysqlCredentials->getPassword();
        $this->mysqlConnection = new mysqli($hostname, $username, $password, $database);
    }

    function __destruct() {
        $this->mysqlConnection->close();
    }

    function executeQuery($query) {
        $result = $this->mysqlConnection->query($query);
        return $result;
    }

    function sanitizeString($var) {
        $var = strip_tags($var);
        $var = htmlentities($var);
        if (get_magic_quotes_gpc()) {
          $var = stripslashes($var);
        }
        return $this->mysqlConnection->real_escape_string($var);
    }

    function queryResultToPhpArray($queryResult) {
        $phparray = array();
        while ($row = $queryResult->fetch_array(MYSQLI_ASSOC)) {
          array_push($phparray, $row);
        }
        return $phparray;
    }

    function autoincrementPrimaryKey() {
        return 'INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (id)';
    }

    function defaultTimestamp() {
        return 'TIMESTAMP';
    }

}

?>