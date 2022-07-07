<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/core/index.php');
$errors = UsersActions::create();
require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');
?>
<main class="container">
<form method="post">
    <div class="mb-3">
        <label for="fio" class="form-label">ФИО</label>
        <input type="text" class="form-control" name="fio"  id="fio"
               value="<?= htmlspecialchars($_POST['fio'] ?? "") ?>"
        >
        <?php if (array_key_exists("fio_error", $errors)) { ?>
            <label for="fio" class="alert alert-danger container-fluid"><?=htmlspecialchars($errors['fio_error'])?></label>
        <?php } ?>
    </div>

    <label for="birth" class="form-label">Дата рождения</label>
    <div class="form-group">
        <input type="date" class="form-control" name = "birth"  max="<?= date('Y-m-d'); ?>"
               value="<?= htmlspecialchars($_POST['birth'] ?? "") ?>">
        <?php if (array_key_exists("birth_error", $errors)) { ?>
            <label for="birth" class="alert alert-danger container-fluid"><?=htmlspecialchars($errors['birth_error'])?></label>
        <?php } ?>
    </div>

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

    <div class="mb-3">
        <label for="repeatedPassword" class="form-label">Повторите пароль</label>
        <input type="password" class="form-control" id="repeatedPassword" name="repeatedPassword" value="<?=htmlspecialchars("")?>">
    </div>

    <input type="hidden" name="action" value="create-type">
    <input type="submit" class="btn btn-primary d-grid gap-2 col-5 mx-auto mb-3"  role="button" value="Зарегистрироваться">
</form>
<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
?>
