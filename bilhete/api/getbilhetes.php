<?php
header('Access-Control-Allow-Origin: *');
chdir("../");
require_once 'bilhete.php';

$bilhete = new Bilhete();
$bilhetes = $bilhete->getBilhetes();
echo json_encode($bilhetes);

?>