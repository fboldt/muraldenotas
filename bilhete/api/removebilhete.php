<?php
chdir("../");
require_once 'bilhete.php';

$bilhete = new Bilhete();
$bilid = $_POST['bilid'];
$retorno = $bilhete->removeBilhete($bilid);
echo !empty($retorno);

?>