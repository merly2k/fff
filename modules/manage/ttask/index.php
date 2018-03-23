<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * `id` INT(11) NOT NULL AUTO_INCREMENT,
	`tname` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`color` VARCHAR(20) NOT NULL COLLATE 'utf8_unicode_ci',
	`bgcolor` VARCHAR(20) NOT NULL COLLATE 'utf8_unicode_ci',
	`marker` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`decription` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
 */
$context='';
$template="newcab1";
$tt=new db();
 $context.="<table><thead>"
	 . "<tr>"
	 . "<td>#</td>"
	 . "<td>название</td>"
	 . "<td>цвет</td>"
	 . "<td>фон</td>"
	 . "<td>иконка</td>"
	 . "<td>описание</td>"
	 . "</tr>"
	 . "</thead>";
foreach ($tt->get_result('select * from taskType') as $row) {
    $context.="<tr><td>$row->id</td><td>$row->tname</td><td>$row->color</td><td>$row->bgcolor</td><td>$row->marker</td><td>$row->decription</td></tr>";
}

include TEMPLATE_DIR.DS.$template.".html";

