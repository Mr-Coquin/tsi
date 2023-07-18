  <div class="container">
    <header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="../" class="nav-link <?=($currentFile == "index.php")?'active':''?>" aria-current="page">Главная</a></li>
        <li class="nav-item"><a href="<?=$basePath?>pages/add_student.php" class="nav-link <?=($currentFile == "add_student.php")?'active':''?>">Добавить студента</a></li>
        <li class="nav-item"><a href="<?=$basePath?>pages/lists_student.php" class="nav-link <?=($currentFile == "lists_student.php")?'active':''?>">Список студентов</a></li>
      </ul>
    </header>
  </div>
