
<?

class discussion{

function id_discussion($id_discussion)
{
    echo"<link rel='stylesheet' type='text/css' href='discussion.css'>";
    echo "<script>
        discussion_time='0000-00-00 00:00:00';
    </script>";

include("bd.php");

$res = mysql_query("select * from author natural join author_book natural join book where id_book = $id_discussion");
$d = mysql_fetch_array($res);
$book_info = $d['book_info'];
$book_name = $d['book_name'];
$name_author = $d["name_author"];


echo"
<div class='box_discussion'>
	<div class='book_info'>
		<img class='cover'>
        <table>

        <tr><td rowspan='3'> <img src='book.png'></td><td colspan='2'><p>Название:".$d['book_name']."</p></td><td  class='button'><button class='read' id='read'  onclick=read_book(".$d['id_book'].")  title=".$d['id_book']." >Читать</button></td></tr>
        <tr><td colspan='2'><p>Автор:".$d['name_author']."</p></td><td class='button'><button href='".$d['file']."'>Скачать</button></td></tr>
        <tr><td colspan='2'><p>Колво. стр.: 145</p></td></tr>
        </table>
	<div class='p_div'><p class='about'>
        ".$d["book_info"]."
        </p>

        </div>
	</div>

	<div class='discussion_mess'>
		<div class='show_mess'>";

			$res = mysql_query("select * from discussion where id_book=$id_discussion");
		while ($d=mysql_fetch_array($res)){

        echo"<div class='box_mess'>
				<div class='mess'>
				".$d['discussion_mess']."

				</div>

			</div>
			<script>
			    discussion_time='".$d['discussion_time']."';

			</script>";

        }

    echo"
        <script>
        function new_discussion(){
        $.ajax({
            type: 'POST',
            url:  'discussion.php',
            data: {discussion_time:discussion_time,id_book:$id_discussion},
            success: function(html)
            {
                //$('body.start').empty();
                // $('textarea.know_mes').val('');
                $('div.show_mess').append(html);
                // $('#messages').scrollTop(90000);
            }
});
}
setInterval(new_discussion, 2000);
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
        $res = mysql_query("select * from discussion where id_book=$id_discussion
        and discussion_time>'$time' order by discussion_time");
        while ($d=mysql_fetch_array($res))

            echo"<div class='box_mess'>
				<div class='mess'>
				".$d['discussion_mess']."

				</div>
			<script>
			    discussion_time='".$d['discussion_time']."';

			</script>
			</div>";
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
