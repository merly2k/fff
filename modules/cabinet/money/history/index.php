<?php
$uid = $_SESSION['id'];
$tid = @$this->param[1];
$userstatus=getUserStatus($this->_data['id']);
$context = '';
$template = "newcab1";
$tree= 0;//userRefTree($this->$_SESSION['id']);
$structure=count($tree);
switch ($tree) {
    case $tree<10:
	$userstatus="Box-D";
	$roles="Box-D";
        break;
    case $tree>=10:
	$userstatus="Box-c";
	$roles="Box-C";
        break;
    case $tree>=100:
	$userstatus="Box-B";
	$roles="Box-B";
        break;
    case $tree>=1000:
	$userstatus="Box-A";
	$roles="Box-A";
        break;
    case $tree>=1000:
	$userstatus="Box-S";
	$roles="Box-S";
break;}

$todo = new db();
$history="<tr><td>".$_SESSION['regDate']."</td><td>Регистрация в системе</td></tr>";
$context.='
   <div class="container">
    <div class="col-md-12">
            <div class="panel panel-primary">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h2 class="panel-title">
                        История
                    </h2>
                </div>
            <div class="panel-body">
            <table class="table dataTable table-hover table-striped light-blue">
                <thead>
                    <tr>
                        <th>событие</th>
                        <th>дата</th>
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
';

include TEMPLATE_DIR . $template . ".html";
