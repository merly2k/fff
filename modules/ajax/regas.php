<?php

$pair=Strukture();
//echo $this->param[0];
//echo"<pre>";
$tree=  userReferer($pair, $this->param[0]);
$u1=count(userReferer($pair, $this->param[0], 1));
$u2=count(userReferer($pair, $this->param[0], 2));
$u3=count(userReferer($pair, $this->param[0], 3));
$u4=count(userReferer($pair, $this->param[0], 4));
$u5=count(userReferer($pair, $this->param[0], 5));
$u6=count(userReferer($pair, $this->param[0], 6));
$u7=count(userReferer($pair, $this->param[0], 7));
$u8=count(userReferer($pair, $this->param[0], 8));
$u9=count(userReferer($pair, $this->param[0], 9));
$u10=count(userReferer($pair, $this->param[0], 10));
$all=$u1+$u2+$u3+$u4+$u5+$u6+$u7+$u8+$u9+$u10;

$userID=$this->param[0];
$udb=new db();

foreach($tree as $users){
    foreach($users as $rows){
    $s="select `login`,`regDate` from users where `id`='".$rows."';";
    $cur=$udb->get_result($s);
    //print_r($cur);
    $row=$cur[0];
    //print_r($row);
    $sd=new DateTime($row->regDate);
$regas.="<tr>
	<td>$row->login</td>

	<td>".$sd->format("d/m/Y")."</td>
   </tr>";
}
}
echo($regas);