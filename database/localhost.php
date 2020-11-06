<?php 
/*
function DBMSConnection() {    
    $hostName = 'localhost';
    $database = 'noteswall';
    $userName = 'francisco';
    $password = 'francisco';
    $mysqlConnection = new mysqli($hostName, $userName, $password, $database);
    return $mysqlConnection;
}
/*/
function DBMSConnection() { 
    $hostName = 'us-cdbr-east-02.cleardb.com';
    $database = 'heroku_aab6fa12ea7243b';
    $userName = 'b4d3f2c3728fa5';
    $password = '2d885664';
    $mysqlConnection = new mysqli($hostName, $userName, $password, $database);
    return $mysqlConnection;
}
//*/
?>
