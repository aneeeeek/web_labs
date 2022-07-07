<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/core/index.php'); //подключение подключений
UsersActions::sign_out(); //выйти из аккаунта ?????
?>
<!doctype html>
<html>
	<head>
        <?php // тут подключение бутстрапа и всякое такое бесполезное ?>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Bootstrap CSS -->
		<link href="/bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
		<meta name="generator" content="Hugo 0.88.1">
        
		<title>Игровые диски в аренду</title>

		<link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/navbar-static/">

		<!-- Bootstrap core CSS -->
		<link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

		<!-- Favicons -->
		<link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
		<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
		<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
		<link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
		<link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
		<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
		<meta name="theme-color" content="#7952b3">


		<style>
            .regbutton:hover
            {
                background: #FFDCDC;
            }
            .signinbutton:hover
            {
                background: #9A9A9A;
            }
			.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			user-select: none;
			}

			@media (min-width: 768px) {
			.bd-placeholder-img-lg {
			font-size: 3.5rem;}
			}
		</style>

		<!-- Custom styles for this template -->
		<link href="navbar-top.css" rel="stylesheet">
	</head>
	<body>  
		<!-- Option 1: Bootstrap Bundle with Popper -->
		<script src="/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

		<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
			<div class="container-fluid">
				<a class="navbar-brand active" href="/games_main.php">Игровые диски в аренду</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<ul class="navbar-nav me-auto mb-2 mb-md-0">
						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="/games_main.php">Диски</a>
						</li>	
						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="/genres_main.php">Жанры</a>
						</li>
					</ul>
                    <?php if(!UsersLogic::isSignedIn()) //проверка на вход в аккаунт - отображается если только не вошел
                    {?>
                        <li class="nav-item">
                            <!--<a class="nav-link" style="color: white" aria-current="page" href="/sign_in.php">Войти</a>-->
                            <a style="color: white" class="signinbutton btn btn-outline-light my-2 my-sm-0"  role="button" href="/sign_in.php">Войти</a>
                        </li>
                        <li class="nav-item">
                            <!--<a class="nav-link" style="color: white" aria-current="page" href="/registration.php">Зарегистрироваться</a>-->
                            <a style="color: black" class="regbutton btn btn-light my-2 my-sm-0" role="button" href="/registration.php">Зарегистрироваться</a>
                        </li>
                    <?php }
                    else { // если вошел - то заменить на кнопку выйти?>
                    <form method="post" enctype="multipart/form-data">
                        <li class="nav-item">
                            <input type="hidden" name="action" value="sign_out">
                            <input type="submit" style="color: black" class="btn btn-light my-2 my-sm-0"  role="button" value="Выйти">
                        </li>
                    </form>
                    <?php } ?>

				</div>
			</div>
		</nav>