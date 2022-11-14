<?php

class Database
{
  private string $host;
  private string $db;
  private string $user;
  private string $password;
  private string $charset;

  public function __construct(string $host, string $database, string $user, string $password, string $charset)
  {
    $this->host = $host;
    $this->db = $database;
    $this->user = $user;
    $this->password = $password;
    $this->charset = $charset;
  }

  public function connect()
  {
    try {
      $connection = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
      $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
      ];

      $pdo = new PDO($connection, $this->user, $this->password, $options);
      return $pdo;
    } catch (PDOException $th) {
      throw $th;
    }
  }
}
