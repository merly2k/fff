<?php

// UI(user interfaces)
$roleList=new db();
foreach ($roleList->get_result("Select * from role") as $rl){
    $roles["$rl->id"]=$rl->name;
    $option[]="$rl->id:'$rl->name'";
}
$roption= "{".implode(",",$option)."}";
$rol=json_encode($roles);
$template = "cabinet"; //"index";
$mod_name = 'правка профиля';
$uid=$this->param[0];
$userdata=new users();
$ud=$userdata->SelectBy($uid);
$pf=$ud[0];
if(!$_POST):
$context='<div class="well">
    <h2>Профиль пользователя<button class="btn btn-primary pull-right" id="enable">Разрешить редактировать <i id="keylock" class="fa fa-lock"></i></button></h2>
  	<hr>
	<div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src="'.WWW_MEDIA_PATH.'user/'.$pf->userPhoto.'" class="avatar img-circle" alt="avatar"><br>
          
<caption><a onclick="AjaxModal(&quot;'.WWW_BASE_PATH.'ajax/photoUpload/'.$pf->id.'/&quot;)" class="add_foto" style="color:green">Сменить фото</a><caption>
          
          </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">Права доступа:</label>'
	    .'<div class="col-lg-8">'
	    . '<a class="editable" id="role" data-type="select" data-name="role" data-pk="'.$uid.'" data-source="'.$roption.'" data-original-title="Select group" data-url="'.WWW_BASE_PATH.'manage/users/edit_profile/'.$uid.'"> '.$roles["$pf->role"].'</a>'
	    . '</div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Имя:</label>'
	    .'<div class="col-lg-8">'
	    . '<a class="editable" href="#" id="name" data-type="text" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'manage/users/edit_profile/'.$uid.'">'.$pf->name.'</a>'
            . '</div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Отчество:</label>'
	    .'<div class="col-lg-8">'
	    . '<a class="editable" href="#" id="sname" data-type="text" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'manage/users/edit_profile/'.$uid.'">'.$pf->sname.'</a>'
            . '</div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Фамилия:</label>'
	    .'<div class="col-lg-8">'
	    . '<a class="editable" href="#" id="fname" data-type="text" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'manage/users/edit_profile/'.$uid.'">'.$pf->fname.'</a>'
            . '</div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">д.р:</label>'
	    .'<div class="col-lg-8">'
	    . '<a class="editable" href="#" id="brith_date" data-type="date" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'manage/users/edit_profile/'.$uid.'">'.$pf->brith_date.'</a>'
            . '</div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">ІНН:</label>'
	    .'<div class="col-lg-8">'
	    . '<a class="editable" href="#" id="INN" data-type="text" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'manage/users/edit_profile/'.$uid.'">'.$pf->INN.'</a>'
            . '</div>
          </div>
          <div class="form-group">
          <div class="form-group">
            <label class="col-lg-3 control-label">Биография:</label>'
	    .'<div class="col-lg-8">'
	    . '<a class="editable" href="#" id="bio" data-name="bio" data-type="textarea" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'manage/users/edit_profile/'.$uid.'">'.$pf->bio.'</a>'
            . '</div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Ветеран(основной e-mail):</label>'
	    .'<div class="col-lg-8">'
	    . '<a class="editable" href="#" id="veteran" data-type="select" data-pk="'.$uid.'" data-source="{0: \'no\', 1: \'yes\'}" data-url="'.WWW_BASE_PATH.'manage/users/edit_profile/'.$uid.'">'.$pf->veteran.'</a>'
            . '</div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Логин(основной e-mail):</label>'
	    .'<div class="col-lg-8">'
	    . '<a class="editable" href="#" id="login" data-type="text" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'manage/users/edit_profile/'.$uid.'">'.$pf->login.'</a>'
            . '</div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Телефон:</label>'
	    .'<div class="col-lg-8">'
	    . '<a class="editable" href="#" id="phone" data-type="text" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'manage/users/edit_profile/'.$uid.'">'.$pf->phone.'</a>'
            . '</div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">дополнительный e-mail:</label>'
	    .'<div class="col-lg-8">'
	    . '<a class="editable" href="#" id="email" data-type="text" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'manage/users/edit_profile/'.$uid.'">'.$pf->email.'</a>'
            . '</div>
          </div>

        </form>
      </div>
  </div>
</div>
<hr>'
	. '';

$template="newcab1";


include TEMPLATE_DIR.$template.".html";
else:
    print_r($_POST);
    
    $pn=$_POST['name'];
    $pv=$_POST['value'];
    $_SESSION[$pv]=$pn;
$rid=$_POST['pk'];
echo $userdata->Update(array($pn=>$pv), $rid);
endif;

?>
