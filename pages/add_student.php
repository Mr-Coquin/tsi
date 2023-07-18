<?php include '../template/header.php'; ?>
    <div class="py-5 text-center">
      <h2>Форма</h2>
      <p class="lead">добавления нового студента</p>
    </div>
<div class="row g-5">
    <div class="col-md-7 col-lg-12">
        <form class="needs-validation" novalidate>
            <div class="row g-3">
                            <div class="col-sm-6">
              <label for="firstName" class="form-label">First name</label>
              <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Last name</label>
              <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>
                
                
                            <div class="col-12">
              <label for="group" class="form-label">Student group</label>
              <input type="text" class="form-control" id="group" placeholder="Student group" required>
              <div class="invalid-feedback">
                Please enter your student group.
              </div>
            </div>
            </div>
            
                      <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Добавить</button>
        </form>
    </div>
</div>

<script>
    // Обработчик события submit формы
    document.querySelector('.needs-validation').addEventListener('submit', function (event) {
        event.preventDefault(); // Предотвращаем стандартное поведение формы

        // Получаем данные формы
        var form = event.target;
        var firstName = form.querySelector('#firstName').value;
        var lastName = form.querySelector('#lastName').value;
        var group = form.querySelector('#group').value;

        // Создаем объект данных для отправки
        var data = {
            firstName: firstName,
            lastName: lastName,
            group: group
        };
        // Отправка данных с помощью AJAX-запроса
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?=$basePath?>ajax/add_student.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Обработка успешного ответа сервера
//                var response = xhr.responseText; 
//                console.log(xhr.responseText);
                var response = JSON.parse(xhr.responseText); 
                console.log(response);
                if(response.Error){
                    var element = document.getElementById('Error');
                    element.textContent = response.Error;
                    setTimeout(function() {
  element.textContent = '';
}, 2000);
            }
            
            if(response.Ok){
                                    var elementOk = document.getElementById('Ok');
                    elementOk.textContent = response.Ok;
                    setTimeout(function() {
  elementOk.textContent = '';
}, 2000);
            }
            }
        };
        xhr.send(JSON.stringify(data));
    });
</script>
<br/>
<div id="Error" style="font:bold; color:red;"></div>
<div id="Ok" style="font:bold; color:green;"></div>
<script src="<?=$basePath?>access/js/form-validation.js"></script>
<?php include '../template/footer.php'; ?>