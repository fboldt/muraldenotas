<?php
chdir("../");
require_once 'bilhete.php';

$bilhete = new Bilhete();
$bilhetes = $bilhete->getBilhetes();
echo json_encode($bilhetes);

?>