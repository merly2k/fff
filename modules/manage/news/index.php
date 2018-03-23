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
if (!empty($cont_id)) {
    $zap = "select * from news where `id`='$cont_id' LIMIT 1;";
    $ed->get_rows($zap);
//print_r($zap);
    extract($ed->result[0]);


    $context.="<fieldset>

<legend>редактор новостей</legend>
<a href='' class='btn btn-error'>add news</a>
<form name='add_content' method='POST' action='" . WWW_BASE_PATH . "/manage/news/update'>
    <input type='hidden' name='id' value='$cont_id' />
        <input type='hidden' name='ref' value='ed_content' />
     <div class='controls'><input type='text' class='form-control' name='header' value='$header' /></div><br />
<div class='width_full'>
    <textarea id='editor' name='content'>$content</textarea>
</div>
</form>
</fieldset>
";
}else{
    $zap = "select * from news";
  $context='<a href="'.WWW_BASE_PATH.'manage/news/add" class="btn btn-info">add news</a>
      <div class="table-responsive">
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
	    ."</td><td>".$row->article
	    ."</td><td>".$row->published
	    ."</td><td class='panel-green'><a href='".WWW_BASE_PATH."manage/news/edit/".$row->id."'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;
                                <a href='".WWW_BASE_PATH."manage/news/del/".$row->id."'><i class='fa fa-trash-o'></i></a>
                                </td>"
	    ."</tr>";
  }
    
}

$postPrint="
        function updateElement(tag,urls){
        //alert(tag);
                $.ajax(
                         {
                            type: \"get\",
                            url: urls,
                            success: function(html){
                            $(tag).html(html);
                           // $('.column').equalHeight();
                            }
                          }
                        );
              }
        function clearElement(tag){
        var clean='';
         $(tag).html(clean);
        }

        ";

include TEMPLATE_DIR . DS . $template . ".html";
?>

