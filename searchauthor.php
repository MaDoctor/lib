<?php
 /*   include('bd.php');
echo'
<ul id="sortable">';

$avt = $_POST['avt'];


include('bd.php');
$res=mysql_query("select * from author where name_author like '% $avt%'");
echo("<p align=center style='font-size:17pt;'>".'Все авторы на букву: '.$avt."</p>");
while ($d=mysql_fetch_array($res))
    echo("
        <li>
        <table>
        <tr><td><p class='silk' onclik='fbook()' style='font-size:18pt; cursor: hand;'>".$d['name_author']."</p></td></tr>
        </table>
        </li>");
echo"<script>
    function fbook()
    {
        $.ajax({

            type: 'POST',
            url:  'searchbook.php',
            data: {book},
            success: function(html)
            {
                $('div.text2').empty();
                $('div.text2').append(html);
            }
        });
    }"*/

include('bd.php');
echo'
<ul id="sortable">';

$book = $_POST['book'];

include('bd.php');
$res=mysql_query("select * from book natural join author natural join author_book where name_author like '%$avt%' and id_author=id_book");
echo("<p align=center style='font-size:17pt;'>".'Авторы на букву: '.$book."</p>");
while($d=mysql_fetch_array($res))
    echo("<li>
        <table width='750'>
        <tbody>
            <tr>
                <td width='60' rowspan='10'><img src='".$d['file_ob']."' style='width: 100px;'></td>
                <td width='250' height='10'><p>Название:".$d['book_name']."</p></td>
                <td width='100' height='10' class='button1'><a class='read' id='read'  onclick=read_book(".$d['id_book'].")  title=".$d['id_book']." >Читать</a></td>
                <td width='600' height='10' > </td>
                <td width='10' height='10' ><input onclick=changebook(".$d['id_book'].") title=".'Редактировать'." type='submit' value='Редактирование'></td>
                <td width='10' height='10' ><input onclick=deletebook(".$d['id_book'].") title=".'Удалить'." type='submit' value='X'></td>
            </tr>
            <tr><td><p>Автор:".$d['name_author']."</p></td><td class='button1' height='10'><a href='".$d['file'].".zip' >Скачать</a></td></tr>
	        <tr><td><p>Колво. стр.: ".$d['col_str']."</p></td><td height='10' class='button1'><a id='discussion' onclick=discussion(".$d['id_book'].") title=".$d['id_book']." > Обсуждения</a></td></tr>
	        <tr><td><p>Жанр: ".$d['janr_name']."</p></td></tr>
	        <tr><td><p>Год: </p></td></tr>
	        <tr><td><p> </p></td></tr>

        </tbody>
        </table>

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
                    $('div.text2').empty();
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

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="Our.css">
</head>
</html>

