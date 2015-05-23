<?php

$uploaddirob = './book/';
$uploadfileob = $uploaddirob.array_pop(explode(".", $_FILES['uploadfileob']['name'])).'/'.basename($_FILES['uploadfileob']['name']);

if (move_uploaded_file($_FILES['uploadfileob']['tmp_name'], $uploadfileob))
{
    echo "successob";
}
else { echo "error"; exit; }
?>