<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/core/index.php');
$errors = UsersActions::sign_in();
require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');
?>
<main class="container">
    <form method="post">
        <?php if (array_key_exists("sign_in_error", $errors)) { ?>
            <h3 style="color: darkred"><?=htmlspecialchars($errors['sign_in_error'])?></h3>
        <?php }?>
        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" class="form-control" name="login"  id="login"
                   value="<?= htmlspecialchars($_POST['login'] ?? "") ?>"
            >
            <?php if (array_key_exists("login_error", $errors)) { ?>
                <label for="login" class="alert alert-danger container-fluid"><?=htmlspecialchars($errors['login_error'])?></label>
            <?php } ?>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" value="<?=htmlspecialchars("")?>">
            <?php if (array_key_exists("password_error", $errors)) { ?>
                <label for="password" class="alert alert-danger container-fluid"><?=htmlspecialchars($errors['password_error'])?></label>
            <?php } ?>

        </div>

        <input type="hidden" name="action" value="sign_in">
        <input type="submit" class="btn btn-primary d-grid gap-2 col-5 mx-auto mb-3"  role="button" value="Войти">
<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
?>
