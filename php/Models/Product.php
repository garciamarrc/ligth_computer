<?php

namespace App\Models;

use App\Core\Database;

class Product extends Database
{
  private string $model;
  private string $specs;
  private float $price;
  private int $id_classification;

  public function __construct(string $model, string $specs, float $price, int $id_classification)
  {
    parent::__construct();

    $this->model = $model;
    $this->specs = $specs;
    $this->price = $price;
    $this->id_classification = $id_classification;
  }

  public function save()
  {
    try {
      $statement = "INSERT INTO productos (modelo, especificaciones, precio, id_clasificacion) VALUES (:model, :specs, :price, :id_classification)";
      $query = $this->connect()->prepare($statement);
      $query->execute([
        'model' => $this->model,
        'specs' => $this->specs,
        'price' => $this->price,
        'id_classification' => $this->id_classification,
      ]);
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
