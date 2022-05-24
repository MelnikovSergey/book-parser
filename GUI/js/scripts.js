$('.button__parse').click(function () {
  var input = document.getElementById('entryFieldInput').value;
  /* Информация о книге */
  $.getJSON('https://parse.polytechnix.ru/?b=' + input + "&y=&data=full", function (data) {
      if (input = data.Title) {
          $('#title').html(data.Title);
          $('#author').html("Автор: " + data.Author);
          $('#year').html("Год: " + data.Year + "г.");
          $('#description').html("Описание: " + data.Description);
      } else {
          $('#title').html("Извините, но нам не удалось найти книгу по указанному адресу. Проверьте пожалуйста ссылку");
          $('#author').html("");
          $('#year').html("");
          $('#description').html("");
      }
});

// функция для получения выделенного текста
function getSelectedText(){
    var text = "";
    if (window.getSelection) {
        text = window.getSelection();
    }else if (document.getSelection) {
        text = document.getSelection();
    }else if (document.selection) {
        text = document.selection.createRange().text;
    }
    return text;
}

// Обрабатываем поле ввода
$('#entry-field').submit(function(e){
  e.preventDefault();
  var data = $(this).serialize();
  $.ajax({
    url: 'new_test.php',
    type: 'POST',
    data: data,
    success: function(result) {
      $('.parse-result').html(result);
    }
  }); 
});

/*

!!! Рамочка, обтекание, цвет рамки !!!

//Vanilla JS concept
const input = document.querySelector('input[type=number]');
const output = document.getElementById('test');

input.addEventListener('input', (event) => {
  output.innerText = event.target.value;
}, true);

// jQuery concept
$("input:checkbox").on('keyup mouseup keydown change blur', 'input', function() {
  $('#test').html($(this).val());
});

*/
$('.border-param input').on('keyup mouseup keydown change blur', function() {
	
	var self = this;
    var img = $('div.parse-result img');

    if(this.name === 'weight-border') {
   	  img.css('border-width', $(self).val());
    }

    if(this.name === 'img-padding') {
   	  img.css('padding', $(self).val());
    }

});

$('.border-param input[type="color"]').val('#585858');

$('.border-param input[type="color"]').on('change', function() {
	$('div.parse-result img').css('border-color', $(this).val());
});

// Вкл./выкл. редактирование текста, Enabled/Disabled Button
contentCustomizeContainer.onchange = function(e) {

  var button = document.getElementById("execute");
  var element = document.getElementById("result");

  if(e.target.id == "element3") {
    element.contentEditable = true;
    button.classList.add('button__disabled_button');
    button.disabled = true;
  } else {
    element.contentEditable = false;
    button.classList.remove('button__disabled_button');
    button.disabled = false;   
  }
}

// Удаляем выделенный фрагмент кнопкой "Выполнить"
document.getElementById("execute").onclick = function() {

  var selection = "";

  if(window.getSelection) {
    selection = window.getSelection().getRangeAt(0);
    var selectedText = selection.extractContents();
    var div = document.createElement("div");
    div.classList.add('for_removing');
    div.appendChild(selectedText);
    console.log(div);
  } 
  else {
    alert('Ваш браузер устарел! Воспользуйтесь опцией «Отредактировать»');
  }

  if(selection == "") {
    alert('Выделите текст!');
  } else {
    div.deleteContents();
    console.log('Выкуси!');
  }

  return false;

};
