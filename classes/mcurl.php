<?php

/*
 * Использование:
 * 	require_once('mcurl.class.php'); 
 * 	$urls = array(
 * 	        'http://felix90.ru',
 * 	        'http://ya.ru',
 * 	        'http://google.com'
 * 	        );	 
 * 	$mcurl = new MCurl();
 * 	$mcurl->setTimeout(5);
 * 	$mcurl->setUrls($urls);
 * 	$mcurl->scan();
 * 	$result = $mcurl->getResults();
 * 	var_export( $result );
 * 
 * Сокращённое использование:
 * 	require_once('mcurl.class.php');
 * 	$urls = array(
 * 	        'http://felix90.ru',
 * 	        'http://ya.ru',
 *	        'http://google.com'
 * 	        );
 * 	$mcurl = new MCurl(5, $urls);	 
 * 	$result = $mcurl->getResults();	 
 * 	var_export( $result );
 */

/**
 * Description of mcurl
 *
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 */

class mcurl
{
    protected $_urls;
    protected $_result;
    protected $_timeout;

    public function __construct($timeout = 5, $urls = false)
    {
        $this->_timeout = $timeout;
        $this->_urls = $urls ? $urls : array();
        $this->_result = array();
    }

    public function setTimeout($timeout)
    {
        $this->_timeout = $timeout;
    }

    public function setUrls($urls)
    {
        $this->_urls = $urls;
    }

    public function getResults()
    {
        if(!$this->_result) $this->scan();
        return $this->_result;
    }

    public function scan()
    {
        $curl = array();
        $mh = curl_multi_init();

        foreach ($this->_urls as $id => $url)
        {
            $curl[$id] = curl_init();
            curl_setopt($curl[$id], CURLOPT_URL, $url);
            curl_setopt($curl[$id], CURLOPT_HEADER, 0);
            curl_setopt($curl[$id], CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl[$id], CURLOPT_TIMEOUT, $this->timeout);
            curl_setopt($curl[$id], CURLOPT_FOLLOWLOCATION, true);
            curl_multi_add_handle($mh, $curl[$id]);
        } 

        $running = null;
        do curl_multi_exec($mh, $running);
        while($running > 0); 

        foreach($curl as $id => $c)
        {
            $this->_result[$id] = curl_multi_getcontent($c);
            curl_multi_remove_handle($mh, $c);
        } 

        curl_multi_close($mh);
    }
}

?>
