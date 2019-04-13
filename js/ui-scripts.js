// Search animation
var body = $('body');
var html = $('html');
var searchBtn = $('.search');

setTimeout(function() {
    html.removeClass('is-hidden');
  }, 500);

searchBtn.on("click", function(e) {
  e.preventDefault();
  body.addClass('is-searching');
  setTimeout(function() {
    body.removeClass('is-searching');
  }, 2000);
});

// Tabs
jQuery(document).ready(function($){
  var tabs = $('.cd-tabs');
  
  tabs.each(function(){
    var tab = $(this),
        tabItems = tab.find('ul.cd-tabs-navigation'),
        tabContentWrapper = tab.children('ul.cd-tabs-content'),
        tabNavigation = tab.find('nav');

    tabItems.on('click', 'a', function(event){
      event.preventDefault();
      var selectedItem = $(this);
      if( !selectedItem.hasClass('selected') ) {
        var selectedTab = selectedItem.data('content'),
            selectedContent = tabContentWrapper.find('li[data-content="'+selectedTab+'"]'),
            slectedContentHeight = selectedContent.innerHeight();
        
        tabItems.find('a.selected').removeClass('selected');
        selectedItem.addClass('selected');
        selectedContent.addClass('selected').siblings('li').removeClass('selected');
        //animate tabContentWrapper height when content changes 
        tabContentWrapper.animate({
          'height': slectedContentHeight
        }, 200);
      }
    });

    //hide the .cd-tabs::after element when tabbed navigation has scrolled to the end (mobile version)
    checkScrolling(tabNavigation);
    tabNavigation.on('scroll', function(){ 
      checkScrolling($(this));
    });
  });
  
  $(window).on('resize', function(){
    tabs.each(function(){
      var tab = $(this);
      checkScrolling(tab.find('nav'));
      tab.find('.cd-tabs-content').css('height', 'auto');
    });
  });

  function checkScrolling(tabs){
    var totalTabWidth = parseInt(tabs.children('.cd-tabs-navigation').width()),
      tabsViewport = parseInt(tabs.width());
    if( tabs.scrollLeft() >= totalTabWidth - tabsViewport) {
      tabs.parent('.cd-tabs').addClass('is-ended');
    } else {
      tabs.parent('.cd-tabs').removeClass('is-ended');
    }
  }
});

// Custom <input type="number" ... >
jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
jQuery('.quantity').each(function() {
  var spinner = jQuery(this),
      input = spinner.find('input[type="number"]'),
      btnUp = spinner.find('.quantity-up'),
      btnDown = spinner.find('.quantity-down'),
      min = input.attr('min'),
      max = input.attr('max');

  btnUp.click(function() {
    var oldValue = parseFloat(input.val());
    if (oldValue >= max) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue + 1;
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });

  btnDown.click(function() {
    var oldValue = parseFloat(input.val());
    if (oldValue <= min) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue - 1;
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });
});

// Принудительная установка чекбоксов
$('#element1').prop('checked', 'checked');
$('#element2').prop('checked', 'checked');

// Обработка чекбоксов
$("input:checkbox").on("change", function () {

    var img = $('div.parse-result img');

    if(this.name === 'img-float') {
      img.toggleClass('img-float');
    }

    if(this.name === 'img-border') {
      img.toggleClass('img-border');

      if ($("#element2").prop("checked")) {
        // действие, если галочка установлена
        $('.border-param').slideDown(600); 
      } else {
        // действие, если галочки нет
        $('.border-param').slideUp(600);
      }
    }

});



function closed (main_elem, pos_elem, time, distance) {
  var offset = $(main_elem).offset();
  var xPos = offset.left;
  var yPos = offset.top;
  
  // можно было бы проверять position и z-index, но пока не до этого
  $(pos_elem).css(
      {
        "top" : yPos - distance + "px",
        "left" : xPos - distance + "px",
      });
}; 

closed('.parser_result', '#draggable-tabs', 1000, 20);


// Scroll
$('.button__parse').click( function(){
  var distance = 20; // небольшой зазор (сверху)
  var scroll_el = $(this).attr('href'); // возьмем содержимое атрибута href, должен быть селектором, т.е. например начинаться с # или .
  if ($(scroll_el).length != 0) { // проверим существование элемента чтобы избежать ошибки
    $('html, body').animate({ scrollTop: $(scroll_el).offset().top - distance }, 500); // анимируем скроолинг к элементу scroll_el
  }

  return false; // выключаем стандартное действие
});
