<?php
require_once 'iDatabaseCredentials.php';

class DatabaseCredentials implements IDatabaseCredentials {
    function getHostname() {
        return '127.0.0.1';
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
