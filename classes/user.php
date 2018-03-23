<?php

/*
 * этот файл распространяется на условиях коммерческой лицензии
 * по вопросам приобретения кода обращайтесь merly2k at gmail.com
 */

/**
 * Description of user
 *
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 */
class user extends db{

    public $classname = __CLASS__;
    public $name;
    public $acl;
    
    function __construct() {
	parent::__construct();
        $this->name=  self::getName();
	
    }
    
    function auch($login){
	$user=$this->get_result("SELECT * FROM users WHERE `login`='$login' LIMIT 1;");
	$curuser=$user[0];
	return $curuser;
	
    }
    function updateReg($id){
	$q="UPDATE `users` SET `activated`='1' WHERE `id`='".$id."';";
	$user=$this->query($q);
	return 1;
    }

    public function getName() {
        if(!isset ($_SESSION['login'])){
            $this->name='guest';
            }else{
            $this->name=$_SESSION['login'];
            }
            
        return $this->name;
    }
    public function GetUser($login){
        
        $user=$this->get_result("SELECT * FROM users WHERE `login`='$login' LIMIT 1;");
	$curuser=$user[0];
	return $curuser;
    }

    function GetPremission($gid){
        $userdata=new db();
        $zapros="select * from user_groups where `gid`='$gid'";
        $userdata->get_rows($zapros);
        $r=$userdata->result;
        $userdata->close();
        return $r;
    }
    function loginForm(){
	return "<!DOCTYPE html>
<html lang='en'>

<head>

    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content='width=device-width, initial-scale=1'>
    <meta name='description' content=''>
    <meta name='author' content=''>
    <link href='".WWW_CSS_PATH."bootstrap.min.css' rel='stylesheet'>

    <!-- Custom CSS -->
    <link href='".WWW_CSS_PATH."sb-admin.css' rel='stylesheet'>

    <!-- Custom Fonts -->
    <link href='".WWW_CSS_PATH."font-awesome.css' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
        <script src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'></script>
    <![endif]-->
  <title>Admin</title>
</head>

<body>
    <div class='container' style='margin-top:40px'>
		<div class='row'>
			<div class='col-sm-6 col-md-6 col-md-offset-3'>
<div class='panel panel-default center-block'>
	<div class='panel-heading'>
	    <strong>Вход</strong>
	</div> 
    <form class='form-horizontal panel-body' style='background-color:#fcfcfc;padding:20px;' method='POST'>"
	    . "<fieldset class='' >
		<!-- Form Name -->

<!-- Text input-->
<div class='form-group'>
  <label class='col-md-3 control-label' for='login'>e-mail</label>  
  <div class='col-md-6'>
  <input id='login' name='login' placeholder='you@mail' class='form-control input-md' type='text'>
  <span class='help-block'>Введите свой e-mail</span>  
  </div>
</div>

<!-- Password input-->
<div class='form-group'>
  <label class='col-md-3 control-label' for='password'>Пароль</label>
  <div class='col-md-6'>
    <input id='password' name='password' placeholder='password' class='form-control input-md' type='password'>
    <span class='help-block'>Введите свой пароль</span>
  </div>
</div>

<!-- Button -->
<div class='form-group'>
  <label class='col-md-4 control-label' for='singlebutton'></label>
  <div class='col-md-4'>
    <button id='singlebutton' name='singlebutton' class='btn btn-primary'>Войти</button>
  </div>
</div>

</fieldset>
</form>
<div class='panel-footer '>
	Вход в закрытую часть сайта только для сотрудников
</div>
</div>";
    }

}

?>
