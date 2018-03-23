<?php
//error_reporting(9999999);
$kml= new db();

// Selects all the rows in the markers table.
$q1 = "SELECT *,GROUP_CONCAT(lng, ',', lat, ',', '100' separator ' ') AS coordinates FROM markers where `marktupe`='poligon' group by task";
$q2="SELECT *,GROUP_CONCAT(lng, ',', lat, ',', '100' separator ' ') AS coordinates FROM markers where `marktupe`='poligon' group by task";
$q3="SELECT *,GROUP_CONCAT(lng, ',', lat, ',', '100' separator ' ') AS coordinates FROM markers where `marktupe`='poligon' group by task";
// Начало KML-файла, создаем родительский узел
$dom = new DOMDocument('1.0','UTF-8');
//Создаем управляющий элемент KML и присоединяем его к Document
$node = $dom->createElementNS('http://earth.google.com/kml/2.1','kml');
$parNode = $dom->appendChild($node);
foreach ($kml->get_result($query) as $row) {
  
//Создаем элемент Folder
$fnode = $dom->createElement('Folder');
$folderNode = $parNode->appendChild($fnode);

//Проходимся по результатам выборки

//Создаем элементы Placemark
$node = $dom->createElement('Placemark');
$placeNode = $folderNode->appendChild($node);

//Создаем атрибут id
$placeNode->setAttribute('id','linestring1');

//Создаем элементы name, description и adress
$nameNode = $dom->createElement('name',$row->name);
$placeNode->appendChild($nameNode);
$descNode= $dom->createElement('description', ' '.$row->type);
$placeNode->appendChild($descNode);
$addrNode= $dom->createElement('addres', ' '.$row->addres);
$placeNode->appendChild($addrNode);
$iconNode= $dom->createElement('href', WWW_BASE_PATH.'/images/icon/f6.png');
$placeNode->appendChild($iconNode);

//Создаем элемент LineString
$lineNode = $dom->createElement('LineString');
$placeNode->appendChild($lineNode);
$exnode = $dom->createElement('extrude', '1');
$lineNode->appendChild($exnode);
$almodenode =$dom->createElement(altitudeMode,'relativeToGround');
$lineNode->appendChild($almodenode);

//Создаем элемент coordinates
$coorNode = $dom->createElement('coordinates',$row->coordinates);
$lineNode->appendChild($coorNode);
}
$kmlOutput = $dom->saveXML();

//Выдаем заголовок KML
header('Content-type: application/vnd.google-earth.kml+xml');
echo $kmlOutput;
?>
