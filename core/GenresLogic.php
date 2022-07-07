<?php

class GenresLogic
{
    public static function create(string $title, string $description) : array
    {
        $errors = self::errors($title,$description);

        if(empty($errors))
            Genres::create($title,$description);

        return $errors;
    }

    public static function delete($id)
    {
        Genres::delete($id);
    }

    public static function update(string $title, string $description, string $id) : array
    {
        $errors = self::errors($title,$description);

        if(empty($errors))
            Genres::update($title,$description,$id);

        return $errors;
    }

    public static function getAll() : array
    {
        return Genres::getAll();
    }

    public static function getById($id) : array
    {
        return Genres::getById($id);
    }

    private static function errors(string $title, $description) : array
    {
        $errors = [];

        if(empty($title))
        {
            $errors['title_error']="Название жанра не может быть пустым";
        }
        if(empty($description))
        {
            $errors['description_error']="Описание жанра не может быть пустым";
        }

        return $errors;
    }
}