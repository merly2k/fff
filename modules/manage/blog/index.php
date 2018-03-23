<?php
//error_reporting(9999);
$template = "admin";
$modName='Управление статьями';
if($_SESSION['role']==9):
    $bcump='<li><a href="'.WWW_BASE_PATH.'manage"><i class="fa fa-dashboard"></i>Дачборд</a></li><li><a href="'.WWW_BASE_PATH.'"><i class="fa fa-home"></i> Головна</a></li>
        <li class="active"><a href="'.WWW_BASE_PATH.'uslugi/"><i class="fa fa-gavel"></i>статьи</a></li>';

    else:
	$bcump='<li><a href="'.WWW_BASE_PATH.'"><i class="fa fa-dashboard"></i> Головна</a></li>
        <li class="active"><a href="'.WWW_BASE_PATH.'uslugi/"><i class="fa fa-gavel"></i>статьи</a></li>';

endif;

$context='';

$cont_id = @$this->param[0];
$ajax = " ";


$ed = new blog();
    if($_POST){
	//    [id] => 10     [title] => Театр     [content] => Театр Театр
    extract($_POST);
    $params=array(
	"name"=>$title,
	"article"=>$content
	
    );
    $z_ap = new blog();
    $z_ap->Update($params, $id);
    if ($z_ap->lastState) {
	$message = $z_ap->lastState;
    } else {
	$message = "сохранено";
	 echo "<script>setTimeout(function() { location.replace('" . WWW_BASE_PATH . "manage/blog/'); }, 900)</script>";
    }
    }
if (!empty($cont_id)) {
    
    
    $art=$ed->SelectBy($cont_id);
    $art=$art[0];
    $context.="<div class='container'><fieldset>

<hr>
<form name='add_content' method='POST'>
<select class=\"selectpicker\" data-style=\"btn-primary\" data-width=\"auto\" style=\"display: none;\">
      <option value='1' data-icon=\"glyphicon glyphicon-music\">Опубликовано ".$art->pdate."</option>
      <option value='0' data-icon=\"glyphicon glyphicon-heart\">Не опубликовано</option>
  </select><br>
    <input type='hidden' name='id' value='$art->id' />
    <label>Заголовок</label><input class='' type='text' name='title' value='$art->name' /><br><br><br>

    <textarea id='editor' rows='28' class='editor' style='width:100%' name='content'>$art->article</textarea>
	

	<button class='btn btn-success'><i class='fa fa-save'></i> Сохранить</button>
</form>

</fieldset></div>
";
} else {
    $context='<a class="btn btn-info" href="'.WWW_ADMIN_PATH.'blog/new">добавить статью</a>
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Заголовок</th>
                                            <th>Статья</th>
                                            <th>действие</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
    
    foreach ($ed->SelectAll() as $row) {
	
	$context.="<tr><td>".$row->id
	    ."</td><td>".$row->name
	    ."</td><td>".strip_tags($row->article)
	    ."</td>"
	    . "<td class='panel'>"
		. "<a href='".WWW_ADMIN_PATH."blog/".$row->id."'>
		    <i class='fa fa-pencil'></i></a>
		    &nbsp;&nbsp;
                    <a href='".WWW_ADMIN_PATH."blog/del_content/".$row->id."'>
		    <i class='fa fa-trash-o'></i></a>"
	    ."</td>"
	. "<tr>";
    };
    $context.='</tbody></table>';
    
}




include TEMPLATE_DIR . DS . $template . ".html";
?>

