<?php
chdir("../");
require_once 'bilhete.php';

$bilhete = new Bilhete();
$texto = $_POST['texto'];
$retorno = $bilhete->insereBilhete($texto);
echo !empty($retorno);

?>