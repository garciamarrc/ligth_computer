<?php

namespace App\Models;

use App\Core\Database;

use PDO;

class Comment extends Database
{
  private int $id;
  private string $text;
  private string $name;
  private float $rate;
  private int $id_product;
  private string $created_at;

  public function __construct(string $text, string $name, float $rate, int $id_product)
  {
    parent::__construct();

    $this->text = $text;
    $this->name = $name;
    $this->rate = $rate;
    $this->id_product = $id_product;
  }

  public function save()
  {
    try {
      $statement = "INSERT INTO comentarios (texto, nombre, calificacion, id_producto) VALUES (:text, :name, :rate, :id_product)";
      $query = $this->connect()->prepare($statement);
      $query->execute([
        'text' => $this->text,
        'name' => $this->name,
        'rate' => $this->rate,
        'id_product' => $this->id_product
      ]);
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public static function getRandom()
  {
    try {
      $db = new Database();
      $query = $db->connect()->query("SELECT * FROM comentarios ORDER BY RAND() LIMIT 1");

      $comment = Comment::createFromArray($query->fetch(PDO::FETCH_ASSOC));

      return $comment;
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public static function readQuery(string $sql)
  {
    try {
      $db = new Database();
      $query = $db->connect()->query($sql);

      $rows = [];

      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $comment = Comment::createFromArray($row);
        array_push($rows, $comment);
      }

      return $rows;
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public static function createFromArray($arr): Comment
  {
    $comment = new Comment($arr['texto'], $arr['nombre'], $arr['calificacion'], $arr['id_producto']);
    $comment->setId($arr['id']);
    $comment->setCreatedAt($arr['created_at']);

    return $comment;
  }

  public function setId(int $id)
  {
    $this->id = $id;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setText(string $text)
  {
    $this->text = $text;
  }

  public function getText()
  {
    return $this->text;
  }

  public function setName(string $name)
  {
    $this->name = $name;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setRate(float $rate)
  {
    $this->rate = $rate;
  }

  public function getRate()
  {
    return $this->rate;
  }

  public function setCreatedAt(string $created_at)
  {
    $this->created_at = $created_at;
  }

  public function getCreatedAt()
  {
    return $this->created_at;
  }
}
