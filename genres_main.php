<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/core/index.php');

$genres = GenresActions::getAll();
GenresActions::delete();

require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');
?>
<main class="container">
    <table class="text" width="100%">
        <tr>
            <td>
                <h1>Жанры</h1>
            </td>
            <td>
                <?php if(UsersLogic::isSignedIn()){?>
                <div class="container" align="right">
                    <a class="btn btn-primary" href="genres_add_change.php?mode=create" role="button">Добавить</a>
                </div>
                <?php }?>
            </td>
        </tr>
    </table>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Название</th>
            <th scope="col">Описание</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i = 0; $i < count($genres); $i++) {
            ?>
            <tr>
                <th scope="row"><?= htmlspecialchars($genres[$i]['id']) ?></th>
                <td><?= htmlspecialchars($genres[$i]['title']) ?></td>
                <td><?= htmlspecialchars($genres[$i]['description']) ?></td>
                <?php if(UsersLogic::isSignedIn()){?>
                <td><a class="btn btn-primary mb-2" href="genres_add_change.php?mode=edit&id=<?=$genres[$i]['id']?>" role="button">Изменить</a>
                    <form method="post">
                        <?php
                        if($genres[$i]['game_id'] == null) :
                        ?>
                        <input type="submit" class="btn btn-danger"  role="button" value="Удалить">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?=htmlspecialchars($genres[$i]['id'])?>">
                        <?php
                        endif;
                        ?>
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
