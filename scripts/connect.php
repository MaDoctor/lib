<?php
    $db = mysql_connect ("localhost","root","")
	or die("<p>Ошибка подключения к базе данных! " . mysql_error() . "</p>");
    mysql_select_db ("library",$db)
	or die("<p>Ошибка выбора базы данных! ". mysql_error() . "</p>");
?>