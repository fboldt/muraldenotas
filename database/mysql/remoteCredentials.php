<?php
require_once 'iDatabaseCredentials.php';

class DatabaseCredentials implements IDatabaseCredentials {
    function getHostname() {
        return 'us-cdbr-east-02.cleardb.com';
    }
    function getDatabase() {
        return 'heroku_aab6fa12ea7243b';
    }
    function getUsername() {
        return 'b4d3f2c3728fa5';
    }
    function getPassword() {
        return '2d885664';
    }
}

?>
