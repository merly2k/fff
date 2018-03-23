<?php

class db {
   public $query;
   public $result =array();
   public $succes;
   private $a;
   static $inst;
   public $lastState;
   public $found;
   public $link;
   public $last_id;
   public $structure;
   
   function __construct() {
         $host = DB_HOST;
         $login = DB_USER;
         $password = DB_PASSWORD;
         $dbname = DB_NAME;
	 $this->link = new mysqli($host, $login, $password, $dbname)or die(mysqli_error($this->link));
   //$this->link = mysqli_connect($host, $login, $password,$dbname) or die(mysqli_error($this->link));
   mysqli_set_charset($this->link,  "UTF8") or die(mysqli_error($this->link));
    }
    function q($zapros){
        $this->result=mysqls_fetch_array (mysqli_query ($this->link,$zapros));
        $this->lastState=mysqli_error($this->link);
        $this->last_id=mysqli_insert_id($this->link);
    }

    function query ($zapros){
        $this->result= mysqli_query($this->link,$zapros);
        $this->lastState=mysqli_error($this->link);
        $this->last_id=mysqli_insert_id($this->link);
    }

    function get_rows($zapros){
        $rest=mysqli_query($this->link,$zapros);
        //$this->found= $this->count_row();
        while ($row=mysqli_fetch_assoc($rest)) {
            $out[]= $row;
        }
	return $out;
        $this->result= $this->a;
        $this->lastState=mysqli_error($this->link);
    }

    function get_cols($zapros){
        $this->clRes();
        $rest=mysqli_query($this->link,$zapros);
        $this->found=  $this->count_row();
        $this->lastState=mysqli_error($this->link);
        while ($row = mysqli_fetch_assoc($rest)) {
            foreach ($row as $key => $value) {
               $this->result[$key][]=$value;
            }

        }

    }
    function fetch_array ($zapros){
        $this->result= mysqli_fetch_assoc(mysqli_query($this->link,$zapros));
        $this->found=  $this->count_row();
        $this->lastState=mysqli_error($this->link);
    }
    
    function get_result($zapros){
	$out=array();
	$rows = $this->link->query($zapros);
	
	while ($row=$rows->fetch_object()) {
	    $out[]=$row;
	}
	return $out;
    }
    
    

    function count_row() {
        $ar=mysqli_fetch_array(mysqli_query($this->link,'SELECT FOUND_ROWS()as found'));
        return (int)$ar['found'];
    }

    function close(){
        mysqli_close($this->link);
    }
}
?>
