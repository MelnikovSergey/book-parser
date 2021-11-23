<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('DATA', ROOT . '/TestData');

require "vendor/autoload.php";

$phpWord = new \PhpOffice\PhpWord\PhpWord();

$phpWord->setDefaultFontName('Arial');
$phpWord->setDefaultFontSize(12);

$properties = $phpWord->getDocInfo();
$properties->setCreated(mktime(0, 0, 0, 5, 11, 2021));

$sectionStyle = array(
	'orientation' => 'landscape',
	'marginTop' => \PhpOffice\PhpWord\Shared\Converter::pixelToTwip(25),
	'marginLeft' => \PhpOffice\PhpWord\Shared\Converter::pixelToTwip(25),
	'marginRight' => \PhpOffice\PhpWord\Shared\Converter::pixelToTwip(25),
	'colsNum' => 2,
	'pageNumberingStart' => 1,
	'borderBottomSize' => 100,
	'borderBottomColor' => 'c0c0c0'
);
$section = $phpWord->addSection($sectionStyle);

$text = 'Текст для примера!';
$section->addText(htmlspecialchars($text), array('name' => 'Arial', 'size' => 18, 'color' => '075776', 'bold' => TRUE), array('align' => 'right', 'spaceBefore' => 500 ));

$text = explode('\n', file_get_contents(DATA . '/annotation.txt'));
// print_r($text);
// exit();

$section->addImage(DATA . '/cover.jpg', array('width' => 80, 'height' => 100, 'marginTop' => 100, 'marginLeft' => 50, 'wrappingStyle' => 'behind'));

if($text) {
    for($i = 0; $i < count($text); $i++) {
	$section->addText($text[$i]);

	// Экспериментирую (добавим в качестве разделителя пустую строку)
	$section->addTextBreak(5); 
    }
} else {
    $section->addText('Что-то пошло не так..');
}

// Экспериментирую (добавим список)
$fontStyle = array('name' => 'Arial', 'size' => 28, 'color' => '075776', 'bold' => TRUE);
$listStyle = array('listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_SQUARE_FILLED);
$section->addListItem('Элемент 1', 0, $fontStyle, $listStyle);
$section->addListItem('Элемент 2', 0, $fontStyle, $listStyle);
$section->addListItem('Элемент 3', 0, $fontStyle, $listStyle);
$section->addListItem('Элемент 4', 0, $fontStyle, $listStyle);
$section->addListItem('Элемент 5', 0, $fontStyle, $listStyle);

// Экспериментирую (добавляем заголовок (второй параметр уровень заголовка: от 1 - 6))
$fontStyle = array('name' => 'Times New Roman', 'size' => 38, 'color' => '075776');
$phpWord->addTitleStyle(2, $fontStyle);
$section->addTitle('Заголовок', 2);

$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('ResFiles/result_annotation.docx');