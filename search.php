<?php

class search {

function  search(){
    if (isset($_POST['find']))
        $this->find();
    else $this->start();
}

    function  start(){
echo '


    <!-------------------------------------- Поиск --------------------------------------->
<link rel="stylesheet" type="text/css" href="Our.css">

    <td colspan="2" bgcolor="#00CED1">
        <form id="find">
            Поиск: <input name="search" size="60">

            <select name="category" id="category" onchange = "window.location=document.forms[0].mymenu.options[document.forms[0].mymenu.selectedIndex].value" >
                <option value="" selected>Во всех категориях</option>
                <option value="Авторы">Авторы</option>
                <option value="Книги">Книги</option>
            </select>

            <input type="button" name="send" value="Найти" onclick = find()>
        </form>


    </td>
</tr>

<!-------------------------------------- Вывод -------------------------------------->

<tr>
    <td colspan="3" height="150">

        <div id="find_rez" >
            <hr> <div class="advert2">';
                $this->find();
            echo'
            </div>
        </div>

    </td>
</tr>

<tr><td height="2200"></td></tr>

</table>
</html>


<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#subcategory").chained("#category");
    });
</script>';

    }


    function find(){

                if (isset($_POST['search'])) { $search = $_POST['search']; if ($search == '') { unset($search);} }
                if (isset($_POST['category'])) { $category = $_POST['category']; if ($category == '') { unset($category);} }
                if (empty($search))
                {
                    exit ("<center><b>Строка поиска пуста!</b></center>");
                }

                // подключение к БД
                include ("bd.php");
        echo'<ul id="sortable">';

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

                while ($d = mysql_fetch_array($query)){

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



      function find()   {

                        $.ajax({

            type: 'POST',
            url:  'search.php',
            data: 'find=ok&'+$('#find').serialize(),
            success: function(html)
            {
                $('.advert2').empty();
                $('.advert2').append(html);
            }
        });
    }
    </script>";

                }
                if(!$query)
                {
                    echo "<p class='text'>Поиск не осуществлен. Код ошибки:</p>";
                    echo exit(mysql_error());
                }


                if (mysql_num_rows($query) > 0)
                {

                    $d = mysql_fetch_array($query);
                } else echo "<p>Ничего не найдено.";

    }


}

new search();
?>