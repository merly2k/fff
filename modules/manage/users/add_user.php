<?php
if(!$_POST):
$option='';
$ol=new db();
foreach ($ol->get_result("select * from role") as $vl) {
    $option.='<option value="'.$vl->id.'">'.$vl->name.'</option>';
}
/* 
 * @var
`id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  `userPhoto` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `bio` text
  `veteran` int
  `INN` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `apiKey` text NOT NULL,
  `brith_date` date NOT NULL,
  `latestActivity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `regDate` datetime NOT NULL,
 */
$context='<form method="post" class="form-horizontal">'
	. '<fieldset>'
	. '<div class="form-group col-md-12">
	    <div class="form-group row">
	    <label class="col-md-2 control-label">Логин</label>  
	    <div class="col-md-2">
	    <input  name="login" placeholder="Логин" class="form-control input-md" type="text">
	    </div>
	    '
	
	. '<label class="col-md-2 control-label" for="textinput">Пароль</label>  
	    <div class="col-md-2">
	    <input  name="password" placeholder="Пароль" class="form-control input-md" type="text">
	    </div>
	    '
	. '
	<label class="col-md-2 control-label" for="textinput">Доступ: </label>  
	<div class="col-md-2">
	<select name="role" class="form-control input-md">'
	.$option.'
	</select>
	</div>
	</div>
	<hr>
	</div>'
	. '<div class="form-group col-md-12">
	    <div class="form-group row">
	    <label class="col-md-2 control-label" for="textinput">Призвіще</label>  
	    <div class="col-md-4">
	    <input  name="fname" placeholder="Призвіще" class="form-control input-md" type="text">
	    </div>
	    '
	
	. '
	    <label class="col-md-2 control-label" for="textinput">Им&rsquo;я</label>  
	    <div class="col-md-4">
	    <input  name="name" placeholder="Им\'я" class="form-control input-md" type="text">
	    </div>
	    </div>
	    </div>
	   '
	
	. '<div class="form-group col-md-12">
	    <div class="form-group row">
	    <label class="col-md-2 control-label" for="textinput">По батькові</label>  
	    <div class="col-md-4">
	    <input  name="sname" placeholder="Отчество" class="form-control input-md" type="text">
	    </div>
	   '
	
	. ' <label class="col-md-2 control-label">Дата нарождения</label>  
	    <div class="col-md-4">
	    <input  name="brith_date" placeholder="Дата нарождения" class="form-control input-md" type="text">
	    </div>
	    </div>
	    </div>'
	.'<div class="form-group col-md-12"><div class="form-group">
  <label class="col-md-2 control-label" for="textarea">Біография</label>
  <div class="col-md-10">                     
    <textarea class="form-control" name="bio"></textarea>
  </div>
</div>
<div class="form-group">
  <label class="col-md-2 control-label" for="checkboxes">ветеран</label>
  <div class="col-md-10">
  <div class="checkbox">
    <label for="checkboxes-0">
      <input name="veteran" id="checkboxes-0" value="1" type="checkbox">
      *виводить у переліку ветеранів організації
    </label>
	</div>
  </div>
</div>'
	. '<div class="form-group col-md-12">
	    <div class="form-group row">
	    <label class="col-md-2 control-label" for="textinput">ІНН</label>  
	    <div class="col-md-4">
	    <input  name="INN" placeholder="INN" class="form-control input-md" type="text">
	    </div>
	    </div>
	    '
	. '<div class="form-group col-md-12">
	    &nbsp<hr>
	    <div class="form-group row">
	    <label class="col-md-2 control-label" for="textinput">телефон</label>  
	    <div class="col-md-4">
	    <input  name="phone" placeholder="телефон" class="form-control input-md" type="text">
	    </div>
	    <div class="form-group row">
	    <label class="col-md-2 control-label" for="textinput">пошта</label>  
	    <div class="col-md-4">
	    <input  name="mail" placeholder="user@mail" class="form-control input-md" type="text">
	    </div>
	    </div>'
	
	. '<div class="form-group">
  <div class="col-md-2 pull-right">
    <button class="btn btn-primary" type="submit">Зберегти</button>
  </div>
</div>'
	. '</fieldset>'
	. '</form>';








$template="newcab1";

include TEMPLATE_DIR.$template.".html";

else:
   $ins=new users();
    echo ' <meta charset="UTF-8">
	<pre>';
    extract($_POST);
    $param=array(
    "login" => "$login",
    "password" => md5($password),
    "role" => "$role",
    "userPhoto"=>'no_photo.png',
    "fname" => "$fname",
    "name" => stripslashes("$name"),
    "sname" =>stripslashes("$sname"),
    "bio" => stripslashes("$bio"),
    "veteran" => "$veteran",
    "INN" => (int)$INN,
    "phone" => "$phone",
    "mail" => "$mail",
    "brith_date" => "$brith_date",
    "apiKey"=>'000',
    'regDate'=>'now()'
    );
    $ins->Insert($param);
    echo '<script>
            window.setTimeout(function(){location.replace("' .WWW_BASE_PATH. 'manage/users")},1000);
          </script>';
endif;