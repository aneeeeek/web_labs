<?php
// ==================== логика запросов для игр =========================
class Games
{
    // создать игру
    public static function create (string $picture, $title, $id_genre, $description, $price)
    {
        $query = Database::prepare('insert into games (picture, title, genre_id,description,price) 
                                    values (:picture, :title, :genre_id, :description, :price)'); // в бд передаешь запрос, где значения переменных берешь из переменных функции (ниже)
        // проверяем переменные на sql-инъекции
        $query->bindValue(":picture", $picture);
        $query->bindValue(":title", $title);
        $query->bindValue(":genre_id", $id_genre);
        $query->bindValue(":description", $description);
        $query->bindValue(":price", $price);

        if (!$query->execute()) // если не выполнился запрос в бд
            throw new PDOException("Error: can't add game");

        // ===============остальные действия делаются аналогично===============
    }

    // удалить игру
    public static function delete($id)
    {
        $query = Database::prepare('delete from games where id = :id');
        $query->bindValue(":id", $id);

        if (!$query->execute())
            throw new PDOException("Error: can't delete this game");
    }

    // изменит игру
    public static function update(string $picture, $title, $id_genre, $description, $price, $id)
    {
        $query = Database::prepare('update games set picture = :picture, title = :title, 
                 genre_id=:genre_id, description = :description, price=:price where id = :id');
        $query->bindValue(":picture", $picture);
        $query->bindValue(":title", $title);
        $query->bindValue(":genre_id", $id_genre);
        $query->bindValue(":description", $description);
        $query->bindValue(":price", $price);
        $query->bindValue(":id", $id);

        if (!$query->execute()) {
            throw new PDOException(("Error: can't update game"));
        }
    }

    // получить все игры
    public static function getAll(): array
    {
        $query = Database::prepare('select games.*, genres.title as genre_title from games join genres on games.genre_id=genres.id');
        $query->execute();

        return $query->fetchAll();
    }

    // получить игру по айди
    public static function getById($id) : array
    {
        $query = Database::prepare('select games.*, genres.title as genre_title from games join genres on games.genre_id=genres.id where games.id = :id');
        $query->bindValue(":id", $id);
        $query->execute();

        $type = $query->fetchAll();

        if(!count($type)){
            return [];
        }

        return $type[0];
    }

}