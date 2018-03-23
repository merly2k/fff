<?php

	$_SESSION['message'] = '';
if (!$_POST):
    $us = new user();
    echo $us->loginForm();

else:
    $login = stripslashes($_POST['login']);
    $password = md5(stripslashes($_POST['password']));
    //echo $password;
    $referer = $_SESSION['Referal'];
    $user = new user();
    $loged = $user->auch($login, $password);
    $_SESSION["loged"] = 1;
    print_r($loged->activated);
    if ($loged->password==$password and $loged->activated==1):
	
    $user = $loged->user;
    $_SESSION[id]=$loged->id;
    $_SESSION[login]=$loged->login;
    $_SESSION[role]=$loged->role;
    $_SESSION[userPhoto]=$loged->userPhoto;
    $_SESSION[name]=$loged->name;
    $_SESSION[sname]=$loged->sname;
    $_SESSION[fname]=$loged->fname;
    $_SESSION[phone]=$loged->phone;
    $_SESSION[email]=$loged->email;
    $_SESSION[apiKey]=$loged->apiKey;
    $_SESSION[latestActivity]=$loged->latestActivity;
    $_SESSION[regDate]=$loged->regDate; 
    //print_r($_SESSION);
	switch ($loged->role) {
	    case 1:
		header('Location:' . WWW_BASE_PATH . 'cabinet/');

		break;
	    case 2:
		header('Location:' . WWW_BASE_PATH . 'cabinet/');

		break;
	    case 3:
		header('Location:' . WWW_BASE_PATH . 'cabinet/');

		break;
	    case 4:
		header('Location:' . WWW_BASE_PATH . 'cabinet/');

		break;
	    case 5:
		header('Location:' . WWW_BASE_PATH . 'cabinet/');

		break;
	    case $loged->role>5:
		header('Location:' . WWW_BASE_PATH . 'manage/');

		break;
	    default :

		header("Location:" . WWW_BASE_PATH . "auth/");

		break;
	};
	
	   else:
	
	$message = 'error';
	$_SESSION['referer'] = $referer;
	$_SESSION['message'] = $message;
	
	session_start();
	header('Location:' . WWW_BASE_PATH . 'auth/');
	
	    
    endif;
    endif;
?>