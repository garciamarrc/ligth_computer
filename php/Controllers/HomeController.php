<?php

namespace App\Controllers;

use App\Models\Classification;

class HomeController
{
  public function index()
  {
    $classifications = Classification::getAll();

    include view('Home/index');
  }

  public function show()
  {
  }
}