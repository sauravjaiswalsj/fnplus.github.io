<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once('simple_html_dom.php');

$newsItems = array();

function cleanText($text){
	return trim(str_replace("\t", "", $text));
}

function getNews($source){
	for ($i=0; $i<sizeof($source); $i++){

		$item = array();
		$title_raw = $source[$i]->find('h4')[0];
		$snip_raw = $source[$i]->find('p');

		$title = $title_raw->plaintext;
		$link = "http://srmuniv.ac.in".$title_raw->find('a')[0]->href;
		$date = $source[$i]->find('span')[0]->plaintext.$source[$i]->find('em')[0]->plaintext;
		$date = str_replace("  ", " ", $date);
		$snip = "";

		for($j=0;$j<sizeof($snip_raw);$j++){
			$snip .= str_replace("... More", "...", $snip_raw[$j]->plaintext);
		}

		$item['title'] = cleanText($title);
		$item['snip'] = cleanText($snip);
		$item['link'] = cleanText($link);
		$item['date'] = cleanText($date);
		array_push($GLOBALS['newsItems'], $item);
	}
}

$source_1 = file_get_html('http://www.srmuniv.ac.in/Announcements');
$source_1 = $source_1->find('div[class=col-lg-12 col-xs-12 col-md-12 col-sm-12 margin-top-20px responsive-top news-border padding-0px]');

$source_2 = file_get_html('http://www.srmuniv.ac.in/University-News');
$source_2 = $source_2->find('div[class=col-lg-12 col-xs-12 col-md-12 col-sm-12 margin-top-20px responsive-top news-border padding-0px]');

getNews($source_1);
getNews($source_2);

echo json_encode(array("newsItems"=>$newsItems));

?>
