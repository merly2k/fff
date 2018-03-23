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
    $zap = "select * from units where `id`='$cont_id' LIMIT 1;";
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
    $zap = "select * from units";
  $context='<a href="'.WWW_ADMIN_PATH.'units/add" class="btn btn-info">добавить осередок</a>
      <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>код карты</th>
                                            <th>осередок</th>
                                            <th>адрес</th>
                                            <th>контакты</th>
                                            <th>действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
  foreach ($ed->get_result($zap) as $row) {
// [id][title][fool] [published]
      $context.="<tr><td>".$row->id
	    ."</td><td>".$row->cod
	    ."</td><td>".$row->unit_name
	    ."</td><td>".$row->addtess
	    ."</td><td>"
	    .$row->contact_person."<br>"
	    .$row->phone
	    ."<br><a href='mailto:".$row->mail."'><i class='fa fa-mail'></i></a>"
	    ."</td><td class='panel-green'>"
	      . "<a href='".WWW_ADMIN_PATH."units/edit/".$row->id."'>
		<i class='fa fa-pencil'></i></a>&nbsp;&nbsp;
                <a href='".WWW_ADMIN_PATH."units/del/".$row->id."'>
		<i class='fa fa-trash-o'></i></a>
                              </td>"
	    ."</tr>";
  }
    
}

$postPrint="
    
        ";

include TEMPLATE_DIR . DS . $template . ".html";
?>

