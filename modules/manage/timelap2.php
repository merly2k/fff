<?php
ini_set("display_errors", 1);
error_reporting(99999);
$tl=new db();
$z="SELECT * FROM `dayli_count` WHERE `dayof`=15 ;";
foreach ($tl->get_result($z) as $value) {
    $value->id;
    $value->uid;
    $value->money;
    $value->refmoney;
    print_r($value);
    $upd_m="INSERT INTO `montli_count` (`uid`, `money`, `refmoney`dayof`) VALUES ( '$value->uid', '$value->money;', '$value->refmoney;', CURRENT_TIMESTAMP);" ;
    $clean_d="UPDATE`dayli_count` SET `money` = '0', `refmoney` = '0', `dayof` = '0' WHERE `id` = $value->id;";
    $insert="INSERT INTO `user_money` (`id`, `user_id`, `money`, `refmoney`, `last_change`, `paydate`)"
	    . " VALUES ($value->id, '$value->uid', '$value->money', '$value->refmoney', CURRENT_TIMESTAMP, now()) ON DUPLICATE KEY"
	    . " UPDATE `money` = `money`+$value->money, `refmoney` = `refmoney`+$value->refmoney, `last_change` = CURRENT_TIMESTAMP";
    //echo $insert;
    $tl->query($insert);
    $tl->query($upd_m);
    $tl->query($clean_d);
}
if($tl->lastState==''){
    echo "Данные обновлены";
    }else{
	echo "ошибка обновления:".$tl->lastState;
    }