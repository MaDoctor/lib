<?
if (!isset($_SESSION['id']))
    session_start();
include 'shablon.php';

if (isset($_POST['janr_name']))//запрос на поиск жанра
{
    include('bd.php');
    $name=$_POST['janr_name'];
    $res=mysql_query("select * from janr where id_janr=".$name);
    $d=mysql_fetch_array($res);

    ?>



    <ul id="sortable">
    <?
    echo("<p align=center style='font-size:17pt;'>".'Жанр: '.$d['janr_name']."</p>");

    $res=mysql_query("select * from book natural join janr natural join janr_book natural join author natural join author_book where id_janr=".$name);
    while($d=mysql_fetch_array($res))
        echo("<li>
        <table>

          <tr><td rowspan='3'> <img src='".$d['file_ob']."' style='width: 100px;'></td><td colspan='2'><p>Название:".$d['book_name']."</p></td><td  class='button1'><button class='read' id='read'  onclick=read_book(".$d['id_book'].")  title=".$d['id_book']." >Читать</button></td></tr>
        <tr><td colspan='2'><p>Автор:".$d['name_author']."</p></td><td class='button1'><button href='".$d['file'].".zip' >Скачать</button></td></tr>
        <tr><td colspan='2'><p>Колво. стр.: ".$d['col_str']."</p></td><td><button id='discussion'  onclick=discussion(".$d['id_book'].")  title=".$d['id_book']." > Обсуждения</button></td></tr>
     </table>

        <div class='p_div'><p class='about'>
        ".$d["book_info"]."
        </p>

        </div>

        </li>");

    echo("</ul>");
    echo"
    <script>

    function save(v){/*
         $.ajax({
                type: 'POST',
                url:  'text.php',
                data: 'id='+v

            }); */}

        function read_book(v){
        book=v;
            $.ajax({
                type: 'POST',
                url:  'reading.php',
                data: 'id_book='+v,
                success: function(html)
                {
                    $('div.text2').empty();
                    $('div.text2').append(html);
                }
            }); };


    </script>";

    echo"
    <script>
        function discussion(v){
        book=v;
            $.ajax({
                type: 'POST',
                url:  'discussion.php',
                data: 'id_book='+v,
                success: function(html)
                {
                    $('div.text2').empty();
                    $('div.text2').append(html);
                }
            }); };


    </script>";

}
else{
//тело сайта
    ?>

    <DOCTYPE html>
<html>
<head>

    <script type="text/javascript" src="./jquery.js"></script>
    <script type="text/javascript" src="./jquery-1.2.6.min.js"></script>
    <script type="text/javascript" src="./jquery-ui.js"></script>


    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Our.css">

    <script>
        var book=0;
    </script>



    <style>
        div.main{
            background-color: gray;
            position: fixed;
            top:20px;
            left:300px;
            height: 700px;

            width:762px;

            border-radius: 10px;



            padding-left: 0px;

            -moz-transition: all .5s linear;
            -o-transition: all .5s linear;
            -webkit-transition: all .5s linear;

            border: 1px solid black;

        }

        ul.left{
            position: fixed;
            top:20px;
            left: 0px;
            width: 300px;
            height: 400px;

            list-style-type: none;
        }



    </style>
</head>
<body background="obo.png">
<script>


    function vivod_tuda(str,table_class){
        document.writeln("<table = "+table_class+"><tr>");
        for (i=0;i<str.length;i++){
            document.writeln('<td width=14 height=10><a  class="silkalf" onclick="'+table_class+'(\''+str.charAt(i)+'\')" >'+str.charAt(i)+"</a></td>");
            if (str.charAt(i+1)=="А")
                document.writeln("</tr><tr>");
        }	document.writeln("</tr></table>");
    }


    function avt(v){
        $.ajax({

            type: 'POST',
            url:  'searchauthor.php',
            data: {avt:v},
            success: function(html)
            {
                $('div.text2').empty();
                $('div.text2').append(html);
            }
        });
    }

    function nam(v){
        $.ajax({

            type: 'POST',
            url:  'searchbook.php',
            data: {book:v},
            success: function(html)
            {
                $('div.text2').empty();
                $('div.text2').append(html);
            }
        });
    }

    function sear(){

        $.ajax({

            type: 'POST',
            url:  'search.php',
            data: {search:document.querySelector('input[type="search"]:valid').value},
            success: function(html)
            {
                $('div.text2').empty();
                $('div.text2').append(html);
            }
        });
    }


    function download_ganr(v){
        $.ajax({
            type: 'POST',
            url:  'index.php',
            data: 'janr_name='+ v,
            success: function(html)
            {
                $('div.text2').empty();
                $('div.text2').append(html);
                // $('#messages').scrollTop(90000);
            }
        });
    }



</script>


<!--<ul class="left">

    <li><a onclick=download_ganr('GANR1')>GANR1</a></li>
    <li><a onclick=download_ganr('GANR2')>GANR2</a></li>
    <li><a onclick=download_ganr('GANR3')>GANR3</a></li>


</ul>

<div class="main">
    <h1>BALBLABLA SUPER BIBLIOTEKA HD!!!!</h1>
</div>-->

<div class="Ramka" >
    <div class="page" >

        <div class="box3" align=center>
            <a class="gl" href="index.php" >
                GrandLibOd.ua</a>
        </div>
        <div class="box4">
            <div class="leftwin">
                <div class="our_poisk">

                    <form id='search_all'>
                        <input class='poisk' type='search' name='search' placeholder='Поиск' id='ser'>
                        <input type='button' class='kn_poisk' type='submit' onclick='sear()' style='width: 75px;' value='Найти'/>
                    </form>

                </div>
                <script>
                    function go_download(){
                        $.ajax({
                            type: 'POST',
                            url:  'download.php',
                            success: function(html)
                            {
                                $('div.text2').empty();
                                $('div.text2').append(html);
                            }
                        });
                    }
                </script>
                <div class="ganri" align=left>
                    <p class="text">
                        <b>Жанры</b> </p>
                    <ul class="catalogueList">
                        <?php
                        include("bd.php");
                        $res= mysql_query("SELECT * FROM `janr` ");

                        while($d=mysql_fetch_array($res)){
                            echo "<li <a class='silk' onclick=download_ganr(".$d['id_janr'].") value='".$d['id_janr']."'>".$d['janr_name']."</a></li><br>";
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="alfav">
                <p class="avt"> ПО ФАМИЛИИ АВТОРА:
                    <script>
                        vivod_tuda("АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ",'avt');

                    </script>
                </p>

                <p class="avt"> ПО НАЗВАНИЮ КНИГИ:
                    <script>
                        vivod_tuda("АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ",'nam');
                    </script>
                </p>
            </div>
            <div class="rightwin">
                <form>
                    <?


                    echo'Добро пожаловать '.$_SESSION['login'].'!';

                    $reg= "<div id=Verh><input class='vvod' type='text' name='login' size='20' maxlength='32' placeholder='Логин' onblur=\"if(this.value=='')this.placeholder='Логин'\"> <br><br>
				<input class='vvod' type='password' name='password' size='20' maxlength='32' placeholder='Пароль' onblur=\"if(this.value=='')this.placeholder='Пароль'\"><br><br>
				</div><div id='status' ></div>
                    <script>
                    function hideDiv(){
                        $('status').delay(3000).fadeOut();
                        }
                    </script>
                    <div id=Verh>
				<input class='kn_poisk' type='button' onclick=reg() name='enter' value='Вход'>

				<div class='reg'> <a class='reg' href='book_reg.html'>Регистрация</a></div>
				<script>
     function reg(){
     $.ajax({
         type: 'POST',
         url:  'login.php',
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
             /*$('#status').animate({
                    height: '0px'
                       }, 3000);*/
             $('#status').slideUp( 800 ).delay( 800 ).fadeIn( 1600 );

         }
     });
     }

</script>
				";

                    $ajax_str;

                    if (!isset($_SESSION['id'])) $ajax_str=$reg; else $ajax_str=$usr;
                    echo $ajax_str;

                    ?>



                </form>
                <a class="silk" href="exit.php"> <p>Настройки</p> </a>
                <a class="silk" onclick=go_download()> <p>Загрузка(Админ)</p> </a>
                <input class='kn_poisk' type='button' href="exit.php"> <p>Exit</p>
                <input class='kn_poisk' type='button' onclick=reg() value='Exit'>
            </div>
        </div>




        <div class="text2">
            <p align='center'>Приветствуем Вас на сайте электронной библиотеки GrandLibOd.ua</p>
            <p align="justify">На нашем сайте представлены книги для бесплатного скачивания в 5 электронных форматах: doc, rtf, fb2, html, txt.
                Для удобства пользования библиотекой, имеется "читальный зал", Вы можете читать книги прямо на сайте, не загружая к себе на компьютер.
                Присутствует функция закладки. Страницу, на которой Вы прерываете чтение, можете сохранить и при следующем посещении сайта
                продолжить чтение, не теряя времени на её поиск. Все сохраненные книги будут отображаться в блоке "Ваши закладки",
                который появится в левой части сайта.
                Для поиска интересующей литературы рекомендуем пользоваться поисковиком по сайту, расположенным в верхней левой части страницы.
                Это самый простой и эффективный способ найти искомое: книгу, автора, серию книг. Если же интересуют книги определенного жанра,
                посетите эту страницу.
                Если Вы точно не уверены что хотите почитать, воспользуйтесь навигацией по первой букве фамилии автора, названия книги, серии книг,
                расположенной в верхней части каждой страницы сайта, либо посмотрите отзывы о книгах, опубликованные читателями библиотеки, возможно,
                вы найдете для себя что-то интересное.</p>
        </div>


    </div>
</div>
</div>
<script>

    }</script>
</body>
<?}



?>