<?php
$template ="cabinet"; //uncomment this string if not use default template
$module_name="Мои счета > Пополнение счёта";
$context="<div class='container'><p>Выберите удобную для вас платёжную систему</p>"
	. "<a class='btn btn-default' href='".WWW_BASE_PATH."cabinet/money/robokassa/' class='btn btn-default'><img src='".WWW_IMAGE_PATH."robo.png' alt='Robokassa'></a>";
$context.="<a class='btn btn-default' href='".WWW_BASE_PATH."cabinet/money/payonline/' class='btn btn-default'><img src='".WWW_IMAGE_PATH."payonline.png' alt='payonline'></a>";
$context.="<a class='btn btn-default' href='".WWW_BASE_PATH."cabinet/money/qiwi/' class='btn btn-default'><img src='".WWW_IMAGE_PATH."qiwi.png' alt='qiwi'></a>"
	. "</div>";



include TEMPLATE_DIR . DS . $template . ".html";