<?php

$context='';
$lang=$_COOKIE['lang'];
$newslist= new news();
foreach($newslist->Latest(1) as $k=>$row){
if($k%2):    
$context.='                    
            
		  
            <div class="single-features">
                    <div class="col-sm-5 wow fadeInLeft" data-wow-duration="500ms" data-wow-delay="300ms">
                        <img src="media/news/'.$row->picture.'" class="img-responsive" alt="">
                    </div>
                    <div class="col-sm-6 wow fadeInRight" data-wow-duration="500ms" data-wow-delay="300ms">
                        <h2>'.$row->title.'</h2>'.$row->published.'
                        <P>'.$row->short.' <a class="btn btn-xsmall btn-info" href="'.WWW_BASE_PATH.'news#news_'.$row->id.'">'.l('more',$lang).' <i class="fa fa-arrow-circle-right"></i></a></P>
                    </div>
                </div>';
else:
$context.='<div class="single-features">
                    <div class="col-sm-6 col-sm-offset-1 align-right wow fadeInLeft" data-wow-duration="500ms" data-wow-delay="300ms">
                        <h2>'.$row->title.'</h2>'.$row->published.'
                        <P>'.$row->short.' <a class="btn btn-xsmall btn-info" href="'.WWW_BASE_PATH.'news#news_'.$row->id.'">'.l('more',$lang).' <i class="fa fa-arrow-circle-right"></i></a></P>
                    </div>
                    <div class="col-sm-5 wow fadeInRight" data-wow-duration="500ms" data-wow-delay="300ms">
                        <img src="media/news/'.$row->picture.'" class="img-responsive" alt="">
                    </div>
                </div>';
endif;
}
echo $context;