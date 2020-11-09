<?php
require_once 'database.php';
require_once '../autenticacao/autenticacao.php';

class Bilhete {
    private $database;

    function __construct() {
        $this->database = new Database();
    }

    function getBilhetes() {
        $bilhetes = $this->database->buscaBilhetesDoBanco();
        return $bilhetes;
    }

    private function getUsuid() {
        $autenticacao = new Autenticacao();
        $usuario = $autenticacao->getUsuario();
        return $usuario['usuid'];
    }

    function insereBilhete($texto) {
        $usuid = $this->getUsuid();
        if ($usuid > 0) {
            return $this->database->insereBilheteNoBanco($usuid, $texto);
        }
        return 0;
    }

    private function getUsuidDeBilhete($bilid) {
        $bilhete = $this->database->buscaBilheteDoBanco($bilid);
        return $bilhete[0]["usuid"];
    }

    function removeBilhete($bilid) {
        $usuid = $this->getUsuid();
        $bilhete_usuid = $this->getUsuidDeBilhete($bilid);
        if ($usuid == $bilhete_usuid) {
            return $this->database->removeBilheteNoBanco($bilid);
        }
        return 0;
    }

}

?>