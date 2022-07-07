<?php

class UsersLogic
{
    private static function errors(string $fio, $birth, $login, $password, $repeatedPassword) : array
    {
        $errors = [];

        if(empty($fio))
        {
            $errors['fio_error']="ФИО не может быть пустым";
        }
        if(empty($birth))
        {
            $errors['birth_error']="Дата рождения не может быть пустой";
        }
        if(empty($login))
        {
            $errors['login_error']="Логин не может быть пустым";
        }
        if(empty($password))
        {
            $errors['password_error']="Пароль не может быть пустым";
        }

        //FIXME проверка валидации+проверить второй пароль
        if(!empty(Users::getByLogin($login)))
        {
            $errors['login_error']="Такой пользователь уже зарегистрирован";
        }
        if($password!=$repeatedPassword)
        {
            $errors['password_error']="Пароли не совпадают";
        }

        if(!filter_var($login, FILTER_VALIDATE_EMAIL))
        {
            $errors['login_error']="Почта указана неверно";
        }
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[+!@#$%^&*.,?])(?=.*[ ])(?=.*[-])(?=.*[_]).{7,}+$/",
            $password))
        {
            $errors['password_error']="Пароль должен быть длиннее 6 символов, обязательно содержать: большие латинские 
            буквы, маленькие латинские буквы, спецсимволы (знаки препинания, арифметические действия и т.п.), 
            пробел, дефис, подчеркивание и цифры. Русские буквы запрещены.";
        }

        return $errors;
    }

    public static function create(string $fio, $birth, $login, $password, $repeatedPassword):array
    {
        $errors = self::errors($fio, $birth, $login, $password, $repeatedPassword);
        if(empty($errors))
            return Users::create($fio, $birth, $login, $password);
        else return $errors;
    }

    public static function sign_in($login, $password):array
    {
        $errors = [];
        $date = date("Y-m-d H:i:s", strtotime("+1 hours"));
        if(empty($login))
        {
            $errors['login_error']="Логин не может быть пустым";
        }
        if(empty($password))
        {
            $errors['password_error']="Пароль не может быть пустым";
        }

        if(!empty(Users::getByLogin($login))&&!empty($password))
        {
            $user = Users::getByLogin($login);

            if(password_verify($password, $user['password']) && $user['fails']<=4)
            {
                if($user['ban'] < $date)
                {
                    Users::unban($user['id']);
                }
                if($user['ban']==NULL || ($user['ban'] < $date))
                {
                    $_SESSION['user'] = $user['id'];
                    return [];
                }
                else
                {
                    $errors['sign_in_error']="Вы были заблокированы";
                }
            }
            else
            {
                if($user['fails']<4)
                {
                    $errors['password_error'] = "Пароль введен неверно";
                }
                else
                {
                    $errors['sign_in_error']="Вы были заблокированы";
                }
                Users::update($user['fails'], $user['id']);
            }
        }
        else
        {
            $errors['sign_in_error']="Такого пользователя не существует";
        }

        return $errors;
    }

    public static function sign_out()
    {
        unset($_SESSION['user']);
    }

    public static function isSignedIn():bool
    {
        if(isset($_SESSION['user']))
            return true;

        return false;
    }
}