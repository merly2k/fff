<?php
$box=new db();
$uid=$_SESSION['id'];
$rou=$this->param[0];
$ml='';
switch ($rou) {
    case 'inbox':
	
	$inbox="select * from `mail` where `to`='".$uid."';";
	foreach ($box->get_result($inbox) as $row) {
	    $ml.='<a href="#" class="list-group-item">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">
                                        </label>
                                    </div>
                                    <span class="glyphicon glyphicon-star-empty"></span>
				    <span class="name" style="min-width: 120px;display: inline-block;">'.getNameById($row->from).'</span>
				    <span class="">'.$row->header.'</span>
                                    <span class="text-muted" style="font-size: 11px;">'.$row->body.'</span>
				    <span class="badge">'.$row->Date.'</span>
				    <span class="pull-right">
				    <span class="glyphicon glyphicon-paperclip"></span>
				    </span>
			    </a>';
	}
	break;
    case 'outbox':
	$outbox="select * from `mail` where `from`='".$uid."' and `status`>0;";
	foreach ($box->get_result($outbox) as $row) {
	    $ml.='<a href="#" class="list-group-item">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">
                                        </label>
                                    </div>
                                    <span class="glyphicon glyphicon-star-empty"></span>
				    <span class="name" style="min-width: 120px;display: inline-block;">'.getNameById($row->from).'</span>
				    <span class="">'.$row->header.'</span>
                                    <span class="text-muted" style="font-size: 11px;">'.$row->body.'</span>
				    <span class="badge">'.$row->Date.'</span>
				    <span class="pull-right">
				    <span class="glyphicon glyphicon-paperclip"></span>
				    </span>
			    </a>';
	}
	break;
    case 'drafts':
	$drafts="select * from `mail` where `from`='".$uid." and `status`=0";

	foreach ($box->get_result($drafts) as $row) {
	    $ml.='<a href="#" class="list-group-item">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">
                                        </label>
                                    </div>
                                    <span class="glyphicon glyphicon-star-empty"></span>
				    <span class="name" style="min-width: 120px;display: inline-block;">'.getNameById($row->from).'</span>
				    <span class="">'.$row->header.'</span>
                                    <span class="text-muted" style="font-size: 11px;">'.$row->body.'</span>
				    <span class="badge">'.$row->Date.'</span>
				    <span class="pull-right">
				    <span class="glyphicon glyphicon-paperclip"></span>
				    </span>
			    </a>';
	}
	break;

    default:
	break;
}



$susbox="select * from `mail` where `from`='0';";
$context='<style>
.nav-tabs .glyphicon:not(.no-margin) { margin-right:10px; }
.tab-pane .list-group-item:first-child {border-top-right-radius: 0px;border-top-left-radius: 0px;}
.tab-pane .list-group-item:last-child {border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;}
.tab-pane .list-group .checkbox { display: inline-block;margin: 0px; }
.tab-pane .list-group input[type="checkbox"]{ margin-top: 2px; }
.tab-pane .list-group .glyphicon { margin-right:5px; }
.tab-pane .list-group .glyphicon:hover { color:#FFBC00; }
a.list-group-item.read { color: #222;background-color: #F3F3F3; }
hr { margin-top: 5px;margin-bottom: 10px; }
.nav-pills>li>a {padding: 5px 10px;}

.ad { padding: 5px;background: #F5F5F5;color: #222;font-size: 80%;border: 1px solid #E5E5E5; }
.ad a.title {color: #15C;text-decoration: none;font-weight: bold;font-size: 110%;}
.ad a.url {color: #093;text-decoration: none;}</style>
<div class="container panel">
<div class="row">
<br>
</div>
    <div class="row">
        <div class="col-sm-3 col-md-2">
          <a href="#" class="btn btn-danger btn-sm btn-block" role="button">Создать</a>
           
        </div>
        <div class="col-sm-9 col-md-10">
            <!-- Split button -->
            <div class="btn-group">
                <button type="button" class="btn btn-default">
                    <div class="checkbox" style="margin: 0; padding:0;">
                        <label>
                            <input type="checkbox">
                        </label>
                    </div>
                </button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Выделить все</a></li>
                    <li><a href="#">Снять выделение</a></li>
                </ul>
            </div>
            <button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh">
                   <span class="glyphicon glyphicon-refresh"></span>   </button>
            <!-- Single button -->
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    More <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Отметить как прочитанное</a></li>
                    <li><a href="#">Удалить</a></li>
                    <li><a href="#">Архивировать</a></li>
                </ul>
            </div>
            <div class="pull-right">
                <span class="text-muted"><b>1</b>–<b>50</b> of <b>277</b></span>
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                    <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-sm-3 col-md-2">
            
            <ul class="nav nav-pills nav-stacked">
                
                <li><a href="'.WWW_BASE_PATH.'cabinet/mail/inbox"><span class="badge pull-right">42</span>Входящие </a></li>
                <li><a href="'.WWW_BASE_PATH.'cabinet/mail/outbox"><span class="badge pull-right">42</span>Отправленные </a></li>
                <li><a href="'.WWW_BASE_PATH.'cabinet/mail/drafts"><span class="badge pull-right">3</span>Черновики</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-md-10">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab"><span class="glyphicon glyphicon-inbox">
                </span>Вся почта</a></li>
                <li><a href="#profile" data-toggle="tab"><span class="glyphicon glyphicon-user"></span>
                    Рекуртинг</a></li>
                <li><a href="#messages" data-toggle="tab"><span class="glyphicon glyphicon-tags"></span>
                    Системные</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="home">
                    <div class="list-group">
                        '.$ml.'
                    </div>
                </div>
                <div class="tab-pane fade in" id="profile">
                    <div class="list-group">
                        <div class="list-group-item">
                            <span class="text-center">This tab is empty.</span>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade in" id="messages">
                    ...</div>
                <div class="tab-pane fade in" id="settings">
                    This tab is empty.</div>
            </div>
            <!-- Ad -->
            <div class="row-md-12">
               
            </div>
        </div>
    </div>
    <div class="row">
<br>
</div>
</div>
';
$template="io";


include TEMPLATE_DIR.$template.".html";

function getNameById($uid) {
    $us=new db();
    $q="select * from `users` where id=$uid";
    echo $q;
    foreach ($us->get_result($q) as $row) {
	$a = $row->fname.' '.$row->name;
    }
    if(!empty($a)){
	return $a;
    }else{
	return "рекуртинг онлайн";
    }
}