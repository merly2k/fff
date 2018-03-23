<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$uid=$this->_DATA['id'];
$user=new mainUser();

$udata= new db();
$pribyl=$user->mymoney;
$dayPay=$user->dayli;
$refWallet=$user->refmoney ;
$dayFefPay=0;
$nacislenia=0;
$regs=  Strukture();
$structure=count($user->structure,COUNT_RECURSIVE)-count($user->structure)."ч/".count($user->structure)."уровней";
foreach($user->history() as $row){
    //print_r($row);
    $history.="<tr><td>".$row->sobytie."</td><td>".$row->sdate."</td></tr>";
}

$urow=$user->UserPackets($uid);

$context='';
$context.='
    <div class="row nomargin">
        <div class="col-md-12">
            <div class="card card-outline-primary">
                <!-- Default panel contents -->
                <div class="card-header card-primary"><h2 class="card-title">
                                            История</h2>
                </div>
            <div class="panel-body">
            <div class="panel-text">
		<table class="table dataTable table-hover table-striped light-blue">
		    <thead>
			<tr>
			    <th>Событие</th>
			    <th>Дата</th>
			</tr>
		    </thead>
		    <tbody>
'.$history.'
		    </tbody>
		</table>
	    </div>
	    </div>
	
    <br><br>
';
$template="newcab1";

include TEMPLATE_DIR.$template.".html";

