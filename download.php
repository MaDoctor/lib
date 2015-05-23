



<?

class download{

    function download(){}

    function download_book()
    {
        echo'
<script type="text/javascript" src="js/jquery-1.3.2.js" ></script>
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
<script>  var  flag=0;</script>
<link rel="stylesheet" type="text/css" href="./download.css">
<meta charset="utf-8">
<div class="d_d_b">
<p align="center">Меню для загрузки книги.</p>
<form id="zagr" accept-charset="utf-8">
    <div id="statusA" style="
    width: 540px;
                    -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
                    -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
                    box-shadow: 0 0 50px transparent, inset 0 0 10px rgb(0, 0, 0);
                    margin: 4px;
                    padding: 4px;
                    padding-top: 0px;

                    -moz-transition: all .5s linear;
                    -o-transition: all .5s linear;
                    -webkit-transition: all .5s linear;
                    ">
    </div>
<ul class="janr">
<li class="janrs">
Жанр книги:';
$this->add_janr();
        echo'
</li>
   <li a onclick="add_janr()" class="add_janr" style="cursor: hand">+</a></li>
<script>
    function add_janr()
    {

$.ajax({
            type: "POST",
            url:  "download.php",
            data: "add_janr=ok",
            success: function(html)
            {
                $("li.janrs").append(html);

            }
});
    }
</script>
</ul>

<script>





                        function statusA()
                        {
                        if (flag===1)
                            $.ajax({

                             type: "POST",
                             url:  "upload.php",
                             data: $("form#zagr").serialize(),
                             success: function(dat)
                             {

                                 $("div#statusA").empty();
                                 $("div#statusA").append(dat);
                             }
                             });else
                             alert("Не выбран файл");
}
</script>

<br>
<!-------------------------------------------------Обложка-------------------------------------------------------------------------->
    Обложка:<input type="text" name="uploadfileob" value="" style="margin-left: 5px;">
    <input class="button1" onclick="uploadob()" type="button" id="uploadfileob"  value="Upload File" style="cursor: hand">
        <script>

	function uploadob(){
		var btnUploadob=$("#uploadfileob");
		var statusob=$("input[name=uploadfileob]");
		new AjaxUpload(btnUploadob, {
			action: "upload-file-ob.php",
			name: "uploadfileob",
			onSubmit: function(file, jpg){
				 if (! (jpg && /^(jpg)$/.test(jpg))){
                    // extension is not allowed
					statusob.val("Only jpg files are allowed");
					return false;
				}
				statusob.text("Uploading...");
			},
			onComplete: function(file, responseob){
				//On completion clear the status
				statusob.text("");
				//Add uploaded file to list
				if(responseob==="successob"){
					flag=1;
					$("input[name=uploadfileob]").val("./book/jpg/"+file);
				} else{
					flag=0;

					$("input[name=uploadfileob]").val("WSE TRLEN");
				}
			}
		});

	}
</script>
<br>
<!-------------------------------------------------Книга-------------------------------------------------------------------------->
    Файл:<input type="text" name="uploadfile" value="" style="margin-left: 36px;">
    <input class="button1" onclick="upload()" type="button" id="uploadfile"  value="Upload File" style="cursor: hand">

    <script>

	function upload(){
		var btnUpload=$("#uploadfile");
		var status=$("input[name=uploadfile]");
		new AjaxUpload(btnUpload, {
			action: "upload-file.php",
			name: "uploadfile",
			onSubmit: function(file, ext){
				 if (! (ext && /^(txt)$/.test(ext))){
                    // extension is not allowed
					status.val("Only txt files are allowed");
					return false;
				}
				status.text("Uploading...");
			},
			onComplete: function(file, response){
				//On completion clear the status
				status.text("");
				//Add uploaded file to list
				if(response==="success"){
					flag=1;
					$("input[name=uploadfile]").val("./book/txt/"+file);
				} else{
					flag=0;

					$("input[name=uploadfile]").val("WSE TRLEN");
				}
			}
		});

	}
</script>
    <br>
    <div>
<!-------------------------------------------------Автор, Название, Описание, Год-------------------------------------------------------------------------->
    Автор:<input type="text" name="name_author" style="margin-left: 30px;"><br>
    Название:<input type="text" name="book_name"><br>
    Год:<input type="text" maxlength="4" onkeyup="this.value=parseInt(this.value) | 0" name="date_books" style="margin-left: 50px;"><br>
    Описание:<br><textarea name="book_info"></textarea><br>
    <input class="kn_poisk" onclick="statusA()" type="button" value="Загрузить">
    </div>
    </form>


    </div>';

    }

    function add_janr(){
        echo'
        <select name="janr[]">';

        include("bd.php");
        $res= mysql_query("SELECT * FROM `janr`");

        while($d=mysql_fetch_array($res)){
            echo "<option value='".$d['id_janr']."'>".$d['janr_name']."</option>";
        }

        echo'
</select>';
    }
}

$d  = new download();
if (isset($_POST[add_janr]))
$d->add_janr();
else $d->download_book();


?>