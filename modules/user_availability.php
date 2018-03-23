<?php
$muser=new db();
$qz="select `login` from users";
$userlist=$muser->get_result($qz);
foreach ($userlist as $row){
    $uus[]=$row->login;
};
//print_r($uus);

$user_name=$_POST['login'];
if (in_array($user_name, $uus))
{	//user name is not availble
	echo "0";
} 
else
{	//user name is available
	echo "1";
}
?>