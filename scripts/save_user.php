<?php
	require 'connect.php'; 
    if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    $login = iconv("utf-8","windows-1251",$login);
	
	if (isset($_POST['name'])) { $name = $_POST['name']; if ($name == '') { unset($name);} }
	$name = iconv("utf-8","windows-1251",$name);
	
	if (isset($_POST['surename'])) { $surename = $_POST['surename']; if ($surename == '') { unset($surename);} }
	$surename = iconv("utf-8","windows-1251",$surename);
	
	if (isset($_POST['email'])) { $email=$_POST['email']; if ($email =='') { unset($email);} }
	$email = iconv("utf-8","windows-1251",$email);
	
	if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} } //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
	if (isset($_POST['repassword'])) { $repassword=$_POST['repassword']; if ($repassword =='') { unset($repassword);} }
	
//если пользователь не ввел логин, пароль, e-mail или номер телефона то выдаем ошибку и останавливаем скрипт
//если логин, пароль, e-mail или номер телефона введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
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
 
//удаляем лишние пробелы
    $login = trim($login);
	$name = trim($name);
	$surename = trim($surename);
	$email = trim($email);
    $password = trim($password);
	$repassword = trim($repassword);
	
//если пользователь ввёл разные значение в поля "пароль" "проверка пароля", то выдаем ошибку и останавливаем скрипт
	if ($password == $repassword)
	{$password = md5($password);}
	else{
    die("Пароли должны совпадать!(Passwords must match!)");
    }
	
// подключаемся к базе
    include ("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь
// проверка на существование пользователя с таким же логином
    $result = mysql_query("SELECT id FROM users WHERE login='$login'",$db);
    $myrow = mysql_fetch_array($result);
    if (!empty($myrow['id'])) {
    exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
    }
// если такого нет, то сохраняем данные
    $result2 = mysql_query ("INSERT INTO users (login,password,repassword,mail,number) VALUES('$login','$password','$repassword','$mail','$number')");
// Проверяем, есть ли ошибки
    if ($result2=='TRUE')
    {
	$("#success").text("Вы ввели все необходимые данные!").addClass("success").show().delay(3000).fadeOut(300);
	$query = mysql_query("INSERT INTO user VALUES('','$login','$name','$surename','$email','$password')");
    }
 else {
    die("Ошибка! Вы не зарегистрированы.");
    }
    ?>