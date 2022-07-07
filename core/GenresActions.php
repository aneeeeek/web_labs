<?php

class GenresActions
{
    public static function create() : array
    {
        if('POST' != $_SERVER['REQUEST_METHOD'])
            return [];

        if('create-type' != $_POST['action'])
            return [];

        $errors = GenresLogic::create($_POST['title'], $_POST['description']);

        if(count($errors)==0) {
            header('Location: /genres_main.php?success=y');
            die();
        }
        else
            return $errors;
    }

    public static function delete()
    {
        if('POST' != $_SERVER['REQUEST_METHOD'])
            return [];

        if('delete' != $_POST['action'])
            return [];

        if(isset($_POST['id'])){
            $genre = GenresLogic::getById($_POST['id']);
            if($genre['game_id'] != null){
                header('Location: /genres_main.php');
                die();
            }
        }

        GenresLogic::delete($_POST['id']);
        header('Location: /genres_main.php?success=y');
        die();
    }

    public static function update() : array
    {
        if('POST' != $_SERVER['REQUEST_METHOD'])
            return [];

        if('update-type' != $_POST['action'])
            return [];

        $errors = GenresLogic::update($_POST['title'], $_POST['description'], $_POST['id']);
        if(count($errors)==0) {
            header('Location: /genres_main.php?success=y');
            die();
        }
        else
            return $errors;
    }

    public static function getAll() : array
    {
        if('GET' != $_SERVER['REQUEST_METHOD'])
            return [];

        return GenresLogic::getAll();
    }

}