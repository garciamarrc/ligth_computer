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

  public static function createFromArray($arr): Comment
  {
    $comment = new Comment($arr['texto'], $arr['nombre'], $arr['calificacion'], $arr['id_producto']);
    $comment->setId($arr['id']);

    return $comment;
  }

  public function setId(int $id)
  {
    $this->id = $id;
  }
}
