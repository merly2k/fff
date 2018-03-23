<?php
class sessions {

  var $id;
  var $data;
  var $login_page;
 
  /*
  The class constructor.
  */ 
  function __construct($login_required=false) {
      if(empty($_COOKIE['sid'])){
          session_name('ucg');
          session_start();
          $_SESSION['sid'] = $_COOKIE['sid'] = session_id();
      }else{
          session_id($_COOKIE['sid']);
      }
   foreach ($_SESSION as $key => $value) {
   $this->data[$key]=$value;
      }
      
    $this->login_page = "login.php";
  }
  
  /*
  expire() is useful for a logout feature. It will empty the session data,
  delete the session file, and expire the sid cookie.
  */
  function expire() {
    $ret = true;
    $this->data = array();
    setcookie('sid' ,$this->id, time()-3600, "/");
    session_destroy(); 
    return $ret;
  }

  /*
  exists() checks if sid cookie exists on user's computer. If so, set id.
  */
  function exists() {
      if (!isset($_COOKIE['sid'])) {
        return false;
      }
    $this->id = $_COOKIE['sid'];
    return true;
  }

  /*
  newId() generates a 32 character identifier that is extremely difficult to
  predict. Save to a cookie to persist between pages.
  */
  function newId() {
      session_regenerate_id();
  }
  
  function save(){
      foreach ($this->data as $key => $value) {
          $_SESSION[$key]=$value;
      }
  
  
  }
    
}

?>
