<?php

//error_reporting(9999999);
$template = "admin"; //dform; //"index";
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
    
    $zap = "select * from faqo where `id`='$cont_id' LIMIT 1;";
    $ed->get_rows($zap);
//print_r($zap);
    extract($ed->result[0]);


    $context.="<form method='POST' action='" . WWW_BASE_PATH . "/manage/faqo/update'>
	<label for='qw'>Вопрос</label><input class='form-control' name='qw' value='$qw' />
	<br />
	<label for='answer'>Ответ</label><textarea id='editor' name='answer'>$answer</textarea>
	<br />
	<label for='votes'>Голоса</label><input name='votes' value='$votes' />
<button type='submit'class='btn btn-default'>save</button>
</form>";
}else{
    $context='<a href="'.WWW_BASE_PATH.'manage/faqo/add" class="btn btn-info">новый вопрос-ответ</a>
	<div class="table-responsive">
                                <table id="faqo" class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
					    <th>вопрос</th>
                                            <th>ответ</th>
                                            <th>голоса</th>
                                            <th>действие</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
    $zap = "select * from faqo order by votes DESC";
    foreach ($ed->get_result($zap) as $row) {
	$context.="<tr>"
		. "<td>".$row->qw."</td>"
		. "<td>".$row->answer."</td>"
		. "<td>".$row->votes."</td>"
		. "<td class='panel-green'>"
		. "<a href='".WWW_BASE_PATH."manage/faqo/".$row->id."'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;"
		. "<a href='".WWW_BASE_PATH."manage/faqo/del/".$row->id."'><i class='fa fa-trash-o'></i></a>"
		. "</td>"
		. "</tr>";
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

