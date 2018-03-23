<?php

// UI(user interfaces)
$template = "default"; //"index";
$ajax.="";

$context.=render_c();

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
$sidebar->left = render_sidebar();

include TEMPLATE_DIR . DS . $template . ".html";

function render_sidebar() {
    $ra = new reqwests();
    $ra->katlist();
    $rr.="<div class='mybox'>" . $ra->kat . "</div>";
    return $rr;
}

function rbar($param) {
    $ra = new reqwests();
    $ra->razdels();
    $subar = "<div class='lavalamp'> <ul>";
    foreach ($ra->raz as $k => $v) {
        if ($k == $param) {
            $activator = "class='active'";
        } else {
            $activator = "";
        }
        $subar.="<li$activator><a href='" . WWW_BASE_PATH . "kategory/filter/$razdel/0/$k'>$v</a></li>";
    };
    $subar.="</ul>
        <div class='floatr' style='left: 16px; width: 78px; -moz-transform: translate(1px, 0px);'></div>
    </div>";
}
function render_c(){
        $con='';
        $bbd=new db();
	$zapros="select * from `context` where `header` ='copyright'";
	$bbd->get_rows($zapros);
	foreach($bbd->result as $key=>$value){
	extract($value);
                $con.=$context;
        }                        
        $bbd->close();
        return $con;
        }

?>
 