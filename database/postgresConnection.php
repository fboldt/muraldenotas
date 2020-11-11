<?php
require_once 'databaseConnection.php';

class PostgresConnection implements DatabaseConnection {
    private $pgConnection;

    function __construct() { 
        $hostName = 'ec2-54-159-107-189.compute-1.amazonaws.com';
        $database = 'd9q8kqci7t6slv';
        $userName = 'whzhsiuwmrjiln';
        $password = 'c4fee2720e737a3af59d5d7a10f60ac4e278f2794914bad385cbcb6d0c33dd3d';
        $connlocal = "host=127.0.0.1 dbname=muraldenotas user=francisco password=francisco";
        $connremote = "host=$hostName dbname=$database user=$userName password=$password";
        $connstring = $connlocal;
        $this->pgConnection = pg_connect($connstring);
    }

    function __destruct() {
        pg_close($this->pgConnection);
    }

    function executeQuery($query) {
        $result = pg_query($query);
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