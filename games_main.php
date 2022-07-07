<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/core/index.php');

$games = GamesActions::getAll();
GamesActions::delete();

require_once ($_SERVER['DOCUMENT_ROOT'] . '/header.php');
?>
<main class="container">
    <table class="text" width="100%">
        <tr>
            <td>
                <h1>Игровые диски в аренду</h1>
            </td>
            <td>
                <?php if(UsersLogic::isSignedIn()){?>
                <div class="container" align="right">
                    <a class="btn btn-primary" href="/games_add_change.php?mode=create" role="button">Добавить</a>
                </div>
                <?php } ?>
            </td>
        </tr>
    </table>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Картинка</th>
            <th scope="col">Название</th>
            <th scope="col">Жанр</th>
            <th scope="col">Описание</th>
            <th scope="col">Стоимость</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i = 0; $i < count($games); $i++) {
        ?>
            <tr>
                <th scope="row"><?= htmlspecialchars($games[$i]['id']) ?></th>
                <th scope="row"><img src=<?=htmlspecialchars("picture.php?picture=".$games[$i]['picture'])?> width="300" height="200"></th>

                <td><?= htmlspecialchars($games[$i]['title']) ?></td>
                <td><?= htmlspecialchars($games[$i]['genre_title']) ?></td>
                <td><?= htmlspecialchars($games[$i]['description']) ?></td>
                <td><?= htmlspecialchars($games[$i]['price']) ?></td>
                <?php if(UsersLogic::isSignedIn()){?>
                <td><a class="btn btn-primary mb-2" href="games_add_change.php?mode=edit&id=<?=$games[$i]['id']?>" role="button">Изменить</a>
                    <form method="post">
                        <input type="submit" class="btn btn-danger"  role="button" value="Удалить">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?=htmlspecialchars($games[$i]['id'])?>">
                    </form>
                </td>
                <?php }?>

            </tr>
            <?php
        } ?>
        </tbody>
    </table>

    <?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
    ?>
