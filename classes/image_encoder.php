<?php

/*
 * этот файл распространяется на условиях коммерческой лицензии
 * по вопросам приобретения кода обращайтесь merly2k at gmail.com
 */

/**
 * Description of image_encoder
 *
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 */
class image_encoder {

    public $classname = __CLASS__;
    public $ful_url;
    public $filetupe;
    function __construct() {
        ;
    }

 function encode_image ($filename=string){
    if ($filename) {
        $imgbinary = fread(fopen($filename, "r"), filesize($filename));
        return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);
    }
}
function encode_file ($filename=string) {
        return 'data:image/' . $this->filetupe . ';base64,' . base64_encode($filename);
    }

   

}

?>
