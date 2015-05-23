<?

// Страница авторизации

# Соединямся с БД
session_start();
class log_analiz{

    function form(){

               echo"<form><div id=Verh><input class='vvod' type='text' name='login_enter' size='20' maxlength='32' placeholder='Логин' onblur=\"if(this.value=='')this.placeholder='Логин'\"> <br><br>
				<input class='vvod' type='password' name='password_enter' size='20' maxlength='32' placeholder='Пароль' onblur=\"if(this.value=='')this.placeholder='Пароль'\"><br><br>
				</div><div id='status' ></div>




                    <script>
                    flag = '';
                    function hideDiv(){
                        $('status').delay(3000).fadeOut();
                        }
                    </script>
                    <div id=Verh>
				<input class='kn_poisk' type='button' onclick=reg() name='enter' value='Вход'>
                <!--<a class='silk' onclick=go_download()> <p>Загрузка(Админ)</p> </a> -->
				<div class='reg'> <a class='reg' href='book_reg.html'>Регистрация</a></div>
				<script>

     function reg(){
     $.ajax({
         type: 'POST',
         url:  'loginuser.php',
         data: {login_enter:$('input[name=login_enter]').val(),
         password_enter:$('input[name=password_enter]').val()},
         success: function(html)
         {
             $('#status').css('display','block');
             $('#status').empty();
             $('#status').animate({
                    top: '0'
                       }, 3000);

             $('#status').append(html);

                   infa(html);
             /*$('#status').animate({
                    height: '0px'
                       }, 3000);*/


             $('#status').slideUp( 100 ).delay( 100 ).fadeIn( 100 );





     }});




     }




 function infa(html){
if (html==='ok'){
                     $.ajax({
                        type: 'POST',
                        url:  'loginuser.php',
                         success: function(html){
                         $('#rightwin').empty();
                            $('#rightwin').append(html);
                         }

                    });


         }}



</script>
				</form>";
    }

function log(){
include 'bd.php';

    $login=trim($_POST['login_enter']);
    $login=ucwords(strtolower($login));
    $password=trim($_POST['password_enter']);

    $query = mysql_query("SELECT id_user, password FROM user WHERE trim(login) like '$login'");

   if (!$query) {echo "неверный запрос"; }
    $data = mysql_fetch_array($query);


    # Сравниваем пароли

    if(trim($data['password']) == $password)
    {
        session_start();
        $_SESSION['id']=$data['id_user'];
        $_SESSION['login']=$login;
        echo"ok";
    }

    else {echo'Вы ввели неправильный логин/пароль';}

    function avt(){

        $login = $_SESSION['login'];
        echo "<form><div id=Verh> Вы вошли как $login
        <br>
        <a class='silk' onclick=go_download()> <p>Загрузка книги</p> </a>
        <a class='button1' href='exit.php' style='text-decoration: none;'><b>EXIT</b></a></div></form>";
    }

    function log_analiz(){

        if (isset($_POST['login_enter']))$this->log();
        else if(isset($_SESSION['login']))$this->avt();
            else $this->form();


    }
}

new log_analiz();
  ?>
