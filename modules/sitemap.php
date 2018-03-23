<?php
$db=new db();
$db->get_rows("select SQL_CALC_FOUND_ROWS menu_name,meny_link,parent,now() as lastmod from menu where `parent` ='0'");

define('DATE_FORMAT_RFC822','r');
//echo "Создаем документ";


$xml = new DomDocument('1.0','utf-8');

//Заголовки
$urlset = $xml->appendChild($xml->createElement('urlset'));
$urlset->setAttribute('xmlns:xsi','http://www.w3.org/2001/XMLSchema-instance');
$urlset->setAttribute('xsi:schemaLocation','http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');
$urlset->setAttribute('xmlns','http://www.sitemaps.org/schemas/sitemap/0.9');

if ($db->found>=1) {//2
foreach($db->result as $row) {

// Вы можете сконвертировать свою дату в нужный формат DATE_FORMAT_RFC822
$lastmod_value = date(DATE_FORMAT_RFC822, $data['time']);;

$url = $urlset->appendChild($xml->createElement('url'));
$loc = $url->appendChild($xml->createElement('loc'));
$lastmod = $url->appendChild($xml->createElement('lastmod'));
$changefreq = $url->appendChild($xml->createElement('changefreq'));
$priority = $url->appendChild($xml->createElement('priority'));
$loc->appendChild($xml->createTextNode(WWW_BASE_PATH.$row['meny_link']));
$lastmod->appendChild($xml->createTextNode($row[lastmod]));
$changefreq->appendChild($xml->createTextNode('monthly'));
//Укажем средний приоритет
$priority->appendChild($xml->createTextNode('0.5'));
}

}

$xml->formatOutput = true;
//$xml->saveHTML();
//Записываем файл
$xml->save('sitemap.xml');
echo "ok";
?>