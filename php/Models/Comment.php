<?php

namespace App\Models;

use App\Core\Database;

class Comment extends Database
{
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
}
