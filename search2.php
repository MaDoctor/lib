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
    echo("<p align=center style='font-size:17pt;'>".'Жанр: '.$d['janr_name']."</p>");
    ?>



    <ul id="sortable">
    <?

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
                url:  'DEMO2.0.php',
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
                    <form name='F2'>
                        <?
                        include('bd.php');
                        echo("
                    <table>
					<td>
					<form action='http://localhost/reaper/search2.php' method='POST'>
                    <tr><input class='poisk' type='search' name='query' placeholder='Поиск'>
                    <input type='submit' name='send' value='Найти'></tr>
                    <select name='category' id='category' onchange = 'window.location=document.forms[0].mymenu.options[document.forms[0].mymenu.selectedIndex].value' >
                         <option value='' selected>Во всех категориях</option>
                         <option value='Авторы'>Авторы</option>
                         <option value='Книги'>Книги</option>
                    </select>
                    </form>
					</td>
			    </table>
            </div>
            ");
                        ?>
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


                        $usr='Добро пожаловать '.$_SESSION['login'].'!';

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
                    <a class="silk" onclick=go_download()> <p>Загрузка(Админ)</p> </a>
                    <a class="silk" href="exit.php"> <p>Exit</p> </a>
                </div>
            </div>

            <html>


            <!-------------------------------------- Поиск --------------------------------------->

            <td colspan="2" bgcolor="#00CED1">
                <form action="search.php" method="POST">
                    Поиск: <input name="search" size="60">

                    <select name="category" id="category" onchange = "window.location=document.forms[0].mymenu.options[document.forms[0].mymenu.selectedIndex].value" >
                        <option value="" selected>Во всех категориях</option>
                        <option value="Авторы">Авторы</option>
                        <option value="Книги">Книги</option>
                    </select>

                    <input type="submit" name="send" value="Найти">
                </form>


            </td>
            </tr>

            <!-------------------------------------- Вывод -------------------------------------->

            <tr>
                <td colspan="3" height='150'>

                    <div >
                        <p align="center">Сортировка: <select id="mymenu" onchange = "document.location=this.options[this.selectedIndex].value" >
                                <option value="all.php">По дате добавления</option>
                                <option value="all1.php">По алфавиту</option>
                            </select></p>
                        <hr>
                        <div class="advert2">

                            <?php
                            if (isset($_POST['search'])) { $search = $_POST['search']; if ($search == '') { unset($search);} }
                            if (isset($_POST['category'])) { $category = $_POST['category']; if ($category == '') { unset($category);} }
                            if (isset($_POST['subcategory'])) { $subcategory = $_POST['subcategory']; if ($subcategory == '') { unset($subcategory);} }
                            //	if (isset($_POST['v_nazv'])) { $v_nazv = $_POST['v_nazv']; if ($v_nazv == '') { unset($v_nazv);} }
                            //если пользователь не ввел логин, пароль, e-mail или номер телефона то выдаем ошибку и останавливаем скрипт
                            if (empty($search))
                            {
                                exit ("<center><b>Строка поиска пуста!</b></center>");
                            }

                            // подключение к БД
                            include ("bd.php");
                            // сохранение данных

                            // if(isset($_POST['nazv']) && $_POST['nazv'] == 'yes') {
                            if ($category=="") {
                                $search_query = "select * from author natural join book natural join author_book where name_author like '%".strtoupper($search)."%' or book_name like '%".strtoupper($search)."%'";
                                $query = mysql_query($search_query);
                            }
                            if ($category=="Авторы") {
                                $search_query = "select * from author natural join book natural join author_book where name_author like '%".strtoupper($search)."%'";
                                $query = mysql_query($search_query);
                            }echo('<br>');
                            if ($category=="Книги") {
                                $search_query = "select * from author natural join book natural join author_book where book_name like '%".strtoupper($search)."%'";
                                $query = mysql_query($search_query);
                            }
                            while ($myrow = mysql_fetch_array($query)){

                                echo("<li>
        <table>

       <tr><td rowspan='3'> <img src='book.png'></td><td colspan='2'><p>Название:".$myrow['book_name']."</p></td><td  class='button'><button class='read' id='read'  onclick=read_book(".$myrow['id_book'].")  title=".$myrow['id_book']." >Читать</button></td></tr>
        <tr><td colspan='2'><p>Автор:".$myrow['name_author']."</p></td><td class='button'><a href='".$myrow['file']."' rel='nofollow'>Скачать</a></td></tr>
        <tr><td colspan='2'><p>Колво. стр.: ".$myrow['col_str']."</p></td><td><button id='discussion'  onclick=discussion(".$myrow['id_book'].")  title=".$myrow['id_book']." > Обсуждения</button></td></tr>
          </table>

        <div class='p_div'><p class='about'>
        ".$myrow["book_info"]."
        </p>

        </div>

        </li>");

                                echo("</ul>");
                                echo"
    <script>
        function read_book(v){
        book=v;
            $.ajax({
                type: 'POST',
                url:  'DEMO2.0.php',
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
                            if(!$query)
                            {
                                echo "<p class='text'>Поиск не осуществлен. Код ошибки:</p>";
                                echo exit(mysql_error());
                            }


                            if (mysql_num_rows($query) > 0)
                            {

                                $myrow = mysql_fetch_array($query);
                            } else echo "<p>Ничего не найдено.";
                            ?>
                        </div>
                    </div>

                </td>
            </tr>

            <tr><td height='2200'></td></tr>

            </table>
            </html>

            <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery("#subcategory").chained("#category");
                });
            </script>
        </div>
    </div>
</div>
<script>

    }</script>
</body>
<?}



?>