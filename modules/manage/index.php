<?php
ini_set("display_errors", 1);
error_reporting(9999);
if ($_SESSION["role"]<6):
    header('HTTP/1.0 403 Forbidden');
    header("Location:" . WWW_BASE_PATH . "auth/logout");
endif;
$ajax = '';
$context = "";
$blogStat="";
$bcump='<li><a href="'.WWW_ADMIN_PATH.'"><i class="fa fa-dashboard"></i> Головна</a></li>
        <li class="active"><a href="'.WWW_BASE_PATH.'uslugi/"><i class="fa fa-gavel"></i>Панель керування</a></li>';
$modName= 'Панель управления';
$template = "admin";


$tt=new templator();
$tpp=' <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-list"></span> {BlockName}
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            Всего записей <i class="pull-right badge">{PU}</i>
                        </li>
			<li class="list-group-item">
                            Опубликовано <i class="pull-right badge">{PB}</i>
                        </li>
			<li class="list-group-item">
                            Не опубликовано <i class="pull-right badge">{PD}</i>
                        </li>
			<li class="list-group-item">
                            Комментариев <i class="pull-right badge">{CM}</i>
                        </li>
                    </ul>
                </div>
                <div class="panel-footer">
                  
                </div>
            </div>
        </div>';


include TEMPLATE_DIR . DS . $template . ".html";

?>
