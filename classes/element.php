<?php

/*
 * этот файл распространяется на условиях коммерческой лицензии
 * по вопросам приобретения кода обращайтесь merly2k at gmail.com
 */

/**
 * Description of element
 *
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 */
class element extends html {

    public $classname = __CLASS__;

    function __construct() {
        ;
    }

    public function set($name, $value=NULL) {
        $this->$name = $value;
        return TRUE;
    }

    public function get($name) {
        return $this->$name;
    }
    
    /* generate abbr html */
    public function abbr($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("abbr", $param , $content);
        return $this->ref; }

/* generate acronym html */
    public function acronym($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("acronym", $param , $content);
        return $this->ref; }

/* generate address html */
    public function address($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("address", $param , $content);
        return $this->ref; }

/* generate applet html */
    public function applet($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("applet", $param , $content);
        return $this->ref; }

/* generate area html */
    public function area($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("area", $param , $content);
        return $this->ref; }

/* generate b html */
    public function b($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("b", $param , $content);
        return $this->ref; }

/* generate base html */
    public function base($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("base", $param , $content);
        return $this->ref; }

/* generate basefont html */
    public function basefont($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("basefont", $param , $content);
        return $this->ref; }

/* generate bdo html */
    public function bdo($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("bdo", $param , $content);
        return $this->ref; }

/* generate big html */
    public function big($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("big", $param , $content);
        return $this->ref; }

/* generate blockquote html */
    public function blockquote($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("blockquote", $param , $content);
        return $this->ref; }

/* generate body html */
    public function body($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("body", $param , $content);
        return $this->ref; }

/* generate br html */
    public function br($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("br", $param , $content);
        return $this->ref; }

/* generate button html */
    public function button($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("button", $param , $content);
        return $this->ref; }

/* generate caption html */
    public function caption($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("caption", $param , $content);
        return $this->ref; }

/* generate center html */
    public function center($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("center", $param , $content);
        return $this->ref; }

/* generate cite html */
    public function cite($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("cite", $param , $content);
        return $this->ref; }

/* generate code html */
    public function code($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("code", $param , $content);
        return $this->ref; }

/* generate col html */
    public function col($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("col", $param , $content);
        return $this->ref; }

/* generate colgroup html */
    public function colgroup($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("colgroup", $param , $content);
        return $this->ref; }

/* generate dd html */
    public function dd($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("dd", $param , $content);
        return $this->ref; }

/* generate del html */
    public function del($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("del", $param , $content);
        return $this->ref; }

/* generate dfn html */
    public function dfn($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("dfn", $param , $content);
        return $this->ref; }

/* generate dir html */
    public function dir($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("dir", $param , $content);
        return $this->ref; }

/* generate div html */
    public function div($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("div", $param , $content);
        return $this->ref; }

/* generate dl html */
    public function dl($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("dl", $param , $content);
        return $this->ref; }

/* generate dt html */
    public function dt($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("dt", $param , $content);
        return $this->ref; }

/* generate em html */
    public function em($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("em", $param , $content);
        return $this->ref; }

/* generate fieldset html */
    public function fieldset($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("fieldset", $param , $content);
        return $this->ref; }

/* generate font html */
    public function font($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("font", $param , $content);
        return $this->ref; }

/* generate form html */
    public function form($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("form", $param , $content);
        return $this->ref; }

/* generate frame html */
    public function frame($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("frame", $param , $content);
        return $this->ref; }

/* generate frameset html */
    public function frameset($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("frameset", $param , $content);
        return $this->ref; }

/* generate h1 html */
    public function h1($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("h1", $param , $content);
        return $this->ref; }

/* generate h2 html */
    public function h2($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("h2", $param , $content);
        return $this->ref; }

/* generate h3 html */
    public function h3($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("h3", $param , $content);
        return $this->ref; }

/* generate h4 html */
    public function h4($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("h4", $param , $content);
        return $this->ref; }

/* generate h5 html */
    public function h5($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("h5", $param , $content);
        return $this->ref; }

/* generate h6 html */
    public function h6($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("h6", $param , $content);
        return $this->ref; }

/* generate head html */
    public function head($param=NULL,$content=NULL) {
        $this->ref=$this->ftag("head", $param , $content);
        return $this->ref; }

/* generate hr html */
    public function hr($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("hr", $param , $content);
        return $this->ref; }

/* generate html html */
    public function html($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("html", $param , $content);
        return $this->ref; }

/* generate i html */
    public function i($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("i", $param , $content);
        return $this->ref; }

/* generate iframe html */
    public function iframe($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("iframe", $param , $content);
        return $this->ref; }

/* generate img html */
    public function img($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("img", $param , $content);
        return $this->ref; }

/* generate input html */
    public function input($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("input", $param , $content);
        return $this->ref; }

/* generate ins html */
    public function ins($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("ins", $param , $content);
        return $this->ref; }

/* generate isindex html */
    public function isindex($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("isindex", $param , $content);
        return $this->ref; }

/* generate kbd html */
    public function kbd($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("kbd", $param , $content);
        return $this->ref; }

/* generate label html */
    public function label($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("label", $param , $content);
        return $this->ref; }

/* generate legend html */
    public function legend($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("legend", $param , $content);
        return $this->ref; }

/* generate li html */
    public function li($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("li", $param , $content);
        return $this->ref; }

/* generate link html */
    public function link($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("link", $param , $content);
        return $this->ref; }

/* generate map html */
    public function map($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("map", $param , $content);
        return $this->ref; }

/* generate menu html */
    public function menu($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("menu", $param , $content);
        return $this->ref; }

/* generate meta html */
    public function meta($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("meta", $param , $content);
        return $this->ref; }

/* generate noframes html */
    public function noframes($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("noframes", $param , $content);
        return $this->ref; }

/* generate noscript html */
    public function noscript($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("noscript", $param , $content);
        return $this->ref; }

/* generate object html */
    public function object($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("object", $param , $content);
        return $this->ref; }

/* generate ol html */
    public function ol($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("ol", $param , $content);
        return $this->ref; }

/* generate optgroup html */
    public function optgroup($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("optgroup", $param , $content);
        return $this->ref; }

/* generate option html */
    public function option($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("option", $param , $content);
        return $this->ref; }

/* generate p html */
    public function p($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("p", $param , $content);
        return $this->ref; }

/* generate param html */
    public function param($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("param", $param , $content);
        return $this->ref; }

/* generate pre html */
    public function pre($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("pre", $param , $content);
        return $this->ref; }

/* generate q html */
    public function q($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("q", $param , $content);
        return $this->ref; }

/* generate s html */
    public function s($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("s", $param , $content);
        return $this->ref; }

/* generate samp html */
    public function samp($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("samp", $param , $content);
        return $this->ref; }

/* generate script html */
    public function script($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("script", $param , $content);
        return $this->ref; }

/* generate select html */
    public function select($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("select", $param , $content);
        return $this->ref; }

/* generate small html */
    public function small($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("small", $param , $content);
        return $this->ref; }

/* generate span html */
    public function span($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("span", $param , $content);
        return $this->ref; }

/* generate strike html */
    public function strike($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("strike", $param , $content);
        return $this->ref; }

/* generate strong html */
    public function strong($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("strong", $param , $content);
        return $this->ref; }

/* generate sub html */
    public function sub($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("sub", $param , $content);
        return $this->ref; }

/* generate sup html */
    public function sup($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("sup", $param , $content);
        return $this->ref; }

/* generate table html */
    public function table($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("table", $param , $content);
        return $this->ref; }

/* generate tbody html */
    public function tbody($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("tbody", $param , $content);
        return $this->ref; }

/* generate td html */
    public function td($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("td", $param , $content);
        return $this->ref; }

/* generate textarea html */
    public function textarea($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("textarea", $param , $content);
        return $this->ref; }

/* generate tfoot html */
    public function tfoot($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("tfoot", $param , $content);
        return $this->ref; }

/* generate th html */
    public function th($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("th", $param , $content);
        return $this->ref; }

/* generate thead html */
    public function thead($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("thead", $param , $content);
        return $this->ref; }

/* generate title html */
    public function title($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("title", $param , $content);
        return $this->ref; }

/* generate tr html */
    public function tr($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("tr", $param , $content);
        return $this->ref; }

/* generate tt html */
    public function tt($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("tt", $param , $content);
        return $this->ref; }

/* generate u html */
    public function u($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("u", $param , $content);
        return $this->ref; }

/* generate ul html */
    public function ul($param=NULL,$content=NULL) {
        $this->ref=parent::ftag("ul", $param , $content);
        return $this->ref; }

   
/**
 * in this sektion generated bloks of content
 * @param type $param 
 */ 
       public function sidebar($param) {
        
    }
    public function box($inbox){
        $this->ref=self::ftag("div",' class="box" ',$inbox);
        return $this->ref;
    }
    public function login_form(){
        $user_name=$this->input(' type="text" name="login" ');
        $user_pass=$this->input(' type="password" name="password" ');;
        $buton_ok= $this->button("type='submit' ", 'ok');
        $fieldset=$user_name.$user_pass.$buton_ok;
        $form=$this->form(' action="login" method="POST"',$fieldset);
        $this->ref= $this->box($form);
    }

}

?>