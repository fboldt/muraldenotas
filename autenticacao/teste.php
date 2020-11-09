<?php
require_once 'autenticacao.php';

function checkautenticacao() {
    $autenticacao = new Autenticacao();
    print_r($autenticacao);

    echo "<br>getUsuario: ";
    print_r($autenticacao->getUsuario());
    echo "<br>checar autenticacao<br>";
    $autenticacao->checarAutenticacao();
}

echo "teste autenticacao.php<br><br>";
checkautenticacao();

$formautenticacao = <<<STR
<form action="api/login.php" method="POST">
<input type="text" size="6" name="login" value="cicrano">
<input type="text" size="6" name="senha" value="123456">
    <input type="submit" value="autenticacao">
</form>
STR;
echo $formautenticacao;

$formsignup = <<<STR
<form action="api/insereusuario.php" method="POST">
    <input type="text" size="6" name="login" value="cicrano">
    <input type="text" size="6" name="senha" value="123456">
    <input type="submit" value="signup">
</form>
STR;
echo $formsignup;

?>