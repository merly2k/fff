<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$context='';
$template="newcab1";
$init=new localmail();
foreach ($init->getNames() as $k=>$vl) {
$usert.='<option value="'.$k.'">'.$vl.'</option>';
$users[$k]=$vl;
}
foreach ($_POST as $key => $value) {
    setcookie($key, $value);
}
extract($_POST);
$context.=$step;
switch ($step) {
    case 1:
	$context.='
	<div class="row">
          <div class="col-md-12">
            <form class="form-horizontal" role="form" method="post">
	    <fileldset>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="task" class="control-label">Задача</label>
		</div>
                <div class="col-sm-10">
		'.$task.'
                  <input type=hidden name="task" value='.$task.'>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="uid" class="control-label">Виконавець</label>
		</div>
                <div class="col-sm-10">
                  <input type="hidden" name="uid" value='.$uid.'>
		  '.$users[$uid].'
		  </select>
                </div>
              </div>
	      
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="deckription" class="control-label">Опис задачі</label>
                </div>
                <div class="col-sm-10">'.$deckription.'
                  <input type="hidden" value="'.$deckription.'" name="deckription">
                </div>
              </div>
              <div class="form-group">
	      <div class="col-sm-2">
                  <label for="addres" class="control-label">Адреса</label>
                </div>
                <div class="col-sm-10">
		  <input class="form-control" type="text" name="addres">
                </div>
              </div>
	      <div class="form-group">
	      <div class="col-sm-2">
                  <label for="deckription" class="control-label">строки виконання</label>
                </div>
              <div class="col-sm-6">
                   <div class="input-daterange input-group" id="datepicker">
			<input type="text" class="input-sm form-control" name="start" />
			    <span class="input-group-addon">по</span>
			<input type="text" class="input-sm form-control" name="end" />
		    </div>
		  <input type="hidden" name="step" value="3">
	      <hr>
              </div>
	      
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
		   <a onclick="history.go(-1)" class="btn btn-default"><i class="fa fa-arrow-left"></i></a>
                  <button type="submit" class="btn btn-default"><i class="fa fa-arrow-right"></i></button>
                </div>
              </div>
	      </fileldset>
            </form>
          </div>
        ';

	break;
case 2:
    
$context.='
	<div class="row">
          <div class="col-md-12">
            <form class="form-horizontal" role="form" method="post">
	    <fileldset>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="task" class="control-label">Задача</label>
		</div>
                <div class="col-sm-10">
		'.$task.'
                  <input type=hidden name="task" value='.$task.'>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="uid" class="control-label">Виконавець</label>
		</div>
                <div class="col-sm-10">
                  <input type="hidden" name="uid" value='.$uid.'>
		  '.$users[$uid].'
		  </select>
                </div>
              </div>
	      
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="deckription" class="control-label">Опис задачі</label>
                </div>
                <div class="col-sm-10">'.$deckription.'
                  <input type="hidden" value="'.$deckription.'" name="deckription">
                </div>
              </div>
	      <div class="form-group">
	      <div class="col-sm-2">
                  <label for="deckription" class="control-label">строки виконання</label>
                </div>
              <div class="col-sm-6">
                   <div class="input-daterange input-group" id="datepicker">
			<input type="text" class="input-sm form-control" name="start" />
			    <span class="input-group-addon">по</span>
			<input type="text" class="input-sm form-control" name="end" />
		    </div>
		    <hr>
              </div>
	      
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
		   <a onclick="history.go(-1)" class="btn btn-default"><i class="fa fa-arrow-left"></i></a>
                  <button type="submit" class="btn btn-default"><i class="fa fa-arrow-right"></i></button>
                </div>
              </div>
	      </fileldset>
            </form>
          </div>
        ';


	break;
case 3:
    $context.='	<div class="row">
          <div class="col-md-12">
            <form class="form-horizontal" role="form" method="post">
	    <fileldset>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="task" class="control-label">Задача</label>
		</div>
                <div class="col-sm-10">
                  <input type=hidden name="task" value='.$task.'>
                 '.$task.'
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="uid" class="control-label">Виконавець</label>
		</div>
                <div class="col-sm-10">
                  <input type="hidden" name="uid" value='.$uid.'>
		  '.$users[$uid].'
		</div>
              </div>
	      
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="deckription" class="control-label">Опис задачі</label>
                </div>
                <div class="col-sm-10">
                 <div class="col-sm-10">'.$deckription.'
                  <input type="hidden" value="'.$deckription.'" name="deckription">
                </div>
                </div>
              </div>';
    if(!empty($addres)):
	$context.=' <div class="form-group">
	      <div class="col-sm-2">
                  <label for="addres" class="control-label">Адреса</label>
                </div>
                <div class="col-sm-10">
		  <input class="form-control" type="hidden" name="addres" value="'.$addres.'">
		      '.$addres.'
                </div>
              </div>';
    endif;
	      $context.='<div class="form-group">
		  <div class="col-sm-2">
                  <label for="deckription" class="control-label">строки виконання</label>
                </div>
              <div class="col-sm-6">
                   <div class="input-daterange input-group" id="datepicker">
			<input type="hidden" value="'.$start.'" name="start" />
			<input type="hidden" value="'.$end.'" name="end" />
			З: '.$start.' ПО: '.$end.'
		    </div>
              </div>
              </div>
              </div>
	      <input type="hidden" name="step" value="4">
	      <hr>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
		 <a onclick="history.go(-1)" class="btn btn-default"><i class="fa fa-arrow-left"></i></a>
                  <button type="submit" class="btn btn-default">Зберегти</button>
                </div>
              </div>
	     
            </form>
          </div>';

	break;
case 4:
	$context="Зберегаю задачу".print_r($_POST,true);
    $td=new todo();
if(!empty($addres)){
    $prepAddr = str_replace(' ','+',$addres);
        $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        $output= json_decode($geocode);
        $lat = $output->results[0]->geometry->location->lat;
        $lng=$output->results[0]->geometry->location->lng;
}
    $param=array(
	'uid'=>$uid,
	'task'=>  stripcslashes($task),
	'deckription'=>  stripcslashes($deckription),
	'start'=>$start,
	'end'=>$end,
	'lat'=>$lat,
	'lng'=>$lng,
	'otchet'=>'',
	'status'=>'0',
    );
    $context.=$td->Insert($param);
    
   if($_SESSION['role']>1):
	$context.= '<script>
            window.setTimeout(function(){location.replace("' .WWW_BASE_PATH. 'manage/todo")},1000);
          </script>';
    else:
	$context.= '<script>
            window.setTimeout(function(){location.replace("' .WWW_BASE_PATH. 'cabinet/todo")},1000);
          </script>';
    endif;
   
    
    
    
	break;

    default:
	if(@$_SESSION){
	    	    extract($_SESSION);}
	$context.='
	<div class="row">
          <div class="col-md-12">
            <form class="form-horizontal" role="form" method="post">
	    <fileldset>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="task" class="control-label">Задача</label>
		</div>
                <div class="col-sm-10">
                  <input name="task" class="form-control" id="task" value="'.$task.'">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="uid" class="control-label">Виконавець</label>
		</div>
                <div class="col-sm-10">
                  <select name="uid" class="form-control" id="uid">
		  '.$usert.'
		  </select>
                </div>
              </div>
	      <div class="form-group">
                <div class="col-sm-2">
                  <label for="deckription" class="control-label">Опис задачі</label>
                </div>
                <div class="col-sm-10">
                  <textarea class="form-control" id="deckription" name="deckription" >'.$deckription.'</textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="radio">
                    <label><input type="radio" name="step" value="1" required="required"> адресна</label>
                    <label><input type="radio" name="step" value="2"> без адреси</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default">далі <i class="fa fa-arrow-right"></i></button>
                </div>
              </div>
	      </fileldset>
            </form>
          </div>
        ';
	break;
}


include TEMPLATE_DIR.$template.".html";

