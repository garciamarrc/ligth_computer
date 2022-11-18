<?php

namespace App\Controllers;

use App\Models\Comment;

class CommentController
{
    public function store(int $id)
    {
        if (!$_POST) {
            return header("Location: " . APP_URL . "product/show/" . $id);
        }

        $text = $_POST['text'];
        $name = $_POST['name'];
        $rate = $_POST['rate'];

        session_start();

        try {
            $comment = new Comment($text, $name, $rate, $id);
            $comment->save();

            $_SESSION['message'] = "Comentario agregado";
        } catch (\Throwable $th) {
            $_SESSION['message'] = "Ocurrió un error al agregar el comentario";
        } finally {
            return header("Location: " . APP_URL . "product/show/" . $id);
        }
    }
}
