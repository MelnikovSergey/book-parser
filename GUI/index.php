<!DOCTYPE html>
<html lang="ru" class="is-hidden">

<head>
  <meta charset="UTF-8">
  <title>Книжный парсер</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet"> 
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/tabs.css"> 
  <link rel="stylesheet" href="css/ui-elements.css"> 
  <link rel="stylesheet" href="css/file_selection.css">
  <link rel="stylesheet" href="css/loader.css">         
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="top-section">
  <h1 class="app-h">КНИЖНЫЙ<br>ПАРСЕР</h1>
  <span>[Бета версия: 0.01]</span>
</header>

<div class="parsing_format"> 
  <input type="radio" name="variation" id="case-1" checked>
  <label for="case-1">Спарсить книгу</label>
  <input type="radio" name="variation" id="case-2"/>
  <label for="case-2">Спарсить список</label>

  <!-- Содержимое первого и второго узлов -->
  <div data-variant="first-tab">
    <!-- Парсинг ссылки -->
    <form id="entry-field">
      <input type="text" placeholder="Просто вставьте ссылку">
      <button type="submit" class="button button__parse" href=".parse-result">Спарсить книгу</button>
    </form>
  </div> 

  <div data-variant="second-tab">
    <!-- Парсинг файла --> 
    <form id="upload-container" method="POST" action="send.php">
      <img id="upload-image" src="img/upload.png">
      <div>
        <input id="file-input" type="file" name="file" multiple>
        <label for="file-input">Выберите файл</label>
        <span>или перетащите его сюда</span>
      </div>
    </form>      
  </div> 
</div>

<div class="loading-dots">
  <div class="loading-dots--dot"></div>
  <div class="loading-dots--dot"></div>
  <div class="loading-dots--dot"></div>
</div>

<div id="result" class="parse-result clearfix boxShadow">
  <h2>Виктор Гюго - Девяносто третий год</h2>
  <img src="../TestData/cover.jpg" width="25%" alt="" class="img-float img-border">
  <p>Автор: Гюго Виктор Мари<br>
     Название: Девяносто третий год<br>
     Жанр:<br>
     Издательский дом: Мир книги, Литература<br>
     Год издания: 2011г.
  </p>
  <p><strong>Аннотация:</strong><br>Великий французский писатель, поэт и драматург Виктор Гюго (1802–1885) – один из самых ярких представителей прогрессивно-романтической литературы XIX века. Вот уже более ста лет во всем мире зачитываются его блестящими романами «Собор Парижской Богоматери», «Отверженные», «Девяносто третий год»; со сцен театров не сходят драмы Гюго «Эрнани», «Мария Тюдор» и другие.В данном томе публикуется одно из самых значительных, ярких и смелых изображений Великой французской революции – роман «Девяносто третий год». Он состоит из коротких драматических эпизодов, полных захватывающих приключений и неожиданных сюжетных поворотов. На примере гражданской войны в Вандее между частями республиканской армии и отрядами монархических мятежников, поддерживаемыми местными крестьянами, писатель пытается решить общие для любой революции проблемы: как понимать справедливость; что важнее – политические убеждения или общечеловеческие ценности; оправдана ли революционная жестокость; почему возвышенная идея обращается в свою противоположность.
  </p>
</div>

<div class="cd-tabs" id="draggable-tabs">
  <nav>
    <ul class="cd-tabs-navigation">
      <li><a data-content="inbox" class="selected" href="#0">Настройка</a></li>
      <li><a data-content="settings" href="#0">Экспорт</a></li>
    </ul> <!-- cd-tabs-navigation -->
  </nav>

  <ul class="cd-tabs-content">
    <li data-content="inbox" class="selected">

      <form name="imageCustomizeContainer" class="image-customize-container">
        <h3>Оформление изображения:</h3>

        <div class="checkbox">
          <input id="element1" type="checkbox" name="img-float" checked>
          <label for="element1">Слева</label>
        </div>

        <div class="checkbox">
          <input id="element2" type="checkbox" name="img-border" checked>
          <label for="element2">Рамка</label>
        </div>
          
        <div class="border-param">
          <div class="quantity clearfix">
            <label for="age">Толщина:</label><br>
            <input type="number" name="weight-border" min="1" max="12" step="1" value="1">
          </div>

          <div class="quantity clearfix">
            <label for="age">Отступ:</label><br>  
            <input type="number" name="img-padding" min="0" max="8" step="1" value="0">
          </div>

          <div class="check-color">
            <label for="color">Выбор цвета:</label><br>  
            <input id="color" name="color" type="color" value="#585858" list="colorList">
            <datalist id="colorList">
              <option value="#ff0000" label="Красный">
              <option value="#008000" label="Зелёный">
              <option value="#0000ff" label="Синий">
            </datalist>
          </div>
        </div>
 
      </form>

      <form name="contentCustomizeContainer" class="content-customize-container">
        <h3>Выделенный фрагмент текста можно:</h3>

        <div class="radio">
          <input id="element3" type="radio" name="my-radio">
          <label for="element3">Отредактировать</label>
        </div>
       
        <div class="radio">
          <input id="element4" type="radio" name="my-radio" checked>
          <label for="element4">Удалить</label>
        </div>

        <button id="execute" class="button button__gray" name="execute">Выполнить</button>
      </form>

    </li>

    <li data-content="settings">

      <div class="file-format-customize-container">
        <h3>Формат файла:</h3>

        <div class="radio">
          <input id="element5" type="radio" name="file-format">
          <label for="element5">.json</label>
        </div>
     
        <div class="radio">
          <input id="element6" type="radio" name="file-format" checked>
          <label for="element6">.docx</label>
        </div>
      </div>

      <div class="file-name-customize-container">
        <h3>Имя файла:</h3>

        <div class="radio">
          <input id="element7" type="radio" name="file-name" checked>
          <label for="element7">Название книги</label>
        </div>
     
        <div class="radio">
          <input id="element8" type="radio" name="file-name">
          <label for="element8">nazvanie_knigi</label>
        </div>
      </div>
    
      <button class="button button__gray search">Экспорт</button>

    </li>
  </ul> <!-- cd-tabs-content -->
</div> <!-- cd-tabs -->

<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/ui-scripts.js"></script>
<script src="js/file_selection.js"></script>
<script src="js/scripts.js"></script>

<script>
  $(function() {
    $("#draggable-tabs").draggable();
    $("#draggable-tabs").css("top", -372+"px");
    $("#draggable-tabs").css("left", 820+"px");
  });
</script>

</body>
</html>
