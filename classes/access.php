<?php

class Access {

    var $sessionVariable = 'userSessionValue';
    var $remTime = 2592000; //One month
    var $remCookieName = 'ckSavePass';
    var $remCookieDomain = '';
    var $passMethod = 'md5';
    var $displayErrors = true;
    var $userID;
    var $dbConn;
    var $userData = array();

    function __construct() {

        $this->remCookieDomain = $this->remCookieDomain == '' ? $_SERVER['HTTP_HOST'] : $this->remCookieDomain;
        if (!isset($_SESSION))
            session_start();
        if (!empty($_SESSION[$this->sessionVariable])) {
            $this->loadUser($_SESSION[$this->sessionVariable]);
        }
        if (isset($_COOKIE[$this->remCookieName]) && !$this->is_loaded()) {
            $u = unserialize(base64_decode($_COOKIE[$this->remCookieName]));
            $this->login($u['uname'], $u['password']);
        }
    }

    /**
     * Login function
     * @param string $uname
     * @param string $password
     * @param bool $loadUser
     * @return bool
     */
    function login($uname, $password, $remember = false, $loadUser = true) {
        $dbConn = new db();
        $uname = $this->escape($uname);
        $password = $originalPassword = $this->escape($password);
        switch (strtolower($this->passMethod)) {
            case 'sha1':
                $password = "SHA1('$password')";
                break;
            case 'md5' :
                $password = "MD5('$password')";
                break;
            case 'nothing':
                $password = "'$password'";
                break;
            default :
                $password = "MD5('$password')";
        }
        
        $res = "SELECT * FROM `users` 
		WHERE `username` = '$uname' 
                AND `password` = '$password' LIMIT 1;";
        $dbConn->get_rows($res);
        
        //if ($dbConn->result == 0): //return false;
            echo $dbConn->result;
            
        //endif;
        if ($loadUser) {
            $this->userData = $dbConn->result;
            $this->userID = $this->userData['id'];
            $_SESSION[$this->sessionVariable] = $this->userID;
            foreach ( $dbConn->result as $key => $value) {
            $_SESSION[$key]=$value;
            $_COOKIE[$key]=$value;
            }
            
            if ($remember) {
                $cookie = base64_encode(serialize(array('uname' => $uname, 'password' => $originalPassword)));
                $a = setcookie($this->remCookieName, $cookie, time() + $this->remTime, '/', $this->remCookieDomain);
            }
        }
        return true;
    }

    /**
     * Logout function
     * param string $redirectTo
     * @return bool
     */
    function logout($redirectTo = '') {
        setcookie($this->remCookieName, '', time() - 3600);
        $_SESSION[$this->sessionVariable] = '';
        $this->userData = '';
        if ($redirectTo != '' && !headers_sent()) {
            header('Location: ' . $redirectTo);
            exit; //To ensure security
        }
    }

    /**
     * Function to determine if a property is true or false
     * param string $prop
     * @return bool
     */
    function is($prop) {
        return $this->get_property($prop) == 1 ? true : false;
    }

    /**
     * Get a property of a user. You should give here the name of the field that you seek from the user table
     * @param string $property
     * @return string
     */
    function get_property($property) {
        if (empty($this->userID))
            $this->error('No user is loaded', __LINE__);
        if (!isset($this->userData[$property]))
            $this->error('Unknown property <b>' . $property . '</b>', __LINE__);
        return $this->userData[$property];
    }

    /**
     * Is the user an active user?
     * @return bool
     */
    function is_active() {
        return $this->userData[$this->tbFields['active']];
    }

    /**
     * Is the user loaded?
     * @ return bool
     */
    function is_loaded() {
        return empty($this->userID) ? false : true;
    }

    /**
     * Activates the user account
     * @return bool
     */
    function activate() {

        if (empty($this->userID))
            $this->error('No user is loaded', __LINE__);
        if ($this->is_active())
            $this->error('Allready active account', __LINE__);
        $res = $this->query("UPDATE `{$this->dbTable}` SET '" . $this->tbFields['active'] . "' = 1 
	WHERE `{$this->tbFields['userID']}` = '" . $this->escape($this->userID) . "' LIMIT 1");
        if (@mysql_affected_rows() == 1) {
            $this->userData[$this->tbFields['active']] = true;
            return true;
        }
        return false;
    }

    /*
     * Creates a user account. The array should have the form 'database field' => 'value'
     * @param array $data
     * return int
     */

    function insertUser($data) {
        if (!is_array($data))
            $this->error('Data is not an array', __LINE__);
        switch (strtolower($this->passMethod)) {
            case 'sha1':
                $password = "SHA1('" . $data[$this->tbFields['pass']] . "')";
                break;
            case 'md5' :
                $password = "MD5('" . $data[$this->tbFields['pass']] . "')";
                break;
            case 'nothing':
                $password = $data[$this->tbFields['pass']];
        }
        foreach ($data as $k => $v)
            $data[$k] = "'" . $this->escape($v) . "'";
        $data[$this->tbFields['pass']] = $password;
        $this->query("INSERT INTO `{$this->dbTable}` (`" . implode('`, `', array_keys($data)) . "`) VALUES (" . implode(", ", $data) . ")");
        return (int) mysql_insert_id($this->dbConn);
    }

    /*
     * Creates a random password. You can use it to create a password or a hash for user activation
     * param int $length
     * param string $chrs
     * return string
     */

    function randomPass($length=10, $chrs = '1234567890qwertyuiopasdfghjklzxcvbnm') {
        for ($i = 0; $i < $length; $i++) {
            $pwd .= $chrs{mt_rand(0, strlen($chrs) - 1)};
        }
        return $pwd;
    }

    ////////////////////////////////////////////
    // PRIVATE FUNCTIONS
    ////////////////////////////////////////////

    
    /**
     * A function that is used to load one user's data
     * @access private
     * @param string $userID
     * @return bool
     */
    function loadUser($userID) {
        $dbu=new db();
        $dbu->query("SELECT * FROM `{$this->dbTable}` WHERE `{$this->tbFields['userID']}` = '" . $this->escape($userID) . "' LIMIT 1");
        $res = $dbu->result;
        print_r($res);
        if (mysql_num_rows($res) == 0)
            return false;
        $this->userData = $res;
        $this->userID = $userID;
        $_SESSION[$this->sessionVariable] = $this->userID;
        $dbu->close();
        return true;
    }

    /**
     * Produces the result of addslashes() with more safety
     * @access private
     * @param string $str
     * @return string
     */
    function escape($str) {
        $ut = filter_var($str, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $ut=  mysql_real_escape_string($ut);
        return $ut;
    }

    /**
     * Error holder for the class
     * @access private
     * @param string $error
     * @param int $line
     * @param bool $die
     * @return bool
     */
    function error($error, $line = '', $die = false) {
        if ($this->displayErrors)
            echo '<b>Error: </b>' . $error . '<br /><b>Line: </b>' . ($line == '' ? 'Unknown' : $line) . '<br />';
        if ($die)
            exit;
        return false;
    }

}

?>