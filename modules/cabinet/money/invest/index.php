<?php
$template ="cabinet"; //uncomment this string if not use default template
$reflink0=WWW_BASE_PATH."register/".$this->_DATA['login'];
	
$context='<div class="col-md-4" data-content="'.WWW_BASE_PATH.'ajax/userpack/" ></div>'
	. '<div class="col-md-12 bg-info text-center"><h4>Ваша реферальная ссылка: '.$reflink0.'</h4></div>'
	.refererBlosk($this->_DATA[id]).'<br>';
$context.='<div class="col-md-4 panel panel-default">
                  <div class="panel-heading"><h4>История операций</h4></div>
                  <div class="panel-body">
                    <div class="list-group">
                    <a href="#" class="list-group-item ">Вывод на кошелёк 1600$</a>
                    <a href="#" class="list-group-item">Запрос на вывод денег</a>
                    <a href="#" class="list-group-item">Начисление прибыли 1740$</a>
                    </div>
                  </div>
              </div>
	      <div class="col-md-4">
		<div class="panel panel-default">
                  <div class="panel-heading"><h4>Новости</h4></div>
                  <div class="panel-body">
                  Внимание! <br>На данный момент проводятся массовые технические работы на сайте.
		  Многие разделы не работают или могут работать неисправно. Проблемы с загрузкой и 
		  корректностью текстов тоже устраняться (некоторые текстовые дорожки, могут быть 
		  прогружены с зеркала Beta версии сайта и могут содержать грамматические и 
		  орфографические ошибки).
		  Не переживайте, данные проблемы связанны с тем, что мы улучшаем сайт и делаем его
		  удобнее и комфортнее для ВАС.<br> Период "модернизации" сайта колеблется от 2 до 4 дней.
Спасибо за понимание!
<br>С Уважением администрация FinansiczlService.
                  </div>
               	</div>
              	</div>
		<div class="col-md-4 panel panel-default">
                <table class="table table-striped">
                      <thead>
                        <tr><th>уровень</th><th>Рефералы</th><th>оборот</th><th>ваша прибыль</th></tr>
                      </thead>
                      <tbody>
                        <tr><td>1</td><td>24</td><td>500</td><td>100</td></tr>
                        <tr><td>2</td><td>45</td><td>120</td><td>40</td></tr>
                        <tr><td>3</td><td>4</td><td>250</td><td>25</td></tr>
                        <tr><td>4</td><td>35</td><td>1000</td><td>100</td></tr>
                        <tr><td>5</td><td>45</td><td>800</td><td>80</td></tr>
                        <tr><td>6</td><td>12</td><td>2500</td><td>250</td></tr>
                        <tr><td>7</td><td>6</td><td>1420</td><td>142</td></tr>
                        <tr><td>8</td><td>78</td><td>910</td><td>91</td></tr>
                        <tr><td>9</td><td>122</td><td>9080</td><td>908</td></tr>
                        <tr><td>10</td><td>2450</td><td>50000</td><td>500</td></tr>
                        
                      </tbody>
               	</table>
              </div>
              	
              
            ';
include TEMPLATE_DIR . DS . $template . ".html";

function refererBlosk($id) {
    if($id>0):
    $userdata=new users();
    $ud=@$userdata->SelectBy($uid);
    $pf=@$ud[0];
    $out=' <div class="class="col-md-4 offer offer-danger" text-center"><img src="'.WWW_MEDIA_PATH.'user/'.$pf->userPhoto.'" class="avatar img-circle" alt="avatar"><br>';
    return $out;
    endif;
}

?>
