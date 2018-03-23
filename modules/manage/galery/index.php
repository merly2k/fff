<?php

if ($_SESSION["role"] < 6):
    header('HTTP/1.0 403 Forbidden');
    header("Location:" . WWW_BASE_PATH . "auth/logout");
endif;
$ajax = '';
$context = "";
$cont_id = @$this->param[0];

$module_name = 'Фотогалерея';
$template = "cabinet";

if (!empty($cont_id)):
    
else:
    $gal=new img_galery();
  $context='<a href="'.WWW_ADMIN_PATH.'galery/add" class="btn btn-info">Добавить</a>
      <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Фото</th>
                                            <th>Описание</th>
                                            <th>действие</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
    
    foreach ($gal->SelectAll() as $row) {
	$context.="<tr>"
	    . "<td>".$row->id
	    ."</td><td><img class='img-responzive' src='".WWW_MEDIA_PATH."galery/".$row->file."' style='width:150px;'/>"
	    ."</td><td>".$row->name."<br>".$row->decription
	    ."</td><td class='panel-green'>"
	    . "<a href='".WWW_ADMIN_PATH."galery/".$row->id."'><i class='fa fa-pencil'></i></a>
		&nbsp;&nbsp;
               <a href='".WWW_ADMIN_PATH."galery/del_content/".$row->id."'><i class='fa fa-trash-o'></i></a>
                                </td>"
	    ."</td><tr>";
    };
    $context.='</tbody></table>';  
    
endif;
$tt = new templator();

include TEMPLATE_DIR . DS . $template . ".html";
