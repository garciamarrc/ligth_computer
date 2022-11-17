<?php

namespace App\Helpers;

class View
{
    public static function view($string)
    {
        return __DIR__ . '/../../public_html/views/' . $string . '.php';
    }

    public static function layout($string)
    {
        return __DIR__ . '/../../public_html/views/Layouts/' . $string . '.php';
    }

    public static function component($string)
    {
        return __DIR__ . '/../../public_html/views/Components/' . $string . '.php';
    }

    public static function icon($string)
    {
        return __DIR__ . '/../../public_html/views/Icons/' . $string . '.php';
    }
}