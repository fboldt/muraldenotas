<?php
require_once 'iDatabaseCredentials.php';

class DatabaseCredentials implements IDatabaseCredentials {
    function getHostname() {
        return 'localhost';
    }
    function getDatabase() {
        return 'muraldenotas';
    }
    function getUsername() {
        return 'francisco';
    }
    function getPassword() {
        return 'francisco';
    }
}

?>
