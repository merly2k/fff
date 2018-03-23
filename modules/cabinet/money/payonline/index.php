<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$template ="cabinet"; //uncomment this string if not use default template
$module_name="Мои счета>> Пополнение счёта через Payonline";
$context='<div class="container">'
	. '   <form action="'.WWW_BASE_PATH.'cabinet/money/payonline/pay" method="post" class="form-horizontal">        
	    <fieldset>
            <input type="hidden" name="orderId" value="Пополнение счёта '.$_SESSION['id'].'" />
  <div class="form-group">
  <label class="col-md-4 control-label" for="ammount">Сумма платежа</label>  
  <div class="col-md-4"><input type="текст" name="ammount" value="" class="form-control input-md" /></div>
  </div>
  информация о плательщике
<div class="form-group">
  <label class="col-md-4 control-label" for="pan">номер карты</label>  
  <div class="col-md-4"><input type="text" name="pan" value="" /></div>
</div>            
<div class="form-group">
<label class="col-md-4 control-label" for="pan">cvv2/cvc2</label>  
            <div class="col-md-4"><input type="text" name="cvv2" value="" /></div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="pan">держатель карты</label>  
            <div class="col-md-4"><input type="text" name="сardholer_name" value="" /></div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="pan">срок действия карты - год</label>  
            <div class="col-md-4"><input type="text" name="valid_thru_year" value="" /></div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="pan">срок действия карты - месяц</label>  
            <div class="col-md-4"><input type="text" name="valid_thru_month" value="" /></div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="pan">email плательщика</label>  
            <div class="col-md-4"><input type="text" name="email" value="" /></div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="pan">страна плательщика</label>  
            <div class="col-md-4"><input type="text" name="country" value="" /></div>
</div>	    
<div class="form-group">
<label class="col-md-4 control-label" for="pan">город плательщика</label>  
            <div class="col-md-4"><input type="text" name="city" value="" /></div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="pan">адрес плательщика</label>  
            <div class="col-md-4"><input type="text" name="address" value="" /></div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="pan">область/штат плательщика</label>  
            <div class="col-md-4"><input type="text" name="state" value="" /></div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="pan">телефон плательщика</label>  
            <div class="col-md-4"><input type="text" name="phone" value="" /></div>
</div>
            <div class="col-md-4"><button type="submit" class="btn btn-info">Провести платеж</button></div>
        </div>
	</fieldset>
    </form>';
include TEMPLATE_DIR . DS . $template . ".html";