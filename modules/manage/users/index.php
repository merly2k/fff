<?php
$context='';
$template="newcab1";
$modName="Задачи";
$ulist=new users();
$z="SELECT * from users";
$context.="<a class='btn btn-info' href='".WWW_ADMIN_PATH."users/add_user'>Додати співробітника</a>"
	. "<br><hr>"
	. "<div class='box-body table-responsive'>"
	. "<table id='users' class='table table-bordered table-hover dataTable'>"
	. "<thead>"
	. "<tr>"
	. "<th>Фото</th>"
	    . "<th class='sorting' role='columnheader'>ФИО</th>"
	    . "<th>Телефон</th>"
	    . "<th>Действия</th>"
	. "</tr>"
	. "</thead>"
	. "<tbody>";
foreach ($ulist->get_result($z) as $row) {
    //$context.=print_r($row,true);
    $context.="<tr>"
	    . "<td class='user-panel'><div class='image'><img class='img-circle' src='".WWW_MEDIA_PATH."user/$row->userPhoto' title='зміна світлини проводится при редагуванні користувача'></div></td>"
	    . "<td>$row->fname $row->name $row->sname</td>"
	    . "<td>$row->phone</td>"
	    . "<td><a href='".WWW_ADMIN_PATH."users/edit_profile/$row->id'><i class='fa fa-edit' title='редагувати'></i></a>&nbsp;&nbsp;"
	    . "<a href='".WWW_ADMIN_PATH."users/del_profile/$row->id'><i class='fa fa-trash-o' title='видалити'></i></a></td>"
	    . "</tr>";
}
$context.="</tbody></table></div>";

include TEMPLATE_DIR.$template.".html";

