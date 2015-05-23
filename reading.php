<DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="./jquery.js"></script>
    <script type="text/javascript" src="./jquery-1.2.6.min.js"></script>
    <script type="text/javascript" src="./jquery-ui.js"></script>
    <script type="text/javascript" src="./ajax.js"></script>
    <script type="text/javascript" src="./jquery-1.7.2.min.js"></script>

    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Our.css">

    <script>

        function str(i){
            el=$("select#bottom_panel").obj;
            x+=i;
            $.ajax({
                type: 'POST',
                url:  'reading.php',
                data: "str="+x+"&id_book="+book,
                success: function(html)
                {
                    $('div.text2').empty();
                    $('div.text2').append(html);
                }
            });
        }


        function select_str(el){
            $.ajax({
                type: 'POST',
                url:  'reading.php',
                data: "str="+el.options[el.selectedIndex].value+"&id_book="+book,
                success: function(html)
                {
                    $('div.text2').empty();
                    $('div.text2').append(html);
                }
            });
        }
    </script>

    <style>

        body#text{

            color: #000000;
        }
        div.book{
            height: 900px;

            background-color: rgba(255, 255, 255, 0.30);

            border-radius: 10px;
            padding: 10px;
            padding-right: 10px;

            border: 1px solid transparent;


            overflow: auto;

            word-wrap: break-word;

            -moz-transition: all .2s linear;
            -o-transition: all .2s linear;
            -webkit-transition: all .2s linear;
            -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
            box-shadow: 0 0 50px transparent, inset 0 0 10px rgb(0, 0, 0);

            /* box-shadow: 0 0 50px rgba(255,255,255), inset 0 0 10px rgb(0, 0, 0);*/


        }
        div.book2{
            height: 900px;

            background-color: rgba(255, 255, 255, 0.30);

            border-radius: 10px;
            padding: 10px;
            padding-right: 10px;

            border: 1px solid transparent;


            overflow: auto;

            word-wrap: break-word;

            -moz-transition: all .2s linear;
            -o-transition: all .2s linear;
            -webkit-transition: all .2s linear;
            -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
            box-shadow: 0 0 50px transparent, inset 0 0 10px rgb(0, 0, 0);

            /* box-shadow: 0 0 50px rgba(255,255,255), inset 0 0 10px rgb(0, 0, 0);*/


        }




        div.main{

        }


    </style>
<body id="text">

<div class="book2">
    <?
    //Вывод текста
    include('bd.php');
    $res=mysql_query("select * from book where id_book=".$_POST['id_book']);
    $d=mysql_fetch_array($res);
    $file_array = file($d['file']);

    $kol_str_min=30;

    $str_text_str=0;

    if ( isset($_POST['str']))

        $str_text_str=$_POST['str'];


    for($i =  $str_text_str*$kol_str_min;$i< $str_text_str*$kol_str_min+$kol_str_min;$i++)
    {
        mb_detect_order("cp1251, UTF-8"); //устанавливаем список кодировок
        $enc=mb_detect_encoding($file_array[$i]); //узнаем кодировку
        $file_array[$i]=iconv($enc, "UTF-8", $file_array[$i]); //перегоняем из cp в utf

        echo($file_array[$i]."<br>");
    }
    $kol_str = count($file_array)/$kol_str_min;


    ?>
</div>
<style>
    #bottom_panel{

        width: 100px;
        height:40px;

        background-color: transparent;

        -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
        -moz-box-shadow: 0 0 400px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
        box-shadow: 0 0 50px transparent, inset 0 0 5px rgb(0, 0, 0);


        -webkit-appearance: menulist;
        box-sizing: border-box;
        align-items: center;
        border: 1px solid transparent;
        border-image-source: initial;
        border-image-slice: initial;
        border-image-width: initial;
        border-image-outset: initial;
        border-image-repeat: initial;
        white-space: pre;
        -webkit-rtl-ordering: logical;
        color: black;
        background-color: transparent;
        cursor: default;

        text-overflow: ellipsis;
        white-space: nowrap;
    }



    #bottom_panel option{

        text-decoration: none;

        display: block;

        background-color: transparent;

        -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
        -moz-box-shadow: 0 0 400px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
        box-shadow: 0 0 50px transparent, inset 0 0 5px rgb(0, 0, 0);

        border:1px solid #000000;



        position:absolute;
        height:100%;
        width:100%;
        font:13px/34px "Lucida Sans Unicode", "Lucida Grande", sans-serif;
        text-align:center;
        text-shadow:1px 1px 0 #EEEEEE;
        color:#666666;
        background: transparent;
        background-position:0 -136px, right -204px, 50% -68px, 0 0;
        background-repeat: no-repeat, no-repeat, no-repeat, repeat-x;
        cursor:pointer;
        -moz-border-radius:3px;
        -webkit-border-radius:3px;
        border-radius:3px;

    }


    #idX{

        width: 100px;
        height:40px;

        background-color: transparent;
        border: 1px solid transparent;

        -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
        -moz-box-shadow: 0 0 400px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
        box-shadow: 0 0 50px transparent, inset 0 0 5px rgb(0, 0, 0);
    }

    #str_box{
        text-align: center;
        width: 100%;
    }


</style>


<?
echo '
    <div id="str_box">
    <button onclick="str(-1)" id="idX"><--</button>
            <select id="bottom_panel" onchange="select_str(this)" >
    ';
for($i=0;$i<$kol_str;$i++)
    if ($i!=$str_text_str)
        echo("<option value=".$i.">".($i+1)."</option>");
    else  echo("<option value=".$i." selected>".($i+1)."</option><script>x=".$i."</script>");

echo'</select>
    <button onclick="str(1)" id="idX">--></button></div>';
?>


</body>

