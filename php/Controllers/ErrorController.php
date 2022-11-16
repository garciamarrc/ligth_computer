<?php

namespace App\Controllers;

use App\Helpers\View;

class ErrorController
{
    public function notFound()
    {
        include View::view('Errors/404');
    }
}
