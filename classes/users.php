<?php



/**
 * Autogenerated class users
 * @author merly2k@gmail.com
 * `id` ,`login`,`password`,`role`,`userPhoto`,
  `name`,`sname`,`fname`,
  `bio`,`veteran`,`INN`,
  `phone`,`email`,
  `apiKey`,
  `brith_date`,
  `latestActivity`,
  `regDate`
 */
class users extends db {

    function __construct() {
        parent::__construct();
    }

    function Insert($val = array()) {

        extract($val);

        $q = "INSERT INTO `users` ("
		. "`login`,"
		. "`password`,"
		. "`role`,"
		. "`userPhoto`,"
		. "`name`,"
		. "`sname`,"
		. "`fname`,"
		. "`bio`,"
		. "`veteran`,"
		. "`INN`,"
		. "`phone`,"
		. "`email`,"
		. "`apiKey`,"
		. "`brith_date`,"
		. "`regDate`"
		. ")"
	. " VALUES ("
		. "'$login',"
		. "'$password',"
		. "'$role',"
		. "'$userPhoto',"
		. "'$name',"
		. "'$sname',"
		. "'$fname',"
		. "'$bio',"
		. "'$veteran',"
		. "'$INN',"
		. "'$phone',"
		. "'$email',"
		. "'$apiKey',"
		. "'$brith_date',"
		. "'$regDate');";
        $this->query($q);

        return $this->lastState;
    }

    /**
     * @param type $id
     * @param type $params array(fieldName=>fieldValue)
     */
    function Update($params, $id) {
	
        $q = "UPDATE `users` SET ";
        foreach ($params as $k => $v) {
            $q.="`$k`='$v'";
        }
	$q.=" WHERE  `id`=$id;";
	$this->query($q);
	
        return print_r($params);;
    }

    /**
     * @param type $cel - столбец по которому производится удаление (по умолчанию ID)
     * @param type $val - значение по которому производится удаление
     */
    function Delete($val, $cel = 'id') {
        $q = "DELETE FROM `users` WHERE  `$cel`='$val;'";

        $this->query($q);

        return $this->lastState;
    }

    /**
     * @param type $cel - столбец по которому производится выборка (по умолчанию ID)
     * @param type $val - значение по которому производится выборка
     */
    function SelectBy($val, $cel = 'id') {
        $q = "SELECT * FROM `users` WHERE  `$cel`='$val';";
        return $this->get_result($q);
    }

    function loginForm() {
        return "<!DOCTYPE html>
<html lang='en'>

<head>

    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content='width=device-width, initial-scale=1'>
    <meta name='description' content=''>
    <meta name='author' content=''>
    <link href='" . WWW_CSS_PATH . "bootstrap.min.css' rel='stylesheet'>

    <!-- Custom CSS -->
    <link href='" . WWW_CSS_PATH . "sb-admin.css' rel='stylesheet'>

    <!-- Custom Fonts -->
    <link href='" . WWW_CSS_PATH . "font-awesome.css' rel='stylesheet' type='text/css'>

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
  <label class='col-md-3 control-label' for='password'>Password</label>
  <div class='col-md-6'>
    <input id='password' name='password' placeholder='password' class='form-control input-md' type='password'>
    <span class='help-block'>Введите свой пароль</span>
  </div>
</div>

<!-- Button -->
<div class='form-group'>
  <label class='col-md-4 control-label' for='singlebutton'></label>
  <div class='col-md-4'>
    <button id='singlebutton' name='singlebutton' class='btn btn-primary'>login</button>
  </div>
</div>

</fieldset>
</form>
<div class='panel-footer '>
	Don't have an account! <a href='reg' onClick=''> Sign Up Here </a>
</div>
</div>";
    }

}

?>