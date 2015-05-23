
<?
echo"<link rel='stylesheet' type='text/css' href='Our.css'>";
class discussion{

function id_discussion($id_discussion)
{
    echo"<link rel='stylesheet' type='text/css' href='discussion.css'>";
    echo "<script>
        discussion_time='0000-00-00 00:00:00';
        $('.show_mess').jScrollPane({showArrows:true,scrollbarWidth:16,arrowSize:16});
    </script>";

include("bd.php");
$res = mysql_query("select * from author natural join author_book natural join janr natural join book where id_book = $id_discussion");
$d = mysql_fetch_array($res);
$book_info = $d['book_info'];
$book_name = $d['book_name'];
$name_author = $d['name_author'];
$janr_name=$d['janr_name'];


echo"
<div class='box_discussion'>
     <p align=center style='font-size:17pt;'>".'Обсуждение'."</p>
	<div class='book_info'>
		<img class='cover'>
		<br>

    <table  width='750' style='margin-left: 20px;'>
        <tbody>
            <tr>
                <td width='60' rowspan='10'><img src='".$d['file_ob']."' style='width: 100px;'></td>
                <td width='200' height='10'><p style='font-size: 12px; font-style: italic;'>Название:".$d['book_name']."</p></td>
                <td width='150' height='10' class='button1'><a class='read' id='read'  onclick=read_book(".$d['id_book'].")  title=".'Читать'." >Чтение</a></td>
                <td width='560' height='10' > </td>

            </tr>
            <tr><td><p style='font-size: 12px; font-style: italic;'>Автор:".$d['name_author']."</p></td><td class='button1' height='10'><a href='".$d['file'].".zip' title=".'Скачать'.">Скачать</a></td></tr>
	        <tr><td><p style='font-size: 12px; font-style: italic;'>Колво. стр.: ".$d['col_str']."</p></td><td height='10'></td></tr>
	        <tr><td><p style='font-size: 12px; font-style: italic;'>Жанр: ".$d['janr_name']."</p></td></tr>
	        <tr><td><p style='font-size: 12px; font-style: italic;'>Год: ".$d['date_books']."</p></td></tr>
	        <tr><td><p> </p></td></tr>

        </tbody>
        </table>
        <p style='font-size: 12pt; font-style: italic; text-align: center;'> Краткое описание</p>
        <div class='p_div'><p style='font-size: 12px; font-style: italic;'>
        ".$d["book_info"]."
        </p>

        </div>
	</div>

	<div class='discussion_mess'>
		<div class='show_mess'>";

			$res = mysql_query("select * from discussion where id_book=$id_discussion");
		while ($d=mysql_fetch_array($res)){

            echo"
            <div class='box_mess'>
				<div>
				".$d['']."
				</div>
				<div class='mess'>
				".$d['discussion_mess']."
				<br>
				<div class='time'>
				".$d['discussion_time']."
				</div>
				</div>
			</div>
			<script>
			    discussion_time='".$d['discussion_time']."'
			</script>";

        }

    echo"
        <script>
        id_book=$id_discussion;
        function new_discussion(){
        $.ajax({
            type: 'POST',
            url:  'discussion.php',
            data: {discussion_time:discussion_time,id_book:id_book},
            success: function(html)
            {
                //$('body.start').empty();
                // $('textarea.know_mes').val('');
                $('div.show_mess').append(html);

                // $('#messages').scrollTop(90000);
            }
});
}
setInterval(new_discussion,6000);
</script>
";

			
		echo "</div> 
		<div class='add_mess'>
			<textarea class='discussion_txt' style='margin: 2px; width: 836px; height: 70px; resize: horizontal; resize: vertical; max-height: 300px;'></textarea>
			<button onclick='add_mess()'>Отправить</button>
		<script>
		    function add_mess()
		    {
		        $.ajax({
		        type: 'POST',
                url:  'discussion.php',
                data: {add_mess:$('textarea.discussion_txt').val(), id_book:$id_discussion},

                success: function(html)
                {
                    $('textarea.discussion_txt').val('');
                }
		        })
		    }
		</script>
		</div>

	</div>

<div>";

}

    function new_discussion()
    {
        include('bd.php');
        $id_discussion=$_POST['id_book'];
        $time=$_POST['discussion_time'];
        $login=$_SESSION['login'];
        $res = mysql_query("select * from discussion where id_book=$id_discussion
        and discussion_time>'$time' order by discussion_time");
        while ($d=mysql_fetch_array($res))

            echo"
            <div class='box_mess'>
                <div>
                ".$d['login']."
                </div>
				<div class='mess'>
				".$d['discussion_mess']."
				<br>
				<div class='time'>
				".$d['discussion_time']."
				</div>
				</div>
			</div>
			<script>
			    discussion_time='".$d['discussion_time']."'
			</script>";
    }

    function add_mess()
    {
        session_start();
        $id_discussion=$_POST['id_book'];
        $mess=$_POST['add_mess'];
        $id_user=1; //$_SESSION['id'];
        include('bd.php');
        $res=mysql_query("INSERT INTO `discussion`(`id_book`, `id_user`, `discussion_time`, `discussion_mess`) VALUES ($id_discussion, $id_user, NOW(),'$mess')");
    }

    function discussion()
    {
        if (isset($_POST['discussion_time'])) $this->new_discussion();
        else
        if (isset($_POST['add_mess'])) $this->add_mess();
     else
        if (isset($_POST['id_book']))
         $this->id_discussion($_POST['id_book']);
    }

}
new discussion ();
?>
