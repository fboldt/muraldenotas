<?php 

function DBMSConnection() {    
    $hostName = 'sql310.epizy.com';
    $database = 'epiz_26152445_authentication';
    $userName = 'epiz_26152445';
    $password = 'RBFgQtOuOj';
    $mysqlConnection = new mysqli($hostName, $userName, $password, $database);
    return $mysqlConnection;
}
    
?>