<?php
/**
 * Post to vbulletin site class.
 */
 
class VBPost{
    /*
     * properties to store post sites, cookie path and
     * max sites to process in one loop
     */
	private $maxSitesToProcess;
	private $cookiesPath;
	private $postsites;
    /**
     * @param $postsites post sites array
     * @param $cookiesPath  cookies path
     * @param $maxSitesToProcess    max sites to process in one loop
     */
	 function __construct ($postsites,$cookiesPath,$maxSitesToProcess) {
		$this->postsites = $postsites;
		$this->cookiesPath = $cookiesPath;
		$this->maxSitesToProcess = $maxSitesToProcess;
	  }

    /**
     * This is our first call to login to sites
     * @param int $start
     * @return array of handles
     */
    private function call1($start=0){
        for($x=$start;$x<=($start + $this->maxSitesToProcess);$x++){
            if(isset($this->postsites[$x])){
                $value = $this->postsites[$x];
                $key = $x;

					$post = 'vb_login_username='.$value['username'].'&vb_login_password='.$value['password'].'&x=0&y=0&s=&securitytoken=guest&do=login&vb_login_md5password='.md5($value['password']).'&vb_login_md5password_utf='.md5($value['password']);
					$lurl = $value['siteurl'] . "login.php";
					$cURL = curl_init();
					curl_setopt($cURL, CURLOPT_URL, $lurl);
					curl_setopt($cURL, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
					curl_setopt($cURL, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt($cURL, CURLOPT_HEADER, 1);
					curl_setopt($cURL,CURLOPT_HTTPHEADER,array("Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7"));
					curl_setopt($cURL, CURLOPT_POST, 1);
					curl_setopt($cURL, CURLOPT_POSTFIELDS, $post);
					curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($cURL, CURLOPT_COOKIEJAR, $this->cookiesPath.$value['cookiefile']);
					// store in multi-dimensional array for later
					$curlHandles[] = array($cURL, $key);

            }
        } //end foreach
         return $curlHandles;
    }

    /**
     * This is our second call to sites to go to open new thread
     * page and get security tokens
     * @param int $start
     * @return array of handles
     */
	private function call2($start=0){

		for($x=$start;$x<=($start + $this->maxSitesToProcess);$x++){
			if(isset($this->postsites[$x])){
				$value = $this->postsites[$x];
				$key = $x;

 					$lurl = $value['siteurl'] . "newthread.php?do=newthread&f=".$value['categoryid'];
					$cURL = curl_init();
					curl_setopt($cURL, CURLOPT_URL, $lurl);
					curl_setopt($cURL, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
					curl_setopt($cURL, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt($cURL, CURLOPT_HEADER, 1);
					curl_setopt($cURL,CURLOPT_HTTPHEADER,array("Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7"));
					curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($cURL, CURLOPT_COOKIEFILE, $this->cookiesPath.$value['cookiefile']);
					$curlHandles[] = array($cURL, $key);

			}
		}
		    return $curlHandles;
	}

    /**
     * Final request to post on sites
     * @param int $start
     * @return array of handles
     */
	private function call3($start=0){
		for($x=$start;$x<=($start + $this->maxSitesToProcess);$x++){
			    if(isset($this->postsites[$x])){
				    $value = $this->postsites[$x];
				    $key = $x;

					$lurl = $value['siteurl'] . "newthread.php?do=postthread&f=2";
                    $cURL = curl_init();
					curl_setopt($cURL, CURLOPT_URL, $lurl);
					curl_setopt($cURL, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
					curl_setopt($cURL, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt($cURL, CURLOPT_HEADER, 1);
					curl_setopt($cURL,CURLOPT_HTTPHEADER,array("Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7"));
					curl_setopt($cURL, CURLOPT_POST, 1);
					curl_setopt($cURL, CURLOPT_POSTFIELDS, $value['postfields']);
					curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($cURL, CURLOPT_COOKIEFILE, $this->cookiesPath.$value['cookiefile']);
					$curlHandles[] = array($cURL, $key);
                }
        }
          return $curlHandles;
    }

    /**
     * This function is core we will call this from outside of class to
     * post on site
     * @param $title title of post
     * @param $post_body  body of post
     * @return void
     */
	public function post($title,$post_body){

	$sitesCount = sizeof($this->postsites);
		$parts = ceil($sitesCount / $this->maxSitesToProcess);

		for($x=0;$x<$parts;$x++){

			$marker = $x * $this->maxSitesToProcess;
			if($marker <= $sitesCount){

                /**
                 *  Calling fist method to login on X amount of sites
                 */
				$curlHandles = $this->call1($marker);
				$mh = curl_multi_init();
				foreach($curlHandles as $handle) {curl_multi_add_handle($mh, $handle[0]);}
				$running = null;
				do {usleep(10000);curl_multi_exec($mh, $running);} while ($running > 0);
				foreach($curlHandles as $handle) {curl_multi_remove_handle($mh, $handle[0]);}
				curl_multi_close($mh);

				/**
                 *  Second call to open new thread page to get security tokens.
                 */
				$curlHandles = $this->call2($marker);
				$mh = curl_multi_init();
				foreach($curlHandles as $handle) {curl_multi_add_handle($mh, $handle[0]);}
				$running = null;
				do {usleep(10000);curl_multi_exec($mh, $running);} while ($running > 0);

                foreach($curlHandles as $handle) {

					$post_body=rawurlencode(nl2br($post_body));
					$data = curl_multi_getcontent($handle[0]);
					preg_match('%name="securitytoken" value="(.*?)"%',$data,$this->postsites[$handle[1]]["securitytoken"]);
					preg_match('%name="posthash" value="(.*?)"%',$data,$this->postsites[$handle[1]]["posthash"]);
					preg_match('%name="poststarttime" value="(.*?)"%',$data,$this->postsites[$handle[1]]["poststarttime"]);
					preg_match('%name="p" value="(.*?)"%',$data,$this->postsites[$handle[1]]["p"]);

                      $this->postsites[$handle[1]]["postfields"] =  "&subject=".$title.
                      "&message=".nl2br(htmlspecialchars_decode($post_body)).
                      "&wysiwyg=1&taglist=&iconid=0".
                      "&s=&securitytoken=".$this->postsites[$handle[1]]["securitytoken"][1].
                      "&f=2".
                      "&do=postthread&posthash=".$this->postsites[$handle[1]]["posthash"][1].
                      "&loggedinuser=1&sbutton=Submit+New+Thread&parseurl=1";
                    }
 				// Close the handles
				foreach($curlHandles as $handle) {curl_multi_remove_handle($mh, $handle[0]);}
				curl_multi_close($mh);


				/**
                 *  Last call, it will post finally on sites in loop
                 */
				$curlHandles = $this->call3($marker);
				$mh = curl_multi_init();
				foreach($curlHandles as $handle) {curl_multi_add_handle($mh, $handle[0]);}
				$running = null;
				do {usleep(10000);curl_multi_exec($mh, $running); } while ($running > 0);
				foreach($curlHandles as $handle) {curl_multi_remove_handle($mh, $handle[0]);}
				curl_multi_close($mh);
            }
        }
    }
}

