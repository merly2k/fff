<?php
//print_r($_SESSION);
ini_set("display_errors", 0);
error_reporting(99999);
$module_name="Личный кабинет";
$uid=@$_SESSION['id'];
$userdata=new users();
$ud=@$userdata->SelectBy($uid);
$pf=@$ud[0];
//print_r($ud);
$tree=0;
$structure=count($tree);
//$MaxPacket=$user->MaxPak($uid);
$userstatus=  GetUserStastus($refpackSumm, $MaxPacket);



if(!$_POST):
$context='
  <div class="container">
  <br>
  <div class="card card-inverse ">
    <div class="card-header no-margin bordered bg-primary">
      <h2>Профиль пользователя<button class="btn btn-primary pull-right" id="enable">Разрешить редактировать <i id="keylock" class="fa fa-lock"></i></button></h2>
    </div>
    <div class="card-block">
    <div class="row">
          <div class="col-md-4">
	 <img src="'.WWW_MEDIA_PATH.'user/'.$pf->userPhoto.'" class="avatar rounded" alt="avatar" style="width:180px;">
	     <br> <br>
	     <a class="btn btn-success" onclick="window.open(\''.WWW_BASE_PATH.'ajax/photoUpload/'.$uid.'\', \'newwindow\', \'width=480, height=450\'); return false;" target="_blank" href="'.WWW_BASE_PATH.'ajax/photoUpload/'.$uid.'" >Сменить фото</a>
	 </div>
          <div class="col-md-8">
        <div class="form-group">
          <div class="col-8">
	  <label class="col-5 form-control-label text-left">Имя:</label>
	  <a class="editable" href="#" id="name" data-type="text" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'cabinet/profile">'.$pf->name.'</a>
        </div>
        <div class="form-group"> 
          <div class="col-8">
	  <label class="col-5 form-control-label">Отчество:</label>
          <a class="editable" href="#" id="sname" data-type="text" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'cabinet/profile">'.$pf->sname.'</a>
	  </div>
        </div>
        <div class="form-group">
          <div class="col-8"> 
	  <label class="col-5 form-control-label">Фамилия:</label>
	  <a class="editable" href="#" id="fname" data-type="text" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'cabinet/profile">'.$pf->fname.'</a>
        </div>
        <div class="form-group">
          <div class="col-8">
	  <label class="col-5 form-control-label">Логин:</label>
	  <a class="" href="#" id="login" data-type="text" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'cabinet/profile">'.$pf->login.'</a>
        </div>
        <div class="form-group"> 
          <div class="col-8"><label class="col-5 form-control-label">профиль фейсбука:</label>
	  <a class="editable" href="#" id="facebook" data-type="text" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'cabinet/profile">'.$pf->facebook.'</a>
          </div>
        </div>
        <div class="form-group"> 
          <div class="col-8">
	  <label class="col-5 form-control-label">профиль VK:</label>
	  <a class="editable" href="#" id="vk" data-type="text" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'cabinet/profile">'.$pf->vk.'</a>
	  </div>
        </div>
        <div class="form-group"> 
          <div class="col-8">
          <label class="col-5 form-control-label">профиль Google+:</label>
	  <a class="editable" href="#" id="google" data-type="text" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'cabinet/profile">'.$pf->google.'</a>
          </div>
        </div>
        <div class="form-group"> 
          <div class="col-8">
	  <label class="col-5 form-control-label">Телефон:</label>
	  <a class="editable" href="#" id="phone" data-type="text" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'cabinet/profile">'.$pf->phone.'</a>
          </div>
        </div>
        <div class="form-group">
          <div class="col-8">
	  <label class="col-5 form-control-label">skype:</label>
	  <a class="editable" href="#" id="skype" data-type="text" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'cabinet/profile">'.$pf->skype.'</a>
        </div>
        </div>
        <div class="form-group"> 
          <div class="col-8">
            <label class="col-5 form-control-label">e-mail:</label>
	    <a class="" href="#" id="email" data-type="text" data-pk="'.$uid.'" data-url="'.WWW_BASE_PATH.'cabinet/profile">'.$pf->email.'</a>
          </div>
        </div>  

	</div>
        </div>
        
      </div>
    </div>
  </div>
        
          
   </div>';
$template="newcab1";


include TEMPLATE_DIR.$template.".html";
else:
   // print_r($_POST);
    $pn=$_POST['name'];
    $pv=$_POST['value'];
    $_SESSION[$pv]=$pn;
    $rid=$_POST['pk'];
$userdata->Update(array($pn=>$pv), $rid);
endif;