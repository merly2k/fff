<?php 
header('Content-Type: text/html; charset=utf-8');

$result = mail('yourmail@domain.ru', 'subject', 'message');

if($result)
{
	echo '��� �����';
}
else
{
	echo '���-�� �� ���';
}
?>