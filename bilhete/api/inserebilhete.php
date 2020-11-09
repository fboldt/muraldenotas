<?php
header('Access-Control-Allow-Origin: *');
chdir("../");
require_once 'bilhete.php';

$bilhete = new Bilhete();
$texto = $_POST['texto'];
$retorno = $bilhete->insereBilhete($texto);
print_r($retorno);

?>