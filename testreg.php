<?

	if (isset($_POST['login_enter'])) { $login_enter = $_POST['login_enter']; if ($login_enter == '') { unset($login_enter);} } //введенный пользователем e-login_enter заносится в переменную $login_enter
    if (isset($_POST['password_enter'])) { $password_enter=$_POST['password_enter']; if ($password_enter =='') { unset($password_enter);} }

//если пользователь не ввел e-login_enter или пароль, то выдаем ошибку и останавливаем скрипт
	if  (empty($login_enter) or empty($password_enter))
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }

//если e-login_enter и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали
    $login_enter = stripslashes($login_enter);
    $login_enter = htmlspecialchars($login_enter);
    $password_enter = stripslashes($password_enter);
    $password_enter = htmlspecialchars($password_enter);

//удаляем лишние пробелы
    $login_enter = trim($login_enter);
    $password_enter = trim($password_enter);

// подключаемся к базе
    include ("bd.php");

$result = mysql_query("SELECT * FROM user WHERE login='$login_enter'"); //извлечение из БД данных о пользователе с введенным логином
    $myrow = mysql_fetch_array($result);

//если существует, то сверяются пароли
    if ($myrow['password']== MD5($password_enter)) {

//если пароли совпадают, то запускается сессия!

    $_SESSION['login']=$login_enter;
    $_SESSION['id']=$myrow['id_user'];

       include_once"fn.php";
        $d=new fn();
        $d->user();
    }
 else {
     exit ("Введённый вами login или пароль неверный.".$_SESSION['login']." ".$password_enter.md5($password_enter));
    }
    ?>
	
