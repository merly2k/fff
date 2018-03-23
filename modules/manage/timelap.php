<?php

//ini_set("display_errors", 1);
//error_reporting(99999);
//изменяем номер дня
$up=new db();


echo "обновляем платежи за день для пользователя<pre>";
$f=$up->get_result("select `id` from users");
foreach ($f as $vl) {
    //print_r($vl);
    $allMoney=0;
    echo "обновляем данные пользователя ".$vl->id."<br>";
$q="select "
	. "t1.user_id,"
	. "t3.money,"
	. "t3.refmoney,"
	. " t1.invest_date,"
	. "t1.invest_summ,"
	. "t1.fund_id,"
	. " t1.payments_period ,"
	. "t2.pribul,"
	. " t2.levels,"
	. " t2.level1,"
	. "t2.level2,"
	. "t2.level3,"
	. "t2.level4,"
	. "t2.level5,"
	. "t2.level6,"
	. "t2.level7,"
	. "t2.level8,"
	. "t2.level9,"
	. "t2.level10"
	. " from user_fundation as t1 "
	. "join user_money as t3 on (t1.user_id=t3.user_id) "
	. "join packets as t2 on (t2.id =t1.fund_id) where t1.user_id='".$vl->id."';";
  $tm=$up->get_result($q);
  foreach ($tm as $r=>$w){
$pp=$w->payments_period;
$newmoney=$w->invest_summ * $w->pribul /30;
$allMoney+=$newmoney;
$lewels=$w->levels;
}


 $all=new utree();
 $s=$all->lvl($vl->id);
 if(!empty($s)){
$budda=array_slice($s, 2);
$out=0;
foreach ($budda as $row) {
    if(!empty($row)){
	$lap=new mainUser();
	$bap=$lap->UserPackets($row[0]->id,2);
	foreach($bap as $bir)
	$out=$out+($bir['curentpay']*100);
	
    }
}	 
 }
 //print_r($s);

echo "Итого за пакеты:".$allMoney."Реферальных: ".$out."<br>";
$a=  dayly($vl->id,$allMoney,$out);
}


function updateMoney($uid,$ammount) {
    $d=new db();
    $update_money="UPDATE `user_money` SET `money`=`money`+$ammount WHERE  `user_id`=".$uid.";";
    $d->query($update_money);
    echo $d->lastState;
}
function updateRefmoney($uid,$ammount) {
    $d=new db();
    $update_money="UPDATE `user_money` SET `money`=`refmoney`+$ammount WHERE  `user_id`=".$uid.";";
    $d->query($update_money);
}
function dayly($uid,$money, $refmoney) {
    $d=new db();
    
    $q="INSERT INTO `dayli_count` (`uid`, `money`, `refmoney`, `dayof`) VALUES ('$uid','$money', '$refmoney', '1')"
	    . " ON DUPLICATE KEY UPDATE `money`=`money`+'$money', `refmoney`=`refmoney`+ '$refmoney', dayof=dayof+1;";
    $d->query($q);
    //print_r($q);
    echo $d->lastState;
}