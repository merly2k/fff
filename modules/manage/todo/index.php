<?php
error_reporting(9999999);
$uid = $_SESSION['id'];
$tid = @$this->param[1];
$context = '';
$template = "cabinet";
$todo = new todo();
$modName="Задачи";
if($_SESSION['role']==9):
    $bcump='<li><a href="'.WWW_BASE_PATH.'manage"><i class="fa fa-dashboard"></i>Дачборд</a></li><li><a href="'.WWW_BASE_PATH.'"><i class="fa fa-home"></i> Головна</a></li>
         <li class="active"><a href="'.WWW_BASE_PATH.'todo/"><i class="fa fa-gavel"></i>Задачі</a></li>';

    else:
	$bcump='<li><a href="'.WWW_BASE_PATH.'"><i class="fa fa-dashboard"></i> Головна</a></li>
         <li class="active"><a href="'.WWW_BASE_PATH.'todo/"><i class="fa fa-gavel"></i>Задачі</a></li>';
endif;
        
if (!empty($tid)) {
    switch ($this->param[0]) {
	case 'report':
	    if (!$_POST):
		$context = '<div class="col-md-12">'
			. '<form method="post" class="form-horizontal">'
			. '<div class="form-group">'
			. '<label class="col-md-3 control-label" for="login">Отчет по задаче</label>'
			. '<textarea name="otchet" id="editor1" class="form-control editor1" rows="10" cols="80">'
			. '</textarea>'
			. '</div>'
			. '<div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-default"><i class="fa fa-save"></i> Сохранить</button>
  </div>'
			. '</form>'
			. '</div>';
	    else:
		extract($_POST);
		$otchet = stripcslashes($otchet);
		$params = array('otchet' => "$otchet");
		$todo->Update($params, $tid);
		$context = "<script>document.location.href='" . WWW_ADMIN_PATH . "todo';</script>";
	    endif;
	    break;
	case 'start':
	    $params = array('status' => 1);
	    $todo->Update($params, $tid);
	    $context = "<script>document.location.href='" . WWW_ADMIN_PATH . "todo';</script>";
	    break;
	case 'pause':
	    $params = array('status' => 2);
	    $todo->Update($params, $tid);
	    $context = "<script>document.location.href='" . WWW_ADMIN_PATH . "todo';</script>";
	    break;

	case 'finish':
	    $params = array('status' => 3);
	    $todo->Update($params, $tid);
	    $context = "<script>document.location.href='" . WWW_ADMIN_PATH . "todo';</script>";
	    break;
	case 'delete':
	    $params = array('status' => 3);
	    $todo->Delete($tid);
	    $context = "<script>document.location.href='" . WWW_ADMIN_PATH . "todo';</script>";
	    break;

	default:
	    $context = "<script>document.location.href='" . WWW_ADMIN_PATH . "todo';</script>";
	    break;
    }
}else {


    $context = '<div class="col-md-12">';
    
	if($_SESSION['role']>1):
	    $context.='<a href="'.WWW_ADMIN_PATH.'todo/addtask" class="btn btn-info">додати задачу</a><hr>';
	endif;
	$context.='<table class="table table-bordered table-hover dataTable">
	<div class="box-body table-responsive">
	<table class="table table-bordered table-hover dataTable">
            <thead>
              <tr>
                <th data-field="id">#</th>
                <th data-field="date" data-sortable="true">Cроки</th>
                <th data-field="task" data-sortable="true">Задача</th>
                <th data-field="report" data-sortable="true">Действия</th>
               </tr>
            </thead>
            <tbody>';
    foreach ($todo->SelectAll() as $row) {
	/**
	 * statuses
	 * 0- new or not started
	 * 1-started
	 * 2-paused
	 * 3-finished
	 * 4-closed by ovner
	 */
	switch ($row->status) {
	    case 0:
		$run = "<a href='" . WWW_ADMIN_PATH . "todo/start/" . $row->id . "'><i class='fa fa-play'></i></a>&nbsp;&nbsp;";
		$run.= "<a href='" . WWW_ADMIN_PATH . "todo/close/" . $row->id . "'><i class='fa fa-flag-checkered'></i></a>&nbsp;&nbsp;";
		$new = "success";
		break;
	    case 1:
		$run = "<a href='" . WWW_ADMIN_PATH . "todo/pause/" . $row->id . "'><i class='fa fa-pause'></i></a>&nbsp;&nbsp;";
		$run.="<a href='" . WWW_ADMIN_PATH . "todo/finish/" . $row->id . "'><i class='fa fa-stop'></i></a>&nbsp;&nbsp;";
		$run.= "<a href='" . WWW_ADMIN_PATH . "todo/report/" . $row->id . "'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;";
		$run.= "<a href='" . WWW_ADMIN_PATH . "todo/close/" . $row->id . "'><i class='fa fa-flag-checkered'></i></a>&nbsp;&nbsp;";
		$new = "";
		break;
	    case 2:
		$run = "<a href='" . WWW_ADMIN_PATH . "todo/start/" . $row->id . "'><i class='fa fa-play'></i></a>&nbsp;&nbsp;";
		$run.="<a href='" . WWW_ADMIN_PATH . "todo/finish/" . $row->id . "'><i class='fa fa-stop'></i></a>&nbsp;&nbsp;";
		$run.= "<a href='" . WWW_ADMIN_PATH . "todo/report/" . $row->id . "'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;";
		$run.= "<a href='" . WWW_ADMIN_PATH . "todo/close/" . $row->id . "'><i class='fa fa-flag-checkered'></i></a>&nbsp;&nbsp;";
		$new = "warning";
		break;
	    case 3:
		$run = "";
		$run.= "<a href='" . WWW_ADMIN_PATH . "todo/report/" . $row->id . "'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;";
		$run.= "<a href='" . WWW_ADMIN_PATH . "todo/close/" . $row->id . "'><i class='fa fa-flag-checkered'></i></a>&nbsp;&nbsp;";
		$new = "";
		break;


	    default:
		break;
	}
	if ($row->otchet == "") {
	    $otc = '';
	} else {
	    $otc = '<hr>' . $row->otchet;
	}

	$context.="<tr class='$new'><td>" . $row->id. "</td>"
		. "<td>c " . $row->start . "<br> по: " . $row->end. "</td>"
		. "<td>" . $row->task . "<br>" . $row->deckription . $otc. "</td>"
		. "<td class='panel-green'>". $run. "</td>"
		. "</tr>";
    };
    $context.='</tbody></table></div></div>';
}
include TEMPLATE_DIR . $template . ".html";

