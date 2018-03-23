<?php
//error_reporting(9999999);
$template = "cabinet"; //dform; //"index";
$module_name='Управление новостями';
$context='';
/**
 * 	`id` INT(10) NOT NULL AUTO_INCREMENT,
 * 	`name` VARCHAR(50) NULL DEFAULT NULL,
 * 	`deckription` TEXT NULL,
 */
//print_r($this);
//echo $this->param[0];
$cont_id = @$this->param[0];
$ajax = "";

$context='';
$ed = new db();


    $zap = "select * from news";
  $context='<div class="table-responsive">
      <a href="'.WWW_BASE_PATH.'cabinet/news/add" class="btn btn-info">додати новину</a><br>.<br>
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Заголовок</th>
                                            <th>Содержание</th>
                                            <th>Опубликовано</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
  foreach ($ed->get_result($zap) as $row) {
// [id][title][fool] [published]
      $context.="<tr><td>".$row->id
	    ."</td><td>".$row->title
	    ."</td><td>".strip_tags($row->article)
	    ."</td><td>".$row->published
	    ."</td><td class='panel-green'><a href='".WWW_BASE_PATH."cabinet/news/edit/".$row->id."'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;
                                <a href='".WWW_BASE_PATH."cabinet/news/del/".$row->id."'><i class='fa fa-trash-o'></i></a>
                                </td>"
	    ."</tr>";
  }
    

$context.='</tbody></table><a href="'.WWW_BASE_PATH.'cabinet/news/add" class="btn btn-info">додати новину</a>';
include TEMPLATE_DIR . DS . $template . ".html";
?>

