<?php

class mainUser extends db {

    public $id;
    public $tree;
    public $paskets;
    public $info;
    public $reflink;
    public $keys=array();
    public $structure;
    public $sline;
    public $refmoney=0;
    public $mymoney=0;
    public $dayli=0;
    public $level=1;

    //put your code here
    function __construct() {
	parent::__construct();
	$this->userRefTree($_SESSION['id']);
	$this->UserPackets($_SESSION['id']);
	$this->lineSt();
	$this->reflink();
	$this->money();
    }

    public function money() {
	$q = "select * from user_money where user_id ='".$_SESSION['id']."';";
	$out=$this->get_result($q);
	$out=$out[0];
	//print_r($out);
	//$is_admin = ($user['permissions'] == 'admin') ? 0 : 1;
	$this->refmoney=(empty($out->refmoney)) ? 0 : $out->refmoney;
	$this->mymoney=(empty($out->money)) ? 0 : $out->money;
    }
    public function UserInfo($id) {
	$out='';
	/**
	 * Возщвращает полную информацию о пользователе в виде масива
	 */
	$q = "select * from users where id='$id' order by apiKey ASC;";
	$out=$this->get_rows($q);
	return $out[0];
    }

    public function countUserReferer() {
	/**
	 * Возщвращает масив с реферальной структурой пользователя
	 */
	
	array_walk_recursive($this->structure, function($value, $key) use (&$result){
    $result[] = array($key, $value);
    	});
	return count($result);
    }
    
    public function lineSt(){
	array_walk_recursive($this->structure, function($value, $key) use (&$result){
    $result[] = array($key, $value);
    	});
	    $this->sline= $result;
    }

    public function userRefTree($id) {
	/**
	 * Возщвращает масив с реферальной структурой пользователя
	 */
	$q = "select * from users where apiKey='$id' order by apiKey ASC;";	    
	
	$tmp=  $this->get_result($q);
	foreach ($tmp as $row) {
	    $this->structure[$id][$row->id]=$row;
	    $this->userRefTree($row->id);
	}
    }
    
    public function MaxPak($id) {
	$tmp=  $this->get_result("select MAX(`packet`)from user_fundation WHERE user_id='".$id."';");
	return $tmp[0];
	
    }


    public function UserPackets($uid,$arr=0) {
	/**
	 * Возщвращает масив с инвест-пакетами приобретённіми конкретным пользователем
	 */
$q = "select t1.*,t2.packet,t2.pribul,t3.dayof ,DATE_ADD(invest_date,INTERVAL 1 YEAR) as fdate,
DATE_ADD(invest_date, INTERVAL 15 DAY) as nextpay
from user_fundation  t1
JOIN dayli_count t3 ON (t3.uid=t1.user_id)
join
packets  t2 on (t2.id =t1.fund_id) where t1.user_id='". $uid . "';";
$urow="";
//echo $q;
	foreach ($this->get_result($q) as $di=>$row) {
	    $sdate = new DateTime($row->fdate);
	    $fdate = new DateTime($row->nextpay);
	    $paymentday = 1;
	    $curentpay = round(($row->invest_summ * $row->pribul / 3000)* $row->dayof, 2);
	    $dayPay = round(($row->invest_summ * $row->pribul / 3000)* $row->dayof, 2);
	    $this->dayli+=$curentpay;
if($arr==0){
	    $urow.="<tr><td>$row->packet</td>
		<td>$row->invest_summ $</td>
		<td>$row->pribul %</td>
		<td>" . $sdate->format("d/m/Y") . "</td>
		<td>" . $fdate->format("d/m/Y") . "</td>
		<td>$dayPay $</td>
	    </tr>";
    }else{
	    $urow[$di]['packet']=$row->packet;
	    $urow[$di]['invest_summ']=$row->invest_summ;
	    $urow[$di]['pribul']=$row->pribul;
	    $urow[$di]['sdate']=$sdate->format("d/m/Y");
	    $urow[$di]['fdate']=$fdate->format("d/m/Y");
	    $urow[$di]['curentpay']=$curentpay;
	    
    }
	}
	return $urow;
    
    }
	
    public function UserRefPackets($id) {
    foreach ($this->sline as $k=>$v){

	$q = "select t1.*,t2.packet,t2.pribul, DATE_ADD(invest_date,INTERVAL 1 YEAR) as fdate,
DATE_ADD(invest_date, INTERVAL 15 DAY) as nextpay
from user_fundation  t1
join
packets  t2 on (t2.id =t1.fund_id) where t1.user_id='" . $v[0] . "';";
	
	foreach ($this->get_result($q) as $row) {
	    $sdate = new DateTime($row->fdate);
	    $fdate = new DateTime($row->nextpay);
	    $dayPay = round($row->invest_summ * $row->pribul / 3000, 2);
	    
	    $up=array('packet'=>$row->packet,
		'investsumm'=>$row->invest_summ,
		'pribul'=>$row->pribul,
		'sdate'=>$sdate->format("d/m/Y"),
		'fdate'=>$fdate->format("d/m/Y"),
		'PayPerDay'=>$dayPay);
    }
    }
    return $up;
    }

    public function reflink() {
	$this->reflink = WWW_BASE_PATH . "register/" . $_SESSION['login'];
    }
    
    public function history($filter=0) {
	if($filter==0){
	    $q="select * from history where uid=".$_SESSION['id']." order by sdate ASC;";
	}else{
	    $q="select * from history where  stupe='$filter' uid=".$_SESSION['id']." order by sdate ASC;";
	}
	//print_r($q);
	return $this->get_result($q);
    }

    public function RefOborot(){
	$c=0;
	foreach ($this->structure as $row){
	    foreach($row as $it){
		$cur[]=$this->UserPackets($it->id);
		$c++;
}
	}
	$c;
    }
    public function getUserMoney(){
	$q="select * from `user_money` where `user_id`='".$_SESSION['id']."';";
	//echo $q;
	$m=$this->get_result($q);
	return $m[0];
    }
    
    
     private function _getSruct() {
        $query = "SELECT * FROM `users`"; //Готовим запрос
        //Выполняем запрос
        //Читаем все строчки и записываем в переменную $result
        $result = $this->get_result($query);
        //Перелапачиваем массим (делаем из одномерного массива - двумерный, в котором 
        //первый ключ - parent_id)
        $return = array();
        foreach ($result as $value) { //Обходим массив
            $return[$value->apiKey] = $value;
        }
        return $return;
    }
    
    public function outTree($parent_id, $level) {
	$category_arr=  $this->_getSruct();
	print_r($category_arr);
        if (isset($category_arr[$parent_id])) { //Если категория с таким parent_id существует
            foreach ($category_arr[$parent_id] as $value) { //Обходим ее
                /**
                 * Выводим категорию 
                 *  $level * 25 - отступ, $level - хранит текущий уровень вложености (0,1,2..)
                 */
                $out[$level]=$value;
                $level++; //Увеличиваем уровень вложености
                //Рекурсивно вызываем этот же метод, но с новым $parent_id и $level
                $this->outTree($value->id, $level);
                $level--; //Уменьшаем уровень вложености
            }
        }
    }

}
