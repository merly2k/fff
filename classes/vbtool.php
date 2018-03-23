<?php
/**
 * Description of vbtool
 *
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 */
class vbtool {
    protected $site, $ch;
       
        public function __construct($i_site, $cookies_file) {
            $this->site = $i_site;
                $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt($this->ch, CURLOPT_TIMEOUT, '50');
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_REFERER, $this->site);
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, $cookies_file);
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, $cookies_file);
        }
       
        public function vB_post_reply($thread, $topic, $message) {
            curl_setopt($this->ch, CURLOPT_URL, $this->site . 'newreply.php?do=newreply&noquote=1&t=' . $thread);
        curl_setopt($this->ch, CURLOPT_POST, 0);
        $buffer = curl_exec($this->ch);
        $sectoken = '';
        $posthash = '';
        $posttime = '';
        $userid = '';
        preg_match('#<input type="hidden" name="securitytoken" value="(.+?)" />(.+?)#', $buffer, $sectoken);
        preg_match('#<input type="hidden" name="posthash" value="(.+?)" />(.+?)#', $buffer, $posthash);
        preg_match('#<input type="hidden" name="poststarttime" value="(.+?)" />(.+?)#', $buffer, $posttime);
        preg_match('#<input type="hidden" name="loggedinuser" value="(.+?)" />(.+?)#', $buffer, $userid);
            if(!$sectoken[1] or !$posthash[1] or !$posttime[1] or !$userid[1]) {
                $this->vB_post_reply($thread, $topic, $message); // try to get info again.
            }
        $data = 'do=postreply&title=' . urlencode($topic) . '&message=' . urlencode($message) . '&wysiwyg=1&iconid=0&securitytoken='
        . $sectoken[1] . '&specifiedpost=0&sbutton=Submit+Reply&parseurl=1&emailupdate=9999&polloptions=4&f=' . $cat . '&posthash=' . $posthash[1] .
        '&poststarttime=' . $posttime[1] . '&loggedinuser=' . $userid[1] . '&t=' . $thread;
        curl_setopt($this->ch, CURLOPT_URL, $this->site . 'newreply.php?do=postreply&t=' . $cat);
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch,CURLOPT_POSTFIELDS, $data);
        $buffer = curl_exec($this->ch);
        if(stristr($buffer, 'you do not have permission to access this page')) {
                return false;
        } elseif(stristr($buffer, 'Please try again in ')) {
                return false;
        } else {
                return true;
        }
        }
       
        public function vB_post_thread($cat, $topic, $message) {
            curl_setopt($this->ch, CURLOPT_URL, $this->site . 'newthread.php?do=newthread&f=' . $cat);
        curl_setopt($this->ch, CURLOPT_POST, 0);
        $buffer = curl_exec($this->ch);
        $sectoken = '';
        $posthash = '';
        $posttime = '';
        $userid = '';
        preg_match('#<input type="hidden" name="securitytoken" value="(.+?)" />(.+?)#', $buffer, $sectoken);
        preg_match('#<input type="hidden" name="posthash" value="(.+?)" />(.+?)#', $buffer, $posthash);
        preg_match('#<input type="hidden" name="poststarttime" value="(.+?)" />(.+?)#', $buffer, $posttime);
        preg_match('#<input type="hidden" name="loggedinuser" value="(.+?)" />(.+?)#', $buffer, $userid);
            if(!$sectoken[1] or !$posthash[1] or !$posttime[1] or !$userid[1]) {
                $this->vB_post_thread($cat, $topic, $message); // try to get info again.
            }
        $data = 'do=postthread&subject=' . urlencode($topic) . '&message=' . urlencode($message) . '&wysiwyg=1&iconid=0&securitytoken='
        . $sectoken[1] . '&sbutton=Submit+New+Thread&parseurl=1&emailupdate=9999&polloptions=4&f=' . $cat . '&posthash=' . $posthash[1] .
        '&poststarttime=' . $posttime[1] . '&loggedinuser=' . $userid[1];
        //echo $data;
        curl_setopt($this->ch, CURLOPT_URL, $this->site . 'newthread.php?do=postthread&f=' . $cat);
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch,CURLOPT_POSTFIELDS, $data);
        $buffer = curl_exec($this->ch);
        if(stristr($buffer, 'you do not have permission to access this page')) {
                return false;
        } elseif(stristr($buffer, 'Please try again in ')) {
                return false;
        } else {
                return true;
        }
        }
       
    function vB_login($user, $pass) {
        $md5Pass = md5($pass);
        $data = "do=login&vb_login_username=$user&securitytoken=guest&vb_login_md5password_utf=$md5Pass&vb_login_md5password=$md5Pass";
        curl_setopt($this->ch, CURLOPT_URL, $this->site . 'login.php?do=login');
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch,CURLOPT_POSTFIELDS, $data);
        $buffer = curl_exec($this->ch);
        $pos = strpos($buffer, "Спасибо");
        //$pos = strpos($buffer, "Thank you for logging in,");
        if($pos === false) {
            return 0;
        } else {
            return 1;
        }
    }

    function vB_inferno_shout($message) {
        $data = "do=shout&message=$message";
        curl_setopt($this->ch, CURLOPT_URL, $this->site . 'infernoshout.php?do=shout');
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch,CURLOPT_POSTFIELDS, $data);
        $buffer = curl_exec($this->ch);
        $pos = strpos($buffer, "completed");
        if($pos === false) {
            return 0;
        } else {
            return 1;
        }
    }        
    
    function html2bb($strings,$order="bbcode"){
    //the bbcode tags..
        
$aloved="<p><a><br><ul><li><img><embed>";
$bbc_a=array("[s]","[/s]","[b]","[/b]","[u]","[/u]","[i]","[/i]",
             "[center]","[/center]","[small]","[/small]","[big]","[/big]",
              "[huge]","[/huge]","[url=","[/url]",
              "[red]","[/red]","[orange]","[/orange]",
              "[green]","[/green]","[blue]","[/blue]"
                );

//bbcode gets converted to..
$bbc_b=array("<s>","</s>","<b>","</b>","<u>","</u>","<i>","</i>",
            "<center>","</center>","<small>","</small>","<font size=4>","</font>",
            "<font size=8>","</font>","<a href=\"\">(.*)</a>",
            "<font color=#ff6666>","</font>","<font color=#ffaa66>","</font>",
            "<font color=#66ff66>","</font>","<font color=#6666ff>","</font>",
             "<div>","</div>");

if($order=="html") //change bbcode to html
{
$return = str_replace($bbc_a,$bbc_b,$strings);
}
elseif($order=="bbcode")//change html to bbcode
{
        $bbstrings=strip_tags($strings,$aloved);
	$return = str_replace($bbc_b,$bbc_a,$bbstrings);
}
	return $return;    
    }
}

/**
 * $test = new vbtool('http://mskforum/', 'cookies.txt');
 * if($test->vB_login('Anthony', 'fuktitsshit')) {
 *    echo 'logged in!';
 * } else {
 *     echo ' couldnt log in????';
 * }
 * if($test->vB_inferno_shout('so whats going on here m8?')) {
 *
 *   echo ' shouted!';
* }
*
* if($test->vB_post_thread(26, 'the cool cat game', 'ur playing it and you dun even know.')) {
*    echo ' thread posted!';
*}
*
* if($test->vB_post_reply(133, 'usuk', 'satellite is whats up dark themes fail.')) {
*    echo ' reply posted!';
* }
* 
 */
?>
