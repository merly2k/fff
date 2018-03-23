<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$du=new users();
$da=new db();
if($this->param[0]='update'){
    $qu="UPDATE `payments_out` SET `status` = 'выплачено' WHERE `payments_out`.`id` =".$this->param[1].";";
    $da->query($qu);
    $context.=$da->lastState.  print_r($this->param,true);
}

$context='<div class="col-md-8">';
$q="select * from payments_out where status='ok';";
foreach ( $da->get_result($q) as $row) {
    $info=$du->SelectBy($row->uid);

$context.="<div class='col-md-4 panel panel-default'>"
	."<div class='panel-header'>заказ на вывод средств</div>"
	."пользователь:<img class='' style='width: 48px' src='".WWW_MEDIA_PATH."user/".$info[0]->userPhoto."'> ". $info[0]->login."<br>"
	."cумма вывода: ".$row->paysumm." $<br>"
	."кошелёк: ".$row->walet_num."<br>"
	."дата заказа:".date('m/d/Y H:i:s',$row->paydate)."<br>"
	."<a href='".WWW_ADMIN_PATH."payouts/update/".$row->id."' class='btn btn-info'>пометить как оплаченный</a></div>";    
}
$context.='</div>';
$context.='</div>';

$template="admin";

include TEMPLATE_DIR.$template.".html";

