<?php
$template="kitty";
$cont_id=$this->param[0];
//echo $cont_id;
$ajax.="
	    $(window).scroll(function() {
	       if ($(this).scrollTop() >= 400) {
	           $('.nav_up').fadeIn();
	       }
	        else {
	       $('.nav_up').fadeOut();
	       };
	    });
	  $('.nav_up').click(function() {
	      $('html, body').animate( {
	          scrollTop: 0
	      }, 'slow')
	  })
        ";
$context.="";
if(!empty($cont_id)){
$zap="select id,header,keywords,deckription,context as content from context where `id`='$cont_id' LIMIT 1;";

}else{
$zap="select id,header,keywords,deckription,context as content from context order by `id` desc LIMIT 1;";
}
$ed=new db();
$ed->get_rows($zap);

    extract($ed->result[0]);
$context.="<div class='title clearfix'>
            <img src='".WWW_BASE_PATH."images/cat_info.png' alt=' class='alignleft' />
                    <h3>$header</h3>
                </div>
                <p>
                $content
                </p> 

";



$postPrint.="
        function updateElement(tag,urls){
        //alert(tag);
                $.ajax(
                         {
                            type: \"get\",
                            url: urls,
                            success: function(html){                                     
                            $(tag).html(html);
                            //$('.column').equalHeight();
                            }
                          }
                        );
              }
        function clearElement(tag){
        var clean='';
         $(tag).html(clean);
        }
        
        ";

        include TEMPLATE_DIR.DS.$template.".html";
        
 ?>

