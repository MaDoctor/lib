<?
if (!isset($_SESSION['id']))
session_start();
include 'shablon.php';

if (isset($_POST['janr_name']))//запит на пошук жанру
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
        echo("<li id=".$d['id_book'].">
        <table width='750'>
        <tbody>
            <tr>
                <td width='60' rowspan='10'><img src='".$d['file_ob']."' style='width: 100px;'></td>
                <td width='250' height='10'><p>Название:".$d['book_name']."</p></td>
                <td width='100' height='10' class='button1'><a class='read' id='read'  onclick=read_book(".$d['id_book'].")  title=".'Читать'." >Чтение</a></td>
                <td width='800' height='10' > </td>
                <td width='10' height='10' ><input onclick=deletebook(".$d['id_book'].") title=".'Удалить'." type='submit' value='X'></td>
            </tr>
            <script>
                if(
                )
            </script>
            <tr><td><p>Автор: ".$d['name_author']."</p></td><td class='button1' height='10'><a href='".$d['file'].".zip' title=".'Скачать'.">Скачать</a></td></tr>
	        <tr><td><p>Колво. стр.: ".$d['col_str']."</p></td><td height='10' class='button1'><a id='discussion' onclick=discussion(".$d['id_book'].") title=".'Обсудить'." > Обсуждения</a></td></tr>
	        <tr><td><p>Жанр: ".$d['janr_name']."</p></td></tr>
	        <tr><td><p>Год: ".$d['date_books']."</p></td></tr>
	        <tr><td><p> </p></td></tr>

        </tbody>
        </table>
        <p style='font-size: 12pt; text-align: center;'> Краткое описание</p>
        <div class='p_div'><p class='about'>
        ".$d["book_info"]."
        </p>

        </div>

        </li>");

    echo("</ul>");
    echo"
    <script>

        function deletebook(v){
        book=v;
            $.ajax({
                type: 'POST',
                url:  'deletebook.php',
                data: 'id_book='+v,
                success: function(html)
                {
                    $('div.text2').append(html);
                }
            }); };

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
            }
        });
    }



</script>
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
            <div class="text2">
                <p align='center'>Приветствуем Вас на сайте электронной библиотеки GrandLibOd.ua</p>
                <p align="justify">На нашем сайте представлены книги для бесплатного скачивания в формате: txt.
                    Для удобства пользования библиотекой, имеется "читальный зал", Вы можете читать книги прямо на сайте, не загружая к себе на компьютер.
                    Для поиска интересующей литературы рекомендуем пользоваться поисковиком по сайту, расположенным в верхней левой части страницы.
                    Это самый простой и эффективный способ найти искомое: книгу, автора. Если же интересуют книги определенного жанра,
                    посетите эту страницу.
                    Если Вы точно не уверены что хотите почитать, воспользуйтесь навигацией по первой букве фамилии автора, названия книги, серии книг,
                    расположенной в верхней части страницы сайта.</p>
            </div>
        </div>
		<div class="rightwin" id="rightwin">
<?
    include "loginuser.php";
    ?>
        </div>
            </div>







	</div>
  </div>
  </div>
    <script>

        }</script>
</body>
    <?}



?>