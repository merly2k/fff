<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$id=$this->param[0];
$u=new users();
if(!$_POST):
$cuser=$u->SelectBy($id);
$cuser=$cuser[0];
$context='<div class="col-md- 12 ">'
	. '<h2>Видалення користувача</h2>'
	. 'ви збираєтесь видалити '
	.'<b>'. $cuser->fname." ".$cuser->name." ".$cuser->sname.'?'
	. ''
	. '<form method="post">'
	. '<a href="'.WWW_ADMIN_PATH.'users" class="btn btn-danger">Відмовитись<a> '
	. '<input type="hidden" name="user" value=".$id.">'
	. '<button value="yes" class="btn btn-info">Погодитись</button>'
	. '</form>'
	. '</div>';
$template="newcab1";

include TEMPLATE_DIR.$template.".html";

else:
    $u->Delete($id);
echo '<script>
                    window.setTimeout(function(){location.replace("' .WWW_BASE_PATH. 'manage/users")},1000);
                    </script>';
endif;
