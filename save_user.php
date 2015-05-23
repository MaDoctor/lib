<?php
	require 'bd.php';
    if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //������� ��������� ������������� ����� � ���������� $login, ���� �� ������, �� ���������� ����������
    $login = iconv("utf-8","windows-1251",$login);
	
	if (isset($_POST['name'])) { $name = $_POST['name']; if ($name == '') { unset($name);} }
	$name = iconv("utf-8","windows-1251",$name);
	
	if (isset($_POST['surename'])) { $surename = $_POST['surename']; if ($surename == '') { unset($surename);} }
	$surename = iconv("utf-8","windows-1251",$surename);
	
	if (isset($_POST['email'])) { $email=$_POST['email']; if ($email =='') { unset($email);} }
	$email = iconv("utf-8","windows-1251",$email);
	
	if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} } //������� ��������� ������������� ������ � ���������� $password, ���� �� ������, �� ���������� ����������
	if (isset($_POST['repassword'])) { $repassword=$_POST['repassword']; if ($repassword =='') { unset($repassword);} }
	
//���� ������������ �� ���� �����, ������, e-mail ��� ����� �������� �� ������ ������ � ������������� ������
//���� �����, ������, e-mail ��� ����� �������� �������,�� ������������ ��, ����� ���� � ������� �� ��������, ���� �� ��� ���� ����� ������
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
	$name = stripslashes($name);
	$name = htmlspecialchars($name);
	$surename = stripslashes($surename);
	$surename = htmlspecialchars($surename);
	$email = stripslashes($email);
    $email = htmlspecialchars($email);
	$password = stripslashes($password);
    $password = htmlspecialchars($password);
	$repassword = stripslashes($repassword);
    $repassword = htmlspecialchars($repassword);	
 
//������� ������ �������
    $login = trim($login);
	$name = trim($name);
	$surename = trim($surename);
	$email = trim($email);
    $password = trim($password);
	$repassword = trim($repassword);
	
//���� ������������ ��� ������ �������� � ���� "������" "�������� ������", �� ������ ������ � ������������� ������
	if ($password == $repassword)
	{$password = md5($password);}
	else{
    die("������ ������ ���������!(Passwords must match!)");
    }
	
// ������������ � ����
    include ("bd.php");// ���� bd.php ������ ���� � ��� �� �����, ��� � ��� ���������, ���� ��� �� ���, �� ������ �������� ����
// �������� �� ������������� ������������ � ����� �� �������
    $result = mysql_query("SELECT id FROM users WHERE login='$login'",$db);
    if (!empty($myrow['id'])) {
    exit ("��������, �������� ���� ����� ��� ���������������. ������� ������ �����.");
    }
// ���� ������ ���, �� ��������� ������
    $result2 = mysql_query ("INSERT INTO users (login,password,repassword,mail,number) VALUES('$login','$password','$repassword','$mail','$number')");
// ���������, ���� �� ������
    if ($result2=='TRUE')
    {
	 $query = mysql_query("INSERT INTO user VALUES('','$login','$name','$surename','$email','$password')");
    }
 else {
    die("Вы не зарегестрированы! Произошла ошибка");
    }
    ?>