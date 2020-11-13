<?php
require_once 'iDatabaseConnection.php';

class DatabaseConnection implements IDatabaseConnection {
    private $pgConnection;

    function __construct($postgresCredentials) {
        $hostname = $postgresCredentials->getHostname();
        $database = $postgresCredentials->getDatabase();
        $username = $postgresCredentials->getUsername();
        $password = $postgresCredentials->getPassword();
        $connstring = "host=$hostname dbname=$database user=$username password=$password";
        $this->pgConnection = pg_connect($connstring);
    }

    function __destruct() {
    }

    function executeQuery($query) {
        $result = pg_query($this->pgConnection, $query);
        return $result;
    }

    function sanitizeString($var) {
        $var = strip_tags($var);
        $var = htmlentities($var);
        if (get_magic_quotes_gpc()) {
          $var = stripslashes($var);
        }
        return pg_escape_string($var);
    }

    function queryResultToPhpArray($result) {
        $phparray = array();
        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
          array_push($phparray, $row);
        }
        pg_free_result($result);
        return $phparray;
    }

    function autoincrementPrimaryKey() {
        return ' serial PRIMARY KEY ';
    }

    function defaultTimestamp() {
        return ' TIMESTAMP DEFAULT CURRENT_TIMESTAMP ';
    }

}

?>