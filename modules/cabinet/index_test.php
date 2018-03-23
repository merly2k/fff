<?php 
ini_set("display_errors", 1);
error_reporting(99999);
$uid=$this->_DATA['id'];
echo "user-".$uid;

print_r(GetUserStastus($uid));

?>
