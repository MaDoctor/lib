<?php
    if(isset($_POST['enter'])){
	require 'bd.php'; 
        $login=($_POST['login_enter']);
        $password=md5($_POST['password_enter']);
        $query=mysql_query("Select * from user");
        if($login = $login_enter && $password == $password_enter){
            echo'good!';
        }
        else{
            echo'bad!';
    }
}
    ?>
	
