<?php

//error_reporting(9999999);
$template = "cabinet"; //dform; //"index";
$context='';
$module_name='Вопросы и ответы';
$cont_id = @$this->param[0];
$a_act=@$this->param[1];
$ajax = "";
switch ($a_act) {
    case '':
    break;
case 'add':
    break;
case 'del':
    break;

    default:
	break;
}

$ed = new db();
if (!empty($cont_id)) {
    
    $zap = "select * from salon where `id`='$cont_id' LIMIT 1;";
foreach($ed->get_result($zap) as $row){

$context.="<form method='POST'><label for='name'>Название</label><input name='name' placeholder='name' value='$row->name' />

<br /><label for='decription'>decription</label><textarea id='editor' name='decription'>$row->decription</textarea>

<br /><label for='country'>country</label><input name='country' placeholder='country' value='$row->country' />

<br /><label for='sity'>sity</label><input name='sity' placeholder='sity' value='$row->sity' />

<br /><label for='street'>street</label><input name='street' placeholder='street' value ='$row->street' />

<br /><label for='building'>building</label><input name='building' placeholder='building' value='$row->building' />

<br />
<button type='submit'>save</button>
</form>
";}
}else{
    $context.='<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            
                                            <th>Адресс</th>
                                            <th>действие</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
    $zap = "select * from salon";
    foreach ($ed->get_result($zap) as $row) {
	$context.="<tr>"
	    ."<td>".$row->country.",".$row->sity.",".$row->street.",".$row->building
	    ."</td><td class='panel-green'><a href='".WWW_BASE_PATH."manage/salon/".$row->id."'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;
                                <a href='href='".WWW_BASE_PATH."manage/salon/".$row->id."/del'><i class='fa fa-trash-o'></i></a>
                                </td>"
	    ."</td><tr>";
    };
    $context.='</tbody></table>';
    
}



$postPrint="
        function updateElement(tag,urls){
        //alert(tag);
                $.ajax(
                         {
                            type: \"get\",
                            url: urls,
                            success: function(html){
                            $(tag).html(html);
                           // $('.column').equalHeight();
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
?>

