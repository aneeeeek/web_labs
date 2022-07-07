<?php
// ========================= взаимодействие с сервером =================================
class GamesActions
{
    // создать игру
    public static function create() : array
    {
        if('POST' != $_SERVER['REQUEST_METHOD']) // метод обязательно должен быть ПОСТ т.к. он возвращает данные с сервера
            return [];

        if('create-type' != $_POST['action']) // параметр тоже должен быть созданием игры
            return [];

        // Возможно тут нужна Проверка на тип?
        $defaultfile = '/imgs/default.png';

        // тут вставляется картинка, а если не указана какая - вставляется дефолтная
        if(!empty($_FILES['picture']['name']))
        {
            if (!move_uploaded_file($_FILES['picture']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/imgs/" . basename($_FILES['picture']['name']))) {
                throw new HttpException("Не удалось сохранить изображение.");
            } else {
                $defaultfile = '/imgs/' . basename($_FILES['picture']['name']);
            }
        }

        // вызываем метод
        $errors = GamesLogic::create($defaultfile, $_POST['title'], $_POST['id_genre'],
            $_POST['description'], $_POST['inputCost']);

        // если нет ошибок
        if(count($errors)==0) {
            header('Location: /games_main.php?success=y'); // переходим на главную страницу
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

        GamesLogic::delete($_POST['id']);
        header('Location: /games_main.php?success=y');
        die();
    }

    public static function update() : array
    {
        if('POST' != $_SERVER['REQUEST_METHOD'])
            return [];

        if('update-type' != $_POST['action'])
            return [];

        //Проверка на тип?
        $uploadfile = GamesLogic::getById($_POST['id'])['picture'];
        $checkFile = [];
        $shouldDelete = isset($_POST['deleteImg']) && $_POST['deleteImg']  ? "1" : "0";
        if($shouldDelete == "1"){
            $uploadfile = '/imgs/default.png';
        }
        elseif(!empty($_FILES['picture']['name']))
        {
            if (!move_uploaded_file($_FILES['picture']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/imgs/" . basename($_FILES['picture']['name']))) {
                throw new HttpException("Не удалось сохранить изображение.");
            } else {
                $uploadfile = '/imgs/' . basename($_FILES['picture']['name']);
            }
        }


        $errors = GamesLogic::update($uploadfile, $_POST['title'], $_POST['id_genre'],
            $_POST['description'], $_POST['inputCost'], $_POST['id']);

        if(count($errors)==0) {
            header('Location: /games_main.php?success=y');
            die();
        }
        else
            return $errors;
    }

    public static function getAll() : array
    {
        if('GET' != $_SERVER['REQUEST_METHOD'])
            return [];

        return GamesLogic::getAll();
    }
}