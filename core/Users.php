<?php

class Users
{
    public static function create(string $fio, $birth, $login, $password): array
    {
        $query = Database::prepare('insert into users (fio, date_of_birth,login,password)
                    values (:fio,:birth,:login,:password)');
        $query->bindValue(":fio",$fio);
        $query->bindValue(":birth",$birth);
        $query->bindValue(":login",$login);
        $query->bindValue(":password",password_hash($password, PASSWORD_DEFAULT));

        if(!$query->execute()){
            throw new PDOException(("Ошибка при добавлении пользователя."));
        }

        return [];
    }

    public static function getById($id): array
    {
        $query = Database::prepare('select * from users where id = :id');
        $query->bindValue(":id", $id);

        $query->execute();

        $user = $query->fetchAll();

        return $user[0];
    }

    public static function getByLogin($login) : array
    {
        $query = Database::prepare('select * from users where login = :login');
        $query->bindValue(":login", $login);

        $query->execute();

        $user = $query->fetchAll();
        if(!empty($user))
        {
            return $user[0];
        }

        return [];
    }

    public static function update($fails,$id)
    {
        if($fails<4)
        {
            $query = Database::prepare('update users set fails = :fails where id = :id');
            $query->bindValue(":fails", ++$fails);
            $query->bindValue(":id", $id);
            if(!$query->execute()){
                throw new PDOException(("Ошибка при обновлении проваленных попыток входа."));
            }
        }
        elseif(self::getById($id)['ban']==NULL)
        {
            $query = Database::prepare('update users set ban = :ban where id = :id');
            $date = date("Y-m-d H:i:s", strtotime("+2 hours"));
            $query->bindValue(":ban",$date);
            $query->bindValue(":id", $id);
            if(!$query->execute()){
                throw new PDOException(("Ошибка при обновлении проваленных попыток входа."));
            }
        }
    }

    public static function unban($id)
    {
        $query = Database::prepare('update users set fails = 0, ban = NULL where id = :id');
        $query->bindValue(":id", $id);
        if(!$query->execute()){
            throw new PDOException(("Ошибка при обновлении проваленных попыток входа."));
        }
    }

}