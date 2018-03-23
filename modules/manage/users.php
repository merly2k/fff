<?php

/* @TODO: сделать управление акаунтами
 * этот файл распространяется на условиях коммерческой лицензии
 * по вопросам приобретения кода обращайтесь merly2k at gmail.com
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 */
// UI(user interfaces)
$template = "cabinet"; //"index";
$ajax = '';
$postPrint = '';
$function_name = $this->param[0];
$context = $function_name();
switch ($function_name) {
    case 'show_users':
	$mod_name = 'Управление пользователями';
	break;
    case 'add_user':

	$mod_name = 'Добавление пользователя';
	break;
    case 'ban_users':
	$mod_name = 'Заблокированные пользователи';
	break;
    case 'send_message':
	$mod_name = 'Отправка сообщений';
	break;
    default:
	$mod_name = 'Управление пользователями';
	break;
}

$element = "admin_user";
$ajax.="$(document).ready(function()
{
	$('#login').blur(function()
	{
		$('#msgbox').removeClass().addClass('procmessage').text('Проверка...').fadeIn('slow');
		$.post('" . WWW_BASE_PATH . "user_availability',{ user_name:$(this).val() } ,function(data)
        {

		  if(parseInt(data)==1)
		  {
		  $('#msgbox').fadeTo(200,0.1,function()
			{
			  $(this).html('<h4 class=\'alert_info\' onclick=\'$(this).hide();\'>логин свободен</h4>').addClass('goodmessage').fadeTo(900,1);
			});
                    }
		  else
		  {
                      $('#msgbox').fadeTo(200,0.1,function()
			{
			  $(this).html('<h4 class=\'alert_info\' onclick=\'$(this).hide();\'>логин занят</h4>').addClass('goodmessage').fadeTo(900,1);
			});

		  }

        });

	});
});
        ";
$postPrint.="
        function updateElement(tag,urls){
        //alert(tag);
                $.ajax(
                         {
                            type: \"get\",
                            url: urls,
                            success: function(html){
                            $(tag).html(html);
                            }
                          }
                        );
              }
        function clearElement(tag){
        var clean='';
         $(tag).html(clean);
        }
        ";

include TEMPLATE_DIR . DS . $template . ".html";

function show_users() {
    $user_row = '';
    $element = "admin_user";
    $users = new db();
    $userlist = "select SQL_CALC_FOUND_ROWS * from users where `gid`<9999 and `ban`='';";
    $users->get_rows($userlist);
    $user_row.="<article class='module width_full'>
		<header><h3 class='tabs_involved'>Управление пользователями</h3>
                    <ul class='tabs'>
   			<li><a href='#tab1'>Пользователи</a></li>
		</ul>
		</header>
		<div class='tab_container'>
                    <div id='tab1' class='tab_content'>
                        <table class='tablesorter' cellspacing='0'>
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Пользователь</th>
                                    <th>E-mail</th>
                                    <th>Телефон</th>
                                    <th>Действия</th>
				</tr>
                            </thead>
                            <tbody>";
    foreach ($users->result as $user) {
	//[id][username][password][email][name][surname][fname][aim][skype][phone][isactive][activekey][resetkey][gid]
	extract($user);

	$user_row.="<tr>
                                    <td><input type='checkbox'></td>
                                    <td>$name,$surname,$fname ($username)</td>
                                    <td><a href='mailto:$email'>$email</a></td>
                                    <td>$phone</td>
                                    <td>
                                        <a href='" . WWW_BASE_PATH . "manage/edit_profile/$id'><image src='" . WWW_BASE_PATH . "images/icn_edit.png' title='править'></a>
                                        <a href='" . WWW_BASE_PATH . "manage/ban_profile/$id'><image src='" . WWW_BASE_PATH . "images/icn_security.png' title='Блокировка'></a>
                                        <a href='" . WWW_BASE_PATH . "manage/delete_profile/$id'><image src='" . WWW_BASE_PATH . "images/icn_trash.png' title='Удаление'></a>
                                    </td>
                                </tr>";
	//echo"<a href='".WWW_BASE_PATH."manage/edit_user/$id' >$name,$surname,$fname ($username)</a>$email,$name,$surname,$fname,$aim,$skype,$phone,$isactive,$activekey,$resetkey,$gid";
    };
    $user_row.="</tbody>
			</table>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->

		</article><!-- end of content manager article -->";
    return $user_row;
}

function send_message() {
    $user_row.="<article class='module width_full'>
		<header><h3 class='tabs_involved'>Отправка сообщений</h3>
                </header>
                <div class='module_content'>
";
    $users = new db();
    $userlist = "select SQL_CALC_FOUND_ROWS * from users where `gid`<9999;";
    $users->get_rows($userlist);
    $user_row.="<form method='POST'>
    <fieldset><legend>сообщение</legend>
        <label>пользователь</label>
            <select name='to'>
            ";
    foreach ($users->result as $user) {
	$user_row.="<option value='" . $user[email] . "'>" . $user['username'] . "</option>";
    }
    $user_row.="</select>";
    $user_row.="<label>сообщение</label>
        <textarea rows='6' name='ad_code' id='editor'>$ad_code</textarea><br />
        <div class='submit_link'>
        <button type='submit' name='save' value='сохранить' class='alt_btn'>сохранить</button>
    </div>
    </fieldset>
        </form><br /></div></article>";
    return $user_row;
}

function add_user() {

    $ret = "<article class='module width_full'><header><h3>Добавление пользователя</h3></header>
		<div class='module_content'>
                <div id='div-regForm'>
<div class='form-title'>Регистрация</div>
<form id='regForm' action='" . WWW_BASE_PATH . "auth/reg' method='post'>
<div id='msgbox'>&nbsp;</div>
      <table>
      <tbody>
      <tr>
 <td><label for='login'>Логин:</label></td>
  <td><div class='input-container'>
  <input name='login' type='text' id='login' value='' required='required' maxlength='15' />
  </div></td>
</tr>
 <tr>
 <td><label for='fname'>Имя:</label></td>
  <td><div class='input-container'>
  <input name='fname' id='fname' type='text' required='required'/>
  </div>
  </td>
</tr>
      <tr>
 <td><label for='lname'>Фамилия:</label></td>

  <td><div class='input-container'>
  <input name='lname' id='lname' required='required' type='text' />
  </div></td>
</tr>
  <tr>
 <td><label for='sname'>Отчество:</label></td>

  <td><div class='input-container'>
  <input name='sname' id='sname'  required='required' type='text' />
  </div></td>
</tr>
      <tr>
 <td><label for='email'>Email:</label></td>
  <td><div class='input-container'>
  <input name='email' required='required' id='email' placeholder='your@mail' type='email' />
  </div></td>
</tr>

      <tr>
 <td><label for='pass'>Пароль:</label></td>
  <td><div class='input-container'>
  <input name='pass' id='pass' type='password' required='required' placeholder='6-12 символов и цифр'/>
  </div></td>
</tr>
      <tr>
 <td><label for='sex-select'>Пол:</label></td>
  <td>
  <div class='input-container'>
  <select name='sex-select' id='sex-select'>
  <option value='0'>Ваш пол:</option>
  <option value='1'>Мужской</option>
  <option value='2'>Женский</option>
  </select>
 </div>
  </td>
  </tr>
  <tr>
  <td><label>дата рождения:</label></td>
  <td>
 <div class='input-container'>
 <select name='month'>
  <option value='0'>Месяц:</option>
  <?=generate_options(1,12,'callback_month')?>
  </select>
 <select name='day'>
  <option value='0'>День:</option>
  <?=generate_options(1,31)?>
  </select>
 <select name='year'>
  <option value='0'>Год:</option>" .
	    generate_options(date('Y'), 1920) . "
  </select>
 </div>
 </td>
</tr>
      <tr>
 <td>&nbsp;</td>
  <td><button type='submit' value='добавить' >добавить</button>
  </td>
</tr>
</tbody>
      </table>
</form>
</div>
<br />";
    return $ret;
}

function ban_users() {
    $ret = "<article class='module width_full'><header><h3>Разблокировка пользователя</h3></header>
		<div class='module_content'>";
    $users = new db();
    $userlist = "select SQL_CALC_FOUND_ROWS * from users where `gid`<9999 and `ban`!='';";
    $users->get_rows($userlist);
    $ret.="<div class='tab_container'>
                    <div id='tab1' class='tab_content'>
                        <table class='tablesorter' cellspacing='0'>
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Пользователь</th>
                                    <th>E-mail</th>
                                    <th>Дата регистрации</th>
                                    <th>Действия</th>
				</tr>
                            </thead>
                            <tbody>";
    if ($users->found > 0) {
	foreach ($users->result as $user) {
	    //[id][username][password][email][name][surname][fname][aim][skype][phone][isactive][activekey][resetkey][gid]
	    extract($user);
	    $ret.="<tr>
                                    <td><input type='checkbox'></td>
                                    <td>$name,$surname,$fname ($username)</td>
                                    <td>$email</td>
                                    <td>$isactive</td>
                                    <td>
                                       <a href='" . WWW_BASE_PATH . "manage/ed_profile/$id'><image src='" . WWW_BASE_PATH . "images/icn_edit.png' title='править'></a>
                                       <a href='" . WWW_BASE_PATH . "manage/ed_content/$id'><img src='" . WWW_BASE_PATH . "images/icn_trash.png' title='удалить'></a>
                                    </td>
                                </tr>";
	    //echo"<a href='".WWW_BASE_PATH."manage/edit_user/$id' >$name,$surname,$fname ($username)</a>$email,$name,$surname,$fname,$aim,$skype,$phone,$isactive,$activekey,$resetkey,$gid";
	};
    } else {
	$ret.="<tr><td colspan='5'>нет заблокированных пользователей</td></tr>";
    }
    $ret.="</tbody>
			</table>
			</div><!-- end of #tab1 -->
		</div><!-- end of .tab_container -->

		</article><!-- end of content manager article -->";

    return $ret;
}

function generate_options($from, $to, $callback = false) {
    $reverse = false;
    if ($from > $to) {

	$tmp = $from;
	$from = $to;
	$to = $tmp;
	$reverse = true;
    }
    $return_string = array();
    for ($i = $from; $i <= $to; $i++) {
	$return_string[] = '
  <option value="' . $i . '">' . ($callback ? $callback($i) : $i) . '</option>
      ';
    }
    if ($reverse) {
	$return_string = array_reverse($return_string);
    }
    return join('', $return_string);
}

function callback_month($month) {
    $m = array("0",
	"январь",
	"февраль",
	"март",
	"апрель",
	"май",
	"июнь",
	"июль",
	"август",
	"сентябрь",
	"октябрь",
	"ноябрь",
	"декабрь");
    return $m[$month];
}

?>
