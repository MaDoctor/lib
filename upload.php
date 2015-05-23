<?
function download_doc(){


    include("bd.php");

    $uploadfile = $_POST['uploadfile'];

    $uploadfileob = $_POST['uploadfileob'];

    $file_array = file($uploadfile);

    $kol_str_min=30;

    $kol_str = count($file_array)/$kol_str_min;

    $date_books= $_POST['date_books'];


    $sql = mysql_query("INSERT INTO `book`(`book_name`, `date_books`, `book_info`, `file`,`file_ob`, `col_str`) VALUES ('".$_POST['book_name']."', '$date_books', '".$_POST['book_info']."', '$uploadfile', '$uploadfileob', '$kol_str')");


    $res =  mysql_query("SELECT * FROM `book` WHERE `book_name` like '%".$_POST['book_name']."%'
    AND `book_info` like '%".$_POST['book_info']."%'");

    $d=mysql_fetch_array($res);
    foreach($_POST['janr'] as $d2)
        $sql=mysql_query("INSERT INTO `janr_book`(`id_janr`, `id_book`) VALUES (".$d2.",".$d['id_book'].")");

    $sql = mysql_query("INSERT INTO `author`(`name_author`) VALUES ('".$_POST['name_author']."')");

    $res1 =  mysql_query("SELECT * FROM `author` WHERE `name_author` like '%".$_POST['name_author']."%'");

    $d1=mysql_fetch_array($res1);
        $sql=mysql_query("INSERT INTO `author_book`(`id_author`, `id_book`) VALUES (".$d1['id_author'].",".$d['id_book'].")");

    $file_name= array_pop(explode("/", $uploadfile));

    


    $zip = new ZipArchive();

    $fileName =  $uploadfile.".zip";
    $zip->open($fileName, ZIPARCHIVE::CREATE);

    $zip->addFile($uploadfile, $file_name);

    $zip->close();


    /*
        $zip = new ZipArchive();

        $fileName =  $uploadfile.".zip";
        $zip->open($fileName, ZIPARCHIVE::CREATE);

        $zip->addFile($uploadfile.".zip", $uploadfile);

        $zip->close();
    */
    echo 'Книга добавлена!';

}


download_doc();
?>