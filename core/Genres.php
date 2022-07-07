<?php

class Genres
{
    public static function create(string $title, string $description)
    {
        $query = Database::prepare('insert into genres (title,description) 
                                    values (:title, :description)');
        $query->bindValue(":title", $title);
        $query->bindValue(":description", $description);

        if (!$query->execute())
            throw new PDOException("Error: can't add genre");
    }

    public static function delete($id)
    {
        $query = Database::prepare('delete from genres where id = :id');
        $query->bindValue(":id", $id);

        if (!$query->execute())
            throw new PDOException("Error: can't delete this genre");
    }

    public static function update(string $title, string $description, string $id)
    {
        $query = Database::prepare('update genres set title = :title, description = :description where id = :id');
        $query->bindValue(":title", $title);
        $query->bindValue(":description", $description);
        $query->bindValue(":id", $id);

        if (!$query->execute()) {
            throw new PDOException(("Error: can't update genre"));
        }
    }

    public static function getAll(): array
    {
        $query = Database::prepare('select genres.*, games.id as game_id from genres left join games on games.genre_id = genres.id');
        $query->execute();

        return $query->fetchAll();
    }

    public static function getById($id) : array
    {
        $query = Database::prepare('select genres.*, games.id as game_id from genres left join games on games.genre_id = genres.id where genres.id = :id');
        $query->bindValue(":id", $id);
        $query->execute();

        $type = $query->fetchAll();

        if(!count($type)){
            return [];
        }

        return $type[0];
    }
}