<?php
require_once 'databaseCredentials.php';

class RemotePostgresCredentials implements DatabaseCredentials {
    function getHostname() {
        return 'ec2-54-159-107-189.compute-1.amazonaws.com';
    }
    function getDatabase() {
        return 'd9q8kqci7t6slv';
    }
    function getUsername() {
        return 'whzhsiuwmrjiln';
    }
    function getPassword() {
        return 'c4fee2720e737a3af59d5d7a10f60ac4e278f2794914bad385cbcb6d0c33dd3d';
    }
}

?>
