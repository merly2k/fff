<?php
$template = "cabinet";
$newslist= new news();
$bcump='<li><a href="'.WWW_BASE_PATH.'"><i class="fa fa-dashboard"></i> Головна</a></li>
        <li class="active"><a href="'.WWW_BASE_PATH.'news/"><i class="fa fa-newspaper-o"></i>Усі новини</a></li>';
if(!@$this->param[0]):
    $modName="Новини<small>усі новини</small>";

$context='
	<ul class="col-md-10">
    ';
foreach ($newslist->SelectAll() as $row) {
   $context.='
    <li>
    <a href="'.WWW_BASE_PATH.'news/'.$row->id.'">
    '
	.$row->title
	. '<span class="date small pull-right">'.$row->published.'</a>
    </li>
          '; 
}
$context.='</ul>';
    else:
	$modName="Новини<small></small>";
$context='';

$even='';
$odd='timeline-inverted';

$newslist= new news();
foreach($newslist->SelectBy($this->param[0]) as $k=>$row){
$context.='
<div class="panel">
<div class="panel-header"><h2>'.$row->title.'<span class="date small pull-right">'.$row->published.'</span></h2></div>
<div class="panel-body">          '.$row->article.'</div>
<hr>

          
          
      ';
}
endif;
/** show newslist */
include TEMPLATE_DIR .  $template . ".html";



;
?>
