<?php

// подключение всех файликов
require_once ($_SERVER['DOCUMENT_ROOT'] . '/core/db.php');

require_once ($_SERVER['DOCUMENT_ROOT'] . '/core/Genres.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/core/GenresActions.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/core/GenresLogic.php');

require_once ($_SERVER['DOCUMENT_ROOT'] . '/core/Games.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/core/GamesActions.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/core/GamesLogic.php');

require_once ($_SERVER['DOCUMENT_ROOT'] . '/core/Users.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/core/UsersActions.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/core/UsersLogic.php');

session_start();