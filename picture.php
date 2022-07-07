<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/core/index.php');
if(UsersLogic::isSignedIn()){
    header('Content-Type: image');
    $file = file_get_contents( "D:/xampp/htdocs/".$_GET['picture']);
    echo $file;
}
else{
    header("Location:/games_main.php");
    die();
}