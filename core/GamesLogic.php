<?php

// ========================= логика обращения к бд (проверяем на ошибки что чет не должно быть нуллом или там меньше единицы) например ======================
class GamesLogic
{
    // создать игру
    public static function create(string $picture, string $title, string $id_genre,
                                  string $description, string $price) : array
    {
        // проверка на ошибки
        $errors = self::errors($picture, $title, $id_genre, $description, $price);

        // выполнить запрос если нет ошибок
        if(empty($errors))
            Games::create($picture, $title, $id_genre, $description, $price);

        return $errors; // всегда возвращаем ошибки даже если их нет, чтобы можно было сообщить пользователю на страничке о том, что он дурачок и неправильно ввел в поля данные
        // остальное аналогично
    }

    // удалить игру
    public static function delete($id)
    {
        Games::delete($id);
    }

    // изменить игру
    public static function update(string $picture, $title, $id_genre, $description, $price, $id) : array
    {
        $errors = self::errors($picture, $title, $id_genre, $description, $price);

        if(empty($errors))
            Games::update($picture, $title, $id_genre, $description, $price, $id);

        return $errors;
    }

    // получить все игры
    public static function getAll() : array
    {
        return Games::getAll();
    }

    // получить игру по айди
    public static function getById($id) : array
    {
        return Games::getById($id);
    }

    // функция проверки на ошибки
    private static function errors(string $picture, $title, $id_genre, $description, $price) : array
    {
        $errors = [];

        if(empty($picture))
        {
            $errors['picture_error']="Добавьте картинку игры";
        }
        if(empty($title))
        {
            $errors['title_error']="Название игры не может быть пустым";
        }
        if(empty($id_genre))
        {
            $errors['genre_error']="Жанр игры не может быть пустым";
        }
        if(empty($description))
        {
            $errors['description_error']="Описание игры не может быть пустым";
        }
        if(empty($price))
        {
            $errors['price_error']="Цена игры не может быть не задана";
        }

        return $errors;
    }
}