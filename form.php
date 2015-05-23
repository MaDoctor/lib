<?php
// Страница регситрации нового пользователя
# Соединямся с БД
mysql_connect("localhost", "root", "");

mysql_select_db("library");

{

    $err = array();
//--------------------------------------------------------------------------------------------------------------
    # проверяем логин

    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[]='Логин может состоять только из букв <u><b>английского алфавита и цифр</b></u>';
    }

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше <u><b>3-х</b></u> символов и не больше <u><b>30</b></u>";
    }

    if (isset($_POST['login']))
    {
        $login = $_POST['login']; if ($login == '')
        {$err[] = "Вы не заполнили форму <u><b>Логин</b></u>";}
    }
//---------------------------------------------------------------------------------------------------------------
    # проверяем пароль

    if(!preg_match("/^[a-zA-Zа-яА-Я0-9]+$/",$_POST['password']))
    {
        $err[]="Пароль может состоять только из букв <u><b>английского, русского алфавита и цифр</b></u>";
    }

    if(strlen($_POST['password']) < 5 or strlen($_POST['password']) > 50)
    {
        $err[] = "Пароль должен быть не меньше <u><b>5-ти</b></u> символов и не больше <u><b>50</b></u>";
    }

    if (isset($_POST['password']))
    {
        $password = $_POST['password']; if ($password == '')
        {$err[] = "Вы не заполнили форму <u><b>Пароль</b></u>";}
    }

    if (isset($_POST['password2']))
    {
        $password2 = $_POST['password2']; if ($password2 == '')
        {$err[] = "Вы не заполнили форму <u><b>Поврор пароля</b></u>";}
    }

    if (isset($_POST['password'])&& isset($_POST['password2']))
    {
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        if ($password!==$password2)
        {$err[] = "Пароли не совпадают!";}
    }
//---------------------------------------------------------------------------------------------------------------
    # проверяем E-mail
    if(!preg_match("/^[^@]+@([a-z\-]+\.)+[a-z]{2,4}+$/",$_POST['email']))
    {
        $err[] = "Введите корректный формат электронной почты!";
    }

    if (isset($_POST['email']))
    {
        $email = $_POST['email']; if ($email == '')
        {$err[]="Вы не заполнили форму электронной почты";}
    }
//---------------------------------------------------------------------------------------------------------------
    # проверяем, не сущестует ли пользователя с таким Логином

    $query = mysql_query("SELECT COUNT(id_user) FROM user WHERE login='".mysql_real_escape_string($_POST['login'])."'");

    if(mysql_result($query, 0) > 0)

    {
        $err[] = "Пользователь с таким Логином уже существует в базе данных";
    }
//---------------------------------------------------------------------------------------------------------------
    # проверяем, не сущестует ли пользователя с таким E-mail

    $query = mysql_query("SELECT COUNT(id_user) FROM user WHERE mail='".mysql_real_escape_string($_POST['email'])."'");

    if(mysql_result($query, 0) > 0)

    {
        $err[] = "Пользователь с таким E-mail уже существует в базе данных";
    }
//---------------------------------------------------------------------------------------------------------------
    # Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {
        $login = $_POST['login'];
        $name = $_POST['name'];
        $surename = $_POST['surename'];
        $email = $_POST['email'];
        $law = $_POST['law'];
        $law==0;
        # Убераем лишние пробелы и делаем двойное шифрование

        $password = trim($_POST['password']);
        $password2 = trim($_POST['password2']);
        if ($password!==$password2)
        {
            $err[] = "Пароли не совпадают!";
        }
//----------------------------------------------------------------------------------------------------------------
        else
        {
            mysql_query("INSERT INTO user VALUES('','$name','$surename','$password','$email','$login', '$law')");

            echo "<script>alert('Вы успешно зарегистрировались!');document.href.refresh('index.php')</script>";
            //header("Location: index.php");
        }
    }
    else
    {
        echo "<b>При регистрации произошли следующие ошибки:</b><br>";

        foreach($err AS $error)
        {
            echo $error."<br>";
        }
     }
}

?>
