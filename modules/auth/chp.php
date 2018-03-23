<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$coda=$this->param[0];
if(!$_POST['coda']):
$content='<form id="regForm" action="'.WWW_BASE_PATH.'auth/chp" method="post" class="form-horizontal" data-toggle="validator">'
	. '<div class="form-group">
	    <label class="col-md-4 control-label" for="inputPassword">Пароль *</label>  
	    <div class="col-md-4">
		<input id="inputPassword" type="password" name="pass" class="form-control input-md" data-minlength="5">
	    </div>
	</div>
	<div class="form-group">
	   <label class="col-md-4 control-label" for="pass" >Повтор Пароля *</label>  
	    <div class="col-md-4">
		<input id="passConfirm" type="password" class="form-control input-md" data-match="#inputPassword" data-match-error="пароли не совпадают">
		 <div class="help-block with-errors"></div>
	    </div>
		<input type="hidden" name="coda" value="'.$coda.'">
	</div>
	'
	. '<div class="form-group col-md-4"></div><div class="form-group col-md-4">
	<button id="button1id" name="button1id" type="submit" class="btn btn-primary ">Сменить пароль</button>
	</div></form><br><br><br>';
    
    else:
	extract($_POST);
	$udp=new db();
    	$q="select * from `pas_link` where hashe='$coda';";
	
	$mail=$udp->get_result($q);
	$maill=$mail[0];
	$email=$maill->mail;
	$update="update `users` SET `password`='".md5(pass)."' WHERE  `email`='".$email."';";
	//echo $update;
	$udp->query($update);
	$content="Пароль изменён";
	$redirectTo="auth";
	//header('refresh: 15; url='.$redirectTo);
    
endif;
$template="login";

include TEMPLATE_DIR.$template.".html";

