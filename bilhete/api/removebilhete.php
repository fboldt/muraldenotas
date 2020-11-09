<?php
header('Access-Control-Allow-Origin: *');
chdir("../");
require_once 'bilhete.php';

$bilhete = new Bilhete();
$bilid = $_POST['bilid'];
$retorno = $bilhete->removeBilhete($bilid);
print_r($retorno);

?>