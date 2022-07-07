<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/core/index.php');
$action = $_REQUEST['mode'];
$errors = array_merge(GenresActions::update(), GenresActions::create());

$genres = [];
$genres['title']="";
$genres['description']="";

if ($action == 'edit') {
    $id = $_GET['id'];
    $genres = GenresLogic::getById($id);
}

if(!UsersLogic::isSignedIn())
{
    header("Location:/genres_main.php");
    die();
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');
?>
<main class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/genres_main.php">Жанры</a></li>
            <li class="breadcrumb-item active" aria-current="page">Добавить жанр</li>
        </ol>
    </nav>

    <form method="post">
        <div class="mb-3">
            <label for="inputName" class="form-label">Название жанра</label>
            <input type="text" class="form-control" name="title" id="inputName"
                   value="<?= htmlspecialchars($_POST['title']??$genres['title'])?>"
            >
            <?php
            if(array_key_exists("title_error",$errors)){?>
                <label for="inputName" class="alert alert-danger container-fluid">
                    <?=$errors['title_error']?>
                    </label>
            <?php } ?>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <input type="text" class="form-control" name="description" id="description"
                    value="<?= htmlspecialchars($_POST['description']??$genres['description'])?>"
            >
            <?php
            if(array_key_exists("description_error",$errors)){?>
            <label for="description" class="alert alert-danger container-fluid">
                <?=$errors['description_error']?>
            </label>
            <?php } ?>
        </div>

        <?php
        if($action == 'edit'){?>
            <input type="hidden" name="action" value="update-type">
            <input type="hidden" name="id" value="<?=$id?>">
        <?php }
        else{?>
            <input type="hidden"  name="action" value="create-type">
        <?php } ?>
        <input type="submit" class="btn btn-primary d-grid gap-2 col-5 mx-auto mb-3" role="button" value="Сохранить">
    </form>


    <?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
    ?>
