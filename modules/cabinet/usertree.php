<?php
//ini_set("display_errors", 1);
//error_reporting(99999);
function Strukture() {
    /**
     * Получаем полный список польpователей системы
     */
$tree=new db();
$sql="SELECT * FROM users ORDER BY apiKey ASC"; // строим запрос к базе пользователей
$rs= $tree->get_result($sql); // получаем список записей из БД

foreach($rs as $k=>$v){
    if(empty($v->apiKey)):$v->apiKey=0;endif;
    $pair[$v->apiKey][]=$v->id;
    
}
return $pair;
}

function RefLevelArray($level,$all){
foreach($level as $val){
    if(is_array($all["$val"])):
    $out=$all["$val"];
    endif;
}
return $out;
}
$pair=Strukture();
$userID=9;
function userReferer($pair,$userID,$level="all") {
    /**
     * @param num $userID Номер пользователя
     * @param num $level Номер уровня
     * @param array $pair - масив всех пользователей
     * Строим масив по уровням
     */
$level1=$pair[$userID];
$level2=RefLevelArray($level1,$pair);
$level3=RefLevelArray($level2,$pair);
$level4=RefLevelArray($level3,$pair);
$level5=RefLevelArray($level4,$pair);
$level6=RefLevelArray($level5,$pair);
$level7=RefLevelArray($level6,$pair);
$level8=RefLevelArray($level7,$pair);
$level9=RefLevelArray($level8,$pair);
$level10=RefLevelArray($level9,$pair);
$level11=RefLevelArray($level10,$pair);
$userRefererList=array(
	    $level1,$level2,$level3,
	    $level4,$level4,$level6,
	    $level7,$level8,$level9,
	    $level10);

if($level=="all"):
        return $userRefererList;
   else:
	return $userRefererList[$lvl];
   endif;

}

$userRefererList=  userReferer($pair, 1);
$thin=  userReferer($pair, 1, all);
echo "<pre>";
print_r($userRefererList);
print_r($thin); 
echo "<hr>";
