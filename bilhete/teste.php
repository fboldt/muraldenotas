<?php
require_once 'bilhete.php';
require_once '../extras/somentedesenvolvimento.php';

function getBilhetes() {
    $bilhete = new Bilhete();
    print_r($bilhete);
    echo "<br><br>";
    $bilhetes = $bilhete->getBilhetes();
    print_r($bilhetes);
}

getBilhetes();

function getUsuid() {
    $autenticacao = new Autenticacao();
    $usuario = $autenticacao->getUsuario();
    return $usuario['usuid'];
}
$usuid = getUsuid();
echo "<br>$usuid<br>";

$form = <<<STR
<form action="api/inserebilhete.php" method="POST">
<input type="text" name="texto" value="teste insere mensagem">
    <input type="submit" value="inserir">
</form>
STR;
echo $form;

$form = <<<STR
<form action="api/removebilhete.php" method="POST">
Id do bilhete: <input type="text" name="bilid">
    <input type="submit" value="remover">
</form>
STR;
echo $form;


?>