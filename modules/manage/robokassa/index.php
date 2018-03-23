<?php

$template ="cabinet"; //uncomment this string if not use default template
$module_name="Мои счета > Пополнение счёта";
$context.="<a href='http://robokassa.ru' class='btn btn-default'>зайти на сайт Robokassa</a>";
$context.="<a href='https://payonline.ru/' class='btn btn-default'>зайти на сайт Payonline</a>";



include TEMPLATE_DIR . DS . $template . ".html";

