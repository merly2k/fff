<?php
error_reporting(999999);
$template="login";
$cont_id=@$this->param[0];
if($_SESSION['message']=='error'){
$content= "<div class='bg-warning'><p class='text-center' style='padding:10px;'><h4>Не удается войти.</h4>
    <b>Возможные причины: </b>
    <ul>
    <li>1. Аккаунт не активирован по ссылке. (Проверьте свой почтовый ящик и перейдите по ссылке в письме).</li>
    <li>2. Неверный логин или пароль.</li>
    <li>3. Возможно, нажата клавиша CAPS-lock?</li>
    <li>4. Может быть, у Вас включена неправильная раскладка? (русская или английская)</li>
Попробуйте набрать свой пароль в текстовом редакторе и скопировать в графу «Пароль»</li>
</ul>
</p></div>";
}else{
    $content="";
}

$content.=" <form class='form-horizontal panel-body' style='background-color:#fcfcfc;padding:20px;' method='POST' action='".WWW_BASE_PATH."auth/login'>
                            <fieldset class='' >
                                <!-- Form Name -->

                                <!-- Text input-->
                                <div class='form-group'>
                                    <label class='col-md-3 control-label' for='login'>login</label>  
                                    <div class='col-md-6'>
                                        <input id='login' name='login' placeholder='login' class='form-control input-md' type='text' data-error='Вы забыли ввести логин' requred>
                                        <span class='help-block'>Введите свой логин</span>  
                                    </div>
                                </div>

                                <!-- Password input-->
                                <div class='form-group'>
                                    <label class='col-md-3 control-label' for='password'>Password</label>
                                    <div class='col-md-6'>
                                        <input id='password' name='password' placeholder='password' class='form-control input-md' type='password' data-error='Вы забыли ввести логин' requred >
                                        <span class='help-block'>Введите свой пароль</span>
                                    </div>
                                </div>
				<div class='g-recaptcha' data-sitekey='6Lc9ByAUAAAAAKOlFnpa91fVuvltXVZYkBUVBOVD'></div>
                                <!-- Button -->
                                <div class='form-group'>
                                    <label class='col-md-4 control-label' for='singlebutton'></label>
                                    <div class='col-md-4'>
                                        <button id='singlebutton' name='singlebutton' class='btn btn-primary'>Войти</button>
                                    </div>
                                </div>

                            </fieldset>
                        </form>";
$_SESSION['message']='';
include TEMPLATE_DIR.$template.".html";
?>