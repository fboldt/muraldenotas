<?php
require_once 'databaseCredentials.php';

class LocalPostgresCredentials implements DatabaseCredentials {
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
