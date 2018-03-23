<?php 
ini_set("display_errors", 0);
$uid=$this->_DATA['id'];
$user=new mainUser();
setlocale(LC_MONETARY, 'en_US');
$udata= new db();
$pribyl= money_format("%!n", ($user->mymoney/100));
$dayPay=money_format("%!n", ($user->dayli));
$refWallet=money_format("%!n", ($user->refmoney/100)) ;
$dayFefPay=0;
$nacislenia=0;
$regs=  Strukture();
$structure=count($user->structure,COUNT_RECURSIVE)-count($user->structure)."ч/".count($user->structure)."уровней";
foreach($user->history() as $row){
    //print_r($row);
    $history.="<tr><td>".$row->sobytie."</td><td>".$row->sdate."</td></tr>";
}

$urow=$user->UserPackets($uid);

$currefpay=0;
foreach ($user->UserRefPackets($uid)as $row){
$ttrow.=  print_r($row,true);

}
for ($index = 1; $index < 11; $index++) {
$r=array(
  1=>0.1,2=>0.05,3=>0.05,4=>0.04,5=>0.03,
  6=>0.02,7=>0.02,8=>0.015,9=>0.001,10=>0.001
);
}
$refpay=new db();
foreach ($refpay->query("select * from history where uid='".$uid."'")as $row){
    $refh.="<tr><td>".print_r($row,true)."</td></tr>";
}
	
	
	
//$pair=  Strukture();
$refpackSumm=0;
foreach($user->structure as $k=>$ra){
    $rf=$user->UserRefPackets($ra);
    //print_r($rf);
    $sula=$rf[PayPerDay]*$r[$k];
    $refpack.="<tr><td>$rf[packet]</td>";
    $refpack.="<td>$rf[investsumm]</td>";
    $refpack.= "<td>$rf[pribul]</td>";
    $refpack.= "<td>$rf[sdate]</td>";
    $refpack.= "<td>$rf[fdate]</td>";
    $refpack.= "<td>$sula</td>";
    $refpack.= "</tr>";
    $refpackSumm+=$sula;
}
$refpackSumm=money_format("%!n", ($refpackSumm));
//$MaxPacket=$user->MaxPak($uid);
$userstatus=  GetUserStastus($refpackSumm, $MaxPacket);




$userID=$this->_DATA['id'];
$pair=Strukture();
$tree=  userReferer($pair, $userID);
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

$template ="newcab1"; //uncomment this string if not use default template
$reflink=$user->reflink;
$context='
    	    

	 <div class="widget gs-w" data-row="3" data-col="1" data-sizex="2" data-sizey="2" style="min-height: 20rem;">
              <div class="w-section" style="background: url('.WWW_IMAGE_PATH.'s25.jpg); background-size: cover;">
                <div class="w-user"><img align="center" src="'.WWW_MEDIA_PATH.'user/'.$this->_DATA['userPhoto'].'"/>
                  <div><a class="name" href="#">'.$this->_DATA['name'].' '.$this->_DATA['fname'].'</a></div>
                </div>
              </div>
              <div class="row text-xs-center p-b-2">
                <div class="col-md-2 col-xs-6">
                  <div class="text-desc text-success">Мой кошелёк</div><b>'.$pribyl.' $ </b>
                </div>
                <div class="col-md-2 col-xs-6"> 
                  <div class="text-desc  text-success">Реферальный кошелёк</div><b>'.$refWallet.' $</b>
                </div>
                <div class="col-md-2 col-xs-6"> 
                  <div class="text-desc text-success">Начисления c начала периода</div><b>'.$dayPay.' $ </b>
                </div>
                <div class="col-md-2 col-xs-6"> 
                   <!--div class="text-desc text-success">Реферальные за день</div><b>'.$refpackSumm.' $ </b> 
                </div-->
                <div class="col-md-2 col-xs-12"> 
                  <div class="text-desc  text-success">Структура</div><b>'.$structure.'</b>
                </div>
              </div>
            </div>   
            </div>   
	    

';
$context.='
    <div class="row nomargin">
    <div class="col-lg-8 bordered">
        <div class="card  card-outline-primary">
	    <div class="card-header card-primary">
	    <h2 class="card-title">
                Инвестиции
            </h2>
            </div>
            <div class="card-block">
	    <div class="card-text">
                <table class="table dataTable table-hover table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>Тип</th>
                            <th>Сумма</th>
                            <th>Процент</th>
                            <th>Окончание</th>
                            <th>Выплата</th>
                            <th>Насчитано</th>
                        </tr>
                    </thead>
                    <tbody>'.$urow.'</tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card ">
            <div class="card-header card-primary">
                 <h2 class="card-title"> Ваша реферальная ссылка</h2>
            </div>
            <div class="card-block">
                <p>'.$reflink.' <b class="fa fa-copy clip btn btn-default" data-clipboard-text="'.$reflink.'"
                    title="copy link" style="cursor: hand;"></b>
                </p>
            </div>
        </div>
        <div class="card">
            <div class="card-header card-info">
                 <h2 class="card-title"> Ваш спонсор   </h2>
            </div>
            <div class="card-block">'.sponsorBlock().'</div>
        </div>
    </div>
</div>
	    
<div class="row nomargin">
    	<div class="col-md-8">
	    <div class="card card-outline-primary">
		<div class="card-header card-primary">
                    <h2 class="card-title">Реферальные начисления</h2>
		</div>
		<div class="card-block">
		<div class="card-text">
		    <table class="table table-responsive  table-hover table-striped dataTable">
			<thead>
			    <tr>
				<th>Тип</th>
				<th>Сумма</th>
				<th>Процент</th>
				<th>Окончание</th>
				<th>Выплата</th>
				<th>за месяц</th>
			    </tr>
			</thead>
			<tbody>
			   '.$refh.'
			</tbody>
		    </table>
		</div>
	    </div>
	    </div>
	</div>
	<div class="col-md-4">
	    <div class="card card-outline-primary">
		<div class="card-header card-primary">
		 <h2 class="card-title">
                    Регистрации
		    </h2>
                </div>
	        <div class="card-text" style="margin:15px;">
		    <table class="table dataTable table-responsive table-hover table-striped table-responsive">
			<thead>
			    <tr>
				<th>ник</th>
				<th>Дата регистраци</th>
			    </tr>
			</thead>
			<tbody>
			    '.$regas.'
			</tbody>
		    </table>
		</div>
	    </div>
	</div>
    </div>';
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
include TEMPLATE_DIR . DS . $template . ".html";
?>
