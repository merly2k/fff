<?php
$template = "newcab1"; //uncomment this string if not use default template
$module_name = "Мои счета";
$money = new db();
$summa = 0;
$invest = 0;
$funds = 0;
$uid= $_SESSION['id'] ;
setlocale(LC_MONETARY, "en_US");
$q = "SELECT t1.*,t2.packet
FROM user_fundation t1
LEFT JOIN packets AS t2 ON t1.fund_id = t2.id
where `user_id`='" .$uid. "';";
$mm = $money->get_result($q);

$tree=0; //userRefTree($this->$_SESSION['id']);
$structure=count($tree);

foreach ($mm as $k => $m) {
    $packets.="<tr><td>$m->packet</td><td>$m->invest_date</td><td>" . money_format("%.2i", $m->invest_summ) . "</td></tr>";
};
$ss = $money->get_result("SELECT * FROM `user_fundation` WHERE  `user_id`='" . $_SESSION['id'] . "';");
foreach ($ss as $s) {
    $invest = $invest + $s->invest_summ;
};
$ff = $money->get_result("SELECT * FROM `user_fundation` WHERE  `user_id`='" . $_SESSION['id'] . "';");
foreach ($ff as $f) {
    $funds = $funds + $f->invest_summ;
};
$bl = new db();
$rows = $bl->get_result("select * from packets");
//print_r($rows);
$tl.='<div class="col-md-1"></div>';
foreach ($rows as $row) {
    //print_r($row); 
    switch ($row->id) {
	case 1:
	    $cssc = "primary-bg";
	    break;
	case 2:
	    $cssc = "warning-bg";
	    break;
	case 3:
	    $cssc = "success-bg";
	    break;
	case 4:
	    $cssc = "info-bg";
	    break;
	case 5:
	    $cssc = "pink";
	    break;

	default:
	    $cssc = "green";
	    break;
    }
	    $tl.='
		<div class="col-md-2 col-sm-6 col-xs-12 ">        
                    <div class="price_table_container">
                        <div class="price_table_heading">' . $row->packet . '</div>
                        <div class="price_table_body">
                            <div class="price_table_row cost ' . $cssc . '">
			    Прибыль
			    <strong>' . $row->pribul . '%</strong>
				<br>
				<span>в месяц</span>
			    </div>
                            <div class="price_table_row">Минимальный вклад: <b>' . $row->minpack . '$</b></div>
                            <div class="price_table_row">Максимальный вклад: <b>' . $row->maxpack . '$</b></div>
                            <div class="price_table_row">Выплаты: раз в 15 дней</div>
                            <div class="price_table_row">Срок инвестиций 12 месяцев</div>
                        </div>
                        <a class="btn btn-warning btn-lg btn-block" href="' . WWW_BASE_PATH . 'cabinet/money/bypack/' . $row->id . '" >Инвестировать</a>
                    </div>
                </div>';
    
}

$context.='
    <div class="col-11">
    <div class="row justify-content-md-center">
        ' . $tl . '
    </div>    
    </div>    
    </div>    
   
    <br>
    
    ';
$context.='
    <div class="container">
       <div class="card card-inverse">
    <!-- Default panel contents -->
    <div class="card-header bg-primary">
         <h2 class="card-title">
                        История платежей
         </h2>
    </div>
    <div class="card-block">
    <div class="container">
        <table class="table dataTable table-hover table-striped table-responsive">
            <thead>
                <tr>
                    <th>№ заявки</th>
                    <th>Вы отдали</th>
                    <th>Дата</th>
                    <th>Действие/Статус</th>
                </tr>
            </thead>
            <tbody>
                '.$history.'
                
            </tbody>
        </table>
    </div>
    </div>
</div>
</div>
<br />
';
include TEMPLATE_DIR . DS . $template . ".html";