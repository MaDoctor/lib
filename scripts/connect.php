<?php
    $db = mysql_connect ("localhost","root","")
	or die("<p>������ ����������� � ���� ������! " . mysql_error() . "</p>");
    mysql_select_db ("library",$db)
	or die("<p>������ ������ ���� ������! ". mysql_error() . "</p>");
?>