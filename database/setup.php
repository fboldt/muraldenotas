<!DOCTYPE html>
<html>

<head>
    <title>DB Setup</title>
</head>

<body>

<pre>
<?php
require_once '../database/connection.php';
require_once '../extras/somentedesenvolvimento.php';

class DatabaseSetup {
  
  private  $databaseConnection;

  function __construct(){
    $this->$databaseConnection = new DatabaseConnection();
  }

  private function execute($query) {
    echo $query;
    echo "\n";
    $result = $this->$databaseConnection->query($query);
    if ($result) {
      print_r($result);
    } else {
      echo "FALHA!!!\n";
    }
    echo "\n";
  }

  function reset() {
    $this->clearDataset();
    $this->createTables();
    $this->insertExamples();
  }

  private function showTables() {
    $query = "SHOW TABLES";
    $this->execute($query);
  }

  private function clearDataset() {
      $query = "DROP TABLE IF EXISTS mensagens";
      $this->execute($query);
      $query = "DROP TABLE IF EXISTS usuarios";
      $this->execute($query);
  }

  private function createTables() {
    $this->createTableUsuarios();
    $this->createTableMensagens();
  }

  private function createTableUsuarios() {
    $query = "CREATE TABLE IF NOT EXISTS usuarios ( 
        id INT NOT NULL AUTO_INCREMENT, 
        PRIMARY KEY (id), 
        login VARCHAR(16) NOT NULL UNIQUE, 
        senha VARCHAR(128) NOT NULL
    )";
    $this->execute($query);
  }

  private function createTableMensagens() {
    $query = "CREATE TABLE IF NOT EXISTS mensagens ( 
        id INT NOT NULL AUTO_INCREMENT, 
        PRIMARY KEY (id), 
        usuid INT NOT NULL, 
        FOREIGN KEY (usuid) REFERENCES usuarios(id),
        texto VARCHAR(128) NOT NULL,
        tempo TIMESTAMP NOT NULL
    )";
    $this->execute($query);
  }

  private function insertExamples() {
    $query = "INSERT INTO usuarios (login, senha) VALUES ('fulano', '123123')";
    $this->execute($query);
    $query = "INSERT INTO mensagens (usuid, texto) VALUES (1,'Nota de exemplo.')";
    $this->execute($query);
  }

}

$databaseSetup = new DatabaseSetup();
$databaseSetup->reset();

?>
</pre>

</body>

</html>