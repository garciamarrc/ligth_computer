<?php

namespace App\Controllers;

use App\Models\Classification;
use App\Helpers\View;

class HomeController
{
  public function index()
  {
    $classifications = Classification::readQuery("SELECT * FROM clasificacion GROUP BY nombre");

    include View::view('Home/index');
  }

  public function show()
  {
  }
}
