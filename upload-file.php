<?php
$uploaddir = 'book/';
$uploadfile = $uploaddir.array_pop(explode(".", $_FILES['uploadfile']['name'])).'/'.basename($_FILES['uploadfile']['name']);

if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile))
{
    echo "success";
    chmod($uploadfile,0777);
}
else { echo "error"; exit; }

if (isset($_POST['uploadfile']))
{
    $login = $_POST['uploadfile'];
    if ($uploadfile == '')
        {$err[] = "Вы не заполнили форму <u><b>Файл</b></u>";}
}

?>