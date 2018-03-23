<?php
ini_set("display_errors", 1);
error_reporting(9999);
$template="blog";
$this->script='articles';
$ajax="";

$cont_id=@$this->param[0];
$ed=new blog();

$context="";
if(!empty($cont_id)){
$fid=$ed->SelectBy($cont_id,"name");
foreach ($fid as $art) {
    

$context.="<div class='container-fluid'>
    <div class='fluid-row'>$art->article</div>
  <script type='text/javascript'>(function() {
  if (window.pluso)if (typeof window.pluso.start == 'function') return;
  if (window.ifpluso==undefined) { window.ifpluso = 1;
    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
    var h=d[g]('body')[0];
    h.appendChild(s);
  }})();</script>
<div class='pluso' data-background='#ebebeb' data-options='small,square,line,horizontal,counter,theme=04' data-services='facebook,twitter,google,email,print'></div>
 </div><br>";

}
}elseif(!empty($razdel)){
$fid=$ed->SelectAllByRazdel($razdel);
foreach ($fid as $art) {
    

$context.="<li class=\"pod\">
                <a href=\"". WWW_BASE_PATH."blog/".$art->id."\" class=\"link\">
                <div class=\"pad\">
                <h4 class=\"title\">".$art->name."</h4>
                <div class=\"detail date\">".$art->pdate."</div>
                <div class=\"detail description\">".$art->article."</div>  
                </div>
                </a>
                </li>";

}
}else{
$fid=$ed->SelectAll();    
foreach ($fid as $art) {
    

$context.="<li class=\"pod\">
                <a href=\"". WWW_BASE_PATH."blog/".$art->name."\" class=\"link\">
                <div class=\"pad\">
                <h4 class=\"title\">".$art->name."</h4>
                <div class=\"detail date\">".$art->pdate."</div>
                <div class=\"detail description\">".$art->article."</div>  
                </div>
                </a>
                </li>";

}
}
if(empty($fid)):$context='В этом разделе пока ничего нет';
endif;




        include TEMPLATE_DIR.$template.".html";

 ?>

