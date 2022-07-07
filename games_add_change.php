<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/core/index.php');
$action = $_REQUEST['mode'];
$errors = array_merge(GamesActions::update(), GamesActions::create());

$games = [];
$games['picture']="/imgs/default.png";
$games['title']="";
$games['genre_id']="";
$games['description']="";
$games['price']="";

if ($action == 'edit') {
    $id = $_GET['id'];
    $games = GamesLogic::getById($id);
}

$genres = GenresLogic::getAll();
if(!UsersLogic::isSignedIn())
{
    header("Location:/games_main.php");
    die();
}
require_once ($_SERVER['DOCUMENT_ROOT'] . '/header.php');
?>

<main class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/games_main.php">Диски</a></li>
            <li class="breadcrumb-item active" aria-current="page">Добавить игру</li>
        </ol>
    </nav>

    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">

            <label for="inputImage" class="form-label">Картинка</label>
            <div class="input-group mb-3">
                <input type="file" id="picture" name="picture" class="form-control">
                <?php
                if(array_key_exists("picture_error",$errors)){?>
                    <label for="picture" class="alert alert-danger container-fluid">
                        <?=htmlspecialchars($errors['picture_error'])?> </label>
                    <?php
                } ?>
            </div>

            <div class="input-group mb-3">
                <img src="<?=htmlspecialchars("picture.php?picture=".$games['picture'])?>"  class="h-100 w-50 img-thumbnail" id = "currentPicture">
            </div>
            <?php
            if ($action == 'edit' && $games['picture'] != "/imgs/default.png") {
                ?>
                <div class="mt-3 mx-auto">
                    <input type="checkbox" id="deleteImg" name="deleteImg" value="1" class="form-check-input">
                    <label for="deleteImg" class="form-check-label">Удалить картинку</label>
                </div>
                <?php
            } ?>


            <div class="mb-3">
                <label for="inputName" class="form-label">Название игры</label>
                <input type="text" class="form-control" name="title" id="inputName"
                       value="<?= htmlspecialchars($_POST['title']??$games['title'])?>">
                <?php
                if(array_key_exists("title_error",$errors)){?>
                <label for="inputName" class="alert alert-danger container-fluid">
                    <?=$errors['title_error']?> </label>
                    <?php
                } ?>
            </div>

            <div class="mb-3">
                <label for="inputGenre" class="form-label">Жанр игры</label>
                <select class="form-select" aria-label="Default select example" name="id_genre">
                    <?php if($action == 'edit') :?>
                    <option selected="selected"
                        value="<?= htmlspecialchars($games['genre_id'])?>"><?= htmlspecialchars($games['genre_title'])?></option>
                <?php endif;
                    for ($i = 0; $i < count($genres); $i++) {
                        if($genres[$i]['id'] != $games['genre_id']): ?>
                        <option value="<?=htmlspecialchars($genres[$i]['id'])?>"><?= $genres[$i]['title']?></option>
                    <?php endif;
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Описание</label>
                <textarea class="form-control" id="description" rows="3" name="description"
                ><?= htmlspecialchars($_POST['description']??$games['description'])?></textarea>
                <?php
                if(array_key_exists("description_error",$errors)){?>
                    <label for="exampleFormControlTextarea1" class="alert alert-danger container-fluid">
                        <?=$errors['description_error']?>
                    </label>
                <?php } ?>
            </div>

            <div class="mb-3">
                <label for="inputCost" class="form-label">Стоимость</label>
                <input type="number" min="1" class="form-control" id="inputCost" name = "inputCost"
                       value="<?= htmlspecialchars($_POST['price']??$games['price'])?>">
                <?php
                if(array_key_exists("price_error",$errors)){?>
                    <label for="inputCost" class="alert alert-danger container-fluid">
                        <?=$errors['price_error']?>
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