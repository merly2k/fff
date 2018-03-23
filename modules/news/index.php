<?php
$template = "main";
$ajax = '';
$context = "";
$postPrint = '';
//print_r($this->param);
$ajax="";
$links='';
$context=' <div class="row">
                <div class="col-md-9 col-sm-7">
                    <div class="row">';


$newslist= new news();
foreach($newslist->SelectAll() as $k=>$row){
   
$context.='<div class="col-sm-12 col-md-12">
                <div class="single-blog single-column">
                    <div class="post-thumb">
                <img src="media/news/'.$row->picture.'" class="img-responsive" alt="">
			<div class="post-overlay">
                            <span class="uppercase"><a href="#">14 <br><small>Feb</small></a></span>
                        </div>
                    </div>
                    <div class="post-content overflow">
                        <a name="news_'.$row->id.'"><h2 class="post-title bold">'.$row->title.'</h2></a>
                                    <h3 class="post-date">'.$row->published.'</h3>
                                    '.$row->article.'

                                    <div class="post-bottom overflow">
                                        <!--ul class="nav navbar-nav post-nav">
                                            <li><a href="#"><i class="fa fa-tag"></i>Creative</a></li>
                                            <li><a href="#"><i class="fa fa-heart"></i>32 Love</a></li>
                                            <li><a href="#"><i class="fa fa-comments"></i>3 Comments</a></li>
                                        </ul-->
                                    </div>
                                </div>
                            </div>
                        </div>';
$links.='<li><a href="#news_'.$row->id.'">'.$row->title.'<span class="pull-right">(1)</span></a></li>';
}
$context.=' </div>
                 </div>
                <div class="col-md-3 col-sm-5">
                    <div class="sidebar blog-sidebar">
                        <div class="sidebar-item categories">
                            <h3>'.  lang("newsarcive").'</h3>
                            <ul class="nav navbar-stacked">
                            '. $links.'
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>';
/** show newslist */
include TEMPLATE_DIR .  $template . ".html";



;
?>

                    
                   