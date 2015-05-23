<?php
    include('bd.php');

    $id = $_POST['id_book'];
    $avt = $_POST['avt'];

    $res = mysql_query("select * from book where id_book = $id");
    $res=mysql_query("select * from author where name_author like '% $avt%'");
    $d= mysql_fetch_array($res);
    unlink($d['file']);
    unlink($d['file'].".zip");

    unlink($d['file_ob']);


    mysql_query("Delete from book where id_book=$id;");
    mysql_query("Delete from author where name_author like '%$avt%'");
    echo"<script> exit = document.getElementById('$id');
                exit.parentNode.removeChild(exit);</script>";
    echo'<script>alert("Книга удалена!")</script>';

?>