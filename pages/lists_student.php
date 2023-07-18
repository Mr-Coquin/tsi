<?php include '../template/header.php'; ?>
<?php
//данные обработки фильтра. Решил сделать по простому
$first_name = isset($_GET['first_name']) ? $_GET['first_name'] : '';
$last_name = isset($_GET['last_name']) ? $_GET['last_name'] : '';
$groups = isset($_GET['groups']) ? $_GET['groups'] : '';

$sql_w = "";

if (!empty($first_name) && $first_name != '') {
    $sql_w .= " AND `first_name` LIKE '%$first_name%' ";
}

if (!empty($last_name) && $last_name != '') {
    $sql_w .= " AND `last_name` LIKE '%$last_name%' ";
}

if (!empty($groups) && $groups != '') {
    $sql_w .= " AND `groups` = '$groups' ";
}
?>
<hr/>
<div class="row mb-3">
    <div class="col-md-3 themed-grid-col">
        <h2>Фильтр</h2>
        <form method="GET" action="">
            <div class="row g-3">
                <div class="col-12">
                    <label for="first_name">Имя</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Введите имя" value="<?= $first_name ?>">
                </div>
                <div class="col-12">
                    <label for="last_name">Фамилия</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Введите фамилию" value="<?= $last_name ?>">
                </div>
                <div class="col-12">
                    <label for="groups">Группа</label>
                    <input type="text" class="form-control" id="groups" name="groups" placeholder="Введите группу" value="<?= $groups ?>">
                </div>
            </div>
            <hr class="my-4">
            <button class="w-100 btn btn-primary btn-lg" type="submit">Применить фильтр</button>
        </form>
    </div>
    <div class="col-md-9 themed-grid-col">
        <div class="row mb-5">
            <div class="col-2 themed-grid-col">Код студента 
                <a href="?sort=sudent_code&act=ASC">↥</a>
                <a href="?sort=sudent_code&act=DESC">↧</a>
            </div>
            <div class="col-3 themed-grid-col">Имя
                <a href="?sort=first_name&act=ASC">↥</a>
                <a href="?sort=first_name&act=DESC">↧</a>
            </div>
            <div class="col-3 themed-grid-col">Фамилия
                <a href="?sort=last_name&act=ASC">↥</a>
                <a href="?sort=last_name&act=DESC">↧</a>
            </div>
            <div class="col-2 themed-grid-col">Номер группы
                <a href="?sort=groups&act=ASC">↥</a>
                <a href="?sort=groups&act=DESC">↧</a>
            </div>
            <div class="col-2 themed-grid-col"></div>
        </div>
<?php
$student = new Student($dbHost, $dbUsername, $dbPassword, $dbName);
if (!empty($_GET['del']) && $_GET['del'] != ''):
    $condition = "`sudent_code` = {$_GET['del']}";
    if ($student->deleteUser($condition)) {
        echo '<div class="row mb-5"><div class="col-12 themed-grid-col">Запись успешно удалена.</div></div>';
    } else {
        echo '<div class="row mb-5"><div class="col-12 themed-grid-col">Ошибка при удалении записи.</div></div>';
    }
endif;
$sort = '';
if (!empty($_GET['sort']) && $_GET['sort'] != ''):
    $sort = " ORDER BY `{$_GET['sort']}` {$_GET['act']}";
endif;
if ($sql_w === ""):
    $sql = "SELECT * FROM students" . $sort;
else:
    $sql = "SELECT * FROM students WHERE 1 = 1 " . $sql_w . $sort;
endif;

$result = $student->executeCustomSQL($sql);
if ($result->num_rows > 0):
    while ($row = $result->fetch_assoc()):
        ?>
                <div class="row mb-5">
                    <div class="col-2 themed-grid-col"><?= $row['sudent_code'] ?></div>
                    <div class="col-3 themed-grid-col"><?= $row['first_name'] ?></div>
                    <div class="col-3 themed-grid-col"><?= $row['last_name'] ?></div>
                    <div class="col-2 themed-grid-col"><?= $row['groups'] ?></div>
                    <div class="col-2 themed-grid-col"><a href="?del=<?= $row['sudent_code'] ?>" class="btn btn-danger" >Удалить</a></div>
                </div>
        <?php
    endwhile;
else:
    echo "Записи не найдены.";
endif;
$student->closeConnection();
?>
    </div>
</div>
<?php
include '../template/footer.php';
?>