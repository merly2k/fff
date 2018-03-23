<?php
$template ="newcab1";
$packet=$this->param[0];
$dp=new db();
$pName=$dp->get_result("SELECT * FROM `packets` where `id`=".$packet.";");
$packetName=$pName[0];
$reflink0=WWW_BASE_PATH."register/".$this->_DATA['login'];
	

$context='<div class="container">
    <div class="card">
        <div class="card-header bg-primary">
            <h2 class="card-title">Приобретение инвестиционного пакета '.$packetName->packet.'</h2>
        </div>
        <div class="card-block">
            <form class="" method="post" action="'.WWW_BASE_PATH.'cabinet/paygate" data-toggle="validator">
                <fieldset>
                    <div class="form-group">
			<label class="col-lg-3 form-control-label" for="ammoumt">Сумма инвестиции</label>
                        <div class="col-lg-9">
                        <input id="ammoumt" name="ammoumt" placeholder="'.$packetName->minpack.' до '.$packetName->maxpack.'$" min="'.$packetName->minpack.'" max="'.$packetName->maxpack.'" class="form-control input-md" required=""  type="number" data-error="сумма инветстиций в данном пакете должна быть от '.$packetName->minpack.' до '.$packetName->maxpack.'$">
			    <span class="help-block with-errors"></span>  
			    <input id="packet" name="packet" type="hidden" value="'.$packetName->id.'"</div>
                    </div>
		    <div class="form-group">
                    <label class="col-lg-3 form-control-label" for="selectbasic">Платёжная система</label>
		    <!-- Select Basic -->
		    <div class="col-lg-10">
                        <div class="col-lg-2 paycard">
                            <input class="form-check-input" id="fs" type="radio" name="walet"
                            value="fs" required data-error="не выбрана платёжная система"/>
                            <label class="drinkcard-cc fs" for="fs"></label>
                        </div>
                        <div class="col-lg-2 paycard">
                            <input class="form-check-input" id="prefectmoney" type="radio" name="walet"
                            value="prefectmoney" />
                            <label class="drinkcard-cc prefectmoney" for="prefectmoney"></label>
                        </div>
                        <div class="col-lg-2 paycard">
                            <input class="form-check-input" id="payeer" type="radio" name="walet"
                            value="payeer" />
                            <label class="drinkcard-cc payeer" for="payeer"></label>
                        </div>
                        <div class="col-lg-2 paycard">
                            <input class="form-check-input" id="bitcoin" type="radio" name="walet"
                            value="bitcoin" />
                            <label class="drinkcard-cc bitcoin" for="bitcoin"></label>
                        </div>
                        <div class="col-lg-2 paycard ">
                            <input class="form-check-input" id="advcash" type="radio" name="walet"
                            value="advcash" />
                            <label class="drinkcard-cc advcash" for="advcash"></label>
                        </div>
                        <div class="col-lg-2 paycard">
                            <input class="form-check-input" id="nix" type="radio" name="walet" value="nix" />
                            <label class="drinkcard-cc nix" for="nix"></label>
                        </div>
                        <div class="col-lg-2 paycard">
                            <input class="form-check-input" id="qiwi" type="radio" name="walet" value="qiwi" />
                            <label class="drinkcard-cc qiwi" for="qiwi"></label>
                        </div>
			
                    </div><br><br>
		    <span class="help-block with-errors" id="hint_radio"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 form-control-label" for="button1id"></label>
                        <div class="col-lg-8">
                            <button id="button1id" name="button1id" class="btn btn-inverse">Отменить</button>
                            <button id="button2id" name="button2id" class="btn btn-success">Перейти к оплате</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary">
                 <h2 class="card-title">
                        История
                    </h2>
            </div>
            <div class="card-block">
                <table class="table dataTable table-hover table-striped light-blue">
                    <thead>
                        <tr>
                            <th>событие</th>
                            <th>дата</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>21-06-2017</td>
                            <td>Зачисление средство за пакет Старт $ 235</td>
                        </tr>
                        <tr>
                            <td>21-06-2017</td>
                            <td>Регистрация в системе</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>';


include TEMPLATE_DIR . DS . $template . ".html";