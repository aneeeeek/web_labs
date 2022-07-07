<?php

class UsersActions
{
    public static function create():array
    {
        if('POST' != $_SERVER['REQUEST_METHOD']){
            return [];
        }

        if('create-type' != $_POST['action']){
            return [];
        }

        $errors = UsersLogic::create($_POST['fio'], $_POST['birth'],
            $_POST['login'], $_POST['password'], $_POST['repeatedPassword']);

        if(count($errors)==0){
            header("Location:/games_main.php");
            die();
        }
        else{
            return $errors;
        }
    }

    public static function sign_in():array
    {
        if('POST' != $_SERVER['REQUEST_METHOD']){
            return [];
        }

        if('sign_in' != $_POST['action']){
            return [];
        }

        $errors = UsersLogic::sign_in($_POST['login'], $_POST['password']);

        if(count($errors)==0){
            header("Location:/games_main.php");
            die();
        }
        else{
            return $errors;
        }
    }

    public static function sign_out()
    {
        if('POST' != $_SERVER['REQUEST_METHOD']){
            return [];
        }

        if('sign_out' != $_POST['action']){
            return [];
        }

        UsersLogic::sign_out();

        header("Location:/games_main.php");
        die();
    }
}