<?php

namespace App\Controllers;

use App\Models\Comment;

class CommentController
{
    public function store(int $id)
    {
        print_r($_POST);
        print_r($id);

        $text = $_POST['text'];
        $name = $_POST['name'];
        $rate = $_POST['rate'];

        session_start();

        try {
            $comment = new Comment($text, $name, $rate, $id);
            $comment->save();

            $_SESSION['message'] = "Comentario guardado";
        } catch (\Throwable $th) {
            $_SESSION['message'] = "Ocurrió un error al guardar el comentario";
        } finally {
            header("Location: " . APP_URL . "product/show/" . $id);
        }
    }
}
