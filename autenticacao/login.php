<?php
require_once 'database.php';

session_start();

class Login {
    private $database;
    private $login;
    private $senha;

    function __construct() {
        $this->database = new Database();
        $this->login = "";
        $this->senha = "";
    }

    function getUsuario() {
        $usuario = array();
        $usuario['usuid'] = $_SESSION['usuid'];
        $usuario['login'] = $_SESSION['login'];
        return $usuario;
    }

    private function sanitizeString($string) {
        $string = preg_replace("/\s+/", "", $string);
        return $this->database->sanitizeString($string);
    }

    private function sanitizaLogin() {
        if (isset($_POST['login'])) {
            $this->login = $this->sanitizeString($_POST['login']);
        }
    }

    private function sanitizaSenha() {
        if (isset($_POST['senha'])) {
            $this->senha = $this->sanitizeString($_POST['senha']);
        }
    }

    private function buscaUsuarioDoBanco() {
        $resultado = $this->database->buscaUsuarioDoBanco($this->login, $this->senha);
        if (sizeof($resultado) > 0) {
            $userObj = $resultado[0];
            $_SESSION['usuid'] = $userObj['id'];
            $_SESSION['login'] = $userObj['login'];
        } else {
            Self::destroy_session();
        }
    }

    function checarLogin() {
        $this->sanitizaLogin();
        $this->sanitizaSenha();
        $this->buscaUsuarioDoBanco();
    }

    private function insereUsuarioNoBanco() {
        $this->database->insereUsuarioNoBanco($this->login, $this->senha);
    }

    function insereUsuario() {
        $this->sanitizaLogin();
        $this->sanitizaSenha();
        $this->insereUsuarioNoBanco();
    }

    static function destroy_session() {
        $_SESSION=array();
        if (session_id != "" || isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-2592000, '/');
        }
        session_destroy();
    }
}

?>
