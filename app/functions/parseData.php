<?php
header('Content-type: text/html; charset=utf-8');
require __DIR__ . '/app/libs/phpQuery.php';

function get_content($url) {
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, TRUE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	
	$result = curl_exec($ch); // возвращает boolean true
	curl_close($ch);

	return $result;
}

function parser($url, $start, $end) {
	if($start < $end) {
		# $file = file_get_contents($url);
		$file = get_content($url);
		$doc = phpQuery::newDocument($file);

		foreach($doc->find('.articles-container .post-excerpt') as $article) {
			$article = pq($article);
			
			$img = $article->find('.img-cont img')->attr('src');
			$text = $article->find('.pd-cont')->html();

			// echo "<img src='$img'>";
			// echo $text;
			// echo '<hr>';
		}

		$next = $doc->find('.pages-nav .current')->next()->attr('href');

		if(!empty($next)) {
			$start++;
			parser($next, $start, $end);
		}
	}
}


$url = 'www.royallib.ru';

$start = 0;
$end = 3;

parser($url, $start, $end);
