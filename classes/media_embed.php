<?php
/************************************************************* 
 * This script is developed by Arturs Sosins aka ar2rsawseen, http://webcodingeasy.com 
 * Feel free to distribute and modify code, but keep reference to its creator 
 * 
 * Media Embed class allows you to retrieve information about media like Video or Images 
 * by simply using link or embed code from media providers like Youtube, Myspace, etc. 
 * It can retrieve embeding codes, title, sizes and thumbnails from 
 * more than 20 popular media providers
 * 
 * For more information, examples and online documentation visit:  
 * http://webcodingeasy.com/PHP-classes/Get-information-about-video-and-images-from-link
**************************************************************/
class media_embed
{
	private $code = "";
	private $site = "";
	private $data = array(
		"small" => "", 
		"medium" => "", 
		"large" => "", 
		"w" => -1, 
		"h" => -1, 
		"embed" => "",
		"iframe" => "",
		"url" => "",
		"site" => "", 
		"title" => ""
		);
	private $default_size = array("w" => 425, "h" => 344);
	private $all_types = array(
		"youtube" => array(
			"link" => "/https?:\/\/[w\.]*youtube\.com\/watch\?v=([^&#]*)|https?:\/\/[w\.]*youtube\.com\/watch\?[^&]+&v=([^&#]*)|https?:\/\/[w\.]*youtu\.be\/([^&#]*)/i",
			"embed" => '/https?:\/\/[w\.]*youtube\.com\/v\/([^?&#"\']*)/is',
			"iframe" => '/https?:\/\/[w\.]*youtube\.com\/embed\/([^?&#"\']*)/is'
		),
		"vimeo" => array(
			"link" => "/https?:\/\/[w\.]*vimeo\.com\/([\d]*)/is",
			"embed" => '/https?:\/\/[w\.]*vimeo\.com\/moogaloop\.swf\?clip_id=([\d]*)/is',
			"iframe" => '/https?:\/\/player\.vimeo\.com\/video\/([\d]*)/is'
		),
		"facebook" => array(
			"link" => "/https?:\/\/[w\.]*facebook\.com\/video\/video\.php\?v=([\d]*)|https?:\/\/[w\.]*facebook\.com\/photo\.php\?v=([\d]*)/is",
			"embed" => '/https?:\/\/[w\.]*facebook\.com\/v\/([\d]*)/is'
		),
		"dailymotion" => array(
			"link" => "/https?:\/\/[w\.]*dailymotion\.com\/video\/([^_]*)/is",
			"embed" => '/https?:\/\/[w\.]*dailymotion\.com\/swf\/video\/([^?&#"\']*)/is',
			"iframe" => '/https?:\/\/[w\.]*dailymotion\.com\/embed\/video\/([^?&#"\']*)/is'
		),
		"myspace" => array(
			"link" => "/https?:\/\/[w\.]*myspace\.com\/video\/.*\/.*\/([\d]*)|https?:\/\/[w\.]*myspace\.com\/video\/vid\/([\d]*)/is",
			"embed" => '/https?:\/\/mediaservices\.myspace\.com\/services\/media\/embed\.aspx\/m=([\d]*)|https?:\/\/player\.hulu\.com\/embed\/myspace_player_v002\.swf\?pid=\d*&embed=true&videoID=([\d]*)/is'
		),
		"metacafe" => array(
			"link" => '/https?:\/\/[w\.]*metacafe\.com\/watch\/([^?&#"\']*)/is',
			"embed" => '/https?:\/\/[w\.]*metacafe\.com\/fplayer\/(.*).swf/is'
		),
		"revver" => array(
			"link" => '/https?:\/\/[w\.]*revver\.com\/video\/(.*)/is',
			"embed" => '/https?:\/\/flash\.revver\.com\/player\/\d\.\d\/player\.swf\?mediaId=([\d]*)|https?:\/\/flash\.revver\.com\/player\/\d\.\d\/player\.js\?mediaId:([\d]*)|https?:\/\/media\.revver\.com\/qt\/([\d]*)\.mov|https?:\/\/media\.revver\.com\/player\/\d\.\d\/qtplayer.js\?mediaId:([\d]*)/is'
		),
		"fivemin" => array(
			"link" => '/https?:\/\/[w\.]*5min\.com\/Video\/([^?&#"\']*)/is',
			"embed" => '/https?:\/\/embed\.5min\.com\/([\d]*)/is'
		),
		"clickthrough" => array(
			"link" => '/https?:\/\/[w\.]*clikthrough\.com\/theater\/video\/([\d]*)/is',
			"embed" => '/https?:\/\/[w\.]*clikthrough\.com\/clikPlayer\.swf\?videoId=([\d]*)/is'
		)
		,
		"dotsub" => array(
			"link" => '/https?:\/\/[w\.]*dotsub\.com\/view\/([^\?\/&#]*)/is',
			"iframe" => '/https?:\/\/[w\.]*dotsub\.com\/media\/(.*)\/e/is'
		),
		"revision" => array(
			"link" => '/https?:\/\/[w\.]*revision3\.com\/([^?&#"\']*)/is',
		),
		"videojug" => array(
			"link" => '/https?:\/\/[w\.]*videojug\.com\/film\/([^?]*)/is',
		),
		"blip" => array(
			"link" => '/https?:\/\/[w\.]*blip\.tv\/([^?]*)/is',
		),
		"viddler" => array(
			"link" => '/https?:\/\/[w\.]*viddler\.com\/explore\/([^?]*)/is',
		),
		"screenr" => array(
			"link" => '/https?:\/\/[w\.]*screenr\.com\/([^?]*)/is',
		),
		"slideshare" => array(
			"link" => '/https?:\/\/[w\.]*slideshare\.net\/([^?]*)/is',
		),
		"hulu" => array(
			"link" => '/https?:\/\/[w\.]*hulu\.com\/watch\/([^?]*)/is',
		),
		"qik" => array(
			"link" => '/https?:\/\/[w\.]*qik\.com\/video\/([^?]*)/is',
		),
		"flickr" => array(
			"link" => '/https?:\/\/[w\.]*flickr\.com\/photos\/([^?]*)/is',
		),
		"funnyordie" => array(
			"link" => '/https?:\/\/[w\.]*funnyordie\.com\/videos\/([^?]*)/is',
		),
		"twitpic" => array(
			"link" => '/https?:\/\/[w\.]*twitpic\.com\/([^?]*)/is',
		),
		"yfrog" => array(
			"link" => '/https?:\/\/[w\.]*yfrog\.[^\/]*\/([^?]*)/is',
		),
		"break" => array(
			"link" => '/https?:\/\/[w\.]*break\.com\/index\/([^?&#"\']*)/is',
		)
	);
	
	function __construct($input){
		foreach($this->all_types as $site => $types)
		{
			foreach($types as $type => $regexp)
			{
				preg_match($regexp, $input, $match);
				if(!empty($match))
				{
					/*echo "<p>".$site." ".$type."</p>";
					echo "<pre>";
					print_r($match);
					echo "</pre>";*/
					for($i = 1; $i < sizeof($match); $i++)
					{
						if($match[$i] != "")
						{
							$this->code = $match[$i];
							$this->site = $site;
							break;
						}
					}
					if($this->code != "")
					{
						break;
					}
				}
			}
			if($this->code != "")
			{
				break;
			}
		}
	}
	
	/**************************
	* PUBLIC FUNCTIONS
	**************************/
	
	public function get_thumb($size = "small"){
		if($this->site != "")
		{
			$size_types = array("small", "medium", "large");
			$size = strtolower($size);
			if(!in_array($size, $size_types))
			{
				$size = "small";
			}
			$this->prepare_data("thumb");
			return $this->data[$size];
		}
		else
		{
			return "";
		}
	}
	
	public function get_iframe($w = -1, $h = -1){
		$this->prepare_data("iframe");
		if($this->site != "" && $this->data["iframe"] != "")
		{
			if($w < 0 || $h < 0)
			{
				$w = (is_int($this->data["w"]) && $this->data["w"] > 0) ? $this->data["w"] : $this->default_size["w"];
				$h = (is_int($this->data["h"]) && $this->data["h"] > 0) ? $this->data["h"] : $this->default_size["h"];
			}
			return '<iframe width="'.$w.'" height="'.$h.'" src="'.$this->data["iframe"].'" frameborder="0" allowfullscreen></iframe>';
		}
		else
		{
			return "";
		}
	}
	
	public function get_embed($w = -1, $h = -1){
		$this->prepare_data("embed");
		if($this->site != "" && $this->data["embed"])
		{
			if($w < 0 || $h < 0)
			{
				$w = (is_int($this->data["w"]) && $this->data["w"] > 0) ? $this->data["w"] : $this->default_size["w"];
				$h = (is_int($this->data["h"]) && $this->data["h"] > 0) ? $this->data["h"] : $this->default_size["h"];
			}
			return '<object width="'.$w.'" height="'.$h.'" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"><param name="movie" value="'.$this->data["embed"].'"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="'.$this->data["embed"].'" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.$w.'" height="'.$h.'"></embed></object>';
		}
		else
		{
			return "";
		}
	}
	
	public function get_url(){
		if($this->site != "")
		{
			$this->prepare_data("url");
			return $this->data["url"];
		}
		else
		{
			return "";
		}
	}
	
	public function get_id(){
		return $this->code;
	}
	
	public function get_site(){
		$this->prepare_data("site");
		return $this->data["site"];
	}
	
	public function get_size(){
		$arr = array();
		$this->prepare_data("size");
		$arr["w"] = ($this->data["w"] < 0) ? $this->default_size["w"] : $this->data["w"];
		$arr["h"] = ($this->data["h"] < 0) ? $this->default_size["h"] : $this->data["h"];
		return $arr;
	}
	
	public function get_title(){
		$this->prepare_data("title");
		return $this->data["title"];
	}
	
	/**************************
	* PRIVATE FUNCTIONS
	**************************/
	private function get_data($url){
		//echo "<p>Curl request ".$url."</p>";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
		$curlData = curl_exec($curl);
		curl_close($curl);
		return $curlData;
	}
	
	private function prepare_data($type){
		if($this->site != "")
		{
			$ready = false;
			switch($type)
			{
				case "size":
					if($this->data["w"] > 0 && $this->data["h"] > 0)
					{
						$ready = true;
					}
				break;
				case "thumb":
					if($this->data["small"] != "" && $this->data["medium"] != "" && $this->data["large"] != "")
					{
						$ready = true;
					}
				break;
				default:
				if($this->data[$type] != "")
				{
					$ready = true;
				}
			}
			//if information is not yet loaded
			if(!$ready)
			{
				$func = ($this->site)."_data";
				$arr = $this->$func();
				//check if information requires http request
				if(!$arr[$type])
				{
					//if not, just provide data
					$func = ($this->site)."_".$type;
					$this->aggregate($this->$func(), $type);
				}
				else
				{
					//else if it needs http request we may as well load all other data
					//so we won't need to request it again
					$req = ($this->site)."_req";
					$res = $this->get_data($this->$req());
					foreach($arr as $key => $val)
					{
						$func = ($this->site)."_".$key;
						if($val)
						{
							$this->aggregate($this->$func($res), $key);
						}
						else
						{
							$this->aggregate($this->$func(), $key);
						}
					}
				}
			}
		}
	}
	
	private function aggregate($data, $type){
		if(is_array($data))
		{
			foreach($data as $key => $val)
			{
				$this->data[$key] = $val;
			}
		}
		else
		{
			$this->data[$type] = $data;
		}
	}
	
	/**************************
	* SOME STANDARDS
	**************************/
	//oembed functions
	private function oembed_size($res){
		$arr = array();
		$res = json_decode($res, true);
		if(is_array($res) && !empty($res) && isset($res["width"]) && isset($res["height"]))
		{
			$arr["w"] = (int)$res["width"];
			$arr["h"] = (int)$res["height"];
		}
		return $arr;
	}
	
	private function oembed_title($res){
		$title = "";
		$res = json_decode($res, true);
		if(is_array($res) && !empty($res) && isset($res["title"]))
		{
			$title = $res["title"];
		}
		return $title;
	}
	
	//og functions
	private function og_size($res){
		$arr = array();
		preg_match( '/property="og:video:width"\s*content="([\d]*)/i', $res, $match);
		if(!empty($match))
		{
			$arr["w"] = (int)$match[1];
		}
		preg_match( '/property="og:video:height"\s*content="([\d]*)/i', $res, $match);
		if(!empty($match))
		{
			$arr["h"] = (int)$match[1];
		}
		return $arr;
	}
	
	private function og_title($res){
		$ret = "";
		preg_match( '/property="og:title"\s*content="([^"]*)"/i', $res, $match);
		if(!empty($match))
		{
			$ret = $match[1];
		}
		return $ret;
	}
	
	private function og_video($res){
		$code = "";
		preg_match( '/<meta\s*property="og:video"\s*content="([^"]*)"/i', $res, $match);
		if(!empty($match))
		{
			$code = $match[1];
		}
		return $code;
	}
	
	//others
	private function link2title(){
		$title = "";
		$parts = explode("/", $this->code);
		if(isset($parts[1]))
		{
			$parts = explode("_", $parts[1]);
			foreach($parts as $key => $val)
			{
				$parts[$key] = ucfirst($val);
			}
			$title = implode(" ", $parts);
		}
		return $title;
	}
	/**************************
	* YOUTUBE FUNCTIONS
	**************************/
	
	//which data needs additional http request
	private function youtube_data(){
		return  array(
			"thumb" => false, 
			"size" => true, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function youtube_req(){
		return $this->youtube_url();
	}
	//return thumbnails
	private function youtube_thumb(){
		$size_types = array("small" => "default", "medium" => "hqdefault", "large" => "hqdefault");
		$arr = array();
		foreach($size_types as $key => $val)
		{
			$arr[$key] = "http://i.ytimg.com/vi/".($this->code)."/".$val.".jpg";
		}
		return $arr;
	}
	//return size
	private function youtube_size($res){
		return $this->og_size($res);
	}
	//return iframe url
	private function youtube_iframe(){
		return "http://www.youtube.com/embed/".($this->code);
	}
	//return embed url
	private function youtube_embed(){
		return "http://www.youtube.com/v/".($this->code);
	}
	//return canonical url
	private function youtube_url(){
		return "http://www.youtube.com/watch?v=".($this->code);
	}
	//return website url
	private function youtube_site(){
		return "http://www.youtube.com";
	}
	//return title
	private function youtube_title($res){
		return $this->og_title($res);
	}
	
	/**************************
	* VIMEO FUNCTIONS
	**************************/
	
	//which data needs additional http request
	private function vimeo_data(){
		return array(
			"thumb" => true, 
			"size" => true, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function vimeo_req(){
		return "http://vimeo.com/api/v2/video/".($this->code).".json";
	}
	//return thumbnails
	private function vimeo_thumb($res){
		$res = json_decode($res, true);
		$arr = array();
		if(is_array($res) && !empty($res))
		{
			$res = current($res);
			$sizes = array("small", "medium", "large");
			foreach($sizes as $val)
			{
				$arr[$val] = $res["thumbnail_".$val];
			}
		}
		return $arr;
	}
	//return size
	private function vimeo_size($res){
		$res = json_decode($res, true);
		$arr = array();
		if(is_array($res) && !empty($res))
		{
			$res = current($res);
			$arr["w"] = (int)$res["width"];
			$arr["h"] = (int)$res["height"];
		}
		return $arr;
	}
	//return iframe link
	private function vimeo_iframe(){
		return "http://player.vimeo.com/video/".($this->code);
	}
	//return embed url
	private function vimeo_embed(){
		return "http://vimeo.com/moogaloop.swf?clip_id=".($this->code);
	}
	//return canonical url
	private function vimeo_url(){
		return "http://www.vimeo.com/".($this->code);
	}
	//return website url
	private function vimeo_site(){
		return "http://www.vimeo.com";
	}
	//return title
	private function vimeo_title($res){
		$res = json_decode($res, true);
		$title = "";
		if(is_array($res) && !empty($res))
		{
			$res = current($res);
			$title = $res["title"];
		}
		return $title;
	}
	
	/**************************
	* FACEBOOK FUNCTIONS
	**************************/
	//which data needs additional http request
	private function facebook_data(){
		return array(
			"thumb" => true, 
			"size" => true, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function facebook_req(){
		return $this->facebook_url();
	}
	//return thumbnails
	private function facebook_thumb($res){
		$arr = array();
		preg_match( '/thumbnail_src(.*)_b\.jpg/i', $res, $match);
		if(!empty($match))
		{
			$arr["large"] = str_replace("\u00253A", ":", str_replace("\u00252F", "/", str_replace("\u00255C", "", str_replace("\u002522\u00253A\u002522", "", $match[1]))))."_b.jpg";
			$arr["medium"] = $arr["large"];
			$arr["small"] = str_replace("_b.jpg", "_t.jpg", $arr["large"]);
		}
		return $arr;
	}
	//return size
	private function facebook_size($res){
		$arr = array();
		preg_match( '/\["width",\s*"([\d]*)"\]/i', $res, $match);
		if(!empty($match))
		{
			$arr["w"] = (int)$match[1];
		}
		preg_match( '/\["height",\s*"([\d]*)"\]/i', $res, $match);
		if(!empty($match))
		{
			$arr["h"] = (int)$match[1];
		}
		return $arr;
	}
	//return iframe url
	private function facebook_iframe(){
		return "http://www.facebook.com/v/".($this->code);
	}
	//return embed url
	private function facebook_embed(){
		return $this->facebook_iframe();
	}
	//return canonical url
	private function facebook_url(){
		return "http://www.facebook.com/video/video.php?v=".($this->code);
	}
	//return website url
	private function facebook_site(){
		return "http://www.facebook.com";
	}
	//return title
	private function facebook_title($res){
		$title = "";
		preg_match( '/<h2 class="uiHeaderTitle">([^<]*)<\/h2>/i', $res, $match);
		if(!empty($match))
		{
			$title = $match[1];
		}
		return $title;
	}
	
	/**************************
	* DAILYMOTION FUNCTIONS
	**************************/
	//which data needs additional http request
	private function dailymotion_data(){
		return array(
			"thumb" => true, 
			"size" => true, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function dailymotion_req(){
		return "http://www.dailymotion.com/services/oembed?format=json&url=".$this->dailymotion_url();
	}
	//return thumbnails
	private function dailymotion_thumb($res){
		$arr = array();
		$res = json_decode($res, true);
		if(is_array($res) && !empty($res))
		{
			$arr["large"] = $res["thumbnail_url"];
			$arr["medium"] = str_replace("large", "medium", $res["thumbnail_url"]);
			$arr["small"] = str_replace("large", "small", $res["thumbnail_url"]);
		}
		return $arr;
	}
	//return size
	private function dailymotion_size($res){
		return $this->oembed_size($res);
	}
	//return iframe url
	private function dailymotion_iframe(){
		return "http://www.dailymotion.com/embed/video/".($this->code);
	}
	//return embed url
	private function dailymotion_embed(){
		return "http://www.dailymotion.com/swf/video/".($this->code);
	}
	//return canonical url
	private function dailymotion_url(){
		return "http://www.dailymotion.com/video/".($this->code);
	}
	//return website url
	private function dailymotion_site(){
		return "http://www.dailymotion.com";
	}
	//return title
	private function dailymotion_title($res){
		return $this->oembed_title($res);
	}
	
	/**************************
	* MYSAPCE FUNCTIONS
	**************************/
	//which data needs additional http request
	private function myspace_data(){
		return array(
			"thumb" => true, 
			"size" => true, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function myspace_req(){
		return "http://mediaservices.myspace.com/services/rss.ashx?type=video&videoID=".$this->code;
	}
	//return thumbnails
	private function myspace_thumb($res){
		$arr = array();
		preg_match( '/<media:thumbnail\s*url="([^"]*)/i', $res, $match);
		if(!empty($match))
		{
			$arr["small"] = $match[1];
			$arr["medium"] = str_replace("/thumb1", "/thumb7", $arr["small"]);
			$arr["large"] = str_replace("/thumb1", "/thumb0", $arr["small"]);
		}
		return $arr;
	}
	//return size
	private function myspace_size($res){
		$arr = array();
		preg_match( '/<media:player url=".*"\s*height="([\d]*)"\s*width="([\d]*)"/i', $res, $match);
		if(!empty($match))
		{
			$arr["h"] = (int)$match[1];
			$arr["w"] = (int)$match[2];
		}
		return $arr;
	}
	//return iframe url
	private function myspace_iframe(){
		return "http://mediaservices.myspace.com/services/media/embed.aspx/m=".($this->code);
	}
	//return embed url
	private function myspace_embed(){
		return $this->myspace_iframe();
	}
	//return canonical url
	private function myspace_url(){
		return "http://www.myspace.com/video/vid/".($this->code);
	}
	//return website url
	private function myspace_site(){
		return "http://www.myspace.com";
	}
	//return title
	private function myspace_title($res){
		$title = "";
		$res = simplexml_load_string($res);
		$title = $res->channel->item->title;
		return $title;
	}
	
	/**************************
	* METACAFE FUNCTIONS
	**************************/
	//which data needs additional http request
	private function metacafe_data(){
		return array(
			"thumb" => false, 
			"size" => false, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => false
		);
	}
	//return http request url where to get data
	private function metacafe_req(){
		return "";
	}
	//return thumbnails
	private function metacafe_thumb(){
		$arr = array();
		$parts = explode("/", $this->code);
		$arr["medium"] = "http://s.mcstatic.com/thumb/".$parts[0].".jpg";
		$arr["large"] = "http://s.mcstatic.com/thumb/".$parts[0]."/0/4/videos/0/1/".$parts[1].".jpg";
		$arr["small"] = "http://s.mcstatic.com/thumb/".$parts[0]."/0/4/sidebar_16x9/0/1/".$parts[1].".jpg";
		return $arr;
	}
		//return size
	private function metacafe_size(){
		$arr = array();
		$arr["w"] = 460;
		$arr["h"] = 284;
		return $arr;
	}
	//return iframe url
	private function metacafe_iframe(){
		$code = ($this->code[strlen($this->code)-1] == "/") ? substr($this->code, 0, strlen($this->code)-1) : $this->code;
		return "http://www.metacafe.com/fplayer/".$code.".swf";
	}
	//return embed url
	private function metacafe_embed(){
		return $this->metacafe_iframe();
	}
	//return canonical url
	private function metacafe_url(){
		$code = ($this->code[strlen($this->code)-1] != "/") ? ($this->code)."/" : $this->code;
		return "http://www.metacafe.com/watch/".($code);
	}
	//return website url
	private function metacafe_site(){
		return "http://www.metacafe.com";
	}
	//return title
	private function metacafe_title(){
		return $this->link2title();
	}
	
	/**************************
	* REVVER FUNCTIONS
	**************************/
	private function revver_decode(){
		$parts = explode("/", $this->code);
		return $parts[0];
	}
	//which data needs additional http request
	private function revver_data(){
		return array(
			"thumb" => false, 
			"size" => false, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => false
		);
	}
	//return http request url where to get data
	private function revver_req(){
		return "";
	}
	//return thumbnails
	private function revver_thumb(){
		$arr = array();
		$arr["small"] = "http://frame.revver.com/frame/120x90/".($this->revver_decode()).".jpg";
		$arr["medium"] = "http://frame.revver.com/frame/320x240/".($this->revver_decode()).".jpg";
		$arr["large"] = "http://frame.revver.com/frame/480x360/".($this->revver_decode()).".jpg";
		return $arr;
	}
	//return size
	private function revver_size(){
		$arr = array();
		$arr["w"] = 480;
		$arr["h"] = 392;
		return $arr;
	}
	//return iframe url
	private function revver_iframe(){
		return "http://flash.revver.com/player/1.0/player.swf?mediaId=".$this->revver_decode();
	}
	//return embed url
	private function revver_embed(){
		return $this->revver_iframe();
	}
	//return canonical url
	private function revver_url(){
		return "http://www.revver.com/video/".($this->code);
	}
	//return website url
	private function revver_site(){
		return "http://www.revver.com";
	}
	//return title
	private function revver_title(){
		return $this->link2title();
	}
	
	/**************************
	* FIVEMIN FUNCTIONS
	**************************/
	private function fivemin_decode(){
		$parts = explode("-", $this->code);
		return $parts[sizeof($parts)-1];
	}
	//which data needs additional http request
	private function fivemin_data(){
		return array(
			"thumb" => true, 
			"size" => true, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function fivemin_req(){
		return "http://api.5min.com/oembed.xml?url=http://www.5min.com/Video/-".$this->fivemin_decode();
	}
	//return thumbnails
	private function fivemin_thumb($res){
		$res = simplexml_load_string($res);
		$arr["medium"] = $res->thumbnail_url;
		$arr["small"] = str_replace(".jpg", "_124_92.jpg", $arr["medium"]);
		$arr["large"] = str_replace(".jpg", "_".($res->width)."_".($res->height).".jpg", $arr["medium"]);
		return $arr;
	}
	//return size
	private function fivemin_size($res){
		$arr = array();
		$res = simplexml_load_string($res);
		$arr["w"] = $res->width;
		$arr["h"] = $res->height;
		return $arr;
	}
	//return iframe url
	private function fivemin_iframe(){
		return "http://embed.5min.com/".$this->fivemin_decode();
	}
	//return embed url
	private function fivemin_embed(){
		return $this->fivemin_iframe();
	}
	//return canonical url
	private function fivemin_url(){
		return "http://www.5min.com/Video/".($this->code);
	}
	//return website url
	private function fivemin_site(){
		return "http://www.5min.com";
	}
	//return title
	private function fivemin_title($res){
		$res = simplexml_load_string($res);
		return $res->title;
	}
	
	/**************************
	* CLICKTHROUGH FUNCTIONS
	**************************/
	//which data needs additional http request
	private function clickthrough_data(){
		return array(
			"thumb" => true, 
			"size" => true, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function clickthrough_req(){
		return "http://www.clikthrough.com/services/oembed/?url=".$this->clickthrough_url()."%26format%3Djson";
	}
	//return thumbnails
	private function clickthrough_thumb($res){
		$arr = array();
		$res = json_decode($res, true);
		if(is_array($res) && !empty($res))
		{
			$arr["medium"] = $res["thumbnail_url"];
			$arr["small"] = str_replace("/M-", "/Sw-", $arr["medium"]);
			$arr["large"] = str_replace("/M-", "/L-", $arr["medium"]);
		}
		return $arr;
	}
	//return size
	private function clickthrough_size($res){
		return $this->oembed_size($res);
	}
	//return iframe url
	private function clickthrough_iframe(){
		return "http://www.clikthrough.com/clikPlayer.swf?videoId=".$this->code;
	}
	//return embed url
	private function clickthrough_embed(){
		return $this->clickthrough_iframe();
	}
	//return canonical url
	private function clickthrough_url(){
		return "http://www.clikthrough.com/theater/video/".($this->code);
	}
	//return website url
	private function clickthrough_site(){
		return "http://www.clikthrough.com";
	}
	//return title
	private function clickthrough_title($res){
		return $this->oembed_title($res);
	}
	
	/**************************
	* DOTSUB FUNCTIONS
	**************************/
	//which data needs additional http request
	private function dotsub_data(){
		return array(
			"thumb" => false, 
			"size" => true, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function dotsub_req(){
		return "http://dotsub.com/services/oembed?url=".$this->dotsub_url();
	}
	//return thumbnails
	private function dotsub_thumb(){
		$arr = array();
		$arr["medium"] = "http://dotsub.com/media/".$this->code."/t";
		$arr["small"] = "http://dotsub.com/media/".$this->code."/t";
		$arr["large"] = "http://dotsub.com/media/".$this->code."/t";
		return $arr;
	}
	//return size
	private function dotsub_size($res){
		return $this->oembed_size($res);
	}
	//return iframe url
	private function dotsub_iframe(){
		return "http://dotsub.com/static/players/portalplayer.swf?uuid=".($this->code)."&lang=eng&plugins=dotsub&embedded=true";
	}
	//return embed url
	private function dotsub_embed(){
		return $this->dotsub_iframe();
	}
	//return canonical url
	private function dotsub_url(){
		return "http://dotsub.com/view/".($this->code);
	}
	//return website url
	private function dotsub_site(){
		return "http://www.dotsub.com";
	}
	//return title
	private function dotsub_title($res){
		return $this->oembed_title($res);
	}
	
	/**************************
	* REVISION3 FUNCTIONS
	**************************/
	//which data needs additional http request
	private function revision_data(){
		return array(
			"thumb" => true, 
			"size" => true, 
			"embed" => true,
			"iframe" => true,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function revision_req(){
		return $this->revision_url();
	}
	//return thumbnails
	private function revision_thumb($res){
		$arr = array();
		preg_match( '/<link\s*rel="image_src"\s*href="([^"]*)"/i', $res, $match);
		if(!empty($match))
		{
			
			$arr["small"] = $match[1];
			$arr["medium"] = str_replace("small.thumb.jpg", "medium.thumb.jpg", $match[1]);
			$arr["large"] = str_replace("small.thumb.jpg", "large.thumb.jpg", $match[1]);
		}
		return $arr;
	}
	//return size
	private function revision_size($res){
		return $this->og_size($res);
	}
	//return iframe url
	private function revision_iframe($res){
		return $this->og_video($res);
	}
	//return embed url
	private function revision_embed($res){
		return $this->revision_iframe($res);
	}
	//return canonical url
	private function revision_url(){
		return "http://revision3.com/".($this->code);
	}
	//return website url
	private function revision_site(){
		return "http://www.revision3.com";
	}
	//return title
	private function revision_title($res){
		return $this->og_title($res);
	}
	
	/**************************
	* VIDEOJUG FUNCTIONS
	**************************/
	//which data needs additional http request
	private function videojug_data(){
		return array(
			"thumb" => true, 
			"size" => true, 
			"embed" => true,
			"iframe" => true,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function videojug_req(){
		return $this->videojug_url();
	}
	//return thumbnails
	private function videojug_thumb($res){
		$arr = array();
		preg_match( '/<link\s*rel="image_src"\s*href="([^"]*)"/i', $res, $match);
		if(!empty($match))
		{
			
			$arr["medium"] = $match[1];
			$arr["small"] = str_replace("Medium.jpg", "Small.jpg", $match[1]);
			$arr["large"] = str_replace("Medium.jpg", "Large.jpg", $match[1]);
		}
		return $arr;
	}
	//return size
	private function videojug_size($res){
		$arr = array();
		preg_match( '/<meta\s*name="video_height"\s*content="([\d]*)"/i', $res, $match);
		if(!empty($match))
		{
			$arr["h"] = (int)$match[1];
		}
		preg_match( '/<meta\s*name="video_width"\s*content="([\d]*)"/i', $res, $match);
		if(!empty($match))
		{
			$arr["w"] = (int)$match[1];
		}
		return $arr;
	}
	//return iframe url
	private function videojug_iframe($res){
		$code = "";
		preg_match( '/<link\s*href="([^"]*)"\s*rel="video_src"\s*\/>/i', $res, $match);
		if(!empty($match))
		{
			$code = $match[1];
		}
		return $code;
	}
	//return embed url
	private function videojug_embed($res){
		return $this->videojug_iframe($res);
	}
	//return canonical url
	private function videojug_url(){
		return "http://www.videojug.com/film/".($this->code);
	}
	//return website url
	private function videojug_site(){
		return "http://www.videojug.com";
	}
	//return title
	private function videojug_title($res){
		$title = "";
		preg_match( '/<meta\s*name="title"\s*content="([^"]*)"/i', $res, $match);
		if(!empty($match))
		{
			$title =$match[1];
		}
		return $title;
	}
	
	/**************************
	* BLIP FUNCTIONS
	**************************/
	//which data needs additional http request
	private function blip_data(){
		return array(
			"thumb" => true, 
			"size" => false, 
			"embed" => true,
			"iframe" => true,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function blip_req(){
		return $this->blip_url();
	}
	//return thumbnails
	private function blip_thumb($res){
		$arr = array();
		preg_match( '/<meta\s*property="og:image"\s*content="([^"]*)"/i', $res, $match);
		if(!empty($match))
		{
			
			$arr["large"] = $match[1];
			$file = explode("blip.tv/", $match[1]);
			$arr["small"] = "http://i.blip.tv/g?src=".$file[1]."&w=140&h=80";
			$arr["medium"] = "http://i.blip.tv/g?src=".$file[1]."&w=300&h=170";
		}
		return $arr;
	}
	//return size
	private function blip_size(){
		$arr = array();
		$arr["h"] = 450;
		$arr["w"] = 800;
		return $arr;
	}
	//return iframe url
	private function blip_iframe($res){
		return $this->og_video($res);
	}
	//return embed url
	private function blip_embed($res){
		return $this->blip_iframe($res);
	}
	//return canonical url
	private function blip_url(){
		return "http://blip.tv/".($this->code);
	}
	//return website url
	private function blip_site(){
		return "http://blip.tv";
	}
	//return title
	private function blip_title($res){
		return $this->og_title($res);
	}
	
	/**************************
	* VIDDLER FUNCTIONS
	**************************/
	//which data needs additional http request
	private function viddler_data(){
		return array(
			"thumb" => true, 
			"size" => true, 
			"embed" => true,
			"iframe" => true,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function viddler_req(){
		return "http://lab.viddler.com/services/oembed/?format=json&type=simple&url=".$this->viddler_url();
	}
	//return thumbnails
	private function viddler_thumb($res){
		$arr = array();
		$res = json_decode($res, true);
		if(is_array($res) && !empty($res))
		{
			$arr["large"] = $res["thumbnail_url"];
			$arr["medium"] = $res["thumbnail_url"];
			$arr["small"] = str_replace("thumbnail_2", "thumbnail_1", $res["thumbnail_url"]);
		}
		return $arr;
	}
	//return size
	private function viddler_size($res){
		return $this->oembed_size($res);
	}
	//return iframe url
	private function viddler_iframe($res){
		$url = "";
		$res = json_decode($res, true);
		if(is_array($res) && !empty($res))
		{
			preg_match( '/<param\s*name="movie"\s*value="([^"]*)"/i', $res["html"], $match);
			if(!empty($match))
			{
				$url = $match[1];
			}
		}
		return $url;
	}
	//return embed url
	private function viddler_embed($res){
		return $this->viddler_iframe($res);
	}
	//return canonical url
	private function viddler_url(){
		return "http://www.viddler.com/explore/".($this->code);
	}
	//return website url
	private function viddler_site(){
		return "http://www.viddler.com";
	}
	//return title
	private function viddler_title($res){
		return $this->oembed_title($res);
	}
	
	/**************************
	* SCREENR FUNCTIONS
	**************************/
	//which data needs additional http request
	private function screenr_data(){
		return array(
			"thumb" => true, 
			"size" => true, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function screenr_req(){
		return "http://www.screenr.com/api/oembed.json?url=".$this->screenr_url();
	}
	//return thumbnails
	private function screenr_thumb($res){
		$arr = array();
		$res = json_decode($res, true);
		if(is_array($res) && !empty($res))
		{
			$arr["small"] = $res["thumbnail_url"];
			$arr["medium"] = $res["thumbnail_url"];
			$arr["large"] = str_replace("_thumb", "", $res["thumbnail_url"]);
		}
		return $arr;
	}
	//return size
	private function screenr_size($res){
		return $this->oembed_size($res);
	}
	//return iframe url
	private function screenr_iframe(){
		return "http://www.screenr.com/embed/".($this->code);
	}
	//return embed url
	private function screenr_embed(){
		return "";
	}
	//return canonical url
	private function screenr_url(){
		return "http://www.screenr.com/".($this->code);
	}
	//return website url
	private function screenr_site(){
		return "http://www.screenr.com";
	}
	//return title
	private function screenr_title($res){
		return $this->oembed_title($res);
	}
	
	/**************************
	* SLIDESHARE FUNCTIONS
	**************************/
	//which data needs additional http request
	private function slideshare_data(){
		return array(
			"thumb" => true, 
			"size" => true, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function slideshare_req(){
		return "http://www.slideshare.net/api/oembed/1?format=json&amp;url=".$this->slideshare_url();
	}
	//return thumbnails
	private function slideshare_thumb($res){
		$arr = array();
		$res = json_decode($res, true);
		if(is_array($res) && !empty($res))
		{
			$arr["small"] = $res["thumbnail"]."-2";
			$arr["medium"] = $res["thumbnail"];
			$arr["large"] = $res["thumbnail"];
		}
		return $arr;
	}
	//return size
	private function slideshare_size($res){
		return $this->oembed_size($res);
	}
	//return iframe url
	private function slideshare_iframe(){
		$code = explode("-", $this->code);
		return "http://www.slideshare.net/slideshow/embed_code/".($code[sizeof($code)-1]);
	}
	//return embed url
	private function slideshare_embed(){
		return "";
	}
	//return canonical url
	private function slideshare_url(){
		return "http://www.slideshare.net/".($this->code);
	}
	//return website url
	private function slideshare_site(){
		return "http://www.slideshare.net";
	}
	//return title
	private function slideshare_title($res){
		return $this->oembed_title($res);
	}

	/**************************
	* HULU FUNCTIONS
	**************************/
	//which data needs additional http request
	private function hulu_data(){
		return array(
			"thumb" => true, 
			"size" => true, 
			"embed" => true,
			"iframe" => true,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function hulu_req(){
		return "http://www.hulu.com/api/oembed.json?url=".$this->hulu_url();
	}
	//return thumbnails
	private function hulu_thumb($res){
		$arr = array();
		$res = json_decode($res, true);
		if(is_array($res) && !empty($res))
		{
			$arr["large"] = $res["thumbnail_url"];
			$arr["medium"] = $res["thumbnail_url"];
			$arr["small"] = $res["thumbnail_url"];
		}
		return $arr;
	}
	//return size
	private function hulu_size($res){
		return $this->oembed_size($res);
	}
	//return iframe url
	private function hulu_iframe($res){
		$url = "";
		$res = json_decode($res, true);
		if(is_array($res) && !empty($res))
		{
			$url = $res["embed_url"];
		}
		return $url;
	}
	//return embed url
	private function hulu_embed($res){
		return $this->viddler_iframe($res);
	}
	//return canonical url
	private function hulu_url(){
		return "http://www.hulu.com/watch/".($this->code);
	}
	//return website url
	private function hulu_site(){
		return "http://www.hulu.com";
	}
	//return title
	private function hulu_title($res){
		return $this->oembed_title($res);
	}
	
	/**************************
	* QIK FUNCTIONS
	**************************/
	//which data needs additional http request
	private function qik_data(){
		return array(
			"thumb" => true, 
			"size" => true, 
			"embed" => true,
			"iframe" => true,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function qik_req(){
		return "http://qik.com/api/oembed.json?url=".$this->qik_url();
	}
	//return thumbnails
	private function qik_thumb($res){
		$arr = array();
		$res = json_decode($res, true);
		if(is_array($res) && !empty($res))
		{
			preg_match( '/FlashVars="streamID=([^&]*)&/i', $res["html"], $match);
			if(!empty($match))
			{
				$arr["large"] = "http://qikimg.com/media.thumbnails.128/".$match[1].".jpg";
				$arr["medium"] = "http://qikimg.com/media.thumbnails.128/".$match[1].".jpg";
				$arr["small"] = "http://qikimg.com/media.thumbnails.128/".$match[1].".jpg";
			}
		}
		return $arr;
	}
	//return size
	private function qik_size($res){
		return $this->oembed_size($res);
	}
	//return iframe url
	private function qik_iframe($res){
		$url = "";
		$res = json_decode($res, true);
		if(is_array($res) && !empty($res))
		{
			preg_match( '/FlashVars="([^"]*)"/i', $res["html"], $match);
			if(!empty($match))
			{
				$url = "http://qik.com/swfs/qikPlayer5.swf?".$match[1];
			}
		}
		return $url;
	}
	//return embed url
	private function qik_embed($res){
		return $this->qik_iframe($res);
	}
	//return canonical url
	private function qik_url(){
		return "http://www.qik.com/video/".($this->code);
	}
	//return website url
	private function qik_site(){
		return "http://www.qik.com";
	}
	//return title
	private function qik_title($res){
		return $this->oembed_title($res);
	}
	
	/**************************
	* FLICKR FUNCTIONS
	**************************/
	//which data needs additional http request
	private function flickr_data(){
		return array(
			"thumb" => true, 
			"size" => true, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function flickr_req(){
		return "http://www.flickr.com/services/oembed/?format=json&url=".$this->flickr_url();
	}
	//return thumbnails
	private function flickr_thumb($res){
		$arr = array();
		$res = json_decode($res, true);
		if(is_array($res) && !empty($res))
		{
			$arr["large"] = str_replace(".jpg", "_b.jpg", $res["url"]);
			$arr["medium"] = $res["url"];
			$arr["small"] = str_replace(".jpg", "_m.jpg", $res["url"]);
		}
		return $arr;
	}
	//return size
	private function flickr_size($res){
		return $this->oembed_size($res);
	}
	//return iframe url
	private function flickr_iframe(){
		return "";
	}
	//return embed url
	private function flickr_embed(){
		return "";
	}
	//return canonical url
	private function flickr_url(){
		return "http://www.flickr.com/photos/".($this->code);
	}
	//return website url
	private function flickr_site(){
		return "http://www.flickr.com";
	}
	//return title
	private function flickr_title($res){
		return $this->oembed_title($res);
	}
	
	/**************************
	* FUNNYORDIE FUNCTIONS
	**************************/
	private function funnyordie_decode(){
		$parts = explode("/", $this->code);
		return $parts[0];
	}
	//which data needs additional http request
	private function funnyordie_data(){
		return array(
			"thumb" => false, 
			"size" => true, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function funnyordie_req(){
		return "http://www.funnyordie.com/oembed?format=json&url=".$this->funnyordie_url();
	}
	//return thumbnails
	private function funnyordie_thumb(){
		$arr = array();
		$arr["large"] = "http://assets.ordienetworks.com/tmbs/".($this->funnyordie_decode())."/fullsize_11.jpg";
		$arr["medium"] = "http://assets.ordienetworks.com/tmbs/".($this->funnyordie_decode())."/large_11.jpg";
		$arr["small"] = "http://assets.ordienetworks.com/tmbs/".($this->funnyordie_decode())."/medium_11.jpg";
		return $arr;
	}
	//return size
	private function funnyordie_size($res){
		return $this->oembed_size($res);
	}
	//return iframe url
	private function funnyordie_iframe(){
		return "http://public0.ordienetworks.com/flash/fodplayer.swf?key=".$this->funnyordie_decode();
	}
	//return embed url
	private function funnyordie_embed(){
		return $this->funnyordie_iframe();
	}
	//return canonical url
	private function funnyordie_url(){
		return "http://www.funnyordie.com/videos/".($this->code);
	}
	//return website url
	private function funnyordie_site(){
		return "http://www.funnyordie.com";
	}
	//return title
	private function funnyordie_title($res){
		return $this->oembed_title($res);
	}
	
	/**************************
	* TWITPIC FUNCTIONS
	**************************/
	//which data needs additional http request
	private function twitpic_data(){
		return array(
			"thumb" => false, 
			"size" => false, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => false
		);
	}
	//return http request url where to get data
	private function twitpic_req(){
		return "";
	}
	//return thumbnails
	private function twitpic_thumb(){
		$arr = array();
		$arr["large"] = "http://twitpic.com/show/full/".($this->code).".jpg";
		$arr["medium"] = "http://twitpic.com/show/large/".($this->code).".jpg";
		$arr["small"] = "http://twitpic.com/show/thumb/".($this->code).".jpg";
		return $arr;
	}
	//return size
	private function twitpic_size(){
		return "";
	}
	//return iframe url
	private function twitpic_iframe(){
		return "";
	}
	//return embed url
	private function twitpic_embed(){
		return "";
	}
	//return canonical url
	private function twitpic_url(){
		return "http://twitpic.com/".($this->code);
	}
	//return website url
	private function twitpic_site(){
		return "http://twitpic.com";
	}
	//return title
	private function twitpic_title(){
		return "";
	}
	
	/**************************
	* YFROG FUNCTIONS
	**************************/
	//which data needs additional http request
	private function yfrog_data(){
		return array(
			"thumb" => true, 
			"size" => true, 
			"embed" => true,
			"iframe" => true,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function yfrog_req(){
		return "http://www.yfrog.com/api/oembed?url=".$this->yfrog_url();
	}
	//return thumbnails
	private function yfrog_thumb($res){
		$arr = array();
		$res = json_decode($res, true);
		if(is_array($res) && !empty($res) && isset($res["url"]))
		{
			$arr["large"] = $res["url"];
			$arr["medium"] = "http://yfrog.com/".($this->code).":medium";
			$arr["small"] = "http://yfrog.com/".($this->code).":small";
		}
		else
		{
			$arr["large"] = "http://yfrog.com/".($this->code).":small";
			$arr["medium"] = "http://yfrog.com/".($this->code).":small";
			$arr["small"] = "http://yfrog.com/".($this->code).":small";
		}
		return $arr;
	}
	//return size
	private function yfrog_size($res){
		return $this->oembed_size($res);
	}
	//return iframe url
	private function yfrog_iframe($res){
		$code = "";
		$res = json_decode($res, true);
		if(is_array($res) && !empty($res) && $res["type"] == "video" && isset($res["html"]))
		{
			$code = $res["html"];
		}
		return $code;
	}
	//return embed url
	private function yfrog_embed($res){
		return $this->yfrog_iframe($res);
	}
	//return canonical url
	private function yfrog_url(){
		return "http://yfrog.com/".($this->code);
	}
	//return website url
	private function yfrog_site(){
		return "http://yfrog.com";
	}
	//return title
	private function yfrog_title($res){
		return $this->oembed_title($res);
	}
	
	/**************************
	* BREAK FUNCTIONS
	**************************/
	//which data needs additional http request
	private function break_data(){
		return array(
			"thumb" => true, 
			"size" => true, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => false
		);
	}
	//return http request url where to get data
	private function break_req(){
		return $this->break_url();
	}
	//return thumbnails
	private function break_thumb($res){
		$arr = array();
		preg_match( '/property="og:image"\s*content="([^"]*)"/i', $res, $match);
		if(!empty($match))
		{
			$arr["large"] = $match[1];
			$arr["medium"] = $match[1];
			$arr["small"] = $match[1];
		}
		return $arr;
	}
	//return size
	private function break_size($res){
		$arr = array();
		preg_match( '/name="video_width"\s*content="([^"]*)"/i', $res, $match);
		if(!empty($match))
		{
			$arr["w"] = $match[1];
		}
		preg_match( '/name="video_height"\s*content="([^"]*)"/i', $res, $match);
		if(!empty($match))
		{
			$arr["h"] = $match[1];
		}
		return $arr;
	}
	//return iframe url
	private function break_iframe(){
		$parts = explode("-", $this->code);
        //get the last part of url
		return "http://embed.break.com/".$parts[sizeof($parts)-1];
	}
	//return embed url
	private function break_embed(){
		return $this->break_iframe();
	}
	//return canonical url
	private function break_url(){
		return "http://www.break.com/index/".($this->code);
	}
	//return website url
	private function break_site(){
		return "http://www.break.com";
	}
	//return title
	private function break_title(){
		$parts = explode("-", $this->code);
		array_pop($parts);
		return ucwords(implode(" ", $parts));
	}
}
?>