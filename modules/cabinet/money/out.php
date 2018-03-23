<?php
$template ="newcab1"; //uncomment this string if not use default template
$module_name="Вывод средств";
$tree= 0;//userRefTree($this->$_SESSION['id']);
$structure=count($tree);
$wal= new db();
$walets=$wal->get_result("select * from user_money where user_id='".$_SESSION['id']."';");
$walets=$walets[0];
$uid= $_SESSION['id'] ;
$context="<div class='container'>"
."<div class='card '>"
.'<div class="card-header bg-primary"><h2>Вывод средств</h2></div>'
. '<div class="card-body">'
. '<br>
<form class="form-horizontal" data-toggle="validator" role="form" method="post" action="'.WWW_BASE_PATH.'cabinet/money/outpay" data-toggle="validator">
<fieldset>
<input id="uid" name="uid" type="hidden" value="'.$_SESSION['id'].'">

<div class="form-group">
  <label class="col-md-3 control-label" for="walet">Кошелёк</label>  
  <div class="col-md-9">
    <select id="walet" name="gate"  class="form-control input-md" required>
	    <option value="pw" data-max="'.$walets->money.'">личный счёт (доступно '.$walets->money.') </option>
	    <option value="rw" data-max="'.$walets->refmoney.'">реферальный счёт (доступно '.$walets->refmoney.')</option>
    </select>
    </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label" for="ammoumt">Сумма вывода</label>  
  <div class="col-md-9">
      <input id="ammount" name="ammount"  class="form-control input-md" required type="number" data-error="Cумма вывода не указана или превышает сумму в кошельке" requred >
  </div>
  <div class="col-md-3"></div>  <div class="col-md-9 help-block with-errors"></div>  
</div>
<div class="form-group">
<label class="col-md-3 control-label" for="selectbasic">Платёжная система</label>
<div class="col-md-12">
<div class="col-md-2 paycard">
   <input class="radio-input" id="prefectmoney" type="radio" name="walet" value="prefectmoney" required data-error="Не выбрана платёжная система"/>
   <label class="drinkcard-cc prefectmoney" for="prefectmoney"></label>
</div>
<div class="col-md-2 paycard">
   <input class="radio-input" id="payeer" type="radio" name="walet" value="payeer" />
   <label class="drinkcard-cc payeer" for="payeer"></label>
</div>
<div class="col-md-2 paycard">
  <input class="radio-input" id="bitcoin" type="radio" name="walet" value="bitcoin" />
  <label class="drinkcard-cc bitcoin" for="bitcoin"> </label>
</div>
<div class="col-md-2 paycard">
<input class="radio-input" id="advcash" type="radio" name="walet" value="advcash" />
<label class="drinkcard-cc advcash" for="advcash"></label>
</div>
<div class="col-md-2 paycard">
   <input class="radio-input" id="nix" type="radio" name="walet" value="nix" />
   <label class="drinkcard-cc nix" for="nix"></label>
</div>
<div class="col-md-2 paycard">
   <input class="radio-input" id="qiwi" type="radio" name="walet" value="qiwi" />
   <label class="drinkcard-cc qiwi" for="qiwi"></label>
 </div>
 </div>
 <div class="col-md-3"></div>  <div class="col-md-9 help-block with-errors"></div>  
 <div class="spicer"><br><br></div>
</div>
<div class="card-futer">
<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="button1id"></label>
  <div class="col-md-8">
    <button id="button1id" name="button1id" class="btn btn-inverse">Отменить</button>
    <button id="button2id" name="button2id" class="btn btn-success">Перейти к оплате</button>
  </div>
   </div>
</div>

</fieldset>
</form>
'
	. "</div><br><br>"
	. "</div>"
	
	. "</div><br>";

$context.=' <div class="container"><div class="card">
                <!-- Default panel contents -->
                <div class="card-header bg-primary">
                    <h2 class="card-title">
                        История платежей
                    </h2>
                </div>
            <div class="card-body">
            <div class="card-text">
	    <div class="container">
            <table class="table dataTable table-hover table-striped light-blue">
                <thead>
                    <tr>
                        <th>№ заявки</th>
                        <th>Вы заказали вывод</th>
                        <th>Дата</th>
                        <th>Действие/Статус</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>
    
    <br>
    <br>
    <br>
   
    </div>

';

include TEMPLATE_DIR . DS . $template . ".html";